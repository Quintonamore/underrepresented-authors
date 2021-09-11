<?php
session_start();
require('db.php');

$authName = " Aiden Thomas";
$title = "Cemetery Boys";
$year = 2002;
$genre2  = "fantasy action romance fiction";
$theme2 = "lgbt";
$ident2 = "lgbt bipoc";
$length2 = "novel";
$isbn = 9781250250469;
$bookcover = "https://i.gr-assets.com/images/S/compressed.photo.goodreads.com/books/1594059624l/52339313._SY475_.jpg";
$booklink = "https://www.goodreads.com/book/show/52339313-cemetery-boys";
$description = "Yadriel has summoned a ghost, and now he can’t get rid of him.

When his traditional Latinx family has problems accepting his gender, Yadriel becomes determined to prove himself a real brujo. With the help of his cousin and best friend Maritza, he performs the ritual himself, and then sets out to find the ghost of his murdered cousin and set it free.

However, the ghost he summons is actually Julian Diaz, the school’s resident bad boy, and Julian is not about to go quietly into death. He’s determined to find out what happened and tie up some loose ends before he leaves. Left with no choice, Yadriel agrees to help Julian, so that they can both get what they want. But the longer Yadriel spends with Julian, the less he wants to let him leave. ";
 $query = "INSERT INTO `books_authors`(`AuthName`, `BookTitle`, `Year`, `Genre`, `Theme`, `AuthIdent`, `Length`, `ISBN`, `Approval`, `bookcover`, `description`, `Link`)".
   "VALUES ('".$authName."', '".$title ."',". $year .", '". $genre2."','". $theme2 ."', '".$ident2 ."', '".$length2 ."',".$isbn.", 0,'".$bookcover ."','".$description."', '".$booklink."'); "; 
 
 $sql = @mysqli_multi_query($link, $query);
 
 echo $query;

if($sql = FALSE){
	ECHO "fail";
} else { echo "pass";}
?>



