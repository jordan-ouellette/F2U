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
		<li><a href="aboutus.php">About Us</a></li>
		<li class="active"><a href="contact.php">Contact</a></li>

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
      

<!-- Contact with Map - START -->
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <div class="well well-sm">
                <form class="form-horizontal" method="POST" action="sendmail.php">
                    <fieldset>
                        <legend class="text-center header" style="color:#043d6d;">Contact us</legend>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="fname" name="name" type="text" placeholder="First Name" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="lname" name="lname" type="text" placeholder="Last Name" class="form-control">
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="email" name="email" type="text" placeholder="Email Address" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-md-offset-1">
                                <textarea class="form-control" id="message" name="message" placeholder="Enter your message for us here. We will get back to you as soon as possible." rows="7"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit"  class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
        <div class="col-md-6">
            <div>
                <div class="panel panel-default">
                    <div class="header text-center" style="font-size: 22px; color: #043d6d; padding:10px 0px 0px 0px;">Location</div>
                    <div class="panel-body text-center">
                        <h4>Address</h4>
                        <div>
                        401 Sunset Ave<br />
                         Windsor, ON <br />
                        # (519) 253-3000<br />
                        </div>
                        <hr />
                        <div id="map1" class="map">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=<?php require_once('connectvars.php'); echo $apikey;?>"></script>
    
<script type="text/javascript">
    jQuery(function ($) {
        function init_map1() {
            var myLocation = new google.maps.LatLng(42.308, -83.07);
            var mapOptions = {
                center: myLocation,
                zoom: 16
            };
            var marker = new google.maps.Marker({
                position: myLocation,
                title: "CAW Location"
            });
            var map = new google.maps.Map(document.getElementById("map1"),
                mapOptions);
            marker.setMap(map);
        }
        init_map1();
    });
</script>

    </body>
</html>

