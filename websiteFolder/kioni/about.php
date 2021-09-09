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
    About Us
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


</body>
</html>
