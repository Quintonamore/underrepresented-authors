<?php
session_start();
require('db.php');


$bookid = $_POST['remove'];
   $query = "DELETE FROM `suggested` WHERE Bookid =" .$bookid . ";";
  // echo "<br>". $query;
   $sql = @mysqli_query($link, $query);

   $_SESSION['return2']= "review.php";

    echo "<script type=\"text/javascript\">
    window.location.href = ' ".  $_SESSION['return2'] ." ' ;
    </script>"; 
?>
