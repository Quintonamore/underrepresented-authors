<?php
session_start();
require('db.php');
?>
<html>
<head>
<?php
if(isset($_SESSION['darkmode'])){ 
echo '<link rel="stylesheet" href="darkstyle.css">';
}else{
echo '<link rel="stylesheet" href="style.css">';
}
 ?>
</head>
<body>
<?php

unset($_SESSION['favVisit']);

if(isset($_SESSION['inDB'])&& isset($_SESSION['user']) && $_SESSION['inDB']){
echo "<div class='dropdown'> <button class='dropbtn'>". $_SESSION['user']. "</button> <div class='dropdown-content'>
    <a href='favorites.php'>My Favorites</a>
    <a href='logout.php'>Logout</a>
	<a href='darkmode.php'>Dark Mode </a>
  </div>
</div> ";
}
else{
    echo "<div class='dropdown'> <button class='dropbtn'>Account</button> <div class='dropdown-content'>
    <a href='login.php'>Log In</a>
    <a href='createAccount.php'>Sign Up</a>
	<a href='darkmode.php'>Dark Mode </a>
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
    <div class = "space">
        <?php
        //show the books with ratings 60 percent and above in descending order
        $favoritesSQL = "SELECT *
                          FROM suggested";
        $result = mysqli_query($link, $favoritesSQL);

        if(mysqli_num_rows($result) > 0){
            //output data of each row
            $count =0;
            while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
                 $authName= $row[0] ;
            $_SESSION['authName']= $authName;
           
            $title = $row[1];
            $_SESSION['title']=$title;
            $year = $row[2];
            $_SESSION['year']=$year;
            $genre2 = $row[3];
            $_SESSION['genre2']=$genre2;
            $theme2 = $row[4];
            $_SESSION['them2']=$theme2;
            $ident2 = $row[5];
            $_SESSION['ident2']=$ident2;
            $length2 = $row[6];
            $_SESSION['length2']=$length2;
            $isbn = $row[7];
            $_SESSION['isbn']=$isbn;
            $approval = $row[8];
            $_SESSION['approval']=$approval;
			$bookcover = $row[9];
			$_SESSION['book-cover'] = $bookcover;
			$description = $row[10];
			$_SESSION['description'] = $description;
            $booklink = $row[11];
			$bookid = $row[12]; 
			 
				
				
			
				?>
                
                <form id = "buttonForm" name ="ratings" method = "POST" ><br/>
            <?php
            echo "<input type='text' id='fname' name='authName' value = '" .$authName ."'> 
			<br> <input type='text' id='fname' name='title' value = '" .$title ."'>
			 <br> <input type='number' id='fname' name='year' value = " .$year .">
			  <br> <input type='text' id='fname' name='genre2' value = '" .$genre2 ."'>
			   <br> <input type='text' id='fname' name='theme2' value = '" .$theme2 ."'>
			    <br> <input type='text' id='fname' name='ident2' value = '" .$ident2 ."'>
				 <br> <input type='text' id='fname' name='length2' value = '" .$length2 ."'>
				  <br> <input type='number' id='fname' name='isbn' value = " .$isbn .">
				   <br> <input type='text' id='fname' name='approval' value = '" .$approval ."'>
				    <br> <input type='text' id='fname' name='bookcover' value = '" .$bookcover ."'>
					 <br> <input type='text' id='fname' name='description' value = '" .$description ."'>
					  <br> <input type='text' id='fname' name='booklink' value = '" .$booklink ."'>" ?>
            <button class = "likesButtons" id = "likeB" type = "submit" name = "approve" value = "<?php echo $bookid; ?>" formaction="approve.php"> approve </button>
            <button class = "likesButtons" id = "dislikeB" type = "submit" name = "remove" value = "<?php echo $bookid; ?>" formaction="remove.php">  remove </button>
            </form>
                <?php
            }
        }
        else
            echo "<div align='center'> There are no current best sellers. </div>";
            
        ?>
    </div>
</div>

</body>
</html>