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
			$description = $row[10];
			$_SESSION['description'] = $description;
			$booklink = $row[11];
		// what will be the this.responcetext 
		echo  " <p class='book-theme'>" .$ident2 ."</p><hr><br>
                      <img src='". $bookcover ."'  alt='cover' width='150' height='230' class='image1'>
          <p class='title1'><b>Title:</b> <a href='https://www.goodreads.com/book/show/53802072-some-girls-do' target='_blank'>S ".$title."</a></p>
          <p class='author1'><b>By:</b> Jennifer Dugan</p>
          <p class='genre1'><b>Genre:</b> Romance</p>
          <p class='ISBN1'><b>ISBN-13:</b> 9780593112533</p><br><br><br><br>

                      <!--Book Description 1-->
                      <div class='description1'>
                        <details>
                          <summary><b>Book Description</b></summary>
                            <div class='summary2'>
Morgan, an elite track athlete, is forced to transfer high schools late in her senior year after it turns out being queer is against her private Catholic schools code of conduct. There, she meets Ruby, who has two hobbies: tinkering with her baby blue 1970 Ford Torino and competing in local beauty pageants, the latter to live out the dreams of her overbearing mother. The two are drawn to each other and cant deny their growing feelings. But while Morgan--out and proud, and determined to have a fresh start--doesnt want to have to keep their budding relationship a secret, Ruby isnt ready to come out yet. With each girl on a different path toward living her truth, can they go the distance together?
                          </div>
                        </details>
                      </div>

                      <br><br><br><hr><br>" ;
		
		
		}
   }

?>