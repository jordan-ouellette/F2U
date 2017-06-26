

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
      <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">


    <title>Food2U</title>
    <!-- Custom styles for this template -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      <link rel="stylesheet" type="text/css" href="css/style.css">
  </head>
  <body>
  			<?php 
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
		<li class="active"><a href="index.php">Home</a></li>
		<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Restaurants <span class="caret"></span></a>
			<ul class="dropdown-menu">
				<li><a href="/restaurants/ahsosushi.php">Ah So Sushi</a></li>
				<li><a href="/restaurants/boosterjuice.php">Booster Juice</a></li>
				<li><a href="/restaurants/burgerbar.php">Burger Bar</a></li>
				<li><a href="/restaurants/mediterranean.php">Mediterranean Grill</a></li>
				<li><a href="/restaurants/pizzapizza.php">Pizza Pizza</a></li>
				<li><a href="/restaurants/subway.php">Subway</a></li>
				<li><a href="/restaurants/timhortons.php">Tim Hortons</a></li>
			</ul>	
		</li>
		<!--End drop down menu in Navigation bar continue horizontal Navigation -->
		<li><a href="/content/order.php">Order Now</a></li>
		<li><a href="/content/aboutus.php">About Us</a></li>
		<li><a href="/content/contact.php">Contact</a></li>

			<!--Start a conditional statement in PHP to check whether there's a user logged in-->	  		
			<?php
	  
				if ( $_SESSION['Email'] == NULL ) {
				##If the Global $_SESSION variable email does not have a user logged in
			?>
					<!-- Display the Login Button -->		
					<li><a href="/users/loginuser.php">Login</a></li>
			<?php
				}
				else {
				##If there is no user logged in
			?>
					<!-- Display the which account the user is logged into-->
					<li><a><?php echo $_SESSION['Email']; ?></a></li>
					<!-- Also offer a Logout button -->
					<li><a href="/users/signout.php">Logout</a></li>
			
			<?php
				}
				
				##If the user is an ADMIN
				if ( $_SESSION['Admin'] == 'TRUE' ) {
					
					
			?>
				<li><a href="/content/admin.php">Admin</a></li>
			<?php
				}
			?>
			
			
    </ul>
  </div>
</nav>
<!-- End the top Navigation bar -->

      
    <div class="container">

      <div class="row row-offcanvas row-offcanvas-right">

        <div class="col-12 col-md-9">
    
          <div class="jumbotron" id="jumbo" style="background-image: url(img/main.jpg);background-size: 100% 100%; min-height: 300px;">
            <h1 id="mainTitle">Welcome to the CAW online cafeteria!</h1>
            <p id="mainPar"></p>
          </div>
          <div class="row">
            <div class="col-6 col-lg-4">
			
			
              <h2>Welcome</h2>
              <p>Have you ever been hungry at the University of Windsor with a deadline or something important to do? Sometimes you put off your hunger till after you’re done the task that you’re working on. We can relate! Here at Food2U we understand how malnutrition can affect the brain and your performance on important tasks. It all seems like an inconvenience </p>
            </div><!--/span-->
            <div class="col-6 col-lg-4">
              <p><br>-Pack up your stuff (possibly lose your seat)<br>-Walk to where you’re going to buy food<br>-Wait in line to order<br>-Wait for them to prepare your order<br>-Wait in line to pay for your order<br>-Walk back (try to find a seat)<br>-Setup the things that your originally packed up </p>
            </div><!--/span-->
            <div class="col-6 col-lg-4">
              <p><br>If you’re on campus at the University of Windsor, we offer services to bring you food or beverages to either you or a group of people so you can keep on task. Simply let us know the building that you’re working in and the desired room and not only will your stomach no longer be bothering you, but your brain will have improved performance as well!</p>
            </div><!--/span-->
          </div><!--/row-->
        </div><!--/span-->
        <div class="col-6 col-md-3 sidebar-offcanvas" id="sidebar">
          <div class="list-group">
            <a href="http://www1.uwindsor.ca/food/hours-our-locations" class="list-group-item">Hours</a>
            <a href="http://www.uwindsor.ca/" class="list-group-item">uWindsor</a>
            <a href="http://www.uwindsor.ca/location/caw-student-centre" class="list-group-item">CAW Student Center</a>
            <a href="http://www1.uwindsor.ca/food/" class="list-group-item">Food Services</a>
          </div>
        </div><!--/span-->
      </div><!--/row-->

      <hr>

      <footer>
        <p>Group B - Adam Beckett, Jordan Ouellette and Richard Labonte</p>
      </footer>

    </div><!--/.container-->
  </body>
</html>