<!DOCTYPE html>
<html lang="en">
<head>
  <title>Food2U</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <link rel="stylesheet" type="text/css" href="../css/style.css">
</head>
<body>
	<?php 
		##Start the session to keep user information across webpages
		session_start();	
	?>
			
<!-- Create navigation bar for the top of the page -->
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Food2U</a>
    </div>
	<!--Create a dropdown menu for restaurants in the Navigation bar --> 
    <ul class="nav navbar-nav">
		<li class="dropdown"><a href="../index.php">Home</a></li>
		<li class="active"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Restaurants <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="ahsosushi.php">Ah So Sushi</a></li>
				<li><a href="boosterjuice.php">Booster Juice</a></li>
				<li><a href="burgerbar.php">Burger Bar</a></li>
				<li><a href="mediterranean.php">Mediterranean Grill</a></li>
				<li><a href="pizzapizza.php">Pizza Pizza</a></li>
				<li><a href="subway.php">Subway</a></li>
				<li><a href="timhortons.php">Tim Hortons</a></li>
			</ul>	
		</li>
		<!--End drop down menu in Navigation bar continue horizontal Navigation -->
		<li><a href="../content/order.php">Order Now</a></li>
		<li><a href="../content/aboutus.php">About Us</a></li>
		<li><a href="../content/contact.php">Contact</a></li>

			<!--Start a conditional statement in PHP to check whether there's a user logged in-->	  		
			<?php
	  
				if ( $_SESSION['Email'] == NULL ) {
				##If the Global $_SESSION variable email does not have a user logged in
			?>
					<!-- Display the Login Button -->		
					<li><a href="../users/loginuser.php">Login</a></li>
			<?php
				}
				else {
				##If there is no user logged in
			?>
					<!-- Display the which account the user is logged into-->
					<li><a><?php echo $_SESSION['Email']; ?></a></li>
					<!-- Also offer a Logout button -->
					<li><a href="../users/signout.php">Logout</a></li>
			
			<?php
				}
				
				##If the user is an ADMIN
				if ( $_SESSION['Admin'] == 'TRUE' ) {
					
					
			?>
				<li><a href="../content/admin.php">Admin</a></li>
			<?php
				}
			?>
			
			
    </ul>
  </div>
</nav>
<!-- End the top Navigation bar -->

    
<div class="container">
	<!-- Display image stored in the /img/ directory for this page-->
    <div class="jumbotron" style="background-image: url(/img/bb.jpg);background-size: 100% 100%; min-height: 275px;">
    </div>
	
	<!-- Display descriptive text about current page-->
	<h2>What's better than being able to order food right to your room?</h2> 
	
	<p>Being able to know what your ordering before it leaves the kitchen! The better the food is for you, the better your brain will be able to perform.<br>

	<i>*Did you know that malnutrition can lead to issues with concentration, memory, sleep patterns, mood and motor skills?*</i><br><br>

	Below, depending on where you’re looking to order from, you can compare the nutritional information to make an informed, knowledgeable decision.</p>     
    
	<!-- Create a table before connecting to the database to fill the table -->
	<table class="table table-hover">
		<thead>
			<tr>
			<th>Item Name</th>
			<th>Price</th>
			<th>Combo Price</th>
			</tr>
		</thead>
		<tbody>

<?php

##Get the variables for the credentials to connect to the database
require_once('../content/connectvars.php');

##Connect to the database if not DIE
$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");

##After connecting to the database, select which database to open
##as a reminder $dbname is held in the connectvars.php
mysql_select_db($dbname) or die("Could not open the db '$dbname'");

##Create a global $_SESSION variable to keep track of which database we're working in
##USED for adding and removing items in a table as admin
$_SESSION['currentdb'] = "burgerbar";


##Create a query to Select all items from the burgerbar table        
$query = "SELECT * from burgerbar";

##Return the output of the query into a variable called $retval
$retval = mysql_query($query, $connect);

##If the query failed      
if(! $retval ) {
	##Display error message to client
	die('Could not get data: ' . mysql_error());
}


##Create an index counter counter that starts at one to count the amount of rows in the table 
$_SESSION['index'] = 1;

	##While there are still rows to display from the table
	while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
 
	?>
	<!--End PHP and start HTML to print the parts of the table -->
	<tr>
		<td>	
			<?php
			##Start PHP to print the data from the column Name in the specified row
			echo "{$row['Name']}";
			##close the PHP tag to close the HTML column table tags
			?>	 
		</td>
		<td>
		
			<?php	 
			echo  "{$row['Price']}";
			?>
		</td>	
		<td>		
			<?php	 
			echo  "{$row['Cprice']}";
			?>
		</td>		
	</tr>
	<!--Close the row for the table -->
	<?php
	##Increment index to keep count of the rows
	$_SESSION['index']++;
	}    
	?>  
</tbody>
<!--Close Table -->
</table>

<!-- Create section for ADMIN to INSERT and DELETE values in the table -->
<?php
	##If the user is an ADMIN
 	if ( $_SESSION['Admin'] == 'TRUE' ) {
?>

<!-- Create admin add item form  -->
<form action="additem.php" method="POST">
	
	<!-- Name field for add item -->
	<div class="col-xs-4">
	<input type="text" class="form-control" placeholder="Name" name="name">
	</div>
	
	<!-- Price field for add item -->
	<div class="col-xs-2">
	<input type="text" class="form-control" placeholder="Price" name="price">
	</div>
	
	<!-- Combo Price field for add item -->
	<div class="col-xs-2">
	<input type="text" class="form-control" placeholder="Combo Price" name="cprice">
	</div>
	
	<!-- Add button in the form -->
	<div>
	<button class="btn btn-primary btn-md" type="submit">Add</button>
	</div> 
	
</form>
<!-- End the add Item form -->

<br>
<!-- Create admin remove Item form  -->
<form action="removeitem.php" method="POST">


	<div class="input-group">
	<!-- Create a select field for remove Item -->
	<select class="form-control" name="search">
	
		<?php 
		##Recall the query to start at the top of the table again
		$retval = mysql_query($query, $connect);
		##Create a variable to store the value of what needs to be removed
		$value;
		
		##While there are still rows in the table to be printed
		while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
			
			##Store the Item Name of this row into a variable called value
			$value = "{$row['Name']}";			
		?>
    
		<!-- Create an option in select for the row in the while loop-->
		<!-- Store the value of the name as the value of the option-->
		<!-- That is the value  that will be sent if the form is submitted-->
		<option value="<?php	echo $value;?>">
		<?php
		##print the value of the row
		echo $value."; {$row['Price']}; {$row['Cprice']} Combo Price";
		?> 
		</option>
		<!-- End the option -->
		<?php 
		##End of the while loop
		}
		?>
    </select>
    <!-- End of select -->
	
	<!-- Create button-->
	<span class="input-group-btn">
	<button class="btn btn-primary btn-md" type="submit" >Remove</button>
	</span>
    <!-- End of button -->
	
	<br>
	</div>
</form>
<!-- End of form -->
	
<?php
	##Close connection to database
	mysql_close($connect);
	}
?>

<!-- Print information at the foot of the page -->
<p>Also we comply with <a href="https://www.ontario.ca/page/calories-menus">Ontarios Healthy Menu Choices Act.</a></p>
<p><i>If there are no calories or combo prices, it is because the Restaurants did not supply the information.</i></p>

</div>
</body>
</html>