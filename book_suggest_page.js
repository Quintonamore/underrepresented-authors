
/*
  Creates the requirements the user must complete before the form is able to submit
*/

const title = document.getElementById('bookTitle');
const author = document.getElementById('bookAuthor');
const isbn = document.getElementById('bookISBN-13');
const theme = document.getElementById('theme-sel');
const form = document.getElementById('form-info');

form.addEventListener('submit', (e) => {
  let messages = [];

  /*
    If the user doesn't fill in the title text box an error message will show
    and tell the user to fill in the text box
  */
  if(title.value == '' || title.value == null){
    const titleError = document.getElementById('title--error');
    messages.push(titleError);
    title.style.color = "#d50000";
    title.style.background = "#fff8f8";
  }

  /*
    If the user doesn't fill in the author text box an error message will show
    and tell the user to fill in the text box
  */
  if(author.value == '' || author.value == null) {
    const authorError = document.getElementById('author--error');
    messages.push(authorError);
    author.style.color = "#d50000";
    author.style.background = "#fff8f8";
  }

  /*
    If the user fills in the isbn text box, the input must be 13 digits long.
    Otherwise, an error message will show and the user will notify the user
    the required format for the isbn.
  */
  if(isNaN(isbn.value) || (isbn.value.length != 13 && isbn.value.length !=0) || isbn.value.includes('.')){
    const isbnError = document.getElementById('isbn-error');
    messages.push(isbnError);
    isbn.style.color = "#d50000";
    isbn.style.background = "#fff8f8";
  }

  /*
    If the user doesn't select a book theme an error message will show
    and ask the user to choose one of the themes.
  */
  if(theme.selectedIndex <= 0) {
    const themeError = document.getElementById('theme--error');
    messages.push(themeError);
    theme.style.color = "#d50000";
    theme.style.background = "#fff8f8";
  }

  /*
    If there are any error messages to be shown they will become visible for the user
    and prevent the user from submitting the form.
    Otherwise the form will submit and tell the user the recommendation was recieved.
  */
  if(messages.length > 0) {
    e.preventDefault();
    messages.forEach(function(error){
      error.style.visibility = "visible";
    });
  } else {
    addEventListener("submit", function(){
      //const pop_form = document.getElementById('form-info');
      var formData = new FormData(form);
      req = new XMLHttpRequest();
      req.open("POST", "https://ua.quinton.pizza/saveForm.php");
      req.send(formData);
      alert('Thank you! We recieved your book recommendation!');
    })
  }

});
