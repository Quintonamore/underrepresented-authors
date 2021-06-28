//initialize extension on installation
/*chrome.runtime.onInstalled.addListener(function() {
  chrome.contextMenus.create({
    "id": "sampleContextMenu",
    "title": "Sample Context Menu",
    "contexts": ["selection"]
  });
});*/

console.log("background running");

//Gets info array bookRecs from content script
chrome.runtime.onMessage.addListener(function(response, sender, sendResponse) {
  console.log(response);
});
