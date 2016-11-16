 <?php 
require_once("includes/functions.php");
require_once("includes/db_const.php");
session_start();
?>
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
}			
?>


<!DOCTYPE html>
<html lang="en">
   <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">	
	<title>All Destinations</title>
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
				<a href="<?php echo "logged.php?id=$id";?>"><img src="images/drivehub.png"/></a>
			</div>
			<!-- //Logo -->
	</header>
	<!-- Main -->
	<main class="main" role="main">
		<!-- Page info -->
		<header class="site-title color">
			<div class="wrap">
				<div class="container">
					<h1>All Destinations</h1>
					</nav>
				</div>
			</div>
		</header>
		<!-- //Page info -->
		
		<div class="wrap">
			<div class="row">
				<!--- Content -->
				<div class="full-width content">
					
					<!-- Tabs -->
					<nav class="tabs six grey">
						<ul>
							<li><a href="#tab1">Attiki</a></li>
							<li><a href="#tab2">North Greece</a></li>
							<li><a href="#tab3">Epirus</a></li>
							<li><a href="#tab4">Thessaly</a></li>
							<li><a href="#tab5">Peloponnese</a></li>
							<li><a href="#tab6">Creta</a></li>
						</ul>
					</nav>
					<!-- //Tabs -->
				
					<!-- TabContent -->
					<div class="tab-content" id="tab1">
						<div class="row">
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/sintagma.jpg" width="100%" height="203px" />
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Sintagma";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Sintagma</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Sintagma";?>" class="more">See cars near Sintagma</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/peristeri_plateia.jpg" width="100%" height="203px" />
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Peristeri";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Peristeri</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Peristeri";?>" class="more">See cars near Peristeri</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/glifada.jpg" width="100%" height="203px" />
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Glifada";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Glifada</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Glifada";?>" class="more">See cars near Glifada</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/Koropi.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Koropi";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Koropi</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Koropi";?>" class="more">See cars near Koropi</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/xalandri.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Xalandri";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Xalandri</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Xalandri";?>" class="more">See cars near Xalandri</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/marousi.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Marousi";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Marousi</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Marousi";?>" class="more">See cars near Marousi</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/peiraias.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Piraias";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Piraias</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Piraias";?>" class="more">See cars near Piraias</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/kifisia.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Kifisia";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Kifisia</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Kifisia";?>" class="more">See cars near Kifisia</a>
								</div>
							</article>
							<!-- //Item -->
                            <!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/agios%20stefanos.JPG" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Agios%Stefanos";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Agios Stefanos</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Agios%Stefanos";?>" class="more">See cars near Agios Stefanos</a>
								</div>
							</article>
							<!-- //Item -->
						</div>
					</div>
					<!-- //TabContent -->
					<!-- TabContent -->
					<div class="tab-content" id="tab2">
						<div class="row">
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/leukos%20pirgos.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Leukos%Pyrgos";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Thessaloniki-Center</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Leukos%Pyrgos";?>" class="more">See cars near Leukos Pirgos</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/toumpa.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Toumpa";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Thessaloniki-Toumpa</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Toumpa";?>" class="more">See cars near Toumpa</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/balawritou.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Valaoriti";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Thessaloniki-Balaoritou</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Valaoriti";?>" class="more">See cars near Balaoritou</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/kabala.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Kavala";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Kabala</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Kavala";?>" class="more">See cars near Kabala</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/aleksandroupoli.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Alexandroupoli";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Aleksandroupoli</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Alexandroupoli";?>" class="more">See cars near Aleksandroupoli</a>
								</div>
							</article>
							<!-- //Item -->
						</div>
					</div>
					<!-- //TabContent -->
					<!-- TabContent -->
					<div class="tab-content" id="tab3">
						<div class="row">
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/ioannina.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Ioannina";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Ioannina</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Ioannina";?>" class="more">See cars near Ioannina</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/arta.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Arta";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Arta</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Arta";?>" class="more">See cars near Arta</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/kastoria.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Kastoria";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Kastoria</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Kastoria";?>" class="more">See cars near Kastoria</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/agrinio.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Agrinio";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Agrinio</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Agrinio";?>" class="more">See cars near Agrinio</a>
								</div>
							</article>
							<!-- //Item -->
						</div>
					</div>
					<!-- //TabContent -->
					<!-- TabContent -->
					<div class="tab-content" id="tab4">
						<div class="row">
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/lamia.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Lamia";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Lamia</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Lamia";?>" class="more">See cars near Lamia</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/thiba.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Thiva";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Thiba</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Thiva";?>" class="more">See cars near Thiba</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/bolos.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Volos";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Bolos</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Volos";?>" class="more">See cars near Bolos</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/karditsa.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Karditsa";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Karditsa</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Karditsa";?>" class="more">See cars near Karditsa</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/trikala.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Trikala";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Trikala</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Trikala";?>" class="more">See cars near Trikala</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/larisa.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Larisa";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Larisa</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Larisa";?>" class="more">See cars near Larisa</a>
								</div>
							</article>
							<!-- //Item -->
						</div>
					</div>
					<!-- //TabContent -->
					<!-- TabContent -->
					<div class="tab-content" id="tab5">
						<div class="row">
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/korinthos.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Korinthos";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Korinthos</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Korinthos";?>" class="more">See cars near Korinthos</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/tripoli.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Tripoli";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Tripoli</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Tripoli";?>" class="more">See cars near Tripoli</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/kalamata.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Kalamata";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Kalamata</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Kalamata";?>" class="more">See cars near Kalamata</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/pirgos.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Pirgos";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Pirgos</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Pirgos";?>" class="more">See cars near Pirgos</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/sparti.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Sparti";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Sparti</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Sparti";?>" class="more">See cars near Sparti</a>
								</div>
							</article>
							<!-- //Item -->
						</div>
					</div>
					<!-- //TabContent -->
					<!-- TabContent -->
					<div class="tab-content" id="tab6">
						<div class="row">
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/xania.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Xania";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Xania</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Xania";?>" class="more">See cars near Xania</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/irakleio.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Hrakleio";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Hrakleio</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Hrakleio";?>" class="more">See cars near Hrakleio</a>
								</div>
							</article>
							<!-- //Item -->
							<!-- Item -->
							<article class="one-fourth">
								<figure class="featured-image">
									<img src="images/rethimno.jpg" width="100%" height="203px"/>
									<div class="overlay">
										<a href="<?php echo "search-results.php?id=$id&dest=Rethimno";?>" class="expand">+</a>
									</div>
								</figure>
								<div class="description">
									<div>
										<h3>Rethimno</h3>
									</div>
									<a href="<?php echo "search-results.php?id=$id&dest=Rethimno";?>" class="more">See cars near Rethimno</a>
								</div>
							</article>
							<!-- //Item -->
						</div>
					</div>
					<!-- //TabContent -->
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
	<script src="js/jquery.slicknav.min.js"></script>
	<script src="js/wow.min.js"></script>
	<script src="js/scripts.js"></script>
	
  </body>
</html>