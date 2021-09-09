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
//unset($_SESSION['return2']);

if(isset($_SESSION['inDB'])&& isset($_SESSION['user']) && $_SESSION['inDB']){
echo "<div class='dropdown'> <button class='dropbtn'>" . $_SESSION['user'] . "</button> <div class='dropdown-content'>
<a href='review.php'>Review Suggestions</a>
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
    Review Book Suggestions
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
        
        $favoritesSQL = "SELECT *
                          FROM suggested";
        $result = mysqli_query($link, $favoritesSQL);

        if(mysqli_num_rows($result) > 0){
            //output data of each row
            $count =0;
            while($row = mysqli_fetch_array($result,MYSQLI_NUM)){
                 $authName= $row[0] ;
            $_SESSION['authorName']= $authName;
           
            $title = $row[1];
            $_SESSION['title1']=$title;
            $year = $row[2];
            $_SESSION['year1']=$year;
            $genre2 = $row[3];
            $_SESSION['genre2']=$genre2;
            $theme2 = $row[4];
            $_SESSION['theme2']=$theme2;
            $ident2 = $row[5];
            $_SESSION['ident2']=$ident2;
            $length2 = $row[6];
            $_SESSION['length3']=$length2;
            $isbn = $row[7];
            $_SESSION['isbn3']=$isbn;
            $approval = $row[8];
            $_SESSION['approval3']=$approval;
			$bookcover = $row[9];
			$_SESSION['book-cover'] = $bookcover;
			$description = $row[10];
			$_SESSION['description'] = $description;
            $booklink = $row[11];
            $_SESSION['bookLink2'] = $booklink;
			$bookid = $row[12]; 
			 
				
				
			
				?>
                
                <form id = "buttonForm" name ="ratings" method = "POST" ><br/>
            <?php
            echo " Author: <br> <input type='text' id='fname' name='authName' value = '" .$_SESSION['authorName'] ."'> 
			<br> Title: <input type='text' id='fname' name='title' value = '" .$_SESSION['title1'] ."'>
			 <br> Year: <input type='number' id='fname' name='year' value = " .$_SESSION['year1'] .">
			  <br> Genre(s): <input type='text' id='fname' name='genre2' value = '" .$_SESSION['genre2'] ."'>
			   <br> Theme(s): <input type='text' id='fname' name='theme2' value = '" .$_SESSION['theme2'] ."'>
			    <br> Author Identity: <input type='text' id='fname' name='ident2' value = '" .$_SESSION['ident2'] ."'>
				 <br> Length: <input type='text' id='fname' name='length2' value = '" .$_SESSION['length3'] ."'>
				  <br> ISBN: <input type='number' id='fname' name='isbn' value = " .$_SESSION['isbn3'] .">
				    <br> Cover: <input type='text' id='fname' name='bookcover' value = '" .$_SESSION['book-cover'] ."'>
					 <br> Description: <input type='text' id='fname' name='description' value = '" .$_SESSION['description'] ."'>
					  <br> Link: <input type='text' id='fname' name='booklink' value = '" .$_SESSION['bookLink2'] ."'>" ?>
            <button class = "likesButtons" id = "approveB" type = "submit" name = "approve" value = "<?php echo $bookid; ?>" formaction="approve.php"> approve </button>
            <button class = "likesButtons" id = "removeB" type = "submit" name = "remove" value = "<?php echo $bookid; ?>" formaction="remove.php">  remove </button>
            </form>
                <?php

                //if a book is approved but already in DB
                if(isset($_SESSION['bookInDB'])){
                    //output message
                    echo "<div align='center'>
                    The suggested book titled ". $_SESSION['title1']. " is already in the database. Please remove suggestion.
                    </div>";
                    //unset variable
                    unset($_SESSION['bookInDB']);

                }
            }
        }
        else
            echo "<div align='center'> There are no current book suggestions. </div>";
            
        ?>
    </div>
</div>

</body>
</html>