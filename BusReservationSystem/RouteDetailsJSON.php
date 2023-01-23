

<?php
	
	include_once("DBLib.php");
	$data=getBus();
	$jsn=json_encode($data);
	echo $jsn;
	
?>
