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
 if( $_SESSION['user'] != ""){
 $like = $_POST["like"];
echo $like[0]; 
@mysqli_multi_query($link,$like[0] );
}
$query = "SELECT DISTINCT *
FROM favorites  RIGHT JOIN books_authors ON favorites.ISBN = books_authors.ISBN WHERE favorites.username = '". $_SESSION['user'] ."';";
echo $query;
 $sql = @mysqli_query($link, $query);
 if(mysqli_num_rows($sql) > 0){
       //output data of each row
       while($row = mysqli_fetch_array($sql,MYSQLI_NUM)){
		echo  " <form id = 'form' action = '' method = 'post'> 
		<div><br/> ". $row[2]. " ". $row[3]. " ". $row[4] . " ". $row[5]. " ".$row[6]. " ". $row[7]. " ". $row[8]. " ". $row[9]. " ". $row[10]. " rating: ". ($row[11]/$row[12]) . " rated by #users " . $row[12] .  
		"
		<button name='like[]' type='submit'  value='
		UPDATE `books_authors` SET Rating =" . ($row[11] -1) .", ofRatings = " . ($row[12] + 1) . " WHERE ISBN =". $row[10]. ";
		DELETE FROM `favorites` WHERE username = \"". $_SESSION['user'] . "\" AND `ISBN` =" .$row[10] . ";
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