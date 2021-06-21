<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>
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
        <input type="checkbox" name="genre" value="Any">Any<br>      
        <input type="checkbox" name="genre" value="Biography">Biography<br>      
        <input type="checkbox" name="genre" value="Sci-Fi">Science Fiction<br>
		<input type="checkbox" name="genre" value="Fantasy">Fantasy<br>      
        <input type="checkbox" name="genre" value="Mystery">Mystery<br>      
        <input type="checkbox" name="genre" value="Thriller">Thriller<br>      
        <input type="checkbox" name="genre" value="Romance">Romance<br>      
		<input type="checkbox" name="genre" value="Autobiography">Autobiography<br>      
    </fieldset>
</label>
<label> Book Themes
<fieldset>           
        <input type="checkbox" name="theme" value="Any">Any<br>      
        <input type="checkbox" name="theme" value="BIPOC">BIPOC<br>      
        <input type="checkbox" name="theme" value="LGBTQ+">LGBTQ+<br>
		<input type="checkbox" name="theme" value="Neurodivergent">Neurodivergent<br>      
        <input type="checkbox" name="theme" value="Women">Women<br>    
    </fieldset>
</label>
<label> Author identity
<fieldset>           
        <input type="checkbox" name="ident" value="Any">Any<br>      
        <input type="checkbox" name="ident" value="BIPOC">BIPOC<br>      
        <input type="checkbox" name="ident" value="LGBTQ+">LGBTQ+<br>
		<input type="checkbox" name="ident" value="Neurodivergent">Neurodivergent<br>      
        <input type="checkbox" name="ident" value="Woman">Woman<br>    
    </fieldset>
</label>
<label> Length
<fieldset>           
        <input type="checkbox" name="length" value="Any">Any<br>      
        <input type="checkbox" name="length" value="Novel">Novel<br>      
        <input type="checkbox" name="length" value="Poem">Poem<br>
		<input type="checkbox" name="length" value="Short Story">Short Story<br>  
    </fieldset>
</label>
<label>Authors Name (Last Name, First Name) 
        <input id="Name" type="text">
        </label>
		<?php 
			echo "Note: Leave blank if you're not searching for a specific author.";
		?>
		<br>
 <button type="submit">Search</button>
</form>
<div class = "space" id= "space">
<?php
if(isset($_POST["genre"])&&isset($_POST["theme"])&&isset($_POST["ident"])&&isset($_POST["length"])){

    $genre = $_POST["genre"];
    $theme = $_POST["theme"];
    $identity = $_POST["ident"];
    $length = $_POST["length"];

    echo "Selected variables: <p></p> ". $genre . " ".$theme." ". $identity. " ". $length;

    //add selected genres in an arraylist

    //add selected themes in an arraylist

    //add selected identities in an arraylist

    //add selected lengths in an arraylist

    //if specific author, search database with typed in name with selected genres



     
}
?>
 <!--after submit button, the list would show up here-->
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