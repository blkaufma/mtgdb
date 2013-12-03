<?php
	require("dbconnect.php");
	$id = $_POST['id'];
	$name = $_POST['cardName'];
	$type = $_POST['type'];
	$supertype = $_POST['supertype'];
	$subtype = $_POST['subtype'];
	$color = $_POST['color'];
	$cost = $_POST['cost'];
	$rarity = $_POST['rarity'];
	$ability = $_POST['ability'];
	$ability = nl2br($ability);
	$count = $_POST['count'];
	$available = $_POST['available'];
	$used = $_POST['used'];
	$power = $_POST['power'];
	$toughness = $_POST['toughness'];
	$query = "UPDATE Cards SET name='$name', type='$type', supertype='$supertype', subtype='$subtype', color='$color', cost='$cost', rarity='$rarity', abilities='$ability', count='$count', power='$power', toughness='$toughness' WHERE id = '$id'";
	$getResults = $db->prepare($query);
	$getResults->execute();
?>
