var warningClose = function(){ // function that closes any warnings that can come up when logging in
	$("#warnings").slideUp("slow"); //slides the warning clicked up, slowly
	$("#warning").remove(); //removes the warning
	$("#login-warning-close").remove(); //removes the x button that closes the warning
	$("#login").attr('data-open','close'); //tells the program that no warnings are up
}//end warningClose
$(document).ready(function(e){  //document.ready tells the script to wait until the page is loaded and ready
	$("#login").click(function(){ //login button function
		if($("#log-status").attr('data-log')=="false"){  //checks to make sure that the login function hasn't already run
			var user = $("#username").val(); //sets the username to the entered value
			var pass = $("#password").val(); //sets the password to the entered value
			var checker = true; //checking variable to ensure that something was entered
			if((user == "")&&(pass=="")){ //if statement to ensure that both a username and password were entered. If either was not been, checker flips to false
				checker = false;
			}//end if
			$.ajax({ //call to the ajax function
				type: "POST", //sets the type to post
				url:"/~blkaufma/cs148/final/login.php", //uses login.php as the php file to pass to
				data:{'username':user,'password':pass,'checker':checker}, //sets the array to pass to login.php
				dataType:'json', //tells ajax to use json
				success: function(data){ //what gets run on success
					var warning = ""; //warning text variable
					var error = false; //tells if there is an error
					var completeCheck = data['completed']; //stors the json array from login.php
					if(eval(data['completed'])){ //checks to see if the login process was completed, if not throws an error and doesn't proceed
						if(eval(data['userExists'])){ //checks to see if login.php found the user
							if(eval(data['success'])){ //last check to see if anything else went wrong in login.php(most likely username+password mismatch)
								warningClose; //closes any warning messages
								$("#log-btn").remove(); //removes the login button
								$("#log-status").append('<p id="loggedIn" class="navbar-text">Logged in as: '+data['name']+'</p>'); //displays a message including the username
								$("#log-status").append('<a class="btn btn-primary navbar-btn btn-sm pull-right" data-toggle="modal" id="logout-btn">Sign Out</a>'); //logout button
								$("#log-status").attr('data-log','true'); //tells the script that someone is logged in
								$("#loginmodal").modal('hide'); //hides the login modal
							}//end if
							else{ //eval(data['success'] else statement, username/password don't match
								warning = "Username and password don't match!" //sets the warning text
								error = true; //informs the function that an error occured
							}//end else
						}//end if
						else{ //eval(data['userExists']} else statement, user does not exist
							warning = "User does not exist!";
							error = true;
						}//end else
					}//end if
					else{ //eval(data['completed') if statement, user didn't enter anything
						warning = "You didn't enter anything!";
						error = true;
					}//end else
					if(error){ //if there is an error, display it
						if($("#login").attr('data-open')=="close"){ //if the warnings div is closed, set the warning text and open it
							$("#warnings").append('<button type="button" class="close pull-right text-center" aria-hidden="true" id="login-warning-close">&times;</button>');//to close the warning
							$("#warnings").append('<p id="warning">'+warning+'</p>'); //warning text, based on error checking earlier
							$("#warnings").slideDown("slow"); //slides the warning down, showing it
							$("#login").attr('data-open',"open"); //sets the div to "open" declaring that a warning is being displayed
						}//end if
						else if($("#login").attr('data-open')=="open"){ //if the warnings div is already open, just change the displayed text to reflect the new warning
							$("#warning").text(warning); //update the text
						}//end else if
					}//end if
				}//end success
			});	//end ajax call
		}//end if
	}); //end login function
	$("#loginmodal-close").click(warningClose); // closes login warnings when the modal is closed
	$(document).on("click","#login-warning-close",warningClose); //closes login warnings
	$(document).on("click","#logout-btn",function(){ //logout function
		$("#logout-btn").remove();  //removes logout button
		$("#loggedIn").remove();  //removes the "logged in as:" statment
		$("#log-status").append('<a class="btn btn-primary navbar-btn pull-right" data-toggle="modal" href="#loginmodal" id="log-btn">Sign In</a>');  //re-adds the login button
		$("#log-status").attr('data-log','false'); //tells the script that no one is logged in again
		$.ajax({ //call to ajax
			type:"POST", //determines type as POST
			url:"../logout.php" //goes to logout.php
		})	//end ajax call
	}); // end logout function
}); //end document.ready
