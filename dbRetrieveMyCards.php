<?php
	require("dbconnect.php");
	if(empty($_SESSION['user'])){
		header("Location: home.php");
		die();
	}//end if
	$array = $_SESSION['user'];
	$username = $array['name'];
	$pagetop = $_POST['page'] * 15;
	$pagebottom = $pagetop-15;
	$query = "SELECT * FROM UserCards WHERE UserID='$username' ORDER BY name Asc LIMIT $pagebottom, $pagetop;";
	$getResults = $db->prepare($query);
	$getResults->execute();
	$results = $getResults->fetchAll();
	echo json_encode($results);
?>
