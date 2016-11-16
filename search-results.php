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
	## query database
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
		
		
		
		//handle location selection from logged.php
		if (isset($_POST["find"])){
		
			$dest = $_POST["from"];
		
			redirect_to("search-results.php?id={$id}&dest={$dest}");
			
			
		
		}else { 
		 //handle location selection from destinations.php  
		    if (isset($_GET["dest"])){
		 		$_SESSION["from"] = $_GET["dest"];
			}
		}	
		
		
		//handle location selection from search-results.php
		if (isset($_POST["search"])){
		
			$_SESSION["from"] = $_POST["from"];
		
			redirect_to("search-results.php?id={$id}&dest={$_SESSION['from']}");
		
		}
		
			
		
		$from = $_SESSION["from"];
		//select cars based on location
		$q = "SELECT * from cars WHERE car_address LIKE '{$from}%' AND car_id != {$id}";
		
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
	
	<!-- Search -->
		<div class="advanced-search color" id="booking">
			<div class="wrap">
				<form role="form" action="" method="post">
                
					<!-- Row -->
					<div class="f-row">
						<div class="form-group select one-third">
							<label>Pick up location</label>
							<select name="from">
								<option selected>&nbsp;</option>
								<optgroup label="Athens">
									<option value="Sintagma">Sintagma</option>
									<option value="Peristeri">Peristeri</option>
									<option value="Glifada">Glifada</option>
									<option value="Koropi">Koropi</option>
									<option value="Xalandri">Xalandri</option>
									<option value="Marousi">Marousi</option>
									<option value="Piraias">Piraias</option>
									<option value="Kifisia">Kifisia</option>
									<option value="Agios Stefanos">Agios Stefanos</option>
								</optgroup>
								<optgroup label="Lamia">
                                    <option value="Lamia">Lamia</option>
								</optgroup>
								<optgroup label="Korinthos">
                                    <option value="Korinthos">Korinthos</option>
								</optgroup>
								<optgroup label="Thiba">
                                    <option value="Thiba">Thiba</option>
								</optgroup>
                                <optgroup label="Bolos">
                                    <option value="Bolos">Bolos</option>
								</optgroup>
                                <optgroup label="Karditsa">
                                    <option value="Karditsa">Karditsa</option>
								</optgroup>
                                <optgroup label="Trikala">
                                    <option value="Trikala">Trikala</option>
								</optgroup>
                                <optgroup label="Larisa">
                                    <option value="Larisa">Larisa</option>
								</optgroup>
                                <optgroup label="Ioannina">
                                    <option value="Ioannina">Ioannina</option>
								</optgroup>
                                <optgroup label="Arta">
                                    <option value="Arta">Arta</option>
								</optgroup>
                                <optgroup label="Kastoria">
                                    <option value="Kastoria">Kastoria</option>
								</optgroup>
                                <optgroup label="Thessaloniki">
                                    <option value="Center-Leukos Pirgos">Center-Leukos Pirgos</option>
									<option value="Toumpa">Toumpa</option>
									<option value="Balaoritou">Balaoritou</option>
								</optgroup>
                                <optgroup label="Kabala">
                                    <option value="Kabala">Kabala</option>
								</optgroup>
                                <optgroup label="Aleksandroupoli">
                                    <option value="Aleksandroupoli">Aleksandroupoli</option>
								</optgroup>
                                <optgroup label="Agrinio">
                                    <option value="Agrinio">Agrinio</option>
								</optgroup>
                                <optgroup label="Tripoli">
                                    <option value="Tripoli">Tripoli</option>
								</optgroup>
                                <optgroup label="Kalamata">
                                    <option value="Kalamata">Kalamata</option>
								</optgroup>
                                <optgroup label="Pirgos">
                                    <option value="Pirgos">Pirgos</option>
								</optgroup>
                                <optgroup label="Sparti">
                                    <option value="Sparti">Sparti</option>
								</optgroup>
                                <optgroup label="Xania">
                                    <option value="Xania">Xania</option>
								</optgroup>
                                <optgroup label="Rethimno">
                                    <option value="Rethimno">Rethimno</option>
								</optgroup>
                                <optgroup label="Hrakleio">
                                    <option value="Hrakleio">Hrakleio</option>
								</optgroup>
							</select>
                            
                            
                           
						</div>
                         
                        <input type="submit" class="btn large black pull-right find_btn" value="Find Transfer" name="find"/>
					</div>
					<!-- //Row -->
					
				</form>
			</div>
		</div>
		<!-- //Search -->
		
		<div class="wrap">
			<div class="row">
				<!--- Content -->
				<div class="full-width content">
					<h2>Select a vehicle in <span style="color:red;"><?php echo $_SESSION["from"]; ?></span></h2>
					
					<div class="results">
                    <?php $result = $mysqli->query($q);
					      if ($result->num_rows > 0) {
						
						
				while($found = $result->fetch_array()){
					
				//echo cars founds in that location
				
				echo "<article class='result'>
						   
								<div class='one-fourth heightfix'><img height='100%' width='100%' src='profile_pictures/".$found["image"]."'/></div>
								<div class='one-half heightfix'>
									<h3>".$found["car_brand"]."<a href='javascript:void(0)' class='trigger color' title='Read more'>Description</a></h3>
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