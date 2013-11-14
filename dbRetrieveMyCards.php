<?php
	require("dbconnect.php");
	$pagetop = $_POST['page'] * 15;
	$pagebottom = $pagetop-15;
	$query = "SELECT * FROM UserCards ORDER BY name Asc LIMIT $pagebottom, $pagetop";
	$getResults = $db->prepare($query);
	$getResults->execute();
	$results = $getResults->fetchAll();
	echo json_encode($results);
?>
