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
<?php include "signup.php" ?>
<?php include "loginmodal.php" ?>
	</body>
</html>
