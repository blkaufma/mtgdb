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
$yourURL = $baseURL . $folderPath . "dblist.php"; 
require_once("dbconnect.php"); 

//############################################################################# 
// set all form variables to their default value on the form. for testing i set 
// to my email address. you lose 10% on your grade if you forget to change it. 

$cardname = "";
$CardType = "";
$color = ""; 
$Cost = "";
$rarity = "";
$ability = "";
$power = "";
$toughness = "";
$count = "";

// $email = ""; 
//############################################################################# 
//  
// flags for errors 

$cardnameERROR = false;
$CardTypeERROR = false;
$rarityERROR = false;


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
        die("<p>Sorry you cannot access this page. Security breach detected and reported.</p>"); 
    } 


//############################################################################# 
// replace any html or javascript code with html entities 
// 

    $cardname = htmlentities($_POST["cardname"], ENT_QUOTES, "UTF-8"); 
    $CardType = htmlentities($_POST["CardType"], ENT_QUOTES, "UTF-8"); 
    $color = htmlentities($_POST["color"], ENT_QUOTES, "UTF-8"); 
    $Cost = htmlentities($_POST["Cost"], ENT_QUOTES, "UTF-8"); 
    $rarity = htmlentities($_POST["rarity"], ENT_QUOTES, "UTF-8"); 
    $ability = htmlentities($_POST["ability"], ENT_QUOTES, "UTF-8"); 
    $power = htmlentities($_POST["power"], ENT_QUOTES, "UTF-8"); 
    $toughness = htmlentities($_POST["toughness"], ENT_QUOTES, "UTF-8"); 


//############################################################################# 
//  
// Check for mistakes using validation functions 
// 
// create array to hold mistakes 
//  

    $errorMsg = array(); 


//############################################################################ 
//  
// Check each of the fields for errors then add any mistakes to the array. 
// 
    //^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^       Check card name
    if (empty($cardname)) { 
        $errorMsg[] = "Please enter the Card Name"; 
        $cardnameERROR = true; 
    } else { 
        $valid = verifyText($cardname); /* test for non-valid  data */ 
        if (!$valid) { 
            $errorMsg[] = "I'm sorry, the card name you entered is not valid."; 
            $cardnameERROR = true; 
        } 
    }
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^       Check type

    if (empty($CardType)) { 
        $errorMsg[] = "Please choose a card type"; 
        $CardTypeERROR = true; 
    } 
//^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^^       Check rarity

    if (empty($rarity)) { 
        $errorMsg[] = "Please chose a rarity"; 
        $rarityERROR = true; 
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
      /*   
        try { 
  //          $db->beginTransaction(); 

  						  // Will this work? //
 			//$sql = 'INSERT INTO Cards SET name="' . $cardname . '", type="' . $CardType . '", color="'. $color . '", cost="'. $Cost . '", rarity="'. $rarity . '", abilities="'. $ability . '", count="'. $count . '", power="'. $power . '", toughness="'. $toughness . '"';
 			$sql = 'INSERT INTO Cards (name, type, color, cost, rarity, abilities, count, power, toughness) values ($cardname, $CardType, $color, $Cost, $rarity, $ability, $count, $power, $toughness)';

			//sql, prepare, insert, execute, last insert		
            $stmt = $db->prepare($sql); 
            if ($debug) print "<p>sql ". $sql; 
        
            $stmt->execute(); 
             
            $primaryKey = $db->lastInsertId(); 
  //          if ($debug) print "<p>pk= " . $primaryKey; 
            
            // all sql statements are done so lets commit to our changes 
           $dataEntered = $db->commit(); 
            if ($debug) print "<p>transaction complete "; 
        } catch (PDOExecption $e) { 
            $db->rollback(); 
            if ($debug) print "Error!: " . $e->getMessage() . "</br>"; 
            $errorMsg[] = "There was a problem accepting your, data please contact us directly."; 
        } 
*/
/*
            //################################################################# 
            // 
            //Put forms information into a variable to print on the screen 
            // 

            $messageA = '<h2>Thank you for registering.</h2>'; 

            $messageB = "<p>Click this link to confirm your registration: "; 
            $messageB .= '<a href="' . $baseURL . $folderPath  . 'confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . '">Confirm Registration</a></p>'; 
            $messageB .= "<p>or copy and paste this url into a web browser: "; 
            $messageB .= $baseURL . $folderPath  . 'confirmation.php?q=' . $key1 . '&amp;w=' . $key2 . "</p>"; 

            $messageC .= "<p><b>First Name:</b><i>   " . $FirstName . "</i></p>"; 
            $messageC .= "<p><b>Last Name:</b><i>   " . $LastName . "</i></p>"; 
            $messageC .= "<p><b>Email Address:</b><i>   " . $email . "</i></p>"; 
            $messageC .= "<p><b>Cook Count:</b><i>   " . $cookCount . "</i></p>"; 
            $messageC .= "<p><b>Date:</b><i>   " . $Date . "</i></p>"; 
            $messageC .= "<p><b>Meal:</b><i>   " . $meal . "</i></p>"; 
            $messageC .= "<p><b>Ingredients:</b><i>   " . $ingredients . "</i></p>"; 



            //############################################################## 
            // 
            // email the form's information 
            // 
             
            $subject = "Your dinner has been planned"; 
            include_once('mailmessage.php'); 
            $mailed = sendMail($email, $subject, $messageA . $messageB . $messageC); 
        } //data entered    */
    } // no errors  
// ends if form was submitted.  


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
                  id="addCard_form"
                  class="addCard_form" 
                  action="addCard.php" 
                  method="post" 
                  name="addCard_form">
                  <title>Menu Planner</title>

    <fieldset>
        <legend>Enter the card's information below: </legend>
        <ul>
            <li>
                <span class="required_notification">* Denotes Required Field</span>
            </li>
            <li>
                <label id="cardname">Card Name:</label>
                <input id="cardname" name="carname" type="text" maxlength="255" class="element text medium<?php if ($cardnameERROR) echo ' mistake'; ?>" value="<?php echo $cardname; ?>" placeholder="Kraj" required tabindex="28">
            	<span class="form_hint">Correct Format: "Zur, the Enchanter"</span>
            </li>
            <li>
            	<label id="CardType">Card Type</label>
           		<select name="CardType" required>
					<option value="Enchantment">Enchantment</option>
					<option value="Creature">Creature</option>
					<option value="Sorcery">Sorcery</option>
					<option value="Instant">Instant</option>
					<option value="Artifact">Artifact</option>
					<option value="Land">Land</option>
				</select>
			</li>
			<li>
                <label id="color">Color</label>
                <input name="color" value="Green" id="Green" type="checkbox" tabindex="60" >
                <i>Green</i>
                <input name="color" value="Red" id="Red" type="checkbox"  tabindex="61" >
                <i>Red</i>
                <input name="color" value="Blue" id="Blue" type="checkbox"  tabindex="62" >
                <i>Blue</i>
                <input name="color" value="White" id="White" type="checkbox"  tabindex="63" >
                <i>White</i>
                <input name="color" value="Black" id="Black" type="checkbox"  tabindex="64" >  
                <i>Black</i>    
                <input name="color" value="Colorless" id="Colorless" type="checkbox" tabindex="65" >
                <i>Colorless</i>

            </li>
            <li>
                <label id="cost">Cost:</label>
				<input id="cost" name="cost" type="txt" maxlength="70" class="element text medium<?php if ($costERROR) echo ' mistake'; ?>"  value="<?php echo $cost; ?>" placeholder="5B" onfocus="this.select()"  tabindex="80">                
				<span class="form_hint">Correct Format: "1WUB"</span>
            </li>
            <li>
                <label id="rarity">Rarity</label>
                <input name="rarity" value="Mythic" id="Mythic" type="radio" required tabindex="84" >
                <i>Mythic</i>
                <input name="rarity" value="Rare" id="Rare" type="radio" required tabindex="86" >
                <i>Rare</i>
                <input name="rarity" value="Uncommon" id="Uncommon" type="radio" required tabindex="88" >
                <i>Uncommon</i>
                <input name="rarity" value="Common" id="Common" type="radio" required tabindex="90" >
                <i>Common</i>
            </li>
			 <li>
                <label id="ability">Ability</label>
                <textarea id="ability" name="ability" type="text" maxlength="480" class="element text medium<?php if ($abilityERROR) echo ' mistake'; ?>" value="<?php echo $ability; ?>" placeholder="Trample"  tabindex="100"></textarea>
				<span class="form_hint">Correct Format: "Flying, Lifelink, Trample, Haste"</span>
            </li>
            <li>
                <label id="power">Power</label>
                <input id="power" name="power" type="text" maxlength="480" class="element text medium<?php if ($powerERROR) echo ' mistake'; ?>" value="<?php echo $power; ?>" placeholder="7"  tabindex="102">
				<span class="form_hint">Correct Format: "18"</span>
            </li>
        	<li>
                <label id="toughness">Toughness</label>
                <input id="toughness" name="toughness" type="text" maxlength="480" class="element text medium<?php if ($powerERROR) echo ' mistake'; ?>" value="<?php echo $power; ?>" placeholder="7"  tabindex="102">
				<span class="form_hint">Correct Format: "18"</span>
            </li>    
       		 <li>
                <label id="count">Count</label>
                <input id="count" name="count" type="text" maxlength="5" class="element text medium<?php if ($countERROR) echo ' mistake'; ?>" value="<?php echo $count; ?>" placeholder="0"  tabindex="110">
				
            </li>
        	<li>
                <input type="submit" id="btnSubmit" name="btnSubmit" value="Submit Card!" class="btn btn-success" tabindex="69"> 
            	<input type="reset" id="butReset" name="butReset" value="Reset Form" class="btn btn-warning" onclick="reSetForm()" tabindex="70">         
            </li>
        </ul>
    </fieldset>
</form>
<?php } //end body sumbit
?>
</body>
</html>
