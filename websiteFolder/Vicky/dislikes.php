<?php
session_start();
require('db.php');

// FOR DISLIKE BUTTON 
//1) Check if user is signed in once the like button is clicked
//2) If user is not logged in, offer log in page or sign up
//3) else delete info from database
//4) update the ratings for the book

if(!isset($_SESSION['user'])){

    //offer log in or sign up
    header("Location: error.php");
    exit;
}
else{
    //check if user already disliked/liked the book

    //insert dislike into user ratings
    $ISBN = $_POST['dislike'];
    $likeSQLIn = "INSERT INTO ratings 
            VALUES ('". $_SESSION['user']."', '". $ISBN . "', 'dislike')";
            //ON DUPLICATE KEY UPDATE rating = 'like';";
    //echo $likeSQLIn;
    $result = mysqli_query($link, $likeSQLIn);
   

    //update the ratings in the books_authors table

    //likes
    $likeSQL = "SELECT COUNT(*) 
            FROM ratings
            WHERE isbn2 = ". $ISBN ." AND rating = 'like'";
    $likers = mysqli_query($link, $likeSQL);
    $likeresult = mysqli_fetch_array($likers);
    $numLikes = $likeresult[0];
    echo $numLikes."</br>";
    

    //dislikes
    $dissql = "SELECT COUNT(*) 
            FROM ratings
            WHERE isbn2 = '". $ISBN ."' AND rating = 'dislike'";
    $disrs = mysqli_query($link, $dissql);
    $disresult = mysqli_fetch_array($disrs);
    $numdisLikes= $disresult[0];
    echo $numdisLikes."</br>";

    //add the total 
    $total = $numLikes + $numdisLikes;
    echo $total."</br>";
    
    //get approval rating
    $approval = $numLikes / $total;
    // decimal to percent
    $likeRate = number_format($approval, 2, '.', '') * 100;
    echo $likeRate."</br>";

    //update rating in table
    $approvSQL = "UPDATE `books_authors` SET `Approval`='".$likeRate."' WHERE ISBN = ". $ISBN;
    mysqli_query($link, $approvSQL);
    $_SESSION['return'] = "home.php";
    
    header("Location:". $_SESSION['return']);

}
    
?>