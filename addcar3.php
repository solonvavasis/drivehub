<?php 
require_once("includes/functions.php");
require_once("includes/db_const.php");
session_start();
?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="js/jquery.min.js"></script>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <link rel="icon" href="img/favicon.ico">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="images/car-tire-16-231903.png" /> 
            <link rel="stylesheet" href="css/theme-red.css" />
            <link rel="stylesheet" href="css/animate.css" />
	        <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700|Montserrat:400,700' rel='stylesheet' type='text/css'>
            <link rel="stylesheet" href="css/style.css" />
        <link href="css/stylecustom.css" rel="stylesheet" type="text/css">

        <title>Add Car - Step Three | Drivehub</title>
    </head>

    <body name="homepage">
    
    <!--php-->
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
}
 

//continue to final step
if (isset($_POST['submit_town'])){
	
    $_SESSION['town']= $_POST['town'];
		
	redirect_to("addcarfinal.php?id=$id");
	
	
}
?>






        <!--navbar-header-->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand " href="<?php echo "logged.php?id=$id";?>">
                        <img class="img-responsive center-block logo" alt="Brand" src="images/drivehub.png">
                    </a>
                </div>
                
                <!-- /.navbar-collapse -->
            </div>
            <!-- /.container-fluid -->
        </nav>


        <!--navbar-header-->


        
        
        
        <!-----headline------>
    <div class="container-fluid whitecolor">      
        <div class="container">
            <div class="row">
                <div class="headline-addcar col-md-12">
                    <h2>Final Step</h2>
                    <p></p>
                    <div class="col-md-4 addyourcarsteps">
                        <div class="newcarstep col-md-offset-6 col-md-1"></div>
                        <p class="col-md-12">Step1</p>
                    </div>
                    <div class="col-md-4 addyourcarsteps">
                        <div class="newcarstep col-md-offset-6 col-md-1"></div>
                        <p class="col-md-12">Step2</p>
                    </div>
                    <div class="col-md-4 addyourcarsteps">
                        <div class="newcarstep col-md-offset-6 col-md-1 active"></div>
                        <p class="col-md-12">Step3</p>
                    </div>
                </div>
                
            </div>
        </div>
    </div>      
        <!-----headline------>

        
        
        <div class="container postnewcarbox">
           
            
                <div class="row">
                    <div class="selecttown">
                        <form class="form-horizontal" method="POST" action="">
                            <div class="form-group">
                                <label for="inputtown" class="col-sm-2 col-md-4 control-label"><p>Select Town</p></label>
                                <div class="col-sm-5 col-md-4">
                                    <select class="form-control" id="first-choice" name="town" required>
                                    
                                        <option selected value="base">Select Town</option>
                                        <option value="Athens">Athens</option>
                                        <option value="Lamia">Lamia</option>
                                        <option value="Korinthos">Korinthos</option>
                                        <option value="Thiva">Thiva</option>
                                        <option value="Volos">Volos</option>
                                        <option value="Karditsa">Karditsa</option>
                                        <option value="Trikala">Trikala</option>
                                        <option value="Larisa">Larisa</option>
                                        <option value="Ioannina">Ioannina</option>
                                        <option value="Arta">Arta</option>
                                        <option value="Kastoria">Kastoria</option>
                                        <option value="Thessaloniki">Thessaloniki</option>
                                        <option value="Kavala">Kavala</option>
                                        <option value="Alexandroupoli">Alexandroupoli</option>
                                        <option value="Agrinio">Agrinio</option>
                                        <option value="Tripoli">Tripoli</option>
                                        <option value="Kalamata">Kalamata</option>
                                        <option value="Pirgos">Pirgos</option>
                                        <option value="Sparti">Sparti</option>
                                        <option value="Xania">Xania</option>
                                        <option value="Rethimno">Rethimno</option>
                                        <option value="Hrakleio">Hrakleio</option>
                                        
                                    </select>
                                    <br>
                                    <input type="submit" class="btn continue-btn" name="submit_town" value="Next">
                                    
                                    
                                </div>
                            </div>
                        </form>    
                    </div>
                </div>            
        </div>
        
        

       
        

       









        <!-------------------------footer-------------------------->
        
        
        
        
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



    </body>

</html>