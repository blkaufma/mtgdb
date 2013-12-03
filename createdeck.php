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
//  
// Initialize variables 
//   

$debug = false; 
if ($debug) print "<p>DEBUG MODE IS ON</p>"; 

$baseURL = "http://www.uvm.edu/~blkaufma/"; 
$folderPath = "cs148/final/"; 
// full URL of this form 
$yourURL = $baseURL . $folderPath . "createdeck.php"; 
require_once("dbconnect.php"); 

//############################################################################# 
// set all form variables to their default value on the form. for testing i set 
// to my email address. 
$deckname = "";
$color = ""; 
// $email = ""; 
//############################################################################# 
//  
// flags for errors 

$decknameERROR = false;


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
    $fromPage = getenv("http_referer"); 

    if ($debug) 
        print "<p>From: " . $fromPage . " should match "; 
        print "<p>Your: " . $yourURL; 

    if ($fromPage != $yourURL) { 
// die("<p>Sorry you cannot access this page. Security breach detected and reported.</p>"); 
    } 


//############################################################################# 
// replace any html or javascript code with html entities 
// 

    $deckname = htmlentities($_POST["deckname"], ENT_QUOTES, "UTF-8"); 
    $color = htmlentities($_POST["color"], ENT_QUOTES, "UTF-8"); 


//############################################################################# 
//  
// Check for mistakes using validation functions 
 require_once ("validation_functions.php"); 

// 
// create array to hold mistakes 
//  

    $errorMsg = array(); 


//############################################################################ 
//  
// Check each of the fields for errors then add any mistakes to the array. 
// 
    //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^       Check card name
    if (empty($deckname)) { 
        $errorMsg[] = "Please enter the Deck's name"; 
        $decknameERROR = true; 
    } else { 
        $valid = verifyText($deckname); /* test for non-valid  data */ 
        if (!$valid) { 
            $errorMsg[] = "I'm sorry, the deck name you entered is not valid."; 
            $decknameERROR = true; 
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
			if(isset($_POST["Green"])){
				$color1 = "Green ";
			}//end if
			if(isset($_POST["Blue"])){
				$color2 = "Blue ";
			}//end if
			if(isset($_POST["Red"])){
				$color3 = "Red ";
			}//end if
			if(isset($_POST["White"])){
				$color4 = "White ";
			}//end if
			if(isset($_POST["Black"])){
				$color5 = "Black ";
			}//end if
			if(isset($_POST["Colorless"])){
				$color6 = "Colorless ";
			}//end if
			$color = $color1 . $color2 . $color3 . $color4 . $color5 . $color6;

			$tblname = "Decks";
			$array = $_SESSION['user'];
			$username = $array['name'];

			$sql = 'INSERT INTO '.$tblname.' SET deckname="' . $deckname . '", deckcolor="'. $color . '", deckcreator = "'. $username . '"';		

			//sql, prepare, insert, execute, last insert		
            $stmt = $db->prepare($sql); 
            if ($debug) print "<p>sql ". $sql; 
        
            $stmt->execute(); 
             
            $primaryKey = $db->lastInsertId(); 
  			// if ($debug) print "<p>pk= " . $primaryKey; 
            				 			 
            //$primaryKey = $db->lastInsertId(); 
            //if ($debug) print "<p>pk= " . $primaryKey;
            
            //finish addition here
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

            $messageC .= "<p><b>You entered the following card:</b><i>   " . $deckname . "</i></p>"; 
            $messageC .= "<p>Color:</b><i>   " . $color . "</i></p>"; 

            //############################################################## 
            // 
            // email the form's information 
            // 
             
            $subject = "Your card has been added."; 
          include_once('mailmessage.php'); 
          $mailed = sendMail($email, $subject, $messageA . $messageB . $messageC); 
        } //data entered    
       // no errors  
   }// ends if form was submitted.  


    $ext = pathinfo(basename($_SERVER['PHP_SELF'])); 
    $file_name = basename($_SERVER['PHP_SELF'], '.' . $ext['extension']); 

    print '<body id="' . $file_name . '">'; 

    ?> 

    <section id="main"> 
      

<?
//############################################################################ 
// 
//  In this block  display the information that was submitted and do not  
//  display the form. 
// 
        if (isset($_POST["btnSubmit"]) AND empty($errorMsg)) { 
            print "<h2>Your deck has "; 

            if (!$mailed) { 
       //         echo "not "; 
            } 

            echo "been added to your database!</h2>"; 

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
            
<div class="modal fade" id="addDeckModal"><!-- add deck Modal -->
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="addDeckModal-close">&times;</button>
				<h4 class="modal-title">Sign Up</h4>
                <div id="warnings" class="alert" style="margin-bottom:0;"></div>
			</div>
			<div class="modal-body">      
            	<!--   Take out enctype line    --> 
            	<form action="<? print $_SERVER['PHP_SELF']; ?>" 
                  enctype="multipart/form-data" 
                  method="post" 
                  id="addDeck_form"
                  class="addDeck_form" 
                  action="addDeck.php" 
                  method="post" 
                  name="addDeck_form">
                  <title>Create a Deck</title>

    <fieldset>
        <legend>Enter the deck's information below: </legend>
        <ul>
            <li>
                <span class="required_notification">* Denotes Required Field</span>
            </li>
            <li>
                <label id="deckname">Deck Name:</label>
                <input id="deckname" name="deckname" type="text" maxlength="255" class="element text medium<?php if ($decknameERROR) echo ' mistake'; ?>" value="" placeholder="<?php echo $deckname; ?>" required tabindex="28">
            	<span class="form_hint">Correct Format: "My Awesome Deck"</span>
            </li>
			<li>
			                <label id="color">Color(s):</label>
				<div class="btn-group" data-toggle="buttons">
 					<label class="btn btn-success">
                		<input  name="Green" value="Green" id="Green" type="checkbox" tabindex="60" > Green
					</label>
 					<label class="btn btn-danger">
                		<input  name="Red" value="Red" id="Red" type="checkbox"  tabindex="61" >Red
					</label>
					<label class="btn btn-info"">
               			<input  name="Blue" value="Blue" id="Blue" type="checkbox"  tabindex="62" >Blue
  					</label>
  					<label class="btn btn-default">
             		   <input name="White" value="White" id="White" type="checkbox"  tabindex="63" >White
  					</label>
  					<label class="btn btn-primary">
        		        <input name="Black" value="Black" id="Black" type="checkbox"  tabindex="64" >Black 
  					</label>
  					<label class="btn btn-primary">
            		    <input name="Colorless" value="Colorless" id="Colorless" type="checkbox" tabindex="65" >Colorless
  					</label>
				</div>

            </li>
         	<li>
                <input type="submit" id="" name="btnSubmit" value="Submit Deck!" class="btn btn-success btnSubmit " tabindex="169"> 
            </li>
        </ul>
    </fieldset>
</form>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- End Signup Modal -->
</div>
<?php } //end body sumbit
?>
