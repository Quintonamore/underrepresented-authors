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
if(isset($_SESSION['inDB'])&& $_SESSION['inDB']){
echo "<div class='dropdown'> <button class='dropbtn'>". $_SESSION['user']. "</button> <div class='dropdown-content'>
    <a href='favorties.php'>My Favorites</a>
    <a href='logout.php'>Logout</a>
  </div>
</div> ";
}
else{
    echo "<div class='dropdown'> <button class='dropbtn'>Log-in</button> <div class='dropdown-content'>
    <a href='login.php'>log-in</a>
    <a href='createAccount.php'>sign up</a>
  </div>
</div> ";

}
?>
<div class = "title">
    Our Best-Sellers
</div>
<div class = "buttonArea">
<a href="home.php" class="button">Home</a>
<a href="bestSellers.php" class="button">Our Best-Sellers</a>
<a href="tutorial.php" class="button">Tutorial</a>
<a href="about.php" class="button">About Us</a>
</div> 
<div class = "text">
<div class = "space" id= "space">
<?php
 $like = $_POST["like"];
echo $like[0]; 
$noyj = @mysqli_multi_query($link,$like[0] );
$query = "SELECT * FROM books_authors ORDER BY Rating DESC;";
 $sql = @mysqli_query($link, $query);
 if(mysqli_num_rows($sql) > 0){
       //output data of each row
       while($row = mysqli_fetch_array($sql,MYSQLI_NUM)){
		echo  " <form id = 'form' action = '' method = 'post'> 
		<div><br/> ". $row[0]. " ". $row[1]. " ". $row[2] . " ". $row[3]. " ".$row[4]. " ". $row[5]. " ". $row[6]. " ". $row[7]. " ". $row[8]. " rating: ". ($row[9]/$row[10]) . " rated by #users " . $row[10] .  
		" <button name='like[]' type='submit'  value='
		INSERT INTO `favorites`(`username`, `ISBN`) VALUES ( \"". $_SESSION['user'] ." \" ,". $row[8] . "); 
		UPDATE `books_authors` SET Rating =" . ($row[9] +1) .", ofRatings = " . ($row[10] +1) . " WHERE ISBN =". $row[8]. ";
		'>Like</button>  
		<button name='like[]' type='submit'  value='
		UPDATE `books_authors` SET Rating =" . ($row[9] -1) .", ofRatings = " . ($row[10] + 1) . " WHERE ISBN =". $row[8]. ";
		DELETE FROM `favorites` WHERE username = \"". $_SESSION['user'] . "\" AND `ISBN` =" .$row[8] . ";
		'>DisLike</button>  
		
		</div> </form>"  ;

       }
   }
   else
        echo "No mathes within our databse.";
  

?>
</div>
</div> 
</body>
</html>