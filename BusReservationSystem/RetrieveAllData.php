

<?php
	include_once("DBLib.php");
	$data=AllUserData();
	
	$jsn=json_encode($data);
	echo $jsn;
?>
