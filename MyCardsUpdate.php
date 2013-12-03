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
				<a class="btn btn-primary navbar-btn btn-sm icon-pencil admin" data-toggle="modal" data-target="#addcardform" id="addcard-btn">Add a card!</a>    
				<table class="table table-striped table-hover table-bordered" id="dblist-table">
                <thead>
					<tr>
						<th>Remove</th>
						<th>Name</th>
						<th>Type</th>
						<th>Color</th>
						<th>Rarity</th>
						<th>Count</th>
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
		<div class="modal fade" id="ViewCardModal"><!-- ViewCardModal -->
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="ViewCardModal-close">&times;</button>
						<h4 class="modal-title" id="cardName">Name</h4>
                        <div id="warnings" class="alert" style="margin-bottom:0;"></div>
					</div>
					<div class="modal-body span12" id="cardViewForm">
						<div class="cardFrame modal-content">
						<img class="cardPicture" width="250" height="300"> 
						</div>
							
						<div id="allTypes" class="likeSection modal-content"> 
							<div id="Type">Type:</div>
							<div id="Supertype">Supertype:</div>
							<div id="Subtype">Subtype:</div>
						</div>
						<div class="likeSection modal-content">
							<div id="Color">Color:</div>
							<div id="theCost">Cost:</div>
							<div id="Rarity">Rarity:</div>
						</div>
						<div class="likeSection modal-content">
							<div id="Ability">Ability:</div>
						</div>
						<div id="Stock" class="likeSection modal-content">
							<div id="Count">Count:</div>
							<div id="Available">Available:</div>
							<div id="Used">Used:</div>
						</div>
						<div class="likeSection modal-content">
							<div id="Power">Power:</div>
							<div id="Toughness">Toughness:</div>
						</div>
						<div class="btn-group" id="end-place">
  								<button class="btn" id="edit"><i class="icon-wrench"></i>Edit</button>
                                <button class="btn" type="submit" id="edit-submit"><i class="icon-download-alt"></i> Submit</button>
  							</div>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
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
				$(holder).append("<td><button class='btn deleteCard'><i class='icon-trash'></i>Delete</button></td>");					   
				$(holder).append("<td>"+data[i]['name']+"</td>");
				$(holder).append("<td>"+data[i]['type']+"</td>");
				$(holder).append("<td>"+data[i]['color']+"</td>");
				$(holder).append("<td>"+data[i]['rarity']+"</td>");      
				$(holder).append("<td><button class='btn btn-success increaseMyCardCount'><i class='icon-arrow-up'></i></button><button class=''>" +data[i]['count']+"</button><button class='btn btn-danger decreaseMyCardCount'><i class='icon-arrow-down'></i></button></td>");      
				$(holder).attr('data-id',data[i]['id']);
				$(holder).on('click',cardLook);
			}//end for
		}//end success function
	});//end ajax call
	}//end happen
	function unHappen(){
		for(var i=1;i<=15;i++){
			var holder = (i).toString();
			holder = "#".concat(holder);
			$(holder).html("");
		}//end for
	}//end unHappen
	function cardLook(){
		var id = $(this).attr('data-id');
		//alert(id);
		$.ajax({
			type:'POST',
			url:'/~blkaufma/cs148/final/MyCardRetrieve.php',
			data:{'id':id},
			dataType:'json',
			success:function(data){
				var cost = data[0]['cost'];
				$("#cardName").html("Name: "+data[0]['name']);
				$("#Type").html("Type: "+data[0]['type']);
				$("#Supertype").html("Supertype: "+data[0]['supertype']);
				$("#Subtype").html("Subtype: "+data[0]['subtype']);
				$("#Color").html("Color: "+data[0]['color']);
				$("#theCost").html("Cost: "+data[0]['cost']);
				$("#Rarity").html("Rarity: "+data[0]['rarity']);
				$("#Ability").html("Ability: "+data[0]['abilities']);
				$("#Count").html("Count: "+data[0]['count']);
				$("#Available").html("Available: "+data[0]['available']);
				$("#Used").html("Used: "+data[0]['used']);
				$("#Power").html("Power: "+data[0]['power']);
				$("#Toughness").html("Toughness: "+data[0]['toughness']);
				$("#edit").attr('data-id',id);
				//$("#cardPicture").append(“ “+data['color']);
				$("#ViewCardModal").modal('show');
				
			},//end success function
			error:function(){alert("fail")}//end error statement
		});//end ajax call
	}//end cardLook
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
					$("#edit-submit").hide();
					happen();
				}//end success
			});//end pages function
			$("#edit").click(function(){
				var cardName = $("#cardName").text().slice(6);
				$("#cardName").html("Name: "+"<input class='EditField' id='cardNameEdit' type='text' name='cardName' value='"+cardName+"'>");
				var Type = $("#Type").text().slice(6);
				$("#Type").html("Type: "+"<input class='EditField' id='typeEdit' type='text' name='Type' value='"+Type+"'>");
				var Supertype = $("#Supertype").text().slice(11);
				$("#Supertype").html("Supertype: "+"<input class='EditField' id='supertypeEdit' type='text' name='Supertype' value='"+Supertype+"'>");
				var Subtype = $("#Subtype").text().slice(9);
				$("#Subtype").html("Subtype: "+"<input class='EditField' id='subtypeEdit' type='text' name='Subtype' value='"+Subtype+"'>");
				var Color = $("#Color").text().slice(7);
				$("#Color").html("Color: "+"<input class='EditField' id='colorEdit' type='text' name='Color' value='"+Color+"'>");
				var theCost = $("#theCost").text().slice(6);
				$("#theCost").html("Cost: "+"<input class='EditField' id='theCostEdit' type='text' name='theCost' value='"+theCost+"'>");
				var Rarity = $("#Rarity").text().slice(8);
				$("#Rarity").html("Rarity: "+"<input class='EditField' id='rarityEdit' type='text' name='Rarity' value='"+Rarity+"'>");
				var Ability = $("#Ability").text().slice(9);
				$("#Ability").html("Ability: "+"<textarea class='EditField2' id='abilityEdit' type='text' name='Ability' value='"+Ability+"'>");
				$("#abilityEdit").val(Ability);
				var Count = $("#Count").text().slice(7);
				$("#Count").html("Count: "+"<input class='EditField' id='countEdit' type='text' name='Count' value='"+Count+"'>");
				var Available = $("#Available").text().slice(11);
				$("#Available").html("Available: "+"<input class='EditField' id='availableEdit' type='text' name='Available' value='"+Available+"'>");
				var Used = $("#Used").text().slice(6);
				$("#Used").html("Used: "+"<input class='EditField' type='text' id='usedEdit' name='Used' value='"+Used+"'>");
				var Power = $("#Power").text().slice(7);
				$("#Power").html("Power: "+"<input class='EditField' type='text' id='powerEdit' name='Power' value='"+Power+"'>");
				var Toughness = $("#Toughness").text().slice(11);
				$("#Toughness").html("Toughness: "+"<input class='EditField' id='toughnessEdit' type='text' name='Toughness' value='"+Toughness+"'>");
				$("#edit").hide();
				$("#edit-submit").show();
			});//end edit
			$(document).on('hide.bs.modal',function(){
				$("#edit-submit").hide();
				$("#edit").show();
			});//switches the submit button back to the edit button
			$("#edit-submit").click(function(){
				var cardName = $("#cardNameEdit").val();
				var cardType = $("#typeEdit").val();
				var Supertype = $("#supertypeEdit").val();
				var Subtype = $("#subtypeEdit").val();
				var Color = $("#colorEdit").val();
				var theCost = $("#theCostEdit").val();
				var Rarity = $("#rarityEdit").val();
				var Ability = $("#abilityEdit").val();
				var Count = $("#countEdit").val();
				var Available = $("#availableEdit").val();
				var Used = $("#usedEdit").val();
				var Power = $("#powerEdit").val();
				var Toughness = $("#toughnessEdit").val();
				var edit = $("#edit").attr('data-id');
				$.ajax({
					type:"POST",
					url:'/~blkaufma/cs148/final/MyCardsUpdate.php',
					data:{
						'cardName':cardName,					
						'type':cardType,	
						'supertype':Supertype,
						'subtype':Subtype,
						'color':Color,
						'cost':theCost,
						'rarity':Rarity,
						'ability':Ability,
						'count':Count,
						'available':Available,
						'used':Used,
						'power':Power,
						'toughness':Toughness,
						'id':edit
					},//end data(finally)
					success:{},
					error:(function(xhr){alert("something went wrong "+ xhr.statusText)})
				})//end ajax call
				unHappen();
				happen();
			//	$("#ViewCardModal").modal('hide');
			});//end submit
        });
	</script>
</html>
