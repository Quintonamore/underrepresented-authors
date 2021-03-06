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
//set a session variable that shows that the favorites page was visited 
//variable gets unset after 
$_SESSION['favVisit'] = true;
if(isset($_SESSION['inDB'])&& $_SESSION['inDB']){
  echo "<div class='dropdown'> <button class='dropbtn'>". $_SESSION['user']. "</button> <div class='dropdown-content'>
      <a href='favorites.php'>My Favorites</a>
      <a href='logout.php'>Logout</a>
    </div>
  </div> ";
  }
  else{
      echo "<div class='dropdown'> <button class='dropbtn'>Account</button> <div class='dropdown-content'>
      <a href='login.php'>Log In</a>
      <a href='createAccount'>Sign Up</a>
    </div>
  </div> ";
  
  }
?>
<div class = "title">
    Your Favorites
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
        //get all the user's liked books
        $favoritesSQL = "SELECT AuthLast, AuthFirst, BookTitle, Year, ISBN, Approval
                        FROM books_authors, ratings
                        WHERE isbn = isbn2 AND rating = 'like' AND user2 = '".$_SESSION['user']."'";
        $result = mysqli_query($link, $favoritesSQL);

        if(mysqli_num_rows($result) > 0){
            //output data of each row
            
            while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
                $lastName= $row[0] ;
                
                $firstName = $row[1];
                
                $title = $row[2];
                
                $year = $row[3];
                
                $isbn = $row[4];
                
                $approval = $row[5];
                
                ?>
                
                <form id = "buttonForm2" name ="favorites" method = "POST" ><br/>
                <?php
                echo $lastName. ", ". $firstName. "- \"".$title."\", ".$year. ", ISBN: ".$isbn. "</br> 
                Approval Rating: ".$approval." %"; ?>
                <button class = "likesButtons" id = "dislikeB" type = "submit" name = "dislike" value = "<?php echo $isbn; ?>" formaction="dislikes.php">  Dislike </button>
                </form>

                <?php
            }
        }
        else
            echo "<div align='center'> Your favorites list is empty! </div>";
            
        ?>
    </div>
</div>

</body>
</html>