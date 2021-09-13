<?php
session_start();
require('db.php');
$userName = "admin1";
$passWord = "plu123";
$emailAdd = "plu@plu.edu"

$query =  "INSERT INTO admins VALUES('".$userName."', SHA1('".$passWord."'), '".$emailAdd."');";
 
 $sql = @mysqli_multi_query($link, $query);
 
 echo $query;

if($sql = FALSE){
	ECHO "fail";
} else { echo "pass";}
?>