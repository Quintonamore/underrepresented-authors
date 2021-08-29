<?php
session_start();
require('db.php');
$authName= $_POST['authName'];
$title = $_POST['title'];
$year = $_POST['year'];
$genre2 = $_POST['genre2'];
$theme2 = $_POST['theme2'];
$ident2 = $_POST['ident2'];
$length2 = $_POST['length2'];
$isbn = $_POST['isbn'];
$bookcover = $_POST['bookcover'];
$description = $_POST['description'];
$booklink = $_POST['booklink'];
$bookid = $_POST['approve'];

   $query = "INSERT INTO `books_authors`(`AuthName`, `BookTitle`, `Year`, `Genre`, `Theme`, `AuthIdent`, `Length`, `ISBN`, `Approval`, `bookcover`, `description`, `Link`)".
   "VALUES ('".$authName."', '".$title ."',". $year .", '". $genre2."','". $theme2 ."', '".$ident2 ."', '".$length2 ."',".$isbn.", 0,'".$bookcover ."','".$description."', '".$booklink."'); "; 
  
    
    //echo "<br>". $query;
  
    mysqli_query($link, $query);
    
   $query2 = "DELETE FROM `suggested` WHERE Bookid =" .$bookid. ";";
   //echo "<br>". $query2;
    $sql2 = @mysqli_query($link, $query2);
?>