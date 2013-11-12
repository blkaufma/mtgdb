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
				<div id="log-status" class="pull-right" data-log="false"><a class="btn btn-primary navbar-btn pull-right" data-toggle="modal" href="#loginmodal" id="log-btn">Sign In</a></div>
				<h3 class="navbar-header text-center">Magic Card Database</h3>
			</div>
		</div>
        <!--End Navbar-->
        <!--Row of Links-->
		<div class="row" style="width:100%">
			<div class="container">
				<ul class="list-inline text-center" style="margin:0;">
					<li class="barli"><a href="dblist.php" class="row-link">Home</a></li>
					<li class="barli"><a href="#" class="row-link">Database Search</a></li>
					<li class="barli"><a href="#" class="row-link">Trade</a></li>
					<li class="barli"><a href="#" class="row-link">Deck Lists</a></li>
					<li class="barli"><a href="#" class="row-link">Contact Us</a></li>
				</ul>
			</div>
		</div>
        <!--End Row of Links-->
		<!--Body-->
        <div class="container"> 
		</div><!-- End Body -->
		<div class="footer">
			<div class="container">
				<p>Test</p>
			</div>
		</div>
		<div class="modal fade" id="loginmodal"><!-- Login Modal -->
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="loginmodal-close">&times;</button>
						<h4 class="modal-title">Log In</h4>
                        <div id="warnings" class="alert" style="margin-bottom:0;"></div>
					</div>
					<div class="modal-body">
						<form id="login-form" action="">
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
