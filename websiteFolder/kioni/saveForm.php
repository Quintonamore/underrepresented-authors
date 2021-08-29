<?php
session_start();
require('db.php');

$genre = $_POST ['genre'];
   $authid = $_POST['authid'];
    $isbn = $_POST['isbn'];
   if(empty($_POST['isbn'])){
	   $isbn = 0;
   }
   
   $query = "INSERT INTO `suggested`(`AuthName`, `BookTitle`,  `Genre`, `Theme`, `AuthIdent`, `Length`, `ISBN`, `Approval`, `bookcover`, `description`, `Link`) 
   VALUES (\"".$_POST['author'] ."\",\"".$_POST['title'] ."\",\"". implode(" ",$genre) ."\",\"". $_POST['bookTheme']."\",\"".implode(" ",$authid) ."\",\"".$_POST['bookLength'] ."\",".$isbn.",0 ,\"".$_POST['imageLink'] ."\",\"".$_POST['description']."\",\"".$_POST['booklink']."\")";
   $sql = @mysqli_query($link, $query);
?>