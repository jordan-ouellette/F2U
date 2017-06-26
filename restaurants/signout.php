<?php
	
	##continue ongoing session
	 session_start();

	 ##unset values tied to current session.
	 session_unset();
	 
	 ##Destroy existing session and return to main index page.
     session_destroy();
	 header("Location: index.php");
?>



