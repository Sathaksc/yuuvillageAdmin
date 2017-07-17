<?php
	require '../db_config.php';

	$num_rec_per_page = 10;
	if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
	$start_from = ($page-1) * $num_rec_per_page;

	if (!empty($_GET["search"])){
		$sqlTotal = "SELECT * FROM materialmaster
			WHERE (materialcode LIKE '%".$_GET["search"]."%' OR description LIKE '%".$_GET["search"]."%' OR typeid LIKE '%".$_GET["search"]."%' OR groupid LIKE '%".$_GET["search"]."%' OR vatpercentage LIKE '%".$_GET["search"]."%' OR unitPrice LIKE '%".$_GET["search"]."%' OR currencyType LIKE '%".$_GET["search"]."%')"; 
		$sql = "SELECT * FROM materialmaster
			WHERE (materialcode LIKE '%".$_GET["search"]."%' OR description LIKE '%".$_GET["search"]."%' OR typeid LIKE '%".$_GET["search"]."%' OR groupid LIKE '%".$_GET["search"]."%' OR vatpercentage LIKE '%".$_GET["search"]."%' OR unitPrice LIKE '%".$_GET["search"]."%' OR currencyType LIKE '%".$_GET["search"]."%') 
			LIMIT $start_from, $num_rec_per_page"; 
	}else{
		$sqlTotal = "SELECT * FROM materialmaster"; 
		$sql = "SELECT materialmaster.*, 
		taxmaster.vatkarnataka as vatpercentageKA,taxmaster.vattamilnadu as vatpercentageTN,taxmaster.vatmaharashtra as vatpercentageMH,taxmaster.vatdelhi as vatpercentageDL, taxmaster.taxHyderabad as vatpercentageHY
		 FROM materialmaster  LEFT JOIN taxmaster ON taxmaster.materialid = materialmaster.materialid
				LIMIT $start_from, $num_rec_per_page"; 
	}

	$result = $mysqli->query($sql);

	while($row = $result->fetch_assoc()){
	     $json[] = $row;
	}
	$data['data'] = $json;
	

	$sqlMaterialType = "SELECT typeid, typename FROM materialtype;";
	$result = $mysqli->query($sqlMaterialType);
	while($row = $result->fetch_assoc()){
	     $json1[] = $row;
	}
	$data['materialType'] = $json1;

	$sqlMaterialGroup = "SELECT groupid, groupname FROM materialgroup;";
	$result = $mysqli->query($sqlMaterialGroup);
	while($row = $result->fetch_assoc()){
	     $json2[] = $row;
	}
	$data['materialGroup'] = $json2;

	$result =  mysqli_query($mysqli,$sqlTotal);
	$data['total'] = mysqli_num_rows($result);
	
	echo json_encode($data);
?>
