<?php include "top.php" ?>
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
