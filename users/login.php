<?php

    ##connect and interact with database (else display error message)
	require_once('../content/connectvars.php');
	
	
	$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
	mysql_select_db($dbname) or die("Could not open the db '$dbname'");
	
	##Working variables to be retrieved from previous page's POST.
    $login = $_POST['email'];
    $passwd = $_POST['password'];
	$hashedpass = sha1($passwd);
	
	##Variables to be used to check if user is Admin and if the user is able to log on
	$userad; 
	$ondb = False;
	
	#Create session to carry over values to connected pages
	session_start();
	$_SESSION['Tempemail'] = $login;
	$_SESSION['Admin'] = $userad;
	
	#identify all attributes on username database to compare with selected email and password.
	$query = "SELECT * from username";
	$retval = mysql_query($query, $connect);
	
	
	#Search all tuples in username database, if email and password match a tuple in the database then the user may attempt to log in
	#Booleon ondb is changed to true for future check 
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
		
	  if($row['Email'] == $login){
		   if($row['Password'] == $hashedpass){
				$ondb = true;
				$userad = $row['Admin'];
		}
	  }
	}
	
	#if user password and email are not found then they are redirected to the wrong login page to try again
		if($ondb == False){
		
			header("Location: wronglogin.php"); 
			
	#if user password and email are found then they are logged in and redirected to the index and a session values are updated	
		}else if($ondb == true){
			
		    $_SESSION['Email'] = $login;
			$_SESSION['Admin'] = $userad;
			header("Location: ../index.php");
			
	#if user password and email are not found then they are redirected to the wrong login page to try again		    
		  }else{
		    header("Location: wronglogin.php");
		  }
		  
	##end connection to database.		  
		mysql_close($connect);
		


?>
