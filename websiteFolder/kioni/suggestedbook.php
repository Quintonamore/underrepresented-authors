<?php
session_start();
require('db.php');
?>
<html>
<head>
<?php
if(isset($_SESSION['darkmode'])){ 
echo '<link rel="stylesheet" href="darkstyle.css">';
}else{
echo '<link rel="stylesheet" href="style.css">';
}
 ?>
</head>
<body>
<?php

unset($_SESSION['favVisit']);

//for regular user
if (isset($_SESSION['inDB']) && isset($_SESSION['user']) && $_SESSION['inDB'] && isset($_SESSION['regUser'])) {
  echo "<div class='dropdown'> <button class='dropbtn'>" . $_SESSION['user'] . "</button> <div class='dropdown-content'>
  <a href='favorites.php'>My Favorites</a>
  <a href='logout.php'>Logout</a>
  <a href='darkmode.php'>Dark Mode </a>
  </div>
  </div> ";   
} 
else{
  //for admin
  if (isset($_SESSION['inDB']) && isset($_SESSION['user']) && $_SESSION['inDB'] && isset($_SESSION['adminUser'])) {
      echo "<div class='dropdown'> <button class='dropbtn'>" . $_SESSION['user'] . "</button> <div class='dropdown-content'>
      <a href='review.php'>Review Suggestions</a>
      <a href='favorites.php'>My Favorites</a>
      <a href='logout.php'>Logout</a>
      <a href='darkmode.php'>Dark Mode </a>
      </div>
      </div> ";   
  } 
  else {
      echo "<div class='dropdown'> <button class='dropbtn'>Account</button> <div class='dropdown-content'>
      <a href='login.php'>Log In</a>
      <a href='createAccount.php'>Sign Up</a>
      <a href='darkmode.php'>Dark Mode </a>
      </div>
      </div> ";
  }

}
?>
<div class = "title">
    Suggest A Book
</div>
<?php
    //if reg user 
    if(isset($_SESSION['regUser'])){
        echo "<div class=\"buttonArea\">
        <a href=\"home.php\" class=\"button\">Home</a>
        <a href=\"bestSellers.php\" class=\"button\">Our Best-Sellers</a>
        <a href=\"suggestedbook.php\" class=\"button\">Suggest A Book</a>
        <a href=\"tutorial.php\" class=\"button\">Tutorial</a>
        <a href=\"about.php\" class=\"button\">About Us</a>
        </div>";
    }
    else{

        echo "<div class=\"buttonArea\">
        <a href=\"home.php\" class=\"button\">Home</a>
        <a href=\"bestSellers.php\" class=\"button\">Our Best-Sellers</a>
        <a href=\"tutorial.php\" class=\"button\">Tutorial</a>
        <a href=\"about.php\" class=\"button\">About Us</a>
        </div>";
    }
    ?>

<div class = "text">
    <!--From Info Section-->
    <form action="saveForm.php" method="POST" id="form-info" autocomplete="off">
      <!--Quick Note-->
      <p><b>Note:</b> We only accept books by someone from an underrepresented group or about an underrepresented group.</p><br><br>
        <!--First half asking for basic book info-->
        <label for="bookTitle">* Title:</label>
        <input type="text" id="bookTitle" autocomplete="off" name= "title"></input><br>
      <span class="form__error" id="title--error">Please enter the book's title.</span>
      <br><br>

       <label for="bookAuthor">* Author:</label>
        <input type="text" id="bookAuthor" autocomplete="off" placeholder="FristName LastName" name= "author"></input><br>
     <span class="form__error" id="author--error">Please enter the author's first and last name.</span>
     <br><br>


    <!--Book ISBN-->
     <label for="bookISBN-13">ISBN-13:</label>
    <input type="integer" id="bookISBN-13" autocomplete="off" name="isbn" placeholder="123" ></input><br>
    <span class="form__error" id="isbn-error">ISBN must be 13 digits long.</span>
    <br><br>


  <!--Book Length-->
  <div class="length-select">
        Book Length:
        <select class="length-sel" id="length-sel" class="sel" name="bookLength">
          <option value="">Unknown</option>
          <option value="Novel">Novel</option>
          <option value="Poem">Poem</option>
          <option value="Short Story">Short Story</option>

        </select>
      </div> <br> <br>

  <!--Genres-->
  <div class="genres">
    <label>Genre(s):</label>
    <ul>

      <li>
        <input type="checkbox" id="genre1" name="genre[]" value="autobiography"></input>
        <label for="genre1" class="check-word">Autobiography</label><br><br>
        <span class="checkmark"></span>
      </li>

    <li>
        <input type="checkbox" id="genre2" name="genre[]" value="biography"></input>
        <label for="genre2" class="check-word">Biography</label><br><br>
        <span class="checkmark"></span>
      </li>

     <li>
        <input type="checkbox" id="genre3" name="genre[]" value="fiction"></input>
        <label for="genre3" class="check-word">Fiction</label><br><br>
        <span class="checkmark"></span>
      </li>

      <li>
        <input type="checkbox" id="genre4" name="genre[]" value="sci-fi"></input>
        <label for="genre4" class="check-word">Sci-Fi</label><br><br>
        <span class="checkmark"></span>
      </li>

      <li>
        <input type="checkbox" id="genre5" name="genre[]" value="fantasy"></input>
        <label for="genre5" class="check-word">Fantasy</label><br><br>
        <span class="checkmark"></span>
      </li>

      <li>
        <input type="checkbox" id="genre6" name="genre[]" value="mystery"></input>
        <label for="genre6" class="check-word">Mystery</label><br><br>
        <span class="checkmark"></span>
      </li>

      <li>
        <input type="checkbox" id="genre7" name="genre[]" value="thriller"></input>
        <label for="genre7" class="check-word">Thriller</label><br><br>
        <span class="checkmark"></span>
      </li>

      <li>
        <input type="checkbox" id="genre8" name="genre[]" value="romance"></input>
        <label for="genre8" class="check-word">Romance</label><br><br>
        <span class="checkmark"></span>
      </li>
    </ul>
  </div>

      <!--Book Theme-->
      <div class="theme-select">
        * Book Theme:
          <select id="theme-sel" name="bookTheme">
          <option value="">-----</option>
          <option value="BIPOC">BIPOC</option>
          <option value="LGBTQ+">LGBTQ+</option>
          <option value="Neurodivergent">Neurodivergent</option>
          <option value="Women">Women</option>
          <option value="Family">Family</option>

        </select><br>
          <span class="form__error" id="theme--error">Please select the book's theme.</span>
      </div>

      <br><br>

      <!--Author Identity-->
      <div class="author-id">
        <label>Author Identity:</label>
        <ul>
          <li>
        <input type="checkbox" id="id1" class="checkboxes" name="authid[]" value="BIPOC"></input>
        <label for="id1" class="check-word">BIPOC</label><br><br>
        <span class="checkmark"></span>
      </li>

    <li>
        <input type="checkbox" id="id2" class="checkboxes" name="authid[]" value="LGBTQ+"></input>
        <label for="id2" class="check-word">LGBTQ+</label><br><br>
        <span class="checkmark"></span>
      </li>

     <li>
        <input type="checkbox" id="id3" class="checkboxes" name="authid[]" value="Neurodivergent"></input>
        <label for="id3" class="check-word">Neurodivergent</label><br><br>
        <span class="checkmark"></span>
      </li>

      <li>
        <input type="checkbox" id="id4" class="checkboxes" name="authid[]" value="Woman"></input>
        <label for="id4" class="check-word">Woman</label><br><br>
        <span class="checkmark"></span>
      </li>
        </ul>
      </div>

      <!--Book Description-->
      <label for="bookDes">Book Description:</label>
      <textarea id="bookDes" name="description"></textarea><br><br>

        <!--Link to Book-->
      <label for="booklink">Link to book:</label>
        <input type="url" id="booklink" name="booklink" autocomplete="off" placeholder="https://www.goodreads.com/en/book/show/53802072-some-girls-do"></input><br><br>

      <!--Link to Image-->
      <label for="image-link">Cover Image Link:</label>
        <input type="text" id="image-link" name="imageLink" autocomplete="off"></input><br><br>


    <!--required-->
    <p class="req">* required</p>
    <br>

    <!--Submit button-->
    <input type="submit" id="sub" class="sub"></input>
  </form>
   
</div>

</body>
</html>