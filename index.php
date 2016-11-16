<?php 
require_once("includes/functions.php");
require_once("includes/db_const.php");
session_start();

if (isset($_POST['find'])){
	redirect_to("login.php");
} 

?>

<!DOCTYPE html>
<html lang="en">
   <head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">	
	<title>Home</title>
	<link rel="stylesheet" href="css/theme-red.css" />
	   
	<link rel="stylesheet" href="css/animate.css" />
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700|Montserrat:400,700' rel='stylesheet' type='text/css'>
	<link rel="shortcut icon" href="images/car-tire-16-231903.png" />
    <link rel="stylesheet" href="css/style.css" />
  </head>
  
  <body class="home">
		<!-- Header -->
		<header class="header" role="banner">
			<div class="wrap">
				<!-- Logo -->
				<div class="logo">
					<a href="index.php"><img src="images/drivehub.png"/></a>
				</div>
				<!-- //Logo -->
                <!-- Main Nav -->
				<nav role="navigation" class="main-nav">
					<ul class="nav navbar-nav navbar-right">
                        <li>
                            <a href="login.php"><button type="button" class="btn large  wow fadeInLeft anchor login_btn">Log in</button></a>
                        </li>
                        <li>
                           <a href="register.php"><button type="button" class="btn large  wow fadeInLeft anchor login_btn">Register</button></a>
                        </li>
			</div>
		</header>
		<!-- //Header -->
	
	<!-- Main -->
	<main class="main" role="main">
        
		<!-- Intro -->
		<div class="intro img-responsive">
			<div class="wrap">
				<div class="textwidget">
					<h1 class="wow fadeInDown">Need a ride?</h1>
					<h2 class="wow fadeInUp">You've come to the right place.</h2>
					<div class="actions">
						<a href="latest.php" class="btn large black wow fadeInLeft anchor">Latest Cars</a>
						<a href="popular.php" class="btn large black wow fadeInRight anchor">Popular Cars</a>
						<a href="login.php" class="btn large white wow fadeInRight anchor">Add your Car</a>
					</div>
				</div>
			</div>
		</div>
		<!-- //Intro -->
		
		<!-- Search -->
		<div class="advanced-search color" id="booking">
			<div class="wrap">
				<form role="form" action="" method="post">
                
					<!-- Row -->
					<div class="f-row">
						<div class="form-group select one-third">
							<label>Looking for a car in a specific area? <br/>Choose an area to find available cars. </label>
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
                         
                        <input type="submit" class="btn large white  find_btn" value="Find Transfer" name="find"/>
					</div>
					<!-- //Row -->
					
				
				</form>
			</div>
		</div>
		<!-- //Search -->		
		
		<!-- Services -->
		<div class="services boxed white" id="services">
			<!-- Item -->
			<article class="one-fourth wow fadeIn">
				<figure class="featured-image">
					<img height="300" width="100%" src="images/greece-athens-parthenonatnight1.jpg"/>
					<div class="overlay">
						<a href="services.php" class="expand">+</a>
					</div>
				</figure>
				<div class="details">
					<h4>Athens</h4>
					<p>Most people have a love-hate relationship to Greece's capital. On one hand it is a city with a wide variety of things to see and do.It is a fascinating place. It is one of the oldest cities in the world, and walking through its ancient Agora or on the Acropolis, </p>
					<a class="more" title="Read more" href="services.html">Read more</a>
				</div>
			</article>
			<!-- //Item -->
			
			<!-- Item -->
			<article class="one-fourth wow fadeIn" data-wow-delay=".2s">
				<figure class="featured-image">
					<img height="300" width="100%" src="images/shutterstock_14464957_1.jpg"/>
					<div class="overlay">
						<a href="services2.php" class="expand">+</a>
					</div>
				</figure>
				<div class="details">
					<h4>Thessaloniki</h4>
					<p>Thessaloniki is the second largest city of Greece and the most important centre of the area. Built near the sea (at the back of the Thermaïkos Gulf), it is a modern metropolis bearing the marks of its stormy history and its cosmopolitan character, which give it a special beauty and charm.</p>
					<a class="more" title="Read more" href="services2.php">Read more</a>
				</div>
			</article>
			<!-- //Item -->
			
			<!-- Item -->
			<article class="one-fourth wow fadeIn" data-wow-delay=".4s">
				<figure class="featured-image">
					<img height="300" width="100%" src="images/chania-main.jpg">
					<div class="overlay">
						<a href="services3.php" class="expand">+</a>
					</div>
				</figure>
				<div class="details">
					<h4>Xania</h4>
					<p>Chania is the capital city, a place where different civilizations have flourished throughout the centuries. Wandering around the Old Town’s maze-like alleys with the beautiful Venetian mansions, the fountains and the elaborate churches will help you discover well-preserved historical monuments.</p>
					<a class="more" title="Read more" href="services3.php">Read more</a>
				</div>
			</article>
			<!-- //Item -->
			
			<!-- Item -->
			<article class="one-fourth wow fadeIn" data-wow-delay=".6s">
				<figure class="featured-image">
					<img src="images/bolos_index.jpg" height="300" width="100%" />
					<div class="overlay">
						<a href="services4.php" class="expand">+</a>
					</div>
				</figure>
				<div class="details">
					<h4>Bolos</h4>
					<p>Volos is one of the largest and most attractive cities in Greece as well as one of the country’s most prominent ports. The modern-day city, built near the site of ancient Iolcos, dominates the region of Magnesia from its position at the foot of Mount Pelion overlooking the Pagasetic Gulf.</p>
					<a class="more" title="Read more" href="services4.php">Read more</a>
				</div>
			</article>
			<!-- //Item -->			
		</div>
		<!-- //Services -->
        
        <!-- Call to action -->
		
		
		<!-- Call to action -->
		<div class="color cta">
			<div class="wrap">
				<p class="wow fadeInLeft">Want to explore more destinations???</p>
				<a href="login.php" class="btn huge black right wow fadeInRight">CLICK HERE</a>
			</div>
		</div>
		<!-- //Call to action -->
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