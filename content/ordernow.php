
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Order Select</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="../css/style.css">
</head>


<body>


	<?php 
	
	##connect and interact with database (else display error message), and begin a session
	
	session_start();
	require_once('connectvars.php');
	$connect = mysql_connect($dbhost, $dbuser, $dbpass) or die("Unable to Connect to '$dbhost'");
    mysql_select_db($dbname) or die("Could not open the db '$dbname'");

	?>
	
	<!-- Upper horizontal banner information and connection -->

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">Food2U</a>
    </div>
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
		<li class="active" ><a href="order.php">Order Now</a></li>
		<li><a href="aboutus.php">About Us</a></li>
		<li><a href="contact.php">Contact</a></li>

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
<br>
<div class="container-fluid text-center">
<div class="container-fluid text-center" id="odtable">

<?php

	##Use previously clicked field to select operational database

	$_SESSION['currentdb'] = $_POST['name'];
	
	##access all information in database for search
	
	$query = "SELECT * FROM ".$_SESSION['currentdb']."";
	
	##Incrementer to identify and select all names and prices of items in database
	
	$inc = 0;
	
	##Create array to store item prices

	$costarray = array();
	
	##Create searchable query to loop through desired database
	
	$retval = mysql_query($query, $connect);
	
	##Use query and display the Price and Name of an item, create a input number type with the id of current $inc
	##Then increment and repeat until database has been fully searched. If a number type is clicked, Javascript Function is run
	##with the id of specific field sent to the function
    
    while($row = mysql_fetch_array($retval, MYSQL_ASSOC)) {
?> <div class="row">
<div class="col-sm-7 text-center">

	<?php
		$costarray[$inc] = $row['Price'];
		echo $costarray[$inc];
		$value = " {$row['Name']} ";
		echo $value;
	?>
	
</div>
	<div class="col-xs-2">
		<input class="form-control" type="number" id="itemamount<?php echo $inc ?>" min="0" value="0" onchange="myFunction(this)"/>
	</div>
</div>
	<?php
		$inc +=1;
	}
	
	
	
	
	
	?>
	</div>

	<script>
	
															//Global values used in more then one function
		var itemcostarr = [];								//Array to house cost of the quantity of selected items
		var deliveryPrice = 0;								//Price of delivery set to zero unless selected
		var numitems = <?php echo $inc ?>;					//get total amount of items to use for loop
		
		function myFunction(arg) {							//Function run if a number type is incremented
		
		var id = arg.getAttribute('id');					//get id of clicked field
		var ar = <?php echo json_encode($costarray) ?>;		//get set in php costs array
		
		var itemprice = 0;									//temperary value to hold cost of 1 of selected item
		var quantity;										//get amount of specific items wanted
		var amountprice = 0;								//temperary value to hold price of the item multiplied by the wanted quantity
		
			for(i = 0; i < numitems; i++){					//Using the total number of items, loop through all input fields
					
					if(id == "itemamount"+i){				//When the selected element id matches a looped element id, use the value of 
															//'i' to obtain the selected fields name and price
						itemprice = ar[i];
						var floatedValue = parseFloat(itemprice.replace(/[^\d\.]/, '')); //set cost to temperary variable and remove currency features
						quantity = document.getElementById("itemamount"+i).value;		//obtain the amount of specific items desired and store them in temperary variable
						amountprice = quantity*floatedValue;		//Multiply the cost of item by the amount the item costs
						itemcostarr[i] = amountprice;				//Set new value into global array using 'i' as an insert index
				}
			}
			
			getTotal();												//Function to display current price to user
		}
		
		function calculateDelTotal(){									//Function to set cost of delivery
			
			var getDel = document.getElementById("includedelivery");	//Optain current statues of delivery field
			if(getDel.checked==true){									//If selected set delivery cost to 5 to be added to total later
				deliveryPrice = 5;
			}else{														//Else if not selected keep value at 0
				deliveryPrice = 0;
			}
			getTotal();													//Function to display current price to user
		}
		
		function getTotal() {											//Function to display current price to user
			
			var finalcost = 0;											//Temperary values used to display desired information
			var tax = 0;
			var aftertax = 0;
			
			finalcost = (finalcost + deliveryPrice);					//Final Cost represents total of items, plus total of delivery
			
			for(i = 0; i < numitems; i++){								//Using amount of total items, loop through global array to retrieve all user desired prices
				if(itemcostarr[i] == null){								//If the array index has no value, it is represented as a 0
					itemcostarr[i] = 0;
				}
				finalcost = (finalcost + itemcostarr[i]);				//Add array index value to total cost
				tax = (finalcost * 0.13);								//Multiply current price by 0.13 to seperatly display taxs
				aftertax = (finalcost + tax);							//Combine above fields to get total cost after taxes
			}
			
			document.getElementById("costp").innerHTML = "Price : $" + finalcost.toFixed(2);		//Values to be sent to HTML to be visable to users
			document.getElementById("taxp").innerHTML = "Tax: $" + tax.toFixed(2);
			document.getElementById("costaftertax").innerHTML = "Total: $" + aftertax.toFixed(2);
		
		}

	</script>
	
	<!-- Form housing the delivery input and submit button, if submit is sent page redirects to the confirm order page -->
	
	<form class="form_order" action="confirmorder.php" method="POST">			
	
		<label for='includedelivery' class="inlinelabel">Include Delivery($5)</label>
		<input type="checkbox" id="includedelivery" name="deliver" value="accept"
		onclick="calculateDelTotal()" /><br />
        <div>
        <div class="col-sm-4"></div>
        <div class="col-sm-4" id="orderadd">
		<input type="text" name="address" id="address" class="form-control col-xs-4" placeholder="Address">
        </div>
        <div class="col-sm-4"></div>
        </div>

        <br /><br />
		<input type="submit" class="btn" value="Submit Order">
	</form>	
	
	<!-- Fields Javascript sends values too, to be visable to user -->
	
	<p>-----------------------</p>
	<p id="costp"></p>
	<p id="taxp"></p>
	<p>____________</p>
	<p id="costaftertax" name="costaftertax"></p>
	
	<p>-----------------------</p>
	
	
		
</div>
</body>
</html>