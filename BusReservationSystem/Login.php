

<?php
	
	include_once("DBLib.php");
	$data=login();
	$jsn=json_encode($data);
	echo $jsn;
	
?>
