<?php
	require '../db_config.php';
	$id = isset($_GET['id']) ? $_GET['id'] : '';
	$sql = "DELETE FROM materialmaster WHERE id = '".$id."'";
	$result = $mysqli->query($sql);
	
	echo json_encode([$id]);
// 
?>