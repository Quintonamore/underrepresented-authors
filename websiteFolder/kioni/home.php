<?php
session_start();
require('db.php');
//include('likeDislike.php');
?>
<html>
<head>

<link rel="stylesheet" href="style.css">
 <!--JavaScript file 
<script src="script.js"></script>
 
jQuery Ajax CDN 
 <script src=
"https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js">
 </script>
 -->
</head>
<body>
<?php

unset($_SESSION['favVisit']);

if(isset($_SESSION['inDB'])&& isset($_SESSION['user']) && $_SESSION['inDB']){
echo "<div class='dropdown'> <button class='dropbtn'>". $_SESSION['user']. "</button> <div class='dropdown-content'>
    <a href='favorites.php'>My Favorites</a>
    <a href='logout.php'>Logout</a>
  </div>
</div> ";
}
else{
    echo "<div class='dropdown'> <button class='dropbtn'>Account</button> <div class='dropdown-content'>
    <a href='login.php'>Log In</a>
    <a href='createAccount.php'>Sign Up</a>
  </div>
</div> ";

}
?>

<!-- Begin Webpage -->
<div class = "title">
    Title
</div>
<div class = "buttonArea">
<a href="home.php" class="button">Home</a>
<a href="bestSellers.php" class="button">Our Best-Sellers</a>
<a href="tutorial.php" class="button">Tutorial</a>
<a href="about.php" class="button">About Us</a>
</div> 
<div class = "text">
<form id = "form" action = "" method = "post">
<label> Genre 
<fieldset>           
        <input type="checkbox" name="genre[]" value="Any">Any<br>      
        <input type="checkbox" name="genre[]" value="Biography">Biography<br>
        <input type="checkbox" name="genre[]" value="Autobiography">Autobiography<br>   
        <input type="checkbox" name="genre[]" value="Fiction">Fiction<br> 
        <input type="checkbox" name="genre[]" value="Sci-Fi">Science Fiction<br>
		<input type="checkbox" name="genre[]" value="Fantasy">Fantasy<br>      
        <input type="checkbox" name="genre[]" value="Mystery">Mystery<br>      
        <input type="checkbox" name="genre[]" value="Thriller">Thriller<br>      
        <input type="checkbox" name="genre[]" value="Romance">Romance<br>      
		    
    </fieldset>
</label>
<label> Book Themes
<fieldset>           
        <input type="checkbox" name="theme[]" value="Any">Any<br>      
        <input type="checkbox" name="theme[]" value="BIPOC">BIPOC<br>      
        <input type="checkbox" name="theme[]" value="LGBTQ+">LGBTQ+<br>
		<input type="checkbox" name="theme[]" value="Neurodivergent">Neurodivergent<br>      
        <input type="checkbox" name="theme[]" value="Women">Women<br>
        <input type="checkbox" name="theme[]" value="Family">Family<br>    
    </fieldset>
</label>
<label> Author identity
<fieldset>           
        <input type="checkbox" name="ident[]" value="Any">Any<br>      
        <input type="checkbox" name="ident[]" value="BIPOC">BIPOC<br>      
        <input type="checkbox" name="ident[]" value="LGBTQ+">LGBTQ+<br>
		<input type="checkbox" name="ident[]" value="Neurodivergent">Neurodivergent<br>      
        <input type="checkbox" name="ident[]" value="Woman">Woman<br>    
    </fieldset>
</label>
<label> Length
<fieldset>           
        <input type="checkbox" name="length[]" value="Any">Any<br>      
        <input type="checkbox" name="length[]" value="Novel">Novel<br>      
        <input type="checkbox" name="length[]" value="Poem">Poem<br>
		<input type="checkbox" name="length[]" value="Short Story">Short Story<br>  
    </fieldset>
</label>
<label>Author's Name (FirstName LastName) 
        <input id = "name" name="Name" type="text">
        </label>
		<?php 
			echo "Note: Leave blank if you're not searching for a specific author.";
		?>
		<br>
 <button type="submit" name = "search" value = "Search">Search</button>
</form>
<div class = "space" id= "space">

<!-- Get info from user input-->
<?php
if(isset($_POST["search"])|| isset($_SESSION['return'])){
    
    //GENRES
    if(!empty($_POST['genre'])){
        $genre = $_POST['genre'];
        $_SESSION['genre'] = $genre;
        $genreSess = $_SESSION['genre'];
        //loop to store and display genres
        echo "Genres chosen: </br>";
        foreach($genreSess as $checkedG){
            //if last element, break
            if($checkedG == $genreSess[count($genreSess)-1]){
                echo $checkedG. "</br>";
            }
            else
                echo $checkedG. ", ";
        }
    }
    
    else{
        //if it is empty and session is set and submit button is set
        if(isset($_SESSION['genre'])&& isset($_POST["search"])){
            unset($_SESSION['genre']);
        }
        
    }
    
    //THEMES
    if(!empty($_POST['theme'])){
        //loop to store and display themes
        $theme = $_POST['theme'];
        $_SESSION['theme'] = $theme;
        $themeSess = $_SESSION['theme'];
        echo "Themes chosen: </br>";
        foreach($themeSess as $checkedT){
            //if last element, break
            if($checkedT == $themeSess[count($themeSess)-1]){
                echo $checkedT. "</br>";
            }
            else
                echo $checkedT. ", ";
        }
    }
    
    else{
        if(isset($_SESSION['theme'])&& isset($_POST["search"])){
            unset($_SESSION['theme']);
        }
        
    }

    //AUTHOR IDENTITY
    if(!empty($_POST['ident'])){
        $identity = $_POST['ident'];
        $_SESSION['identity'] = $identity;
        //loop to store and display identities
        echo "Author Identities chosen: </br>";
        foreach($_POST['ident'] as $checkedA){
            //if last element, break
            if($checkedA == $identity[count($identity)-1]){
                echo $checkedA. "</br>";
            }
            else
                echo $checkedA. ", ";
        }
    }

    else{
        if(isset($_SESSION['ident'])&& isset($_POST["search"])){
            unset($_SESSION['ident']);
        }
        
    }

    //LENGTH
    if(!empty($_POST['length'])){
        //loop to store and display 
        $length = $_POST['length'];
        $_SESSION['length'] = $length;
        echo "Lengths chosen: </br>";
        foreach($_POST['length'] as $checkedL){
            //if last element, break
            if($checkedL == $length[count($length)-1]){
                echo $checkedL. "</br>";
            }
            else
                echo $checkedL. ", ";
        }
    }

    else{
        if(isset($_SESSION['length'])&& isset($_POST["search"])){
            unset($_SESSION['length']);
        }
        
    }

    //if specific author, search database with typed in name with selected genres etc. 
    if(!empty($_POST['Name'])){
        $author_name = $_POST['Name'];
        $_SESSION['author_name'] = $author_name;
        echo "Search for author: ". $author_name;
    }
    else{
        
        if(isset($_SESSION['author_name'])&& isset($_POST["search"])){
            unset($_SESSION['author_name']);
        }
        
        echo "No author submitted. </br>";
        
    }
        


    //if the "any" checkbox is checked, then the user would not be allowed to check any of the other options
    //unless they uncheck the "any" box

//QUERIES START HERE
	$whereUsed = false;
$query = "SELECT * FROM books_authors";
$AndUsed = false;
if(!empty($_SESSION['genre'])&& ($_SESSION['genre'][0]!="Any")){
   for ($i=0; $i< sizeof($_SESSION['genre']);$i++) {  
	   
	   if($whereUsed){
		   if($AndUsed){
			   $query .= " OR Genre = '". $_SESSION['genre'][$i]. "'";
		   }
		   else{
			   
		   $query .= " AND ( Genre = '". $_SESSION['genre'][$i]. "'";
		   $AndUsed = true;
		   }
	   }
	   else{
		   $query .= " WHERE ( Genre = '". $_SESSION['genre'][$i]. "'";
		   $whereUsed = true;
		   $AndUsed = true;
	   }



   }
   if(sizeof ($_SESSION['genre']) > 0){
	   $query .= ")";
   }
}
if(!empty($_SESSION['theme'])&& ($_SESSION['theme'][0]!="Any")){
   $AndUsed = false;
   for ($i=0; $i<sizeof ($_SESSION['theme']);$i++) {  
	   if($whereUsed){
		   if($AndUsed){
			   $query .= " OR Theme = '". $_SESSION['theme'][$i]. "'";
		   }
		   else{
		   $query .= " AND ( Theme = '". $_SESSION['theme'][$i]. "'";
		   $AndUsed = true;
		   }
	   }
	   else{
		   $query .= " WHERE ( Theme = '". $_SESSION['theme'][$i]. "'";
		   $whereUsed = true;
		   $AndUsed = true;
		   
	   }



   }
   if(sizeof ($_SESSION['theme']) > 0){
	   $query .= ")";
   }
}
if(!empty($_SESSION['identity'])&& ($_SESSION['identity'][0]!="Any")){
   $AndUsed = false;
   for ($i=0; $i<sizeof ($_SESSION['identity']);$i++) {  
	   if($whereUsed){
		   if($AndUsed){
			   $query .= " OR AuthIdent = '". $_SESSION['identity'][$i]. "'";
		   }
		   else{
		   $query .= " AND ( AuthIdent = '". $_SESSION['identity'][$i]. "'";
		   $AndUsed = true;
		   }
	   }
	   else{
		   $query .= " WHERE ( AuthIdent = '". $_SESSION['identity'][$i]. "'";
		   $whereUsed = true;
		   $AndUsed = true;
		   
	   }

   }
   if(sizeof ($_SESSION['identity']) > 0){
	   $query .= ")";
   }
   

}
if(!empty($_SESSION['length'])&& ($_SESSION['length'][0]!="Any")){
    $AndUsed = false;
   for ($i=0; $i<sizeof ($_SESSION['length']);$i++) {  
	   
	   if($whereUsed){
		   if($AndUsed){
			   $query .= " OR Length = '". $_SESSION['length'][$i]. "'";
			   
		   }
		   else{
			   $query .= " AND (Length = '". $_SESSION['length'][$i]. "'";
			   $AndUsed = true;
		   }
	   }
	   else{
		   $query .= " WHERE ( Length = '". $_SESSION['length'][$i]. "'";
		   $whereUsed = true;
		   $AndUsed = true;
		   
	   }
   }
   if(sizeof ($_SESSION['length']) > 0){
	   $query .= ")";
   }
}
   $query .= ";";
   //echo $query;

   $sql = @mysqli_query($link, $query);

   if(mysqli_num_rows($sql) > 0){
       //output data of each row
       
        while($row = mysqli_fetch_array($sql,MYSQLI_NUM)){
            $lastName= $row[0] ;
            $_SESSION['lastName']= $lastName;
            $firstName = $row[1];
            $_SESSION['firstName']=$firstName;
            $title = $row[2];
            $_SESSION['title']=$title;
            $year = $row[3];
            $_SESSION['year']=$year;
            $genre2 = $row[4];
            $_SESSION['genre2']=$genre2;
            $theme2 = $row[5];
            $_SESSION['them2']=$theme2;
            $ident2 = $row[6];
            $_SESSION['ident2']=$ident2;
            $length2 = $row[7];
            $_SESSION['length2']=$length2;
            $isbn = $row[8];
            $_SESSION['isbn']=$isbn;
            $approval = $row[9];
            $_SESSION['approval']=$approval;
			$bookcover = $row[10];
			$_SESSION['book-cover'] = $bookcover;
			$description = $row[11];
			$_SESSION['description'] = $description;

            ?>
            
            <form id = "buttonForm" name ="ratings" method = "POST" ><br/>
            <?php
            echo "<img src=\"".$bookcover ."\" alt=\"Girl in a jacket\" width=\"40\" height=\"60\">".$_SESSION['lastName']. ", ". $_SESSION['firstName']. "- \"".$_SESSION['title']."\", ".$_SESSION['year']. ", ISBN: ".$_SESSION['isbn']. "</br> 
            Approval Rating: ".$_SESSION['approval']."%, Description: " . $description . ""; ?>
            <button class = "likesButtons" id = "likeB" type = "submit" name = "like" value = "<?php echo $isbn; ?>" formaction="likes.php"> Like </button>
            <button class = "likesButtons" id = "dislikeB" type = "submit" name = "dislike" value = "<?php echo $isbn; ?>" formaction="dislikes.php">  Dislike </button>
            </form>

            <?php
            //unset session variables from checkboxes
            unset($_SESSION['genre']);
            unset($_SESSION['theme']);
            unset($_SESSION['identity']);
            unset($_SESSION['length']);

        }
        

       //if not signed, click on button and direct to log in page.
       //if signed in, click on button, change color + insert into favorites/ dislikes
       //if clicked on again, change back to original color and update favorites/ dislikes
       //update approval column in books_authors table
   }
   else
        echo "No matches within our databse.";
  
}

?>


</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js">
</script>
<script>
$("#form").on("submit", function(event) {
		$("#space").text(" ")
		var $genre = $("#genre")
		var $authorID = $("#author-id")
		var $theme = $("#Themes")
		var $name = $("#Name")
		var $length = $("#length")
		
		var genre = $genre.val()
		var authorID = $authorID.val()
		var theme = $theme.val()
		var name = $name.val()
		var Booklength = $length.val() 
		
		var $text= $("<p>"+ genre + " " + theme + " " + authorID +" "+ Booklength +" "+ name + "<p>");
		$text.appendTo("#space")
    });

</script>
</body>
</html>
