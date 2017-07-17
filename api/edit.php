<?php
	require '../db_config.php';
	$id = isset($_GET['id']) ? $_GET['id']: '1';
   // $sql = "UPDATE materialmaster SET materialcode='$materialcode', description = '$description' where id ='$id'";
    //$result = $mysqli->query($sql);
	$sql = "SELECT * FROM materialmaster WHERE id = '$id'"; 

	$sql = "SELECT materialmaster.*, 
	taxmaster.vatkarnataka as vatpercentageKA,taxmaster.vattamilnadu as vatpercentageTN,taxmaster.vatmaharashtra as vatpercentageMH,taxmaster.vatdelhi as vatpercentageDL, taxmaster.taxHyderabad as vatpercentageHY
	FROM materialmaster  LEFT JOIN taxmaster ON taxmaster.materialid = materialmaster.materialid WHERE materialmaster.materialid = '$id'"; 
	$result = $mysqli->query($sql);
	$data = $result->fetch_assoc();
	
	echo json_encode($data);
// 
?>