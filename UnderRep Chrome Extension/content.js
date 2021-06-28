//checks if loaded page says "books", "library", or any genera of book
  //can change to be only certain urls
  //don't want to run on things like google docs

//Working on causing this to trigger popup

const wordList = ['fiction', 'non-fiction', 'nonfiction', 'comedy', 'drama', 'fantasy', 'horror',
'mystery', 'romance', 'thriller', 'sci fi', 'sci-fi', 'action'];

const bookRecs = [];

//"action" shows up on every google page need a fix

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
    chrome.runtime.sendMessage({bookRecs});
    alert('We have book recommendation for you!\nPlease click the BIPOC authors extension to see them!');
  }

} catch (err) { //catches any errors
  console.log(err);
}

//Add button where you can suggest books to the website
