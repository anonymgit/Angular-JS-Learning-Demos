

<?php
	
	include_once("DBLib.php");
	$data=updateUserProfile();
	$jsn=json_encode($data);
	echo $jsn;
	
?>
