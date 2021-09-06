const wordList = ['fiction', 'non-fiction', 'nonfiction', 'comedy', 'drama', 'fantasy', 'horror',
'mystery', 'romance', 'thriller', 'sci fi', 'sci-fi', 'action', 'autobiography', 'biography'];

const bookRecs = [];


var word = "";
var wordMatches, count, index = 0;

//loops through wordList array to see if certain words appear on current site
try {
  while(index < wordList.length) {

    var curWord = wordList[index];
    word = new RegExp(curWord, 'gi');
    wordMatches = document.documentElement.innerHTML.match(word);

    if(wordMatches != null && wordMatches.length > 0) {
      console.log(curWord);
      bookRecs.push(curWord);
    }
    index++;
  }

  /*
    Gives alert if a word in wordList
    --excluding "action"--shows up on the current webpage
    "action" doesn't always reference the genre
      if statement catches that
  */
  if(!(bookRecs.length == 1 && bookRecs.includes("action")) && bookRecs.length > 0) {
    //alert('We have book recommendation for you!\nPlease click the under represented authors extension to see them!');

    chrome.runtime.sendMessage({bookRecs});
  	// turns the bookRecs array into a json format we can send with xhr to the php file
  	var jsonString = JSON.stringify(bookRecs);
  	// turns the bookRecs array into a json format we can send with xhr to the php file
  	var jsonString = JSON.stringify(bookRecs);


  	/* sends the array of genres we found to a php file that does a query on the database and returns a responce */
  	const xhr = new XMLHttpRequest();
  	/* after the request is loaded it executes this code which creates the popup,
  	the this.repsoncetext is the books the database found that matches the genre list*/


  	xhr.onload = function(){
      var cid = chrome.runtime.id;

      //Makes div to put iframe in
      var elem = document.createElement('div');
      elem.id = "draggable_frame";

      //Makes Iframe
      var iframe = document.createElement('iframe');
      iframe.id = "iframe_for_pop";
      iframe.class = "iframe_for_pop_class";
      iframe.name = "frame";
      iframe.scrolling = "no";
      iframe.frameBorder = "0";
      iframe.src = "chrome-extension://" + cid + "/recommend.html";
      iframe.setAttribute("style", "width:450px; height:65px; position: absolute; top:3rem; right:1rem; z-index:100000;text-align:center; margin:0; padding:0; overflow:hidden; border-radius: 5px;");

      elem.appendChild(iframe);
      document.body.appendChild(elem);

      //Listens for messages from scrips
      addEventListener("message", function(event){
        //Makes sure message is from correct origin
        if(event.origin == 'chrome-extension://' + cid){
          //checks if message is from close button
          //  if it is iframe closes on click
          if(event.data == "my-close-btn"){
            var div = parent.document.getElementById('draggable_frame');
            div.remove();
          }

          //checks if message is from checkbox
          //  if it is and the message is true iframe height is set to 590px
          //  otherwise the iframe height is set to 65px
          const frame = document.getElementById('iframe_for_pop');
          if(event.data == true){
            frame.style.height = '590px';
          } else if(event.data == false) {
            frame.style.height = '65px';
          }
        }
      })

      //Sends requested database info to the popup's script (recommend.js)
      const mes = this.responseText;
      var frame = document.getElementById('iframe_for_pop');
      window.addEventListener('load', (event) => {
        frame.contentWindow.postMessage(mes, 'chrome-extension://' + cid);
      });

  	};
  	// the file we are sending to edit if you use a diffrent port for your mysql sever default option is http://localhost/
    xhr.open("POST", "https://ua.quinton.pizza/Extention.php");
	  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  	// the array we are sending which is a json string version of bookrecs
  	xhr.send( jsonString);

  }

} catch (err) { //catches any errors
  console.log(err);
}