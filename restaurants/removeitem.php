<?php


	require_once('../content/connectvars.php');
	
	$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
	mysql_select_db($dbname) or die("Could not open the db '$dbname'");
	
	session_start();
	

	$name = $_POST['search'];
	echo $name;
	
	$ondb = False;
	
	$query ="DELETE FROM ".$_SESSION['currentdb']." WHERE Name='$name'";
	
	$query2 = "SELECT * FROM ".$_SESSION['currentdb']."";
	$retval = mysql_query($query2, $connect);
	
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)){
		
	 
	  if($row['Name'] == $name){
		   $ondb = true;
	  }
	}
	
		if($ondb == true){
		
		if (mysql_query($query, $connect)) {
			header("Location:".$_SESSION['currentdb'].".php");
		}else{
			echo "The DELETE query failed". mysql_error();		
		}
		
	}else{		
		echo "Invalid Delete";
	}
	
	
  mysql_close($connect);
  echo $query;
 ##header("Location:".$_SESSION['currentdb'].".php");

  ?>