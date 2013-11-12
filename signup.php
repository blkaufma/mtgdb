<?php 
/* the purpose of this page is to display a form to allow a person to register 
 * the form will be sticky meaning if there is a mistake the data previously  
 * entered will be displayed again. Once a form is submitted (to this same page) 
 * we first sanitize our data by replacing html codes with the html character. 
 * then we check to see if the data is valid. if data is valid enter the data  
 * into the table and we send and dispplay a confirmation email message.  
 *  
 * if the data is incorrect we flag the errors. 
 *  
 * Written By: Robert Erickson robert.erickson@uvm.edu 
 * Last updated on: October 10, 2013 
 *  
 *  
  -- -------------------------------------------------------- 
  -- 
  -- Table structure for table `tblRegister` 
  -- 

  CREATE TABLE IF NOT EXISTS `tblRegister` ( 
  `pkRegisterId` int(11) NOT NULL AUTO_INCREMENT, 
  `fldEmail` varchar(65) DEFAULT NULL, 
  `fldDateJoined` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  `fldConfirmed` tinyint(1) NOT NULL DEFAULT '0', 
  `fldApproved` tinyint(4) NOT NULL DEFAULT '0', 
  PRIMARY KEY (`pkPersonId`) 
  ) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ; 

 * I am using a surrogate key for demonstration,  
 * email would make a good primary key as well which would prevent someone 
 * from entering an email address in more than one record. 
 */ 

//----------------------------------------------------------------------------- 
// Initialize variables 
//   

$debug = false; 
if ($debug) print "<p>DEBUG MODE IS ON</p>"; 

$baseURL = "http://www.uvm.edu/~blkaufma/"; 
$folderPath = "cs148/final/"; 
// full URL of this form 
$yourURL = $baseURL . $folderPath . "signup.php"; 
require_once("dbconnect.php"); 

//############################################################################# 
// set all form variables to their default value on the form. for testing i set 
// to my email address. you lose 10% on your grade if you forget to change it. 

$username = "";
$password = "";
$email = ""; 

// $email = ""; 
//############################################################################# 
//  
// flags for errors 

$usernameERROR = false;
$passwordERROR = false;
$emailERROR = false;


//############################################################################# 
//   
$mailed = false; 
$messageA = ""; 
$messageB = ""; 
$messageC = ""; 


//----------------------------------------------------------------------------- 
//  
// Checking to see if the form's been submitted. if not we just skip this whole  
// section and display the form 
//  
//############################################################################# 
// minor security check 

if (isset($_POST["btnSubmit"])) { 
   // $fromPage = getenv("http_referer"); 

    if ($debug) 
        print "<p>From: " . $fromPage . " should match "; 
        print "<p>Your: " . $yourURL; 

    if ($fromPage != $yourURL) { 
//        die("<p>Sorry you cannot access this page. Security breach detected and reported.</p>"); 
    } 


//############################################################################# 
// replace any html or javascript code with html entities 
// 

    $username = htmlentities($_POST["username"], ENT_QUOTES, "UTF-8"); 
    $password = htmlentities($_POST["password"], ENT_QUOTES, "UTF-8"); 
    $email = htmlentities($_POST["email"], ENT_QUOTES, "UTF-8"); 
    


//############################################################################# 
//  
// Check for mistakes using validation functions 
    include ("validation_functions.php"); 

// 
//  create array to hold mistakes 
//  

    $errorMsg = array(); 


//############################################################################ 
//  
// Check each of the fields for errors then add any mistakes to the array. 
// 
    //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^       Check username
    if (empty($username)) { 
        $errorMsg[] = "Please enter a username"; 
        $usernameERROR = true; 
    } else { 
        $valid = verifyText($username); /* test for non-valid  data */ 
        if (!$valid) { 
            $errorMsg[] = "I'm sorry, the card name you entered is not valid."; 
            $usernameERROR = true; 
        } 
    }
    
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^       Check password

    if (empty($password)) { 
        $errorMsg[] = "Please choose password"; 
        $CardTypeERROR = true; 
    } 
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^       Check email

  if (empty($email)) { 
        $errorMsg[] = "Please enter your email address"; 
        $emailERROR = true; 
    } else { 
        $valid = verifyEmail($email); /* test for non-valid  data */ 
        if (!$valid) { 
            $errorMsg[] = "I'm sorry, email address you entered is not valid."; 
            $emailERROR = true; 
        } 
    }
    
//############################################################################ 
//  
// Processing the Data of the form 
// 

    if (!$errorMsg) { 
        if ($debug) print "<p>Form is valid</p>"; 

//############################################################################ 
// 
// the form is valid so now save the information 
//     
  //      $primaryKey = ""; 
  //      $dataEntered = false; 
        
        try { 
            $db->beginTransaction(); 

  			// Will this work? //
 			$sql = 'INSERT INTO Login SET name="' . $username . '", password="' . $password . '", email="'. $email . '"';
 			//$sql = "INSERT INTO Cards (name, type, color, cost, rarity, abilities, count, power, toughness) values ($cardname, $CardType, $color, $Cost, $rarity, $ability, $count, $power, $toughness)";

			//sql, prepare, insert, execute, last insert		
            $stmt = $db->prepare($sql); 
            if ($debug) print "<p>sql ". $sql; 
        
            $stmt->execute(); 
             
            $primaryKey = $db->lastInsertId(); 
  			// if ($debug) print "<p>pk= " . $primaryKey; 
            
            // all sql statements are done so lets commit to our changes 
           $dataEntered = $db->commit(); 
            if ($debug) print "<p>transaction complete "; 
        } catch (PDOExecption $e) { 
            $db->rollback(); 
            if ($debug) print "Error!: " . $e->getMessage() . "</br>"; 
            $errorMsg[] = "There was a problem accepting your, data please contact us directly."; 
        } 


            //################################################################# 
            // 
            //Put forms information into a variable to print on the screen 
            // 

            $messageA = '<h2>Thank you for registering.</h2>'; 

            $messageB = "<p>Click this link to confirm your registration: "; 
            $messageB .= '<a href="' . $baseURL . $folderPath  . 'confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . '">Confirm Registration</a></p>'; 
            $messageB .= "<p>or copy and paste this url into a web browser: "; 
            $messageB .= $baseURL . $folderPath  . 'confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . "</p>"; 

            $messageC .= "<p><b>Username:</b><i>   " . $username . "</i></p>"; 
           



            //############################################################## 
            // 
            // email the form's information 
            // 
             
            $subject = "Your dinner has been planned"; 
              include_once('mailmessage.php'); 
              $mailed = sendMail($email, $subject, $messageA . $messageB . $messageC); 
        } //data entered    
      } // no errors  
	 // ends if form was submitted.  


    $ext = pathinfo(basename($_SERVER['PHP_SELF'])); 
    $file_name = basename($_SERVER['PHP_SELF'], '.' . $ext['extension']); 

 //   print '<body id="' . $file_name . '">'; 

    ?> 

    <section id="main"> 
      

        <? 
//############################################################################ 
// 
//  In this block  display the information that was submitted and do not  
//  display the form. 
// 
        if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { 
            print "<h2>Your Request has "; 

          if (!$mailed) { 
                echo "not "; 
            } 
            

            echo "been processed</h2>"; 

            print "<p>A copy of this message has "; 
            if (!$mailed) { 
                echo "not "; 
            } 
            print "been sent to: " . $email . "</p>"; 

            echo $messageA . $messageC; 
        } else { 


//############################################################################# 
// 
// Here we display any errors that were on the form 
// 

            print '<div id="errors">'; 

            if ($errorMsg) { 
                echo "<ol>\n"; 
                foreach ($errorMsg as $err) { 
                    echo "<li>" . $err . "</li>\n"; 
                } 
                echo "</ol>\n"; 
            } 
            print '</div>'; 
            ?> 
            
            <!--   Take out enctype line    --> 
            <form action="<? print $_SERVER['PHP_SELF']; ?>" 
                  enctype="multipart/form-data" 
                  method="post" 
                  id="signup_form"
                  class="signup_form" 
                  action="signup.php" 
                  method="post" 
                  name="signup_form">
<!--                  
                  <title>Sign Up</title>

    <fieldset>
        <legend>Enter your information below: </legend>
        <ul>
            <li>
                <span class="required_notification">* Denotes Required Field</span>
            </li>
            <li>
                <label id="username">User Name:</label>
                <input id="username" name="username" type="text" maxlength="255" class="element text medium<?php if ($usernameERROR) echo ' mistake'; ?>" value="<?php echo $username; ?>" placeholder="Bob" required tabindex="20">
            	<span class="form_hint">Correct Format: "Bob"</span>
            </li>
   			<li>
                <label id="username">Password:</label>
                <input id="username" name="password" type="password" maxlength="255" class="element text medium<?php if ($passwordERROR) echo ' mistake'; ?>" value="<?php echo $username; ?>" placeholder="Password" required tabindex="24">
            	<span class="form_hint">Correct Format: "********"</span>
            </li>
              <li>
                <label id="email">Email Address</label>
                <input id="email" name="email" type="text" maxlength="255" class="element text medium<?php if ($emailERROR) echo ' mistake'; ?>" value="<?php echo $email; ?>" placeholder="Bob" required tabindex="29">
            	<span class="form_hint">Correct Format: "rerickso@uvm.edu"</span>
            </li>
        	<li>
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Register!" class="btn btn-success" tabindex="69"> 
            	<input type="reset" id="butReset" name="butReset" value="Reset Form" class="btn btn-warning" onclick="reSetForm()" tabindex="70">         
            </li>
        </ul>
    </fieldset>
</form>
-->
<div class="container">      
				<a class="btn btn-primary navbar-btn btn-sm" data-toggle="modal" data-target="#signupmodal" id="signup-btn">Sign Up!</a>    
<div class="modal fade" id="signupmodal"><!-- Sign Up Modal -->
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="signupmodal-close">&times;</button>
						<h4 class="modal-title">Sign Up</h4>
                        <div id="warnings" class="alert" style="margin-bottom:0;"></div>
					</div>
					<div class="modal-body">
			<form action="<? print $_SERVER['PHP_SELF']; ?>" 
                  enctype="multipart/form-data" 
                  method="post" 
                  id="signup_form"
                  class="signup_form" 
                  action="signup.php" 
                  method="post" 
                  name="signup_form">
               				<input id="username" name="username" type="text" maxlength="255" class="form-control element text medium<?php if ($usernameERROR) echo ' mistake'; ?>" value="<?php echo $username; ?>" placeholder="Username" required tabindex="20">
							<input id="password" name="password" type="text" maxlength="255" class="form-control element text medium<?php if ($passwordERROR) echo ' mistake'; ?>" value="<?php echo $password; ?>" placeholder="Password" required tabindex="21">
							<input id="email"    name="email" type="email" maxlength="255" class="form-control element text medium<?php if ($emailERROR) echo ' mistake'; ?>" value="<?php echo $email; ?>" placeholder="Email" required tabindex="24">
							<div style="text-align:center;">
								<button type="submit" id="btnSubmit" name="btnSubmit" class="btn btn-primary text-center login-btn" style="top:50%;" data-open="close">Sign Up</button>
							</div>
						</form>
					</div>
				</div><!-- /.modal-content -->
			</div><!-- /.modal-dialog -->
		</div><!-- End Signup Modal -->
<?php } //end body submit
?>

</body>

</html>


		
