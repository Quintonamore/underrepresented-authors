<?php
session_start();
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
    Oops!
</div>
<p></p>

<div class = "errorMessage">
The task you attempted to achieve requires an account. Please log in, or create an account. 
<p></p> 
<a href="login.php" class="accountButton">Log In</a>
<a href="createAccount.php" class="accountButton">Create Account</a>
</div>


</body>
</html>
