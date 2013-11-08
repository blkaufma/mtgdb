<?php 
    require("dbconnect.php"); 
	
    $submitted_username = '';
	$echo_out;
	$login_ok = false;
	$userExists = true;
	if($_POST['checker']){
        $query = " 
            SELECT 
                id, 
                name, 
                password, 
                email 
            FROM Login 
            WHERE 
                name = :username 
        "; 
        $query_params = array(':username' => $_POST['username']); 
        try{
			// Query db for username 
            $stmt = $db->prepare($query); 
            $result = $stmt->execute($query_params); 
        }catch(PDOException $ex){ 
            die("Failed to run query: " . $ex->getMessage()); 
        }//end try catch 
        $row = $stmt->fetch(); 
        if($row){ 
            $check_password = $_POST['password'];
            if($check_password === $row['password']){ 
                $login_ok = true; 
            }//end if
        }//end if
		else{
			$userExists = false;
		}//end else
        if($login_ok){  
            unset($row['password']); 
            $_SESSION['user'] = $row;
        }//end if 
	}//end if 
	echo json_encode(array('completed'=>($_POST['checker']),'userExists'=>$userExists,'name'=>$_POST['username'],'success'=>$login_ok)); 
