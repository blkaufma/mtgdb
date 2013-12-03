<?php include "top.php" ?>
		<!--Body-->
        <div class="row" style="width:100%">
        	<div class="container">      
				<a class="btn btn-primary btn-sm icon-pencil admin" data-toggle="modal" data-target="#addcardform" id="addcard-btn"> Add a card!</a>    
	
				<table class="table table-striped table-condensed table-hover table-bordered" id="dblist-table">
                <thead>
					<tr>
						<th>Card Name</th>
						<th>Card Type</th>
						<th>Color</th>
						<th>Rarity</th>
						<th>Card Management</th>

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
							<div id="Count admin">Count:</div>
							<div id="Available admin">Available:</div>
							<div id="Used admin">Used:</div>
						</div>
						<div class="likeSection modal-content">
							<div id="Power">Power:</div>
							<div id="Toughness">Toughness:</div>
						</div>
						<div class="btn-group" id="end-place">
  								<button class="btn admin" id="edit"><i class="icon-wrench"></i>Edit</button>
                                <button class="btn admin" type="submit" id="edit-submit"><i class="icon-download-alt"></i> Submit</button>
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
		url:'/~blkaufma/cs148/final/dbretrieve.php',
		data:{'page':page},
		dataType:'json',
		success: function(data){
			for(var i=0;i<data.length;i++){
				var holder = (i+1).toString();
				var holder2 = "delete-".concat(holder);
				holder = "#".concat(holder);					   
				$(holder).append("<td class='triggerModal'>"+data[i]['name']+"</td>");
				$(holder).append("<td class='triggerModal'>"+data[i]['type']+"</td>");
				$(holder).append("<td class='triggerModal'>"+data[i]['color']+"</td>");
				$(holder).append("<td class='triggerModal'>"+data[i]['rarity']+"</td>");      
				$(holder).append("<td><button class='btn addMyCards'><i class='icon-plus'></i>Add to My Cards</button><button id='"+holder2+"' class='btn admin delete'><i class='icon-trash'></i>Delete</button><button class='btn admin increaseCount'><i class='icon-arrow-up'></i> </button><button class='btn admin decreaseCount'><i class='icon-arrow-down'></i> </button></td>");					   
				$(holder).attr('data-id',data[i]['id']);
				holder2 = "#".concat(holder2);
				$(".triggerModal").on('click',cardLook);
				$(holder2).on('click',deletion);
				$("#backPage").attr('data-pid',(page-1));
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
	function deletion(){
		var id = $(this).parent().parent().attr('data-id');
		$.ajax({
			type:'POST',
			url:'/~blkaufma/cs148/final/delete.php',
			data:{'id':id},
			dataType:'json',
			success:function(data){
			}//end success
		});//end ajax call
		unHappen();
		happen();
	}//end deletion
	function cardLook(){
		var id = $(this).parent().attr('data-id');
		//alert(id);
		$.ajax({
			type:'POST',
			url:'/~blkaufma/cs148/final/cardRetrieve.php',
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
	function pager(){
		var pid = $(this).attr('data-pid');
		if(pid != 0){
			page = pid;
			unHappen();
			happen();
			$("#pagination-links").html("");
			pageCalculator();
		}//end if
	}//end pager
	function pageCalculator(){
		$.ajax({
				type:'POST',
				url:'/~blkaufma/cs148/final/dbcount.php',
				dataType:'json',
				success: function(data){
					num_of_pages = 1000;
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
					var thisPage = page;
					$("#pagination-links").append("<li class='pagination-link icon-fast-backward' data-pid='1' id='firstPage'></li>");//
					$("#pagination-links").append("<li class='pagination-link icon-arrow-left' data-pid='"+(thisPage-1)+"' id='backPage'></li>");//
					if(num_of_pages <= 7){
						for(var i=0;i<num_of_pages;i++){
							var holder = (i+1).toString();
							temp = holder;
							holder = "pid".concat(holder);
							if(temp == page){
							}//end if
							$("#pagination-links").append("<li class='pagination-link' data-pid='"+temp+"' id= '"+holder+"'><button class='btn btn-info'>" +temp+"</button></li>");//
						}//end for
					}//end if
					else if (num_of_pages>7){
						if(page<6){
							for(var i=1;i<=6;i++){
								var holder = (i).toString();
								temp = holder;
								holder = "pid".concat(holder);
								if(temp == page){
								}//end if
								$("#pagination-links").append("<li class='pagination-link' data-pid='"+temp+"' id='"+holder+"'><button class='btn btn-info'>"+temp+"</button></li>");//
							}//end for
							$("#pagination-links").append("<li>...</li>");//
							var holder = num_of_pages
							temp = holder
							holder = "pid".concat(holder);
							$("#pagination-links").append("<li class='pagination-link' data-pid='"+temp+"' id='"+holder+"'><button class='btn btn-info'>"+temp+"</button></li>");//
						}//end if
						else if((page>=6)&&(page<num_of_pages-5)){
							$("#pagination-links").append("<li class='pagination-link' data-pid='1' id='pid1'>1</li>");//
							$("#pagination-links").append("<li>...</li>");//
							for(var i=page;i<=page+4;i++){
								var holder = (i).toString();
								temp = holder;
								holder = "pid".concat(holder);
								if(temp == page){
								}//end if
									$("#pagination-links").append("<li class='pagination-link' data-pid='"+temp+"' id='"+holder+"'><button class='btn btn-info'>"+temp+"</button></li>");//
							}//end for
							$("#pagination-links").append("<li>...</li>");//
							var holder = num_of_pages
							temp = holder
							holder = "pid".concat(holder);
							$("#pagination-links").append("<li class='pagination-link' data-pid='"+temp+"' id='"+holder+"'><button class='btn btn-info'>"+temp+"</button></li>");//
						}//end else if
						else if((page>=num_of_pages-5)&&(page<=num_of_pages)){
							$("#pagination-links").append("<li class='pagination-link' data-pid='1' id='pid1'><button class='btn btn-info'>1</button</li>");//
							$("#pagination-links").append("<li class=''>...</li>");//
							for(var i=num_of_pages-5;i<=num_of_pages;i++){
								var holder = (i).toString();
								temp = holder;
								holder = "pid".concat(holder);
								if(temp == page){
								}//end if
									$("#pagination-links").append("<li class='pagination-link' data-pid='"+temp+"' id='"+holder+"'><button class='btn btn-info'>"+temp+"</button></li>");//
							}//end for
						}//end else if
					}//end else if
					$("#pagination-links").append("<li class='pagination-link icon-arrow-right' data-pid='"+(page+1)+"' id='forwardPage'></li>");
					$("#pagination-links").append("<li class='pagination-link icon-fast-forward' data-pid='"+num_of_pages+"' id='lastPage'></li>");
					$("#edit-submit").hide();
					$(".pagination-link").on('click',pager);
				}//end success
			});//end pages function
	}//end pageCalculator
		$(document).ready(function(e){
			var pages = pageCalculator();
			happen();
			$("#edit").click(function(){
				$("#edit").hide();
				$("#edit-submit").show();
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
					url:'/~blkaufma/cs148/final/update.php',
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
