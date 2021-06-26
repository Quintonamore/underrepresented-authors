<?php

require('db.php');


?>

<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
echo "<div class='dropdown'> <button class='dropbtn'>Home</button> <div class='dropdown-content'>
    <a href='home.php'>Home</a>
  </div>
</div> ";
?>
<div class = "title">
    Login Page
</div>
<p></p>
<div class = "loginText">
<form action = "" method = "post">
Username: </br>
<input type = "text" name = "user" size = "30" maxlength = "20" required><br>
Password: </br>
<input type = "password" name = "pass" size = "30" maxlength = "30" required><br>
<p></p>
<div class = "loginButton">
<input type="submit" name = "signUp" value = "Signed Up"><br>
</form>
</div>
</div>
<?php

if(isset($_POST['signUp'])){

    $user = $_POST['user'];
    $passW = $_POST['pass']; 

    $login = "SELECT * FROM accounts WHERE username = '". $user . "'" . "AND password = '" . $passW . "'; ";
    $sql2 = @mysqli_query($link, $login);

	if(mysqli_num_rows($sql2) > 0){
	 echo " <script>alert('either login or password is already in use ');</script>";
	 
	 }else{
	$query = "INSERT INTO accounts (`username`, `password`) VALUES ( '". $user."' , '" . $passW ."' );";
	 $sql3 = @mysqli_query($link, $query);
	 }
}

?>


</body>
</html>