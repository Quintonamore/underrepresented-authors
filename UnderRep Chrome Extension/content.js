//checks if loaded page says "books", "library", or any genera of book
  //can change to be only certain urls
  //don't want to run on things like google docs

//Working on causing this to trigger popup

const wordList = ['fiction', 'non-fiction', 'nonfiction', 'comedy', 'drama', 'fantasy', 'horror',
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

  /*
    Gives alert if a word in wordList
    --excluding "action"--shows up on the current webpage
    "action" doesn't always reference the genre
      if statement catches that
  */
  if(bookRecs.length > 0 && !(bookRecs.length == 1 && bookRecs.includes("action"))) {
    //alert('We have book recommendation for you!\nPlease click the under represented authors extension to see them!');

    chrome.runtime.sendMessage({bookRecs});



    /*Adds html for book recommendation popup to current page */

    var elem = document.createElement('div');
    elem.id = 'popup_id';
    var shadowRoot = elem.attachShadow({mode: 'open'});
    shadowRoot.innerHTML = `
    <div class="recom-pop" id="recom-pop">
      <input type="button" value="&times;" id="close-btn" class="close-btn"
      onclick="function closepop(){
        document.getElementById('recom-pop').style.display = 'none';
      } closepop();">

      <h2 class="pop_h2">Book Recommendations</h2>
      <h3 class="pop_h3">Demo</h3>
      <hr>
      <br>

      <!--Content of popup-->
      <div class="book-theme">
        <h3>LGBTQ+</h3>
        <div class="vertical-menu">
          <img src="https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1604597893l/53802072._SX318_.jpg" alt="Some Girls Do (Cover)" width="200" height="330" class="image1">
          <p class = "title">Title: <a href="https://www.goodreads.com/book/show/53802072-some-girls-do" target = "_blank">Some Girls Do</a></p>
          <p class = "author">By: Jennifer Dugan</p>
          <p class = "genre">Genre: Romance</p>
          <p class = "ISBN">ISBN-13: 9780593112533</p>
          <br>
          <img src = "https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1601312585l/53180089.jpg" alt = "Meet Cute Diary (Cover)" width= "200" height="330" class="image2">
          <p class = "title">Title: <a href="https://www.goodreads.com/book/show/53180089-meet-cute-diary" target = "_blank">Meet Cute Diary</a></p>
          <p class = "author">By: Emery Lee</p>
          <p class = "genre">Genre: Romance</p>
          <p class = "ISBN">ISBN-13: 9780063038837</p>
        </div>
      </div>
      <style>
        /*Style for whole popup*/
        .recom-pop{
          text-align: center;
          position: absolute;
          top: 1rem;
          right: 1rem;
          background-color: white;
          border: 1px solid black;
          border-radius: 10px;
          z-index: 10000;
          font-family: "Times New Roman", Times, serif;

        }

        .pop_h2{
          font-family: "Times New Roman", Times, serif;
        }

        .pop_h3{
          font-family: "Times New Roman", Times, serif;
        }

        /*Scroll wheel for popup*/
        .vertical-menu{
          width: 400px;
          height: 550px;
          overflow-y: auto;
        }

        .close-btn {
          border: .6px solid white;
          padding: 10px;
          position: absolute;
          top: 1rem;
          right: 1rem;
          font-size: 1rem;
          cursor: pointer;
          transition: .5s;
        }

        .close-btn:hover{
          background: steelblue;
        }

      </style>
    </div>
    `;

    document.body.appendChild(shadowRoot);

    chrome.runtime.sendMessage({bookRecs});

    //Change content of page to html

  }


} catch (err) { //catches any errors
  console.log(err);
}
