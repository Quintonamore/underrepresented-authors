<?php
session_start();
require('db.php');

$_SESSION['user'] = "studentweb";
 $_SESSION['inDB'] = true; 
?>
<script type="text/javascript">
window.location.href = "home.php";
</script>
