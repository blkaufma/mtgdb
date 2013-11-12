<?php require("dbconnect.php"); ?>
<!--
<?php include "validation_functions.php"  ?>
-->
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Magic the Gathering Database</title>
		<link rel="shortcut icon" href="http://www.uvm.edu/~blkaufma/cs148/final/logo.jpg" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<!-- Bootstrap -->
		<link href="includes/bootstrap.css" rel="stylesheet" media="screen">
		<!--Font Awesome-->
        <link rel="stylesheet" href="font-awesome/css/font-awesome.css">
		<!--Custon Stylesheet-->
        <link rel="stylesheet" href="includes/common.css">
	</head>
	<body>
		<!--JQuery-->
		<script src="includes/jquery.js"></script>
		<!--Bootstrap Javascript-->
		<script src="includes/bootstrap.js"></script>
        <!--Custom Scripts -->
        <script src="includes/scripts.js"></script>
		<!--Navbar-->
        <div class="navbar navbar-inverse navbar-static-top" style="margin-bottom:0;">
			<div class="container text-center">
				<div id="log-status" class="pull-right" data-log="false">
				<? include 'buttonSwitch.php' ?>
				</div>
				
                <div>
					<h3 class="navbar-header text-center">Magic Card Database</h3>
				</div>
			</div>
		</div>
        <!--End Navbar-->
        <!--Row of Links-->
		<div class="row" style="width:100%">
			<div class="container">
				<ul class="list-inline text-center" style="margin:0;">
					<li class="barli"><a href="home.php" class="row-link">Home</a></li>
					<li class="barli"><a href="dblist.php" class="row-link">Database Search</a></li>
					<li class="barli"><a href="#" class="row-link">Trade</a></li>
					<li class="barli"><a href="#" class="row-link">Deck Lists</a></li>
					<li class="barli"><a href="#" class="row-link">Contact Us</a></li>
				</ul>
			</div>
		</div> 
        <!--End Row of Links-->
