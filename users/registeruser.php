<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
      
      <link rel="stylesheet" href="../css/style.css">


    <title>Register</title>
  </head>

  <body>
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
		<li><a href="../content/order.php">Order Now</a></li>
		<li><a href="../content/aboutus.php">About Us</a></li>
		<li><a href="../content/contact.php">Contact</a></li>
		
		<!--Start a conditional statement in PHP to check whether there's a user logged in-->	  		
			<?php
	  
				if ( $_SESSION['Email'] == NULL ) {
				##If the Global $_SESSION variable email does not have a user logged in
			?>
					<!-- Display the Login Button -->		
					<li class="active"><a href="../users/loginuser.php">Login</a></li>
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
  
  


    <div class="container" id="logindiv">
	
	<!-- When login is pressed, 'insertuser.php' takes filled in fields and validates fields -->
	<!-- if they pass validation, then email password and student number are added to the database -->
      <form class="form-signin" action="insertuser.php" method="POST">
        <h2 class="form-signin-heading">Register</h2>
		
	<!-- Fields to be sent to 'insertuser.php: email, student number, password and confirm_password populated by user-->
        <label for="inputEmail" class="sr-only">Email address</label>
		<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus><br>
		
		<label for="studentNum" class="sr-only">User Id</label>
		<input type="number" name="stnumber" id="inputid" class="form-control" placeholder="User ID" required>
		<br>
        <label for="inputPassword" class="sr-only">Password</label>
		<input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>
				<br>
		<label for="confirmPassword" class="sr-only">Confirm Password</label>
        <input type="password" name="confpassword" id="checkPassword" class="form-control" placeholder="Confirm Password" required>
        <div class="checkbox">
          <label>
            <input type="checkbox" value="remember-me"> Remember me
          </label>
        </div>
		
		<!-- When button is clicked, all 4 field values are sent to insertuser.php -->
        <button class="btn btn-lg btn-primary btn-block" type="submit">Finish Registering</button>
		
      </form>
	  </div> 
  </body>
</html>
