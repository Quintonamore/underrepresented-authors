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
$query = "SELECT * FROM books_authors ORDER BY Rating DESC;";
 $sql = @mysqli_query($link, $query);
 
 if(mysqli_num_rows($sql) > 0){
       //output data of each row
	   
       while($row = mysqli_fetch_array($sql,MYSQLI_NUM)){
		 $lastName= $row[0] ;
            $firstName = $row[1];
            $title = $row[2];
            $year = $row[3];
            $genre2 = $row[4];
            $theme2 = $row[5];
            $ident2 = $row[6];
            $length2 = $row[7];
            $isbn = $row[8];
            $approval = $row[9];
            $_SESSION['isbn'] = $isbn;
			$_SESSION['retuen'] = "bestSellers.php";
            ?>
            <form action = "" method = "POST"><br/>
            <?php
            echo $lastName. ", ". $firstName. "- \"".$title."\", ".$year. ", ISBN: ".$isbn. "</br> 
            Approval Rating: ".$approval." %"; ?>
            <button type = "submit" name = "like" value = "<?php echo $isbn; ?>" formaction="likes.php"> Like </button>
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
