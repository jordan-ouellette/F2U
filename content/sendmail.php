<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Contact</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    
    <link rel="stylesheet" href="../css/style.css">

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
		<li><a href="order.php">Order Now</a></li>
		<li class="active"><a href="aboutus.php">About Us</a></li>
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
<!-- End the top Navigation bar -->

<?php
$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$formcontent=" From: $name \n Message: $message";
$recipient = "beckett2@uwindsor.ca";
$subject = "Contact Form";
$mailheader = "From: $email \r\n";
mail($recipient, $subject, $formcontent, $mailheader) or die("Error!");
?>
<div class="container text-center"><h3>Thank you for your comment!</h3></div>

</div>
</body>
</html>