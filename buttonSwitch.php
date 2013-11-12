<?php
	if(isset($_SESSION['user'])){
		$array = $_SESSION['user'];
		echo '<p id="loggedIn" class="navbar-text">Logged in as: '.$array['name'].'</p>';
		echo '<a class="btn btn-primary navbar-btn btn-sm pull-right" data-toggle="modal" data-target="#loginmodal" id="logout-btn">Sign Out</a>';
	}//end if
	else{
		echo '<a class="btn btn-primary navbar-btn pull-right" data-toggle="modal" href="#loginmodal" id="log-btn">Sign In</a>';
	}//end else
?>
