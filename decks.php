<?php include "top.php" ?>
<?php include "createdeck.php" ?>
        <div class="row" style="width:100%">
        	<div class="container">
<div class="btn-group">
  <button class="btn btn-primary">My Decks</button>
  <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
  	<li><a class="btn btn-primary btn-sm icon-pencil admin" data-toggle="modal" data-target="#addDeckModal" id="addDeck-btn"> Create a Deck!</a></li>
  </ul>
</div>
<div class="btn-group">
  <button class="btn btn-primary">Decks</button>
  <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
	<li> Friends Decks </li>
  </ul>
</div>
</div>
</div>

        <div class="row" style="width:100%">
        	<div class="container">      	
				<table class="table table-striped table-condensed table-hover table-bordered" id="dblist-table">
                <thead>
					<tr>
						<th>Deck Name</th>
						<th>Number of Cards</th>
						<th>Colors</th>
						<th>Deck Management</th>

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
	<script>
	var page = 1;
	var num_of_pages;
	function happen(){$.ajax({
		type:'POST',
		url:'/~blkaufma/cs148/final/dbretrieveDeck.php',
		data:{'page':page},
		dataType:'json',
		success: function(data){
			for(var i=0;i<data.length;i++){
				var holder = (i+1).toString();
				holder = "#".concat(holder);					   
				$(holder).append("<td class='triggerModal'>"+data[i]['DeckTitle']+"</td>");
				$(holder).append("<td class='triggerModal'>"+data[i]['DeckCards']+"</td>");    
				$(holder).append("<td><button class='btn'><i class='icon-wrench'></i>Edit</button><button class='btn delete'><i class='icon-trash'></i>Delete</button></td>");					   
				$(holder).attr('data-id',data[i]['id']);
				$(holder).on('click',cardLook);
			}//end for
		}//end success function
	});//end ajax call
	}//end happen
	</body>
</html>
