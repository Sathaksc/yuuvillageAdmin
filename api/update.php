<?php
	require '../db_config.php';
	$id = isset($_GET['id']) ? $_GET['id'] : '';
	
	$post = file_get_contents('php://input');
	$post = json_decode($post);
	$sql = "UPDATE materialmaster SET materialcode = '".$post->materialcode."', description = '".$post->description."' , typeid = '".$post->typeid."' , groupid = '".$post->groupid."' , vatpercentage = '".$post->vatpercentageKA."' , unitprice = '".$post->unitPrice."' , currencytype = '".$post->currencyType."' WHERE materialid = '$id'; ";
	$sql1 = "UPDATE taxmaster SET vatkarnataka='$post->vatpercentageKA', vattamilnadu='$post->vatpercentageTN',vatmaharashtra='$post->vatpercentageMH',vatdelhi='$post->vatpercentageDL',taxHyderabad='$post->vatpercentageHY' WHERE materialid='$id';";

	$result = $mysqli->query($sql);
	$result = $mysqli->query($sql1);
	$data['sql'] = $result;
	$sql = "SELECT * FROM materialmaster WHERE materialid = '".$id."'"; 
	$result = $mysqli->query($sql);
	$data['data'] = $result->fetch_assoc();
	
	echo json_encode($data);
// 
?>