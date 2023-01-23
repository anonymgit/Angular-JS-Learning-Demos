

<?php
	
	include_once("DBLib.php");
	$data=getStationName();
	$jsn=json_encode($data);
	echo $jsn;
	
?>
