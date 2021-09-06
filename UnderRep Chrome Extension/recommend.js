var cid = chrome.runtime.id;
var stylesheet = document.getElementById('stshe');
stylesheet.href = "chrome-extension://"+ cid +"/recommendStyle.css";


//Sends message to content script if accordion is opened or closed
var checkbox = document.querySelector('input[type=checkbox]');
checkbox.addEventListener('change', function(){
  parent.postMessage(this.checked, '*');
});


//Sends message to content script is close button is clicked
var closebtn = document.getElementById('close-btn');
closebtn.addEventListener('click', function(){
  parent.postMessage("my-close-btn", '*');
});

//Listens for result of database call and adds result to recommend html
window.addEventListener("message", function(evt){
  var elm = document.createElement('div');
  var div = document.getElementById('pop_info');
  elm.innerHTML = evt.data;
  div.appendChild(elm);
})
