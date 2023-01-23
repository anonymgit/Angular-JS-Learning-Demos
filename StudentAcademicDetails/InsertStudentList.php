

<?php
	include_once("Lib.php");
	$data=InsertStudentData();
	$jsn=json_encode($data);
	echo $jsn;
?>
