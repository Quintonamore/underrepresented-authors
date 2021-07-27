
console.log("background running");

chrome.runtime.onMessage.addListener(function(response, sender, sendResponse) {
  console.log(response);
});

//Gets info array bookRecs from content script
