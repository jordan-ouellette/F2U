<?php

	##Initialize and connect to database
	require_once('../content/connectvars.php');		
	
	$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
	mysql_select_db($dbname) or die("Could not open the db '$dbname'");
	
	##Start a session to be used for implementing the targeted database
	session_start();
	
	##Variables to be inserted into a new column in desired database
	##All variables are initialized to 0, incase the database doesn't have a value for desired field
	$name = NULL;
	$calories = 0;
	$price = 0;
	$cprice = 0;
	$index = 0;
	
	##Retrieve values from previous page and inserted into previously initialized values
	$name = $_POST['name'];
	$calories = $_POST['cal'];
	$price = $_POST['price'];
	$cprice = $_POST['cprice'];
	$index = $_SESSION['index'];
	
	##All values are used in a query using the session value to select the table and the remaining values are inserted as a new touple
   $query ="INSERT INTO ".$_SESSION['currentdb']." VALUES ('$index','$name', '$calories', '"."$"."$price', '$cprice')";
			
	##The user will recieve a message back depending on whether the query was successful or failed
		if (mysql_query($query, $connect)) {
			
			echo "The Create query was successful.";
		}else {
			echo "The Create query failed". mysql_error();
		}
		
  ##Close connection to database
  mysql_close($connect);
  
  ##Redirect user to webpage of targeted resteraunts
  header("Location:".$_SESSION['currentdb'].".php");
  
  ?>