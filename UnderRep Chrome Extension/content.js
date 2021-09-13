

//checks if loaded page has the following words

/*const wordList = ['fiction', 'non-fiction', 'nonfiction', 'comedy', 'drama', 'fantasy', 'horror',
'mystery', 'romance', 'thriller', 'sci fi', 'sci-fi', 'action'];

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
*/
  /*
    Gives alert if a word in wordList
    --excluding "action"--shows up on the current webpage
    "action" doesn't always reference the genre
      if statement catches that
  */
  /*if(!(bookRecs.length == 1 && bookRecs.includes("action")) && bookRecs.length > 0) {

    chrome.runtime.sendMessage({bookRecs});
	// turns the bookRecs array into a json format we can send with xhr to the php file
	var jsonString = JSON.stringify(bookRecs);
	// turns the bookRecs array into a json format we can send with xhr to the php file
	var jsonString = JSON.stringify(bookRecs);*/


    /*Adds html for book recommendation popup to current page */
    /*var elem = document.createElement('div');
    elem.class = 'book_popup';*/
	/* sends the array of genres we found to a php file that does a query on the database and returns a responce */
	//const xhr = new XMLHttpRequest();
	/* after the request is loaded it executes this code which creates the popup,
	the this.repsoncetext is the books the database found that matches the genre list*/

	/*xhr.onload = function(){
    elem.innerHTML =`
    <div class='pop_iframe' id='draggable_frame'>
      <div id='move-area'><label>+</label></div>
  <iframe id='iframe_for_pop' class='iframe_for_pop_class' scrolling='no' frameBorder='0'
  srcdoc="<html>

            <body>
              <div class='accordion' id='accordion'>
              <!--Script for arrow-->

                <input type='checkbox' name='popup_accordion' id='popup_ac' class='accordion__input'>
                <label for='popup_ac' class='accordion__label'>Book Recommendations</label>



              <!--Content of popup-->

                <div class='accordion__content'>
                  <div class='recom-pop' id='recom-pop'>

                    <div class='vertical-menu'>
                      <input type='button' value='&times;' id='close-btn' class='close-btn' aria-label='Dismiss alert' >`+ this.responseText +`






                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </body>
            <style>

              @import url('https://fonts.googleapis.com/css?family=Montserrat:400,700&display=swap');*/

              /*Stylizing accordion*/
              /*.accordion{
                max-width: 600px;
                max-height: 650px;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
                border-radius: 5px;
                overflow: hidden;
                font-family: 'Montserrat', sans-serif;
                background: #946B2D;
                display: block;
                z-index: 10000;
               }

               .accordion__label, .accordion__content{
                 padding: 14px 20px;
                }
*/

                 /*Stylizing label*/
                /* .accordion__label{
                   display: block;
                   color: white;
                   font-weight: 500;
                   font-size: 20px;
                   cursor: pointer;
                   text-align: center;
                   width: 400px;
                   transition: background 0.1s;
                }


                .accordion__label:hover{
                  background: rgba(0, 0, 0, 0.1);
                }
*/

                  /*Makes dropdown work when clicked*/
  /*                .accordion__input{
                    display: none;

                 }

                 .accordion__input:checked ~ .accordion__content{
                   display: block;
                 }
*/

                 /*Stylizing content*/
  /*               .accordion__content{
                    background: white;
                    line-height: 1.6;
                    font-size: 0.85em;
                    display: none;
                  }
/*
                  /*Scroll wheel for popup*/
/*                  .vertical-menu{
                    width: 400px;
                    height: 500px;
                    overflow-y: auto;
                    text-align: center;
                  }

                  .book-theme{
                    font-size: 20px;

                  }*/

                  /*close button style*/
                /*  .close-btn {
                    border: .6px solid white;
                    padding: 5px;
                    font-size: 20px;
                    cursor: pointer;
                    color: grey;
                    transition: 0.5s;
                    float: right;
                    background:white;
                  }

                  .close-btn:hover{
                    color: black;
                  }
*/
                  /*Book info style*/
              /*    .title1, .title2, .title3, .author1, .author2, .author3, .genre1, .genre2, .genre3, .ISBN1, .ISBN2, .ISBN3{
                    font-family: 'Montserrat', sans-serif;
                    font-size: 15px;
                    text-align:left;
                    right: 20px;

                  }


                  .image1, .image2, .image3{
                    border: 5px solid white;
                    float:left;
                  }*/

                  /*Description style*/
                /*  .description1, .description2, .description3{
                    font-family: 'Montserrat', sans-serif;
                    font-size: 15px;
                    text-align: left;
                  }




            </style>

            <!--Changes the iframe's height based on if accordion is open or closed-->
            <script>
              var checkbox = document.querySelector('input[type=checkbox]');
              const frame = parent.document.getElementById('draggable_frame');
              checkbox.addEventListener('change', function(){
                if(this.checked){
                  frame.style.height = '590px';
                } else {
                  frame.style.height = '65px';
                }
              });


            </script>
            <!--Makes sure iframe closes and the user can click around page after-->
            <script>
              var closebtn = document.getElementById('close-btn');
              closebtn.addEventListener('click', function(e){
                var d = parent.document;
                var frame = d.getElementById('draggable_frame');
                frame.remove();
              });
            </script>

          </html>"
   ></iframe>
  <style>
    .pop_iframe{
      overflow:none;
      width:450px;
      height:65px;
      position: absolute;
      top: 3rem;
      right: 1rem;
      z-index: 100000;
    }

    #move-area{
      font-size:15px;
      cursor:move;
    }

    #iframe_for_pop{
      width:100%;
      height:100%;
      text-align:center;
      margin:0;
      padding:0;
      overflow:hidden;
      border-radius: 5px;
    }
  </style>
</div>
<script>
  dragElement(document.getElementById('draggable_frame'));

  function dragElement(elem){
    var pos1 = 0, pos2 = 0, pos3 = 0, pos4 = 0;
    if(document.getElementById('move-area')) {
      document.getElementById('move-area').onmousedown = dragMouseDown;
    } else {
      elem.onmousedown = dragMouseDown;
    }

    function dragMouseDown(e) {
      e = e || window.event;
      e.preventDefault();
      pos3 = e.clientX;
      pos4 = e.clientY;
      document.onmouseup = closeDragElement;
      document.onmousemove = elementDrag;

    }

    function elementDrag(e){
      e = e || window.event;
      e.preventDefault;
      pos1 = pos3 - e.clientX;
      pos2 = pos4 - e.clientY;
      pos3 = e.clientX;
      pos4 = e.clientY;
      elem.style.top = (elem.offsetTop - pos2) + 'px';
      elem.style.left = (elem.offsetLeft - pos1) + 'px';
    }

    function closeDragElement(){
      document.onmouseup = null;
      document.onmousemove = null;
    }
  }

</script>
    `;
    document.body.appendChild(elem);
	};
	// the file we are sending to edit if you use a diffrent port for your mysql sever default option is http://localhost/
	xhr.open("POST", "https://ua.quinton.pizza/Extention.php");
	xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	// the array we are sending which is a json string version of bookrecs
	xhr.send( jsonString);

    //Change content of page to html

  }


} catch (err) { //catches any errors
  console.log(err);
}*/







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
