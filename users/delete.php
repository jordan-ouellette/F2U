<html>
<head>
</head>

<body>

<?php

	
	##connect and interact with database (else display error message), and begin a session
	require_once('../content/connectvars.php');
	
	$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
	mysql_select_db($dbname) or die("Could not open the db '$dbname'");
	session_start();
	
	##Retrieve email of user that Admin wishes to delete from previous page and store in variable
	$name = $_POST['search'];
	
	##Query implemented on username database to delete all records with the username equil to the username previously stored in name variable
	$query = "DELETE FROM username WHERE Email='$name'";
	
	##Display message to user depending on whether the query was successful or not
		if (mysql_query($query, $connect)) {
			
			echo "The DELETE query was successful on $name.";
				}else {
			echo "The DELETE has query failed on $name". mysql_error();
				}
	
  ##end connection to database.	
  mysql_close($connect);
   
?>
	
  <!-- Button to return user back to the index page --> 
	<form class="return_back" action="../index.php" method="POST">
		<input type="hidden" name="name" value="return"/>
		<button class="btn btn-lg btn-primary btn-block" name="ret" type="submit">Return Home</button><br />
	</form>

</body>
</html>