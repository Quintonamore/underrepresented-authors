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
<input type="submit" name = "login" value = "Log In"><br>
</form>
</div>
</div>
<?php

if(isset($_POST['login'])){

    $user = $_POST['user'];
    $passW = $_POST['pass']; 

    $login = "SELECT * FROM accounts WHERE username = '". $user . "'" . "AND password = '" . $passW . "'; ";
    $sql2 = @mysqli_query($link, $login);


    //if not in databse
    if((mysqli_num_rows($sql2)==0) || !$sql2){
        echo "
        <p></p>
        <div class = \"message\">
        Please enter a valid username and password. If you would like to create an account, click here: 
        <input type = 'submit' name = 'create' value = 'Create Account' action = 'createAccount.php'> 
        </div>"; 
    }
    else{
        
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['inDB'] = true; 
        header("Location: home.php");
        exit; 
    }
    
}


?>


</body>
</html>
