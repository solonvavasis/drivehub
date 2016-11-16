<?php 
require_once("includes/functions.php");
require_once("includes/db_const.php");
session_start();
?>




<!DOCTYPE html>
<html lang="en">
   <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">	
	<title>Results</title>
	<link rel="stylesheet" href="css/theme-red.css" />
	   
	<link rel="stylesheet" href="css/animate.css" />
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700|Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="images/car-tire-16-231903.png" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  
  <body>
  
   <?php
   
   if (logged_in() == false) {
	redirect_to("login.php");
} else {
	if (isset($_GET['id']) && $_GET['id'] != "") {
		$id = $_GET['id'];
		if ($id!=$_SESSION['user_id']){
			redirect_to("login.php");
			}
	} else {
		$id = $_SESSION['user_id'];
	}

 
	## connect mysql server
		$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
		# check connection
		if ($mysqli->connect_errno) {
			echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
			exit();
		}
		
		# fetch data from mysql database
		$sql = "SELECT * FROM users WHERE id = {$id} LIMIT 1";
 
		if ($result = $mysqli->query($sql)) {
			$user = $result->fetch_array();
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}
		
		if ($result->num_rows == 1) {
			# calculating online status
			if (time() - $user['status'] <= (5*60)) { // 300 seconds = 5 minutes timeout
				$status = "Online";
			} else {
				$status = "Offline";
			}
 
			# echo the user profile data		
		} else { // 0 = invalid user id
			echo "<p><b>Error:</b> Invalid user ID.</p>";
		}
 
		//select most popular cars from db (cars with the highest booking_count)
		$popular = "SELECT * from cars where car_id != {$id} order by booking_count desc limit 5";
}
	
 ?> 
  
  
  
    <!-- Header -->
	<header class="header" role="banner">
		<div class="wrap">
			<!-- Logo -->
			<div class="logo">
				<a href="<?php echo "logged.php?id=$id";?>"><img src="images/drivehub.png"/></a>
			</div>
			<!-- //Logo -->
		</div>
	</header>
	<!-- //Header -->
	
	<!-- Page info -->
		<header style="margin-top:0px;" class="site-title color">
			<div class="wrap">
				<div class="container">
					<h1>Most Popular Cars</h1>
					<nav role="navigation" class="breadcrumbs">
					</nav>
				</div>
			</div>
		</header>
		<!-- //Page info -->
	
	
		
		<div class="wrap">
			<div class="row">
				<!--- Content -->
				<div class="full-width content">
					
					
					<div class="results">
                    <?php $result = $mysqli->query($popular);
					      if ($result->num_rows > 0) {
						
						
				while($found = $result->fetch_array()){
				      
					//echo most popular cars
					
					echo "<article class='result'>
							   
									<div class='one-fourth heightfix'><img height='100%' width='100%' src='profile_pictures/".$found["image"]."'/></div>
									<div class='one-half heightfix'>
										<h3><img height='60' width='60' src='images/icon-best-seller.png' alt='new'/>".$found["car_brand"]."<a href='javascript:void(0)' class='trigger color' title='Read more'>Description</a></h3>
										<ul>
											<li>
												<span><img height='35px' width='15%' src='images/engine.png'/></span>
												<p><br/><strong>".$found["car_cc"]."cc</strong> <br /></p>
											</li>
											<li>
												<span><img height='40px' width='9%' src='images/gps.png'/></span>
												<p><br/>Locations:<br/><strong>".$found["car_address"]."</strong> <br /></p>
											</li>
										</ul>
									</div>
									<div class='one-fourth heightfix'>
										<div>
											<div class='price'>".$found["car_price"]." <small>Euro</small></div>
											<span class='meta'>per day</span>
											<p class='meta'>Booked ".$found['booking_count']." times.</p>
											<a href='booking.php?id=".$id."&car=".$found['car_id']."' class='btn grey large'>Book Now</a>
										</div>
									</div>
									
									
									<div class='full-width information'>	
										<a href='javascript:void(0)' class='close color' title='Close'>x</a>
										<p>".$found["car_description"]."</p>
									
									</div>
								</article>";
					}			
				
			} else if ($result->num_rows == 0){
				echo "No cars found";
			} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}?>
						<!-- Item -->
						
						<!-- //Item -->
					</div>
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
					<p class="contact-data">
                        <span class="ico email"></span> 
                        <a href="contact.php">
                            <button type="button" class="btn contactbtn">Send E-mail</button>
                        </a>
                    </p>
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
	<script src="js/search.js"></script>
	<script src="js/scripts.js"></script>
	
  </body>
</html>