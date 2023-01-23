

<?php
	
	include_once("DBLib.php");
	$data=getRoutes();
	$jsn=json_encode($data);
	echo $jsn;
	
?>
