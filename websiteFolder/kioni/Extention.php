<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Credentials: true ");
header("Access-Control-Allow-Methods: OPTIONS, GET, POST");
header("Access-Control-Allow-Headers: Content-Type, Depth, User-Agent, X-File-Size, X-Requested-With, If-Modified-Since, X-File-Name, Cache-Control");
require('db.php');
// gets what the xhr sent in string format
$in = file_get_contents('php://input');
// turns the json string into php code
$data2 = json_decode($in);
// builds the query 
$query = "SELECT * FROM books_authors Where Genre = 'Null'";
foreach($data2 as $d){
     $query .= "OR Genre LIKE '%" . $d ."%'";
  }
$query .= ";";
// sends the query to database 
   $sql = @mysqli_query($link, $query);
//processes the results 
   if(mysqli_num_rows($sql) > 0){
       //output data of each row
       
        while($row = mysqli_fetch_array($sql,MYSQLI_NUM)){ 
		 $lastName= $row[0] ;
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
			$description =str_replace('"', "", $row[10]);
			$_SESSION['description'] = $description;
			$booklink = $row[11];
		// what will be the this.responcetext 
		echo  ""?>
		<hr><br>
                      <img src=' <?php echo $bookcover; ?>'  alt='cover' width='150' height='230' class='image1'>
          <p class='title1'><b>Title:</b> <a href=' <?php echo $booklink; ?>' target='_blank'> <?php echo $title; ?></a></p>
          <p class='author1'><b>By:</b>  <?php echo $authName; ?></p>
          <p class='genre1'><b>Genre:</b>  <?php echo $genre2; ?></p>
          <p class='ISBN1'><b>ISBN-13:</b>  <?php echo $isbn; ?></p><br><br><br><br>

                      <!--Book Description 1-->
                      <div class='description1'>
                        <details>
                          <summary><b>Book Description</b></summary>
                            <div class='summary2'>  <?php echo $description; ?>
                          </div>
                        </details>
                      </div>

                      <br><br><br><hr><br> <?php  ;
		
		
		}
   }

?>
