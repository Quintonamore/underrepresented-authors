<?php
session_start();
require('db.php');

if(!isset($_SESSION['darkmode'])){

    $_SESSION['darkmode'] = true;
    ?>
<script type="text/javascript">
window.location.href = 'home.php';
</script>
<?php
    exit;
}else{
	unset($_SESSION['darkmode']);
	?>
<script type="text/javascript">
window.location.href = 'home.php';
</script>
<?php
    exit;
}
?>