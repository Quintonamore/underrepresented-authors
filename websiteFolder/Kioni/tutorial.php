<html>
<head>
<link rel="stylesheet" href="style.css">
<?php
$servername = "localhost";
$username = 'studentweb1';
$password = 'bipoc1';
$db = 'bipoc_authors';
$host = 'localhost';
$port = 8889;

$link = mysqli_init();
$success = mysqli_real_connect(
   $link, 
   $host, 
   $username, 
   $password, 
   $db,
   $port
)OR die('could not connect to MySQL' . mysqli_connect_error($link));

include_once 'profile.php';
?>
</head>
<body>
<div class = "title">
    Tutorial
</div>
<div class = "buttonArea">
<a href="home.php" class="button">Home</a>
<a href="bestSellers.php" class="button">Our Best-Sellers</a>
<a href="tutorial.php" class="button">Tutorial</a>
<a href="about.php" class="button">About Us</a>
</div> 
</body>
</html>