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
        
         <!-- dont delete these -->
        <link href="calendar/calendarstyle.css" rel="stylesheet" type="text/css">
		<link href="calendar/jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
	    <link href="calendar/jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
		<link href="calendar/jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
		<script src="calendar/jQueryAssets/jquery-1.11.1.min.js" type="text/javascript"></script>
		<script src="calendar/jQueryAssets/jquery.ui-1.10.4.datepicker.min.js" type="text/javascript"></script>
        
          <style>
			
			.booked a.ui-state-default
			{
				background:#ED0D10;
				color:#FFFFFF;
			}
			
			.calendar .ui-datepicker-header {
   				background:#A32E30;
			}
		</style>
        <!--dont delete these-->


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

        <title>Book</title>
    </head>

    <body name="homepage">
    
    
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
		
		if (isset($_GET['car'])){
			//get the id of the car that the user wants to book
			$car_for_booking = $_GET['car'];
			
			//get the car info from db
			$sql_vehicle = "SELECT * FROM cars WHERE car_id = {$car_for_booking} LIMIT 1";
			//get the owner info from db
			$sql_owner =  "SELECT * FROM users WHERE id = {$car_for_booking} LIMIT 1";
			 if ($vehicle_result = $mysqli->query($sql_vehicle)) {
					$vehicle = $vehicle_result->fetch_array();
				} else {
					echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
					exit();
				}
			 if ($owner_result = $mysqli->query($sql_owner)) {
					$owner = $owner_result->fetch_array();
				} else {
					echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
					exit();
				}	
				
		}
		
		$dates ="";
		//select dates disabled by the owner from the testdate table and add them to the $dates variable
        $sql = $mysqli->query("SELECT blocked_dates FROM testdate WHERE date_id={$car_for_booking} AND is_owner=1");
        while ($day = $sql->fetch_array(MYSQLI_BOTH)) {
					
            $dates.='"'.date('Y-n-j',strtotime($day["blocked_dates"])).'",';
		}
		
		$dates = rtrim($dates, ",");
		echo $dates;
		//select dates booked by other users from the testdate table and add them to the $booked_dates variable
		$booked_dates ="";
        $sql2 = $mysqli->query("SELECT blocked_dates FROM testdate WHERE date_id={$car_for_booking} AND is_owner=0");
        while ($bday = $sql2->fetch_array(MYSQLI_BOTH)) {
					
            $booked_dates.='"'.date('Y-n-j',strtotime($bday["blocked_dates"])).'",';
		}
		
		$booked_dates = rtrim($booked_dates, ",");
		echo $booked_dates;
		
		if (isset($_POST['book'])){
			//store starting and ending dates in $_SESSION
			$_SESSION['start_of_book'] = $_POST['from'];
			$_SESSION['end_of_book'] = $_POST['to'];
			
			redirect_to("process_booking.php?id={$_SESSION['user_id']}&car={$car_for_booking}");
			
		}
		
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
        
         <!-- Page info -->
		<header style="margin-top:-10px;" class="site-title color">
			<div class="wrap">
				<div class="container">
					<h1>Booking Process</h1>
					<nav role="navigation" class="breadcrumbs">
					</nav>
				</div>
			</div>
		</header>
		<!-- //Page info -->


        
       
        
        <div class="container postnewcarbox">
        <div style="margin-bottom:30px;" class="row">
        <h3>Select the date range for booking. Dates in <span style="color:red; padding-top:15px; padding-bottom:15px;">red</span> are unavailable.</h3>
        </div>
            <div class="row">
            
               <div class="col-md-3">
                    <img class="img-responsive img-thumbnail pull-left" src="profile_pictures/<?php echo "{$vehicle['image']}";?>">
               </div>
                <div class="col-md-offset-2 col-md-7 col-sm-6 profileinfo">
                    <h2>Car Info</h2>
                    <div class="col-md-4 col-sm-6 col-xs-6">
                        <h3>CC:</h3>
                        <h3>BRAND:</h3>
                        <h3>E-MAIL:</h3>
                        <h3>PRICE/DAY:</h3>
                        <h3>LOCATION:</h3>
                    </div>
                    <div class="col-md-5 col-sm-6 col-xs-6">
                        <p><?php echo $vehicle['car_cc'];?></p>
                        <p><?php echo $vehicle['car_brand'];?></p>
                        <p><?php echo $owner['email'];?></p>
                        <p><?php echo $vehicle['car_price'];?></p>
                        <p><?php echo $owner['address'];?></p>
                    </div>
                </div>
<!--
               <div class="col-md-offset-3 col-md-2">
                   <a href="editprofile.html"><button type="button" class="btn editprofilebtn">Edit</button></a>
               </div>
-->
            </div>
            
            
             <script type="text/javascript">
                /*echo booked and disabled dates brought from db, into two arrays that will be handled by datepicker*/
				var disableddates = [<?php echo $dates; ?>, "2010-2-10"];
				var booked_dates =[<?php echo $booked_dates;?>];
				
				 
				function DisableSpecificDates(date) {
				 
					 var m = date.getMonth();
					 var d = date.getDate();
					 var y = date.getFullYear();
					 
					 // convert the date in to the yy-mm-dd format 
					 // Take note that we will increment the month count by 1 
					 var currentdate = y + '-' + (m + 1)  + '-' + d ;
					 
				     var bd = $.inArray(currentdate, booked_dates);
					 if (bd > -1) {
						return [true, 'booked','This date is booked!'];
					 }
					 var db = $.inArray(currentdate, disableddates);
        			 return [db == -1]
				}
				 
				 
				 $(function() {
				 $( "#datepicker" ).datepicker({
					beforeShowDay: DisableSpecificDates,
					dateFormat: 'yy-mm-dd',
					minDate: 0,
					onSelect: function(date) {
							//alert(date);
						}
					});
				 });
				 
				 $(function() {
				 $( ".selection" ).datepicker({
					beforeShowDay: DisableSpecificDates,
					dateFormat: 'yy-mm-dd',
					minDate: 0,
					onSelect: function(date) {
						   // alert(date);
						}
					});
				 });
				 
			</script>	  
            
            
            <div class="row">
                <div class="inputdates">
                    <div class="col-md-8 col-sm-12">
                        <form class="form-horizontal" action="" method="POST">
                            <div class="form-group">
                                <label for="inputstartdate" class="col-md-3 col-sm-2 col-xs-2 control-label"><h3 class=" pull-left">Start date:</h3></label>
                                <input type="text" class="form-control col-md-9 selection" name="from" id="startdate">
                            </div>
                            <div class="form-group">
                                <label for="inputenddate" class="col-md-3 col-sm-2 col-xs-2 control-label"><h3 class=" pull-left">End date:</h3></label>
                                <input type="text" class="form-control col-md-9 selection" name="to" id="enddate">
                            </div>
                            
                            <input type="submit" class="book-btn" value="Book" name="book">
                            
                        </form>
                    </div>
                    <div class="col-md-4 col-sm-12">
                        <div class="calendar">
                                <!--<div id="Holder">-->
                          			<div id="datepicker">
                         		 <!--</div>-->
                        </div>
                    </div>
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