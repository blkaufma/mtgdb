<?php
	require_once("dbconnect.php");
	$id = $_POST['id'];
	$query = "DELETE FROM Cards WHERE id = '$id'";
	$getResults = $db->prepare($query);
	$getResults->execute();
?>
