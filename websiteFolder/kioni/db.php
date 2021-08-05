<!-- connect to database-->
<?php

$username = getenv('DB_USER') ?: 'studentweb1';
$password = getenv('DB_PASSWORD') ?: 'bipoc1';
$db = 'bipoc_authors';
$host = getenv('DB_HOST') ?: 'localhost';
$port = getenv('DB_PORT') ?: 8889;
$link = mysqli_init();
$success = mysqli_real_connect(
   $link,
   $host,
   $username,
   $password,
   $db,
   $port
)OR die('could not connect to MySQL' . mysqli_connect_error());