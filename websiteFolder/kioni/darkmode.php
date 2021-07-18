<?php
session_start();
require('db.php');

if(!isset($_SESSION['darkmode'])){

    $_SESSION['darkmode'] = true;
    header("Location: home.php");
    exit;
}else{
	unset($_SESSION['darkmode']);
	
	header("Location: home.php");
    exit;
}
?>