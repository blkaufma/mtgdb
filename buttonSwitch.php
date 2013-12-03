<?php
	if(isset($_SESSION['user'])){
		$array = $_SESSION['user'];
		echo '<p id="loggedIn" class="navbar-text navbar-inverse text-info">Logged in as: '.$array['name'].'</p>';
		echo '<a class="btn btn-primary pull-right icon-user navbar-btn" data-toggle="modal" id="logout-btn" onclick="/~blkaufma/cs148/final/logout.php"> Sign Out</a>';
	}//end if
	else{
		echo '<a class="btn btn-primary pull-right icon-user navbar-btn" data-toggle="modal" href="#loginmodal" id="log-btn"> Sign In</a>';
	}//end else
?>
