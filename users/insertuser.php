<?php

	##connect and interact with database (else display error message), and begin a session
	require_once('../content/connectvars.php');
	
	$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
	mysql_select_db($dbname) or die("Could not open the db '$dbname'");
	session_start();
	
	##Working variables to be checked and/or updated from previous page.
    $login = $_POST['email'];
	$id = $_POST['stnumber'];
    $passwd = $_POST['password'];
	$cfpasswd = $_POST['confpassword'];
	
	$_SESSION['register'] = $login;
	
	#default booleon, if false after check, tuple will be added. 
	$ondb = False;
	
	#find length of student number to be checked for validity 
	$intid = strlen((string)$id);
	
	#identify all attributes on database to compare with selected email.
	$query2 = "SELECT * from username";
	$retval = mysql_query($query2, $connect);
	
	##validity check: ensure user enters the correct password and that Id is the right length, if not user is redirected to wrongregister page.
	if($passwd != $cfpasswd || $intid!=9){
		$ondb = true;
		header("Location: ../users/wrongregister.php");
	}
	
	#compare user email to all emails in username database, if there is a match the booleon switches to yes to indicate update. 
		while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
		
			if($row['Email'] == $login){   
				$ondb = true;
		}
	  }
	
	#if email isn't found in database, then user values are added so user can log in, the session email is added to be used on other pages, and then the users are then redirected to index page.
	#if there is an error updating the table, then user is notified.
	if($ondb == False){
		
		$hashedpass = sha1($passwd);
		$query ="INSERT INTO username VALUES('$login', '$id', '$hashedpass', 'FALSE')";
		$_SESSION['Email'] = $login;
				
		if (mysql_query($query, $connect)) {
			
			header("Location: ../index.php");
				}else {
			echo "The Create query failed". mysql_error();
				}
		
	}else{
		echo "Invalid Create, user already exits";
	}
	
  #end connection to database.	
  mysql_close($connect);
  
  ?>