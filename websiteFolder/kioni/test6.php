<?php
session_start();
require('db.php');

$query = "  ALTER TABLE `books_authors` ADD PRIMARY KEY (`Bookid`); ALTER TABLE `books_authors` MODIFY `Bookid` double NOT NULL AUTO_INCREMENT;
 ";
 
 $sql = @mysqli_multi_query($link, $query);
 
 echo $query;

if($sql = FALSE){
	ECHO "fail";
} else { echo "pass";}
?>