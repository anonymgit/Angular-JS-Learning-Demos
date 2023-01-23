

<?php
	include_once("Lib.php");
	
	
	$data=DeleteStudentList($_REQUEST["Rollno"]);
	$jsn=json_encode($data);
	echo $jsn;
?>
