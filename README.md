mtgdb
=====

Magic the Gathering Database
<?php
	require ("dbconnect.php");
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Magic the Gathering Database</title>
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
				<a class="navbar-brand pull-left navbar-inverse" href="#">Image goes here</a>
				<div id="log-status" class="pull-right" data-log="false"><? include 'buttonSwitch.php' ?></div>
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
					<li class="barli"><a href="#" class="row-link">Home</a></li>
					<li class="barli" id="dblist-link"><a href="dblist.php" class="row-link" id="dblist-link">Database Search</a></li>
					<li class="barli"><a href="#" class="row-link">Trade</a></li>
					<li class="barli"><a href="#" class="row-link">Deck Lists</a></li>
					<li class="barli"><a href="#" class="row-link">Contact Us</a></li>
				</ul>
			</div>
		</div>
        <!--End Row of Links-->
		<!--Body-->
        <div class="container">  
			<!--Carousel Container-->
        	<div class="col-lg-4 col-lg-offset-4" style="padding-top:20px;">
				<!--Carousel-->
				<div id="trade-carousel" class="carousel slide" data-interval="false"><!-- class of slide for animation -->
					<div class="carousel-inner">
						<div class="item active text-center"><!-- class of active since it's the first item -->
							<img src="Images/image1.jpg" alt="" />
							<div class="carousel-caption">
								<h3>Want to trade for this card?</h3>
								<p>Or search cards we have for trade</p>
								<input type="text" placeholder="Enter Search Term Here" style="width:auto;" class="carousel-input">
								<button type="submit" class="btn btn-success">Search</button>
							</div>
						</div>
						<div class="item text-center">
							<img src="Images/image1.jpg" alt="" />
								<div class="carousel-caption">
									<h3>Want to trade for this card?</h3>
									<p>Or search cards we have for trade</p>
									<input type="text" placeholder="Enter Search Term Here" style="width:auto;" class="carousel-input">
									<button type="submit" class="btn btn-success">Search</button>
								</div>
						</div>
						<div class="item text-center">
							<img src="Images/image1.jpg" alt="" />
							<div class="carousel-caption">
								<h3>Want to trade for this card?</h3>
								<p>Or search cards we have for trade</p>
								<input type="text" placeholder="Enter Search Term Here" style="width:auto;" class="carousel-input">
								<button type="submit" class="btn btn-success">Search</button>
							</div>
						</div>
						<div class="item text-center">
							<img src="Images/image1.jpg" alt="" />
							<div class="carousel-caption">
								<h3>Want to trade for this card?</h3>
								<p>Or search cards we have for trade</p>
								<input type="text" placeholder="Enter Search Term Here" style="width:auto;" class="carousel-input">
								<button type="submit" class="btn btn-success">Search</button>
							</div>
						</div>
					</div><!-- /.carousel-inner -->
					<!--  Next and Previous controls below href values must reference the id for this carousel -->
					<a class="carousel-control left" href="#trade-carousel" data-slide="prev"></a>
					<a class="carousel-control right" href="#trade-carousel" data-slide="next"></a>
				</div><!-- /.carousel -->   
			</div>        
		</div><!-- End Body -->
		<div class="modal fade" id="loginmodal"><!-- Login Modal -->
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="loginmodal-close">&times;</button>
						<h4 class="modal-title">Log In</h4>
                        <div id="warnings" class="alert" style="margin-bottom:0;"></div>
					</div>
					<div class="modal-body">
						<form id="login-form">
							<input type="text" class="form-control" style="100px" placeholder="Username" id="username">
							<input type="password" class="form-control" style="100px" placeholder="Password" id="password">
							<div style="text-align:center;">
								<button type="button" class="btn btn-primary text-center login-btn" style="top:50%;" id="login" data-open="close">Log In</button>
							</div>
						</form>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- End  Login Modal -->
	</body>
</html>
