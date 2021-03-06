<?php require("dbconnect.php"); ?>

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
        <?php include "loginmodal.php" ?>
		<?php include "validation_functions.php" ?>
		<?php 
		$permissions = $_SESSION['user'];
		$level = $permissions['permissions'];
		if ($level == 0){
			echo "<link rel='stylesheet' href='includes/admin.css'>";
			echo "<script> alert('$level');</script>";		 
		}//end if
		else{
			echo "<link rel='stylesheet' href='includes/notadmin.css'>";
		}//end else
		?>
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
				<h3 class="navbar-header text-center">Magic Card Database</h3>
				<div id="" class="pull-left" data-log="">
					<? include 'signup.php' ?>
				</div>

				<div id="log-status" class="pull-right" data-log="false">
					<? include 'buttonSwitch.php' ?>
				</div>
			</div>		
		</div>
		</div>
		
        <!--End Navbar-->
        <!--Row of Links-->
		<div class="row" style="width:100%">
		
			<div class="container nav-wrap">
				<ul class="list-inline text-center" style="margin:0;">
					<li class="barli"><a href="home.php" class="row-link icon-home"> Home</a></li>
					<li class="barli"><a href="dblist.php" class="row-link icon-search"> Database</a></li>
					<li class="barli"><a href="myCards.php" class="row-link icon-folder-open"> My Cards</a></li>
					<li class="barli"><a href="decks.php" class="row-link icon-briefcase "> Deck Lists</a></li>
					<li class="barli"><a href="contact.php" class="row-link icon-fire"> Contact Us</a></li>
				</ul>
			</div>
		</div>
        <!--End Row of Links-->
