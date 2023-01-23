

<?php
	include_once("Lib.php");
	$data=EditStudentList();
	$jsn=json_encode($data);
	echo $jsn;
?>
