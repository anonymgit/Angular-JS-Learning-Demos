

<?php
	include_once("DBLib.php");
	$data=getAllAdmin();
	
	$jsn=json_encode($data);
	echo $jsn;
?>
