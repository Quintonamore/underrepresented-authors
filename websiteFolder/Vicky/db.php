<!-- connect to database-->
<?php

$servername = "localhost";
$username = 'studentweb1';
$password = 'bipoc1';
$db = 'bipoc_authors';
$host = 'localhost';

$link = mysqli_init();
$success = mysqli_real_connect(
   $link, 
   $host, 
   $username, 
   $password, 
   $db
)OR die('could not connect to MySQL' . mysqli_connect_error($link));