<?php 
	require("includes/functions.php");
	require("includes/db_const.php");
	session_start();
	if (logged_in() == true) {
		redirect_to("logged.php?id={$_SESSION['user_id']}");
	}
?>

<!DOCTYPE html>
<html lang="en">
   <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">	
	<title>Forgot Password</title>
	<link rel="stylesheet" href="css/theme-red.css" />
	
	<link rel="stylesheet" href="css/animate.css" />
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700|Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="images/car-tire-16-231903.png" />
    <link rel="stylesheet" href="css/style.css" />
  
  </head>
  
  <body>
    <!-- Header -->
	<header class="header" role="banner">
		<div class="wrap">
			<!-- Logo -->
			<div class="logo">
				<a href="index.php" ><img src="images/drivehub.png" /></a>
			</div>
			<!-- //Logo -->
		</div>
	</header>
	<!-- //Header -->
	
	<!-- Main -->
	<main class="main" role="main">
		<!-- Page info -->
		<header class="site-title color">
			<div class="wrap">
				<div class="container">
					<h1>Password Reset</h1>
					
				</div>
			</div>
		</header>
		<!-- //Page info -->
		
		<div class="wrap">
			<div class="row">
				<!--- Content -->
				<div class="content one-half modal">
					<!--Login-->
					<div class="box">
						<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
							<div class="f-row">
								<div class="full-width">
									<label for="email">Your Email</label>
									<input type="email" id="email" name="email" />
								</div>
							</div>
							<div class="f-row">
								<div class="full-width">
									<label for="password">New password</label>
									<input type="password" id="password" name="password" />
								</div>
							</div>
							<div class="f-row">
								<div class="full-width">
									<input type="submit" name="submit" value="Submit" class="btn color medium full" />
								</div>
							</div>
						</form>
                        
                        
<!--login form php-->
<?php
if (isset($_POST['submit'])) {
	$email = $_POST['email'];
	$userpassword = $_POST['password'];
	//hash the password
	$password = password_hash($userpassword, PASSWORD_DEFAULT);
	
 
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	# check connection
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}
	
    //find user in db, based on email
	$sql = "SELECT * from users WHERE email LIKE '{$email}' LIMIT 1";
	$result = $mysqli->query($sql);
 
	if ($result->num_rows != 1) {
		echo "<p><b>Error:</b> Email does not exist</p>";
	} else {
		
		
	         //update user password
			$upd = $mysqli->query("UPDATE users SET password = '{$password}' WHERE email LIKE '{$email}'");
			
			//redirect to login
			redirect_to("login.php?msg=Password updated successfully");
			
		}
	
} 
 
 //message
if(isset($_GET['msg'])) {
	echo "<p style='color:green;'>".$_GET['msg']."</p>";
}
?>	
                        
<!--login form php-->
                        
					</div>
					<!--//Login-->
				</div>
				<!--- //Content -->
			</div>
		</div>
	</main>
	<!-- //Main -->
	
	<!-- Footer -->
	<footer class="footer black" role="contentinfo">
		<div class="wrap">
			<div class="row">
				<!-- Column -->
				<article class="one-half">
					<h6>About us</h6>
					<p>We work with leading car rental suppliers from around the world, and the best local suppliers, to bring you cheap car hire prices.By renting with us you can be sure that you will get friendly and reliable service, and be secure in the knowledge that you are hiring a car from an international brand you can trust. We hope that booking your car through us becomes part of a fantastic trip or holiday.</p>
				</article>
				<!-- //Column -->
				
				<!-- Column -->
				<article class="one-fourth">
					<h6>Need help?</h6>
					<p>Contact us via phone or email:</p>
					<p class="contact-data"><span class="ico phone"></span> +2105555555</p>
					<p class="contact-data"><span class="ico email"></span>  
                        <a href="contact.php">
                            <button type="button" class="btn contactbtn">Send E-mail</button>
                        </a></p>
				</article>
				<!-- //Column -->
				
				<!-- Column -->
				<article class="one-fourth">
					<h6>Follow us</h6>
					<ul class="social">
						<li class="facebook"><a href="https://www.facebook.com/DriveHub-454023768124435/?ref=hl" title="facebook">facebook</a></li>
						<li class="twitter"><a href="https://twitter.com/drivehub1" title="twitter">twitter</a></li>
						<li class="gplus"><a href="https://plus.google.com/u/1/102490635396542472290/posts?hl=el" title="gplus">google plus</a></li>
					</ul>
				</article>
				<!-- //Column -->
			</div>
			
			<div class="copy">
				<p>Copyright 2016, SAE Athens. All rights reserved. </p>
			</div>
		</div>
	</footer>
	<!-- //Footer -->
	
	<!-- Preloader -->
	<div class="preloader">
		<div id="followingBallsG">
			<div id="followingBallsG_1" class="followingBallsG"></div>
			<div id="followingBallsG_2" class="followingBallsG"></div>
			<div id="followingBallsG_3" class="followingBallsG"></div>
			<div id="followingBallsG_4" class="followingBallsG"></div>
		</div>
	</div>
	<!-- //Preloader -->

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
	<script src="js/jquery.uniform.min.js"></script>
	<script src="js/jquery.datetimepicker.js"></script>
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/scripts.js"></script>
	
  </body>
</html>