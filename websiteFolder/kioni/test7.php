<?php
session_start();
require('db.php');

$query = " ALTER TABLE `ratings` CHANGE `isbn2` `bookid` DOUBLE NOT NULL;';
 ";
 
 $sql = @mysqli_multi_query($link, $query);
 
 echo $query; 
?>