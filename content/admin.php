<html>
<head>
  <title>Admin</title>
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
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Food2U</a>
    </div>
	<!--Create a dropdown menu for restaurants in the Navigation bar --> 
    <ul class="nav navbar-nav">
		<li class="dropdown"><a href="../index.php">Home</a></li>
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Restaurants <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="../restaurants/ahsosushi.php">Ah So Sushi</a></li>
				<li><a href="../restaurants/boosterjuice.php">Booster Juice</a></li>
				<li><a href="../restaurants/burgerbar.php">Burger Bar</a></li>
				<li><a href="../restaurants/mediterranean.php">Mediterranean Grill</a></li>
				<li><a href="../restaurants/pizzapizza.php">Pizza Pizza</a></li>
				<li><a href="../restaurants/subway.php">Subway</a></li>
				<li><a href="../restaurants/timhortons.php">Tim Hortons</a></li>
			</ul>	
		</li>
		<!--End drop down menu in Navigation bar continue horizontal Navigation -->
		<li><a href="../users/order.php">Order Now</a></li>
		<li><a href="../users/aboutus.php">About Us</a></li>
		<li><a href="../users/contact.php">Contact</a></li>

			<!--Start a conditional statement in PHP to check whether there's a user logged in-->	  		
			<?php
	  
				if ( $_SESSION['Email'] == NULL ) {
				##If the Global $_SESSION variable email does not have a user logged in
			?>
					<!-- Display the Login Button -->		
					<li><a href="../users/logintest.php">Login</a></li>
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
				<li class="active"><a href="../content/admin.php">Admin</a></li>
			<?php
				}
			?>
			
			
    </ul>
  </div>
</nav>


<?php
	
	##connect and interact with database else display message.
	require_once('../content/connectvars.php');
	
	$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
	mysql_select_db($dbname) or die("Could not open the db '$dbname'");


	##Create a query to Select all items from the ahsosushi table        
	$query = "SELECT * from username";

	##Return the output of the query into a variable called $retval
	$retval = mysql_query($query, $connect);
	
?>

	<!-- Create a table before connecting to the database to fill the table -->
<table class="table table-hover">
		<thead>
			<tr>
			<th>Email</th>
			<th>ID Number</th>
			<th>Hashed Password</th>
			<th>Admin</th>
			</tr>
		</thead>
		<tbody>
		
	<?php
		while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
 
	?>
	<!--End PHP and start HTML to print the parts of the table -->
	<tr>
		<td>	
			<?php
			##Start PHP to print the data from the column Name in the specified row
			echo "{$row['Email']}";
			##close the PHP tag to close the HTML column table tags
			?>	 
		</td>
		<td>
		
			<?php	 
			echo  "{$row['Id']}";
			?>
		</td>	
		<td>		
			<?php	 
			echo  "{$row['Password']}";
			?>
		</td>
		<td>		
			<?php	 
			echo  "{$row['Admin']}";
			?>
		</td>		
	</tr>
	<?php
		}
	?>
	</tbody>
</table>

<br /><br />

	<form action="../users/delete.php" method="POST">
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
					$value = "{$row['Email']}";			
				?>
			
				<!-- Create an option in select for the row in the while loop-->
				<!-- Store the value of the name as the value of the option-->
				<!-- That is the value  that will be sent if the form is submitted-->
				<option value="<?php	echo $value;?>">
				<?php
				##print the value of the row
				echo $value."; {$row['Id']}; {$row['Admin']}";
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
			<button class="btn btn-primary btn-md" type="submit">Remove User</button>
		</span>
		
    <!-- End of button -->
	
		<br>
		</div>
	</form>
	
		
	
	<!-- Create button-->
		<form action="../users/makeadmin.php" method="POST">
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
					$value = "{$row['Email']}";			
				?>
			
				<!-- Create an option in select for the row in the while loop-->
				<!-- Store the value of the name as the value of the option-->
				<!-- That is the value  that will be sent if the form is submitted-->
				<option value="<?php	echo $value;?>">
				<?php
				##print the value of the row
				echo $value."; {$row['Id']}; {$row['Admin']}";
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
			<button class="btn btn-primary btn-md" type="submit">Make Admin</button>
		</span>
		
    <!-- End of button -->
	
		<br>
		</div>
	</form>
		
    <!-- End of button -->
	
		<br>
		</div>
	</form>

<!-- End of form -->

	<form class="init_database" action="initialize.php" method="POST">
		<input type="hidden" name="name" value="return"/>
		<button class="btn btn-lg btn-primary btn-block" name="init" type="submit">Initialize Database</button><br />
	</form>
	
<?php
	##Close connection to database
	mysql_close($connect);
	
?>



</body>
</html>