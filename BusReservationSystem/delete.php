

<?php
	
	include_once("DBLib.php");
	$data=getUserDelete();
	$jsn=json_encode($data);
	echo $jsn;
	
?>
