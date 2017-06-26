<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <title>Order Select</title>


    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">
  </head>

  <body>
  
<?php	
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
		<li class="active"><a href="order.php">Order Now</a></li>
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

<?php

	
	if ( $_SESSION['Email'] == NULL ) {
		?>			
		 <div class="container text-center"><h3>We apologize, you must be <a href="../users/loginuser.php">logged in</a> to place an order!</h3>
		 <p>Please log in to place your order</p></div>
		<?php
	}
	else {

?>

	<div class="container">

  <!-- Fields representing all of the resteraunt databases with values set to the resteraunts name to be sent by POST to ordernow.php  -->
  <!-- This selection will determine the database that will be queried -->
    
	  <h2 class="form_order">Select Where You Would Like to Order From</h2>
	  
	  <form class="form_order" action="ordernow.php" method="POST">
		<input type="hidden" name="name" value="ahsosushi"/>
		<button class="btn btn-lg btn-primary btn-block" name="name" value="ahsosushi" type="hidden">Ah-So Sushi</button><br />
	  </form>
	  
	  <form class="form_order" action="ordernow.php" method="POST">
		<input type="hidden" name="name" value="boosterjuice"/>
		<button class="btn btn-lg btn-primary btn-block" name="boosterjuice" type="submit">Booster Juice</button><br />
	  </form>
	  
	  <form class="form_order" action="ordernow.php" method="POST">
		<input type="hidden" name="name" value="burgerbar"/>
		<button class="btn btn-lg btn-primary btn-block" name="burgerbar" type="submit">Burger Bar</button><br />
	  </form>
	  
	  <form class="form_order" action="ordernow.php" method="POST">
		<input type="hidden" name="name" value="mediterranean"/>
		<button class="btn btn-lg btn-primary btn-block" name="mediterranean" type="submit">Mediterranean Grill</button><br />
	  </form>
	  
	  <form class="form_order" action="ordernow.php" method="POST">
		<input type="hidden" name="name" value="pizzapizza"/>
		<button class="btn btn-lg btn-primary btn-block" name="pizzapizza" type="submit">Pizza Pizza</button><br />
	  </form>
	  
	  <form class="form_order" action="ordernow.php" method="POST">
		<input type="hidden" name="name" value="subway"/>
		<button class="btn btn-lg btn-primary btn-block" name="subway" type="submit">Subway</button><br />
	  </form>
	  
	  <form class="form_order" action="ordernow.php" method="POST">
		<input type="hidden" name="name" value="timhortons"/>
		<button class="btn btn-lg btn-primary btn-block" name="timhortons" type="submit">Tim Hortons</button><br />
	  </form>

<?php 
}
?>
</body>
</html>

