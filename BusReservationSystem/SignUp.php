

<?php
	
	include_once("DBLib.php");
	$data=registerUser();
	$jsn=json_encode($data);
	echo $jsn;
	
?>
