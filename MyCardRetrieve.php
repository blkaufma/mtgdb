<?php
	require("dbconnect.php");
	$id = $_POST['id'];
	$query = "SELECT * FROM UserCards WHERE id = '$id'";
	$getResults = $db->prepare($query);
	$getResults->execute();
	$results = $getResults->fetchAll();
	echo json_encode($results); 
?>
