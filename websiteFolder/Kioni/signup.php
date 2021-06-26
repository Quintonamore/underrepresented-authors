<html>
<head>
 <a href='home.php'>home</a>
</head>
<body>
<form action = " " method = "post">
<label for="username">UserName:</label>
  <input type="text" name="userNA" minlength="6"><br><br>
  <label for="password">Password:</label>
  <input type="password" name="passWO" minlength="8"><br><br>
  <input type="submit" value="Submit">
</form>

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
$login = "SELECT * FROM accounts WHERE username = '". $_POST['userNA'] . "' 	OR password = '" . $_POST['passWO']. "'; ";
 $sql2 = @mysqli_query($link, $login);
 if(mysqli_num_rows($sql2) > 0){
	 echo " <script>alert('either login or password is already in use ');</script>";
	 
 }else{
$query = "INSERT INTO accounts (`username`, `password`) VALUES ( '". $_POST['userNA']."' , '" . $_POST['passWO']."' );";
 $sql3 = @mysqli_query($link, $query);
 }
?>
</body>
</html>