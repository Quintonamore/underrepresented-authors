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

    //check if the user is in accounts table
    $login = "SELECT * FROM accounts WHERE username = '". $user . "'" . "AND password = PASSWORD('".$passW."'); ";
    $sql2 = @mysqli_query($link, $login);
    //echo $login;


    //if in accounts table
    if((mysqli_num_rows($sql2)>0)){
        $_SESSION['regUser'] = true; 
        $_SESSION['user'] = $_POST['user'];
        $_SESSION['inDB'] = true; 

        //echo "USER";
        
        ?>
        <script type="text/javascript">
        window.location.href = "home.php";
        </script>
        <?php
        exit;   
    }
    else{
        //check in admin
        $login2 = "SELECT * FROM admins WHERE username = '". $user . "'" . "AND password = PASSWORD('".$passW."'); ";
        $sql3 = @mysqli_query($link, $login2);

        //if yes admin
        if((mysqli_num_rows($sql3)>0)){
            $_SESSION['adminUser'] = true; 
            $_SESSION['user'] = $_POST['user'];
            $_SESSION['inDB'] = true; 
            //echo "ADMIN";
            
            ?>
            <script type="text/javascript">
            window.location.href = "home.php";
            </script>
            <?php
            exit;  
        }
        //not an admin (or any other account)
        else{
            echo "
            <p></p>
            <div class = \"message\">
            Please enter a valid username and password. If you would like to create an account, click here: 
            <input type = 'submit' name = 'create' value = 'Create Account' action = 'createAccount.php'> 
            </div>";
        }

             
    }
    
    
}


?>


</body>
</html>
