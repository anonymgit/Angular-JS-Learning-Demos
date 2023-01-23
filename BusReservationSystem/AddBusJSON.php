

<?php
	
	include_once("DBLib.php");
	$data=AddBus();
	$jsn=json_encode($data);
	echo $jsn;
	
?>
