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
     ?>
<script type="text/javascript">
window.location.href = 'error.php';
</script>
<?php
    exit;
}
else{
   
    $ISBN = $_POST['like'];

    /**FIRST LIKE  */
    //if no row exists with user and isbn, add to ratings with like
    //and update database 
    $checkIfLike = "SELECT * FROM ratings WHERE isbn2 = '". $ISBN. "' AND user2 = '".$_SESSION['user']."'";
    $checkresult2 = mysqli_query($link, $checkIfLike);
    if(mysqli_num_rows($checkresult2)==0){
        $likeSQLIn = "INSERT INTO ratings 
                        VALUES ('". $_SESSION['user']."', '". $ISBN . "', 'like')";
        //echo $likeSQLIn;
        mysqli_query($link, $likeSQLIn);

        //added true
        $_SESSION['likeAdded'] = true; 
        unset($_SESSION['visitLike']);

    }
    else{
        //if like already exists
        //check if user already liked the book
        // check database for isbn and 'like'
        /*********UNLIKE********/
        
        $checkLike = "SELECT * FROM ratings WHERE isbn2 = '". $ISBN. "' AND user2 = '".$_SESSION['user']."' AND rating = 'like'";
        //echo $checkLike;
        $checkresult = mysqli_query($link, $checkLike);
        //echo ;
        if((isset($_SESSION['likeAdded']) && isset($_SESSION['visitLike']))|| (mysqli_num_rows($checkresult)>0)){
                //if liked before, delete like from ratings table
                $unlikeSQL = "DELETE FROM ratings WHERE user2 = '". $_SESSION['user']."' AND isbn2 = '".$ISBN."' AND rating = 'like'";
                //echo $unlikeSQL;
                mysqli_query($link, $unlikeSQL);
                //unset session variable
                unset($_SESSION['likeAdded']);

        }
        
        

        //if liked, but disliked before change dislike to like
        /*DISLIKE TO LIKE *******/
        $checkDislike = "SELECT * FROM ratings WHERE isbn2 = '". $ISBN. "' AND user2 = '".$_SESSION['user']."' AND rating = 'dislike'";
        //echo $checkDislike;
        $checkresultD = mysqli_query($link, $checkDislike);
        if(mysqli_num_rows($checkresultD)>0){
                //change like to dislike
                $like2SQL = "UPDATE `ratings` SET `rating`='like' WHERE `user2`='".$_SESSION['user']."' AND `isbn2`='". $ISBN."' AND `rating`='dislike'";
                //echo $like2SQL;
                mysqli_query($link, $like2SQL);
                $_SESSION['likeAdded'] = true;
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
    //echo $numLikes."</br>";

    //dislikes
    $dissql = "SELECT COUNT(*) 
            FROM ratings
            WHERE isbn2 = '". $ISBN ."' AND rating = 'dislike'";
    $disrs = mysqli_query($link, $dissql);
    $disresult = mysqli_fetch_array($disrs);
    $numdisLikes= $disresult[0];
   // echo $numdisLikes."</br>";

    //add the total 
    $total = $numLikes + $numdisLikes;
    //echo $total."</br>";
    if($total == 0){
            $approval = 0;
    }
    else{
        //get approval rating
        $approval = $numLikes / $total;
    }
    
    // decimal to percent
    $likeRate = number_format($approval, 2, '.', '') * 100;
    //echo $likeRate."</br>";

    //update rating in table
    $approvSQL = "UPDATE `books_authors` SET `Approval`='".$likeRate."' WHERE ISBN = ". $ISBN;
    mysqli_query($link, $approvSQL);
    $_SESSION['approval']= $likeRate;
    
    $_SESSION['return'] = "home.php";
    $_SESSION['visitLike'] = true;

     
 echo "<script type=\"text/javascript\">
window.location.href = ' ".  $_SESSION['return'] ." ' ;
</script>";

}
    
?>
