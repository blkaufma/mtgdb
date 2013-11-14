<?php include "top.php" ?>
<?php
 if(empty($_SESSION['user'])){
	 header("Location: home.php");
	 die();
 }//end if
?>
		<!--Body-->
        <div class="row" style="width:100%">
        	<div class="container">      
				<a class="btn btn-primary navbar-btn btn-sm" data-toggle="modal" data-target="#addcardform" id="addcard-btn">Add a card!</a>    
				<table class="table table-striped table-hover table-bordered" id="dblist-table">
                <thead>
					<tr>
						<th>Card Name</th>
						<th>Card Type</th>
						<th>Number available</th>
					</tr>
                </thead>
                	<tbody>
                    	<tr class="table-open" id="1"></tr>
                    	<tr class="table-open" id="2"></tr>
                        <tr class="table-open" id="3"></tr>
                        <tr class="table-open" id="4"></tr>
                        <tr class="table-open" id="5"></tr>
                        <tr class="table-open" id="6"></tr>
                        <tr class="table-open" id="7"></tr>
                        <tr class="table-open" id="8"></tr>
                        <tr class="table-open" id="9"></tr>
                        <tr class="table-open" id="10"></tr>
                        <tr class="table-open" id="11"></tr>
                        <tr class="table-open" id="12"></tr>
                        <tr class="table-open" id="13"></tr>
                        <tr class="table-open" id="14"></tr>
                        <tr class="table-open" id="15"></tr>
                    </tbody>
                </table>
				<ul class="list-inline text-center pull-right" id="pagination-links">
				</ul>
            </div>
		</div>
        <!-- End Body -->
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
        <div class="modal fade" id="addcardform"><!-- Add Card Modal -->
        	<div class="modal-dialog">
            	<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="loginmodal-close">&times;</button>
					<h4 class="modal-title">Add a card to your database!</h4>
					<div id="warnings" class="alert" style="margin-bottom:0;"></div>
				</div>
           		<div class="modal-body add-card-modal">
					<?php include 'addCard.php' ?>
				</div>
                </div>
            </div>
        </div>
	</body>
	<script>
	var page = 1;
	var num_of_pages;
	function happen(){$.ajax({
		type:'POST',
		url:'/~blkaufma/cs148/final/dbRetrieveMyCards.php',
		data:{'page':page},
		dataType:'json',
		success: function(data){
			for(var i=0;i<data.length;i++){
				var holder = (i+1).toString();
				holder = "#".concat(holder);
				$(holder).append("<td>"+data[i]['CardID']+"</td>");
				$(holder).append("<td>"+data[i]['type']+"</td>");
				$(holder).append("<td>"+data[i]['available']+"</td>");
				$(holder).attr('data-id',data[i]['id']);
			}//end for
		}//end success function
	});//end happen
	}
		$(document).ready(function(e){
			var pages = $.ajax({
				type:'POST',
				url:'/~blkaufma/cs148/final/dbcount.php',
				dataType:'json',
				success: function(data){
					num_of_pages = data;
					var temp;
					if(num_of_pages%15>0){
						temp = (num_of_pages)-(num_of_pages%15);
						temp = temp/15;
						temp++;
						num_of_pages = temp;
					}//end if
					else{
						num_of_pages = num_of_pages/15;
					}//end else
					$("#pagination-links").append("<li class='pagination-link' id='firstPage'>&laquo;</li>");
					$("#pagination-links").append("<li class='pagination-link' id='backPage'>&lsaquo;</li>");
					if(num_of_pages <= 7){
						for(var i=0;i<num_of_pages;i++){
							var holder = (i+1).toString();
							temp = holder;
							holder = "pid".concat(holder);
							if(temp == page){
							}//end if
							$("#pagination-links").append("<li class='pagination-link' id="+holder+">"+temp+"</li>");
						}//end for
					}//end if
					else if (num_of_pages>7){
						if(page<6){
							for(var i=0;i<6;i++){
								var holder = (i+1).toString();
								temp = holder;
								holder = "pid".concat(holder);
								if(temp = page){
								}//end if
								$("#pagination-links").append("<li class='pagination-link' id="+holder+">"+temp+"</li>");
							}//end for
							$("#pagination-links").append("<li>...</li>");
							var holder = num_of_pages
							temp = holder
							holder = "pid".concat(holder);
							$("#pagination-links").append("<li class='pagination-link' id="+holder+">"+temp+"</li>");
						}//end if
					}//end else if
					$("#pagination-links").append("<li class='pagination-link' id='forwardPage'>&rsaquo;</li>");
					$("#pagination-links").append("<li class='pagination-link' id='lastPage'>&raquo;</li>");
					happen();
				}//end success
			});//end pages function
        });
	</script>
</html>
