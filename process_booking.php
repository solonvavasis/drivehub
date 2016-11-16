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
			//get selected car id and store it into variable
			$car_for_booking = $_GET['car'];
			//get associated data of selected car from db
			$sql_car = "SELECT * FROM cars WHERE car_id = {$car_for_booking} LIMIT 1";
			if ($rc = $mysqli->query($sql_car)) {
				$car = $rc->fetch_array();
				//increase booking_count of selected car by 1 ,each time a new booking is processed
				$newbook = "UPDATE cars SET booking_count = booking_count + 1 WHERE car_id = {$car_for_booking}";
				$increase_book_count = $mysqli->query($newbook);
				
			} else {
				echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
				exit();
			}
			//get associated data of selected car's owner  from db
			$sql_owner = "SELECT * FROM users WHERE id = {$car_for_booking} LIMIT 1";
				if ($ro = $mysqli->query($sql_owner)) {
					$owner = $ro->fetch_array();
				} else {
					echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
					exit();
				}
			
		}
		
		
//store starting/ending dates into variables
$date1 = mysqli_real_escape_string($mysqli,$_SESSION['start_of_book']);
$new_date1 = date('Y-m-d',strtotime($date1));

$date2 = mysqli_real_escape_string($mysqli,$_SESSION['end_of_book']);
$new_date2 = date('Y-m-d',strtotime($date2));


$start_date = $new_date1;
$end_date = $new_date2;

//count number of days
$total_days = round(abs(strtotime($end_date) - strtotime($start_date)) / 86400, 0) + 1;

if ($end_date >= $start_date)
{
  for ($day = 0; $day < $total_days; $day++)
  {
	$single_day = array(date("Y-m-d", strtotime("{$start_date} + {$day} days")));  
   
	foreach ($single_day as $tmp){
	
	        
		$exists = "";
		$result = $mysqli->query("SELECT blocked_dates from testdate WHERE blocked_dates = '{$tmp}' AND date_id = '{$car_for_booking}'");
		if ($result->num_rows > 0) {
			$exists .= "u";
		}
		
		if ($exists == "u"){
			//this date range is unavailable
		}else{
			    //is_owner column is used to seperate blocked dates(owner) from booked dates(buyer).
				//blocked dates are inserted into database with an is_owner value of 1. booked dates are inserted into database with an is_owner value of 0.
				//blocked dates will be added into database only by the owner. booked dates will be added into database only by buyers.
			    //in this case the dates are booked by a buyer, so we will handle them as booked dates, not as blocked.
				$sql = $mysqli->query ("INSERT  INTO testdate (date_id,blocked_dates,is_owner) VALUES ('$car_for_booking','$tmp','0')");
					
		}	
		
		
	}
	
	unset($tmp);
                                 
  }
}
}
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
		</style>
        <!--dont delete these-->


        <!--<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>-->
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
        <link rel="icon" href="img/favicon.ico">
        <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css" rel="stylesheet">
        <link rel="shortcut icon" href="images/car-tire-16-231903.png"/>  
            <link rel="stylesheet" href="css/theme-red.css" />
            <link rel="stylesheet" href="css/animate.css" />
	        <link href='http://fonts.googleapis.com/css?family=Raleway:400,500,600,700|Montserrat:400,700' rel='stylesheet' type='text/css'>
            <link rel="stylesheet" href="css/style.css" />
            <link href="css/stylecustom.css" rel="stylesheet" type="text/css">

        <title>Book</title>
    </head>

    <body name="homepage">
    
    
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
        <h2 class="message">
        
        <?php
		 if ($exists == "u"){
			echo "This date range is unavailable."; 
		  }else{
		echo "Car successfully booked. Check your email for a summary of your booking.";	 
		
		 //email owner and buyer
		 
		 $to_buyer = $user['email'];
		$subject1 = "Drivehub: Your booking summary";
		
		$message1 = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml" style="font-family: Verdana, Geneva, sans-serif; margin: 0; padding: 0;">&#13;
<head>&#13;
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />&#13;
<title>Untitled Document</title>&#13;
&#13;
&#13;
</head>&#13;
&#13;
<body style="font-family: Verdana, Geneva, sans-serif; margin: 0; padding: 0;"><style type="text/css">
.group:before { content: "" !important; display: table !important; }
.group:after { content: "" !important; display: table !important; }
.group:after { clear: both !important; }
&gt;</style>&#13;
<div id="container" style="font-family: Verdana, Geneva, sans-serif; max-width: 1300px; margin: 100px auto 0; padding: 0;">&#13;
    <div class="header" style="font-family: Verdana, Geneva, sans-serif; width: 100%; background-color: #C10000; margin: 0; padding: 0;">&#13;
    	<h1 style="font-family: Verdana, Geneva, sans-serif; color: white; text-align: center; margin: 0; padding: 20px 0;" align="center">Drivehub</h1>&#13;
    </div>&#13;
    <div class="subheader" style="font-family: Verdana, Geneva, sans-serif; margin: 0; padding: 0;">&#13;
    	<h2 style="font-family: Verdana, Geneva, sans-serif; text-align: center; color: #060; margin: 40px 0; padding: 0;" align="center">Booking summary</h2>&#13;
    </div>&#13;
    <div id="wrapper" style="font-family: Verdana, Geneva, sans-serif; max-width: 1000px; margin: auto; padding: 0;">&#13;
        <h4 class="custinfo" style="font-family: Verdana, Geneva, sans-serif; text-align: center; color: white; background-color: #333; margin: 0; padding: 20px 0;" align="center">Owner personal and car information</h4>&#13;
        <div class="section group main" style="clear: both; zoom: 1; font-family: Verdana, Geneva, sans-serif; margin: 0px; padding: 30px 0px;">&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0; padding: 0;" align="center">&#13;
            First Name&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$owner['first_name'].'</p> &#13;
            </div>&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Last Name&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$owner['last_name'].'</p>&#13;
            </div>&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Email&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$owner['email'].'</p>&#13;
            </div>&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Phone&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$owner['phone'].'</p>&#13;
            </div>&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Address&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$owner['address'].'</p>&#13;
            </div>&#13;
         </div>&#13;
          <div class="section group main" style="clear: both; zoom: 1; font-family: Verdana, Geneva, sans-serif; margin: 0px; padding: 30px 0px;">&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0; padding: 0;" align="center">&#13;
            Car CC&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$car['car_cc'].'</p> &#13;
            </div>&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Car Brand&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$car['car_brand'].'</p>&#13;
            </div>&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Car Price/Day&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$car['car_price'].'</p>&#13;
            </div>&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Car Town&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$car['car_town'].'</p>&#13;
            </div>&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Car Location&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$car['car_location'].'</p>&#13;
            </div>&#13;
         </div>&#13;
         <div class="section group main" style="clear: both; zoom: 1; font-family: Verdana, Geneva, sans-serif; margin: 0px; padding: 30px 0px;">&#13;
            <div class="col span_1_of_2" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0; padding: 0;" align="center">&#13;
            Starting date of booking&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$start_date.'</p>&#13;
            </div>&#13;
            <div class="col span_1_of_2" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Ending date of booking&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$end_date.'</p>&#13;
            </div>&#13;
        </div>&#13;
     </div>   &#13;
    &#13;
</div>&#13;
</body>&#13;
</html>

		';
		
		
		$headers1 = "MIME-Version: 1.0" . "\r\n";
		$headers1 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		$headers1 .= 'From: <drivehub@test.com>' . "\r\n";
		
		mail($to_buyer,$subject1,$message1,$headers1);
		
		
		//email the car owner
		
		$to_owner = $owner['email'];
		$subject2 = "Drivehub: Your car has a new booking";
		
		$message2 = '
		<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns="http://www.w3.org/1999/xhtml" style="font-family: Verdana, Geneva, sans-serif; margin: 0; padding: 0;">&#13;
<head>&#13;
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />&#13;
<title>Untitled Document</title>&#13;
&#13;
&#13;
</head>&#13;
&#13;
<body style="font-family: Verdana, Geneva, sans-serif; margin: 0; padding: 0;"><style type="text/css">
.group:before { content: "" !important; display: table !important; }
.group:after { content: "" !important; display: table !important; }
.group:after { clear: both !important; }
&gt;</style>&#13;
<div id="container" style="font-family: Verdana, Geneva, sans-serif; max-width: 1300px; margin: 100px auto 0; padding: 0;">&#13;
    <div class="header" style="font-family: Verdana, Geneva, sans-serif; width: 100%; background-color: #C10000; margin: 0; padding: 0;">&#13;
    	<h1 style="font-family: Verdana, Geneva, sans-serif; color: white; text-align: center; margin: 0; padding: 20px 0;" align="center">Drivehub</h1>&#13;
    </div>&#13;
    <div class="subheader" style="font-family: Verdana, Geneva, sans-serif; margin: 0; padding: 0;">&#13;
    	<h2 style="font-family: Verdana, Geneva, sans-serif; text-align: center; color: #060; margin: 40px 0; padding: 0;" align="center">You have a new booking for your car!</h2>&#13;
    </div>&#13;
    <div id="wrapper" style="font-family: Verdana, Geneva, sans-serif; max-width: 1000px; margin: auto; padding: 0;">&#13;
        <h4 class="custinfo" style="font-family: Verdana, Geneva, sans-serif; text-align: center; color: white; background-color: #333; margin: 0; padding: 20px 0;" align="center">Customer information</h4>&#13;
        <div class="section group main" style="clear: both; zoom: 1; font-family: Verdana, Geneva, sans-serif; margin: 0px; padding: 30px 0px;">&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0; padding: 0;" align="center">&#13;
            First Name&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$user['first_name'].'</p> &#13;
            </div>&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Last Name&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$user['last_name'].'</p>&#13;
            </div>&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Email&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$user['email'].'</p>&#13;
            </div>&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Phone&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$user['phone'].'</p>&#13;
            </div>&#13;
            <div class="col span_1_of_5" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Address&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$user['address'].'</p>&#13;
            </div>&#13;
         </div>&#13;
        
         <div class="section group main" style="clear: both; zoom: 1; font-family: Verdana, Geneva, sans-serif; margin: 0px; padding: 30px 0px;">&#13;
            <div class="col span_1_of_2" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0; padding: 0;" align="center">&#13;
            Starting date of booking&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$start_date.'</p>&#13;
            </div>&#13;
            <div class="col span_1_of_2" style="display: block; float: left; width: 100%; font-family: Verdana, Geneva, sans-serif; text-align: center; color: #900; font-weight: bold; margin: 1% 0 1% 0%; padding: 0;" align="center">&#13;
            Ending date of booking&#13;
            <p class="info" style="font-family: Verdana, Geneva, sans-serif; color: #000; font-weight: 500; margin: 0; padding: 0;">'.$end_date.'</p>&#13;
            </div>&#13;
        </div>&#13;
     </div>   &#13;
    &#13;
</div>&#13;
</body>&#13;
</html>

		';
		
		
		$headers2 = "MIME-Version: 1.0" . "\r\n";
		$headers2 .= "Content-type:text/html;charset=UTF-8" . "\r\n";
		
		// More headers
		$headers2 .= 'From: <drivehub@test.com>' . "\r\n";
		
		mail($to_owner,$subject2,$message2,$headers2);
				}
		  
		?>
        
        </h2>
        
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