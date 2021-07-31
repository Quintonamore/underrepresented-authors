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
        $favoritesSQL = "SELECT AuthName, BookTitle, Year, ISBN, Approval, bookcover, description 
                          FROM books_authors
                          WHERE `Approval`> 60
                          ORDER BY Approval DESC";
        $result = mysqli_query($link, $favoritesSQL);

        if(mysqli_num_rows($result) > 0){
            //output data of each row
            $count =0;
            while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
                $authName= $row[0] ;
                
                
                
                $title = $row[1];
                
                $year = $row[2];
                
                $isbn = $row[3];
                
                $approval = $row[4];
				$bookcover = $row[5];
				$description = $row[6];
                $count = $count +1;
                
                ?>
                
                <form id = "best" name ="bestSellers" method = "POST" ><br/>
                <?php
                echo $count. ". <img src=\"".$bookcover ."\" alt=\"Girl in a jacket\" width=\"40\" height=\"60\">". $authName. "- \"".$title."\", ".$year. ", ISBN: ".$isbn. "</br> 
                Approval Rating: ".$approval."% Description: " . $description . ""; ?>
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
