<?php 
	require_once('includes/functions.php');
	require_once('includes/db_const.php');
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
	<title>Register</title>
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
				<a href="index.php"><img src="images/drivehub.png"/></a>
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
					<h1>Register</h1>
					<nav role="navigation" class="breadcrumbs">
					</nav>
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
									<label for="username">Your username</label>
									<input type="text" id="username" name="username" />
								</div>
							</div>
							<div class="f-row">
								<div class="full-width">
									<label for="name">Your name</label>
									<input type="text" id="name" name="first_name" />
								</div>
							</div>
							<div class="f-row">
								<div class="full-width">
									<label for="surname">Your surname</label>
									<input type="text" id="surname" name="last_name" />
								</div>
							</div>
							<div class="f-row">
								<div class="full-width">
									<label for="password">Your password</label>
									<input type="password" id="password" name="password" />
								</div>
							</div>
							<div class="f-row">
								<div class="full-width">
									<label for="email">Your Email</label>
									<input type="email" id="email" name="email" />
								</div>
							</div>
                            <div class="f-row">
								<div class="full-width">
									<label for="telephone">Your Telephone</label>
									<input type="number" id="telephone" name="phone"/>
								</div>
							</div>
                            <div class="f-row">
								<div class="full-width">
									<label for="Address">Your Address</label>
									<input type="text" id="address" name="address"/>
								</div>
							</div>
							<div class="f-row">
								<div class="full-width">
									<input type="submit" name="submit" value="Create an account" class="btn color medium full" />
								</div>
							</div>
							
							<p>Already have an account? <a href="login.php">Login</a>.</p>
						</form>
                        
<!--form php-->
<?php
if (isset($_POST['submit'])) {
## connect mysql server
	$mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
	# check connection
	if ($mysqli->connect_errno) {
		echo "<p>MySQL error no {$mysqli->connect_errno} : {$mysqli->connect_error}</p>";
		exit();
	}
	
	
// Required field names
$required = array('username', 'first_name', 'last_name', 'password', 'email', 'phone', 'address');

// Loop over field names, make sure each one exists and is not empty
$error = false;
foreach($required as $field) {
  if (empty($_POST[$field])) {
    $error = true;
  }
}

//check if everything is set
if ($error) {
  redirect_to("register.php?msg=All fields are required");
} else {
  //success


	
	# prepare data for insertion
	$username	= test_input($_POST['username']);
	$first_name = test_input($_POST['first_name']);
	$last_name = test_input($_POST['last_name']);
	$userpassword	= test_input($_POST['password']);
	$email		= test_input($_POST['email']);
	$phone      = test_input($_POST['phone']);
	$address    = test_input($_POST['address']);
	//when a user first registers, his/her userlvl will be set to "simple". if he chooses to add his car later on, his userlvl will be updated to "full"
	$userlvl = "simple";
	
	//hash the password
    $password = password_hash($userpassword, PASSWORD_DEFAULT);
    
  

	
 
	# check if username and email exist else insert
	// u = username, e = emai, ue = both username and email already exists
	$exists = "";
	$result = $mysqli->query("SELECT username from users WHERE username = '{$username}' LIMIT 1");
	if ($result->num_rows == 1) {
		$exists .= "u";
	}	
	$result = $mysqli->query("SELECT email from users WHERE email = '{$email}' LIMIT 1");
	if ($result->num_rows == 1) {
		$exists .= "e";
	}
 
	if ($exists == "u") echo "<p><b>Error:</b> Username already exists!</p>";
	else if ($exists == "e") echo "<p><b>Error:</b> Email already exists!</p>";
	else if ($exists == "ue") echo "<p><b>Error:</b> Username and Email already exists!</p>";
	else {
		# insert data into mysql database
		$sql = "INSERT  INTO users (id, username, first_name, last_name, password, email , phone , address , user_lvl) 
				VALUES (NULL, '$username', '$first_name', '$last_name', '$password', '$email' , '$phone' , '$address' , '$userlvl')";
 
		if ($mysqli->query($sql)) {
			redirect_to("login.php?msg=Registered successfully");
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}
	}
}

} //end of check



//sanitize data
function test_input($data)
{
  $data = trim($data);
  $data = htmlspecialchars(addslashes($data));
  return $data;
}


//message
if(isset($_GET['msg'])) {
	echo "<p style='color:red;'>".$_GET['msg']."</p>";
}
?>	


<!--form php-->
                        
                        
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
	<script src="js/scripts.js"></script>
	
  </body>
</html>