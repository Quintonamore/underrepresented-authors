<?php
session_start();
require('db.php');


$bookid = $_POST['remove'];
   $query = "DELETE FROM `suggested` WHERE Bookid =" .$bookid . ";";
   echo "<br>". $query;
   $sql = @mysqli_query($link, $query);
?>