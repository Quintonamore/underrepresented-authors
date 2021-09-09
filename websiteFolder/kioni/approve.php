<?php
session_start();
require('db.php');

unset($_SESSION['bookInDB']);

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

//check if book is already in database 

$checkQ = "SELECT * FROM books_authors WHERE ISBN = '". $isbn. "' OR (AuthName = '". $authName. "' AND BookTitle = '". $title. "');";

//echo $checkQ;
$resultCheck = mysqli_query($link, $checkQ);

if(mysqli_num_rows($resultCheck)>0){
    //output message value and return to review
    $_SESSION['bookInDB'] = true;

    $_SESSION['return2']= "review.php";

    echo "<script type=\"text/javascript\">
    window.location.href = ' ".  $_SESSION['return2'] ." ' ;
    </script>";

}
else{

    

   $query = "INSERT INTO `books_authors`(`AuthName`, `BookTitle`, `Year`, `Genre`, `Theme`, `AuthIdent`, `Length`, `ISBN`, `Approval`, `bookcover`, `description`, `Link`)".
   "VALUES ('".$authName."', '".$title ."',". $year .", '". $genre2."','". $theme2 ."', '".$ident2 ."', '".$length2 ."',".$isbn.", 0,'".$bookcover ."','".$description."', '".$booklink."'); "; 
  
    
    //echo "<br>". $query;
  
    mysqli_query($link, $query);
    
   $query2 = "DELETE FROM `suggested` WHERE Bookid =" .$bookid. ";";
   //echo "<br>". $query2;
    $sql2 = @mysqli_query($link, $query2);

    $_SESSION['return2']= "review.php";

    echo "<script type=\"text/javascript\">
    window.location.href = ' ".  $_SESSION['return2'] ." ' ;
    </script>";     
}
?>