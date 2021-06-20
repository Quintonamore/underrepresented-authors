//initialize extension on installation
chrome.runtime.onInstalled.addListener(function () {
  chrome.contextMenues.create({
    "id": "sampleContextMenu",
    "title": "Sample Context Menu",
    "contexts": ["selection"]
  });
});

