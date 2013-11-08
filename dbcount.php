<?php
	require("dbconnect.php");
	$query = "SELECT COUNT(*) FROM Cards";
	$getResults = $db->prepare($query);
	$getResults->execute();
	$results = $getResults->fetchColumn();
	echo json_encode($results);
?>
