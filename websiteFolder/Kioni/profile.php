<?php 
$user =  $_POST['userNA'];
$passW = $_POST['passWO'];
$login = "SELECT * FROM accounts WHERE username = '". $user . "' AND password = '" . $passW . "'; ";
 $sql2 = @mysqli_query($link, $login);
 
if(mysqli_num_rows($sql2) > 0 ){
echo "<div class='dropdown'> <button class='dropbtn'>". $user."</button> <div class='dropdown-content'>
    <a href='#'>favorites</a>
    <a href='logout.php'>logout</a>
  </div>
</div> ";
}
else{
	echo "<div class='dropdown'> <button class='dropbtn'>log in</button> <div class='dropdown-content'>
    <a href='login.php'>log-in</a>
    <a href='signup.php'>sign up</a>
  </div>
</div> ";
	
}	
?>