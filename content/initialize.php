<?php

	##connect and interact with database (else display error message), and begin a session
	require_once('connectvars.php');
	
	$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
	mysql_select_db($dbname) or die("Could not open the db '$dbname'");
	
	##variable to hold the hashed password to be added when creating initial admin account
	$hashedpass = sha1("admin");
	
	##Query used to create all starting tables and admin account
$query="CREATE TABLE ahsosushi(
		Index INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		Name VARCHAR(30) NOT NULL,
		Calories INT(3) NOT NULL
		Price VARCHAR(5) NOT NULL,
		Cprice VARCHAR(6) NOT NULL
	);
	
	CREATE TABLE boosterjuice(
		Index INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		Name VARCHAR(30) NOT NULL,
		Calories INT(3) NOT NULL
		Price VARCHAR(5) NOT NULL,
		Cprice VARCHAR(6) NOT NULL
	);
	
	CREATE TABLE burgerbar(
		Index INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		Name VARCHAR(30) NOT NULL,
		Calories INT(3) NOT NULL
		Price VARCHAR(5) NOT NULL,
		Cprice VARCHAR(6) NOT NULL
	);
	
	CREATE TABLE mediterranean(
		Index INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		Name VARCHAR(30) NOT NULL,
		Calories INT(3) NOT NULL
		Price VARCHAR(5) NOT NULL,
		Cprice VARCHAR(6) NOT NULL
	);
	
	CREATE TABLE pizzapizza(
		Index INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		Name VARCHAR(30) NOT NULL,
		Calories INT(3) NOT NULL
		Price VARCHAR(5) NOT NULL,
		Cprice VARCHAR(6) NOT NULL
	);
	
	CREATE TABLE subway(
		Index INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		Name VARCHAR(30) NOT NULL,
		Calories INT(3) NOT NULL
		Price VARCHAR(5) NOT NULL,
		Cprice VARCHAR(6) NOT NULL
	);
	
	CREATE TABLE timhortons(
		Index INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		Name VARCHAR(30) NOT NULL,
		Calories INT(3) NOT NULL
		Price VARCHAR(5) NOT NULL,
		Cprice VARCHAR(6) NOT NULL
	);
	
	CREATE TABLE username(
		Email VARCHAR(30) NOT NULL,
		Id INT(9) PRIMARY KEY,
		Password VARCHAR(40) NOT NULL,
		Admin VARCHAR(5) NOT NULL
	);
	
	INSERT INTO username VALUES ('admin@uwindsor.ca','123456789', '$hashedpass', 'TRUE')";
	
	##Display message to user depending on whether the query was successful or not
	if (mysql_query($query, $connect)) {
			
			echo "The Database was initialized";
				}else {
			echo "Database initialization has failed". mysql_error();
				}
				
	##end connection to database.		
	mysql_close($connect);


?>