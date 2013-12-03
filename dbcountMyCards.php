<?php
	require("dbconnect.php");
	if(empty($_SESSION['user'])){
		header("Location: home.php");
		die();
	}//end if
	$array = $_SESSION['user'];
	$username = $array['name'];
	$query = "SELECT COUNT(*) FROM UserCards";
	$getResults = $db->prepare($query);
	$getResults->execute();
	$results = $getResults->fetchColumn();
	echo json_encode($results);
?>
