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
/*
//create connection
$conn = new mysqli($servername, $username, $password, $db);

//check connection
if(!$conn){
    die("Connection failed: ".mysqli_connect_error());
}
echo "Connected successfully";

*/
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
        <input type="checkbox" name="genre[]" value="Sci-Fi">Science Fiction<br>
		<input type="checkbox" name="genre[]" value="Fantasy">Fantasy<br>      
        <input type="checkbox" name="genre[]" value="Mystery">Mystery<br>      
        <input type="checkbox" name="genre[]" value="Thriller">Thriller<br>      
        <input type="checkbox" name="genre[]" value="Romance">Romance<br>      
		<input type="checkbox" name="genre[]" value="Autobiography">Autobiography<br>      
    </fieldset>
</label>
<label> Book Themes
<fieldset>           
        <input type="checkbox" name="theme[]" value="Any">Any<br>      
        <input type="checkbox" name="theme[]" value="BIPOC">BIPOC<br>      
        <input type="checkbox" name="theme[]" value="LGBTQ+">LGBTQ+<br>
		<input type="checkbox" name="theme[]" value="Neurodivergent">Neurodivergent<br>      
        <input type="checkbox" name="theme[]" value="Women">Women<br>    
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
<label>Authors Name (Last Name, First Name) 
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
if( $_SESSION['user'] != ""){
 $like = $_POST["like"];
echo $like[0]; 
$noyj = @mysqli_multi_query($link,$like[0] );
}
if(isset($_POST["search"])){

    //basically gets the values that were chosen in the checkbox and puts in array
    $genre = $_POST['genre'];
    $theme = $_POST['theme'];
    $identity = $_POST['ident'];
    $length = $_POST['length'];


    //GENRES
    if(!empty($_POST['genre'])){
        //loop to store and display genres
        echo "Genres chosen: </br>";
        foreach($_POST['genre'] as $checkedG){
            //if last element, break
            if($checkedG == $genre[count($genre)-1]){
                echo $checkedG. "</br>";
            }
            else
                echo $checkedG. ", ";
        }
    }
    //THEMES
    if(!empty($_POST['theme'])){
        //loop to store and display themes
        echo "Themes chosen: </br>";
        foreach($_POST['theme'] as $checkedT){
            //if last element, break
            if($checkedT == $theme[count($theme)-1]){
                echo $checkedT. "</br>";
            }
            else
                echo $checkedT. ", ";
        }
    }

    //AUTHOR IDENTITY
    if(!empty($_POST['ident'])){
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

    //LENGTH
    if(!empty($_POST['length'])){
        //loop to store and display identities
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

    //if specific author, search database with typed in name with selected genres etc. 
    if(!empty($_POST['Name'])){
        $author_name = $_POST['Name'];
        echo "Search for author: ". $author_name;
    }
    else
        echo "No author submitted. </br>";


    //if the "any" checkbox is checked, then the user would not be allowed to check any of the other options
    //unless they uncheck the "any" box

//QUERIES START HERE
	$whereUsed = false;
$query = "SELECT * FROM books_authors";
$AndUsed = false;
   for ($i=0; $i< sizeof($genre);$i++) {  
	   
	   if($whereUsed){
		   if($AndUsed){
			   $query .= " OR Genre = '". $genre[$i]. "'";
		   }
		   else{
			   
		   $query .= " AND ( Genre = '". $genre[$i]. "'";
		   $AndUsed = true;
		   }
	   }
	   else{
		   $query .= " WHERE ( Genre = '". $genre[$i]. "'";
		   $whereUsed = true;
		   $AndUsed = true;
	   }



   }
   if(sizeof ($genre) > 0){
	   $query .= ")";
   }
   $AndUsed = false;
   for ($i=0; $i<sizeof ($theme);$i++) {  
	   if($whereUsed){
		   if($AndUsed){
			   $query .= " OR Theme = '". $theme[$i]. "'";
		   }
		   else{
		   $query .= " AND ( Theme = '". $theme[$i]. "'";
		   $AndUsed = true;
		   }
	   }
	   else{
		   $query .= " WHERE ( Theme = '". $theme[$i]. "'";
		   $whereUsed = true;
		   $AndUsed = true;
		   
	   }



   }
   if(sizeof ($theme) > 0){
	   $query .= ")";
   }
   $AndUsed = false;
   for ($i=0; $i<sizeof ($identity);$i++) {  
	   if($whereUsed){
		   if($AndUsed){
			   $query .= " OR AuthIdent = '". $identity[$i]. "'";
		   }
		   else{
		   $query .= " AND ( AuthIdent = '". $identity[$i]. "'";
		   $AndUsed = true;
		   }
	   }
	   else{
		   $query .= " WHERE ( AuthIdent = '". $identity[$i]. "'";
		   $whereUsed = true;
		   $AndUsed = true;
		   
	   }

   }
   if(sizeof ($identity) > 0){
	   $query .= ")";
   }
   $AndUsed = false;
   for ($i=0; $i<sizeof ($length);$i++) {  
	   
	   if($whereUsed){
		   if($AndUsed){
			   $query .= " OR Length = '". $length[$i]. "'";
			   
		   }
		   else{
			   $query .= " AND (Length = '". $length[$i]. "'";
			   $AndUsed = true;
		   }
	   }
	   else{
		   $query .= " WHERE ( Length = '". $length[$i]. "'";
		   $whereUsed = true;
		   $AndUsed = true;
		   
	   }
   }
   if(sizeof ($length) > 0){
	   $query .= ")";
   }
   $query .= ";";
   //echo $query;

   $sql = @mysqli_query($link, $query);

   if(mysqli_num_rows($sql) > 0){
       //output data of each row
       while($row = mysqli_fetch_array($sql,MYSQLI_NUM)){
        // FOR LIKE BUTTON 
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
