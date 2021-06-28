<?php
session_start();
require('db.php');
?>

<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
<?php
// FOR LIKE BUTTON 
//1) Check if user is signed in once the like button is clicked
//2) If user is not logged in, offer log in page or sign up
//3) else insert info into database
//4) update the ratings for the book

if(!isset($_SESSION['user'])){

    //offer log in or sign up
    header("Location: error.php");
    exit;
}
else{
    //check if user already liked the book

    //insert like into user ratings
    $likeSQLIn = "INSERT INTO ratings 
            VALUES ('". $_SESSION['user']."', '". $_SESSION['isbn'] . "', 'like')";
            //ON DUPLICATE KEY UPDATE rating = 'like';";
    //echo $likeSQLIn;
    $result = mysqli_query($link, $likeSQLIn);
   

    //update the ratings in the books_authors table

    //likes
    $likeSQL = "SELECT COUNT(*) 
            FROM ratings
            WHERE isbn2 = ". $_SESSION['isbn'] ." AND rating = 'like'";
    $likers = mysqli_query($link, $likeSQL);
    $likeresult = mysqli_fetch_array($likers);
    $numLikes = $likeresult[0];
    

    //dislikes
    $dissql = "SELECT COUNT(*) 
            FROM ratings
            WHERE isbn2 = '". $_SESSION['isbn'] ."' AND rating = 'dislike'";
    $disrs = mysqli_query($link, $dissql);
    $disresult = mysqli_fetch_array($disrs);
    $numdisLikes= $disresult[0];
    

    //add the total 
    $total = $numLikes + $numdisLikes;
    
    //get approval rating
    $approval = $numLikes / $total;
    // decimal to percent
    $likeRate = number_format($approval, 2, '.', '') * 100;
    

    //update rating in table
    $approvSQL = "UPDATE `books_authors` SET `Approval`='".$likeRate."' WHERE ISBN = ". $_SESSION['isbn'];
    mysqli_query($link, $approvSQL);
    exit;
}
    
?>


</body>
</html>