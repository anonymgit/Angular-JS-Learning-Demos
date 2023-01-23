

<?php
	include_once("Lib.php");
	$data['StudentList']=ListData();;
	$data['success']='Result fetched!!';
	$jsn=json_encode($data);
	echo $jsn;
?>
