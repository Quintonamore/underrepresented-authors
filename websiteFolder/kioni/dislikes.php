<?php
session_start();
require('db.php');

// FOR LIKE BUTTON 
//1) Check if user is signed in once the like button is clicked
//2) If user is not logged in, offer log in page or sign up
//3) else insert info into database
//4) update the ratings for the book

if(!isset($_SESSION['user'])){

    //offer log in or sign up
    header("Location: error.php");
}
else{
   $query =  "UPDATE `books_authors` SET Rating = Rating -1 , ofRatings = ofRatings +1 WHERE ISBN =". $_POST['dislike']. ";
		DELETE FROM `favorites` WHERE username = \"". $_SESSION['user'] . "\" AND `ISBN` =". $_POST['dislike'] . ";";
	 @mysqli_multi_query($link,$query );
   header("Location:". $_SESSION['retuen']);
}
  ?>