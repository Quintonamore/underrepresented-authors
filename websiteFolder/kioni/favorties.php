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
$query = "SELECT DISTINCT *
FROM favorites  RIGHT JOIN books_authors ON favorites.ISBN = books_authors.ISBN WHERE favorites.username = '". $_SESSION['user'] ."';";

 $sql = @mysqli_query($link, $query);
 if(mysqli_num_rows($sql) > 0){
       //output data of each row
       while($row = mysqli_fetch_array($sql,MYSQLI_NUM)){
		  $lastName= $row[2] ;
            $firstName = $row[3];
            $title = $row[4];
            $year = $row[5];
            $genre2 = $row[6];
            $theme2 = $row[7];
            $ident2 = $row[8];
            $length2 = $row[9];
            $isbn = $row[10];
            $approval = $row[11];
            $_SESSION['isbn'] = $isbn;
			$_SESSION['retuen'] = "favorties.php";
            ?>
            <form action = "" method = "POST"><br/>
            <?php
            echo $lastName. ", ". $firstName. "- \"".$title."\", ".$year. ", ISBN: ".$isbn. "</br> 
            Approval Rating: ".$approval." %"; ?>
            <button type = "submit" name = "dislike" value = "<?php echo $isbn; ?>" formaction="dislikes.php" >  Dislike </button>
            </form>

            <?php
		
       }
	  
	   
   }
   else
        echo "No mathes within our databse.";
  

?>
</div>
</div> 
</body>
</html>