/*TODO: Fix "Script error"*/
/*TODO: Test both async functions to see if they work (after no more bugs)*/

let bookRec = document.getElementById("bookRec");

/* create a variable fetch using the library isomorphic-fetch */
const fetch = import('isomorphic-fetch');

/* started to use this tutorial but then paused: https://replit.com/talk/learn/Get-started-with-Web-Scraping/8930 */
// const express = import('express');
// const app = express();

/* fetch from a json file and return a string of whatever is inside fetch('') */
(async () => {
  try {
  const response = await fetch('www.google.com');
  const json = await response.json();
  console.log(JSON.stringify(json));
  } catch {
    console.log("error");
  }
})()

/* fetch from the html of a webpage and return a strong of whatever matches with the regular expression */
(async () => {
  try {
    const response = await fetch('example');
    const text = await response.text();
    console.log(text.match(/(?<=\<h1>).*(?=\<\/h1>)/));
    // console.log()
  } catch {
    console.log("error");
  }
})()

/* change the innerHTML of where the bookRec id is*/
bookRec.innerHTML = JSON.stringify(json);
bookRec.innerHTML = "booktitle";
