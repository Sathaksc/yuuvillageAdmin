<?php
	require '../db_config.php';
	$post = file_get_contents('php://input');
	$post = json_decode($post);

	//{,"typeid":"1","groupid":"2","vatpercentage":"5.50","unitPrice":"91900.00","currencyType":"INR","vatpercentageKA":"4","vatpercentageTN":"4","vatpercentageMH":"4","vatpercentageDL":"4","vatpercentageHY":"4"}

	$sql = "INSERT INTO materialmaster (materialcode, description, typeid, groupid, unitPrice, currencyType, vatpercentage) 
		VALUES ('$post->materialcode', '$post->description', '$post->typeid', '$post->groupid', '$post->unitPrice', '$post->currencyType', '$post->vatpercentageKA');";
	
	$result = $mysqli->query($sql);
	$data['result'] = $result;
	$materialid = $mysqli->insert_id;
	$data['insert_id'] = $materialid;

	$sql = "INSERT INTO taxmaster (materialid, vatkarnataka , vattamilnadu, vatmaharashtra, vatdelhi, taxHyderabad) VALUES
			('$materialid', '$post->vatpercentageKA', '$post->vatpercentageTN', '$post->vatpercentageMH', '$post->vatpercentageDL', '$post->vatpercentageHY')";
	$result = $mysqli->query($sql);
	
$data['sql'] = $sql;

	$sql = "SELECT materialmaster.*, 
	taxmaster.vatkarnataka as vatpercentageKA,taxmaster.vattamilnadu as vatpercentageTN,taxmaster.vatmaharashtra as vatpercentageMH,taxmaster.vatdelhi as vatpercentageDL, taxmaster.taxHyderabad as vatpercentageHY
	
	  FROM materialmaster  LEFT JOIN taxmaster ON taxmaster.materialid = materialmaster.id Order by materialmaster.id desc LIMIT 31"; 
	$result = $mysqli->query($sql);
	$json = $result->fetch_assoc();
	$data['data'] = $json;
	echo json_encode($data);
// 
?>