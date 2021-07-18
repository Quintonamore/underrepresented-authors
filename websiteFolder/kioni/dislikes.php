<?php
session_start();
require('db.php');

// FOR DISLIKE BUTTON 
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
   
    $ISBN = $_POST['dislike'];
    
    /**FIRST DISLIKE  */
    //if no row exists with user and isbn, add to ratings with like
    //and update database 
    $checkIfDLike = "SELECT * FROM ratings WHERE isbn2 = '". $ISBN. "' AND user2 = '".$_SESSION['user']."'";
    $checkresult2 = mysqli_query($link, $checkIfDLike);
    if(mysqli_num_rows($checkresult2)==0){
        $DlikeSQLIn = "INSERT INTO ratings 
                        VALUES ('". $_SESSION['user']."', '". $ISBN . "', 'dislike')";
        //echo $likeSQLIn;
        mysqli_query($link, $DlikeSQLIn);

        //added true
        $_SESSION['dislikeAdded'] = true; 
        unset($_SESSION['visitDLike']);

    }
    else{
        //if dislike already exists
        //check if user already liked the book
        // check database for isbn and 'like'
        /*********UNDISLIKE********/
        
        $checkDLike = "SELECT * FROM ratings WHERE isbn2 = '". $ISBN. "' AND user2 = '".$_SESSION['user']."' AND rating = 'dislike'";
        //echo $checkLike;
        $checkresultD = mysqli_query($link, $checkDLike);
        //echo ;
        if((isset($_SESSION['dislikeAdded']) && isset($_SESSION['vistDLike']))||(mysqli_num_rows($checkresultD)>0)){
                //if liked before, delete like from ratings table
                $undlikeSQL = "DELETE FROM ratings WHERE user2 = '". $_SESSION['user']."' AND isbn2 = '".$ISBN."' AND rating = 'dislike'";
                echo $unlikeSQL;
                mysqli_query($link, $undlikeSQL);
                //unset session variable
                unset($_SESSION['dislikeAdded']);
                

        }
        
        

        //if disliked, but liked before, change like to dislike
        /*LIKE TO DISLIKE *******/
        $checklike = "SELECT * FROM ratings WHERE isbn2 = '". $ISBN. "' AND user2 = '".$_SESSION['user']."' AND rating = 'like'";
        //echo $checkDislike;
        $checkresultL = mysqli_query($link, $checklike);
        if(mysqli_num_rows($checkresultL)>0){
                //change like to dislike
                $dlike2SQL = "UPDATE `ratings` SET `rating`='dislike' WHERE `user2`='".$_SESSION['user']."' AND `isbn2`='". $ISBN."' AND `rating`='like'";
                //echo $like2SQL;
                mysqli_query($link, $dlike2SQL);
                $_SESSION['dislikeAdded'] = true; 
        }

    }
    
     

    
    //once liked, change button color 
   

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
    if($total == 0){
            $approval = 0;
    }
    else{
        //get approval rating
        $approval = $numLikes / $total;
    }
    
    // decimal to percent
    $likeRate = number_format($approval, 2, '.', '') * 100;
    echo $likeRate."</br>";

    //update rating in table
    $approvSQL = "UPDATE `books_authors` SET `Approval`='".$likeRate."' WHERE ISBN = ". $ISBN;
    mysqli_query($link, $approvSQL);
    $_SESSION['approval']= $likeRate;

    if(isset($_SESSION['favVisit'])){
        $_SESSION['return'] = "favorites.php";
        $_SESSION['vistDLike'] = true;

        header("Location:". $_SESSION['return']);
    }
    else{
        $_SESSION['return'] = "home.php";
        $_SESSION['vistDLike'] = true;

        header("Location:". $_SESSION['return']);
    }
    
    
}
    
?>
