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
    Create an Account
</div>
<p></p>
<div class = "loginText">
<form action = "" method = "post">
Email: </br>
<input type = "text" name = "email" size = "50" maxlength = "50" required><br>
Username: </br>
<input type = "text" name = "user2" size = "30" maxlength = "20" required><br>
Password: </br>
<input type = "password" name = "pass2" size = "30" maxlength = "30" required><br>
<p></p>
<div class = "loginButton">
<input type="submit" name = "create" value = "Submit"><br>
</form>
</div>
</div>
<?php

if(isset($_POST['create'])){

    $emailAdd = $_POST['email'];
    $userName = $_POST['user2'];
    $passWord = $_POST['pass2']; 

    //first check if username already in database
    $checkDB = "SELECT * FROM accounts WHERE username = '". $userName . "'; ";
    $sql3 = @mysqli_query($link, $checkDB);

    if(mysqli_num_rows($sql3)>0 || !$sql3){
        echo "
        <p></p>
        <div class = \"message\">
        This username already exists. Please enter another username, or login here:
        <a href=\"login.php\" class=\"accountButton\">Log In</a>
        </div>"; 
    }

    else{
         /* echo "
        <p></p>
        <div class = \"message\"> the account isnt in the database previously 
        </div>"; */

    //if not in databse, add to database and send user to log in page
   // $createAccount = "INSERT INTO accounts VALUES('".$userName."',PASSWORD('".$passWord."'), '".$emailAdd."');";
   $createAccount = "INSERT INTO accounts VALUES('".$userName."','".$passWord."', '".$emailAdd."');";
    //$createAccount = "INSERT INTO accounts VALUES('".$userName."',ENCRYPT('".$passWord."'), '".$emailAdd."');";
    $sql4 = @mysqli_query($link, $createAccount);
   
        /*echo "after second querry";
         if(!$link){
        echo "NO LINK";
        }
        if($sql4){
        echo "YAY!";
        }  
        */ 
    }
/*

  ?>
<script type="text/javascript">
window.location.href = "login.php";
</script>
<?php
    exit; 
    } */

    
    
}


?>


</body>
</html>

