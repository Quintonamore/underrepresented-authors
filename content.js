//checks if loaded page says "books", "library", or any genera of book
  //can change to be only certain urls
  //don't want to run on things like google docs


const wordList = ['genre', 'genres', 'fiction', 'novel',
'non-fiction', 'nonfiction', 'action', 'comedy', 'drama', 'fantasy', 'horror',
'mystery', 'romance', 'thriller', 'sci fi', 'sci-fi'];

var word = "";
var wordMatches = 0;
var count = 0;
var index = 0;

//loops through wordList array to see if certain words appear on current site
try {
  while(index < wordList.length) {

    var curWord = wordList[index];
    word = new RegExp(curWord, 'gi');
    wordMatches = document.documentElement.innerHTML.match(word);

    if(wordMatches != null && wordMatches.length > 0) {
      console.log(wordList[index]);
    }
  index++;
}
} catch {
  console.log("error");
}

