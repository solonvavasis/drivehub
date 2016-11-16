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


        <!-- <script src="//code.jquery.com/jquery-1.11.3.min.js"></script> -->
        
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
			
			.cal .ui-datepicker-header {
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

        <title>Edit</title>
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
			if ($user['user_lvl']!="full"){
				redirect_to("editprofile.php?id={$_SESSION['user_id']}");
			}
			
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}
		
		$sql_car = "SELECT * FROM cars WHERE car_id = {$id} LIMIT 1";
 
		if ($result_car = $mysqli->query($sql_car)) {
			$car = $result_car->fetch_array();
		} else {
			echo "<p>MySQL error no {$mysqli->errno} : {$mysqli->error}</p>";
			exit();
		}
		
		
		$dates ="";
        $sql = $mysqli->query("SELECT blocked_dates FROM testdate WHERE date_id={$id} AND is_owner=1");
        while ($day = $sql->fetch_array(MYSQLI_BOTH)) {
					
            $dates.='"'.date('Y-n-j',strtotime($day["blocked_dates"])).'",';
		}
		
		$dates = rtrim($dates, ",");
		echo $dates;
		
		$booked_dates ="";
        $sql2 = $mysqli->query("SELECT blocked_dates FROM testdate WHERE date_id={$id} AND is_owner=0");
        while ($bday = $sql2->fetch_array(MYSQLI_BOTH)) {
					
            $booked_dates.='"'.date('Y-n-j',strtotime($bday["blocked_dates"])).'",';
		}
		
		$booked_dates = rtrim($booked_dates, ",");
		echo $booked_dates;
		
		
 
		if ($result->num_rows == 1) {
			# calculating online status
			if (time() - $user['status'] <= (5*60)) { // 300 seconds = 5 minutes timeout
				$status = "Online";
			} else {
				$status = "Offline";
			}
 
			# echo the user profile data
			echo "<p>Status: {$status}</p>";			
		} else { // 0 = invalid user id
			echo "<p><b>Error:</b> Invalid user ID.</p>";
		}
		
		//update user data
		if(isset($_POST['update'])){
		$UpdateFName = $_POST['first_name'];
		$UpdateLName = $_POST['last_name'];
		$UpdateEmail = $_POST['email'];
		$UpdatePhone = $_POST['phone'];
		$UpdateAddress = $_POST['address'];
		
		$update_user_info = $mysqli->query("UPDATE users SET first_name = '{$UpdateFName}', last_name = '{$UpdateLName}', email = '{$UpdateEmail}', phone = '{$UpdatePhone}', address = '{$UpdateAddress}' where id=$id");
		
		//update car data
		$UpdateCarCC = $_POST['car_cc'];
		$UpdateCarPrice = $_POST['car_price'];
		$UpdateCarBrand = $_POST['car_brand'];
		$UpdateCarDescription = $_POST['car_description'];
		
		$update_car_info = $mysqli->query("UPDATE cars SET car_cc = '{$UpdateCarCC}', car_price = '{$UpdateCarPrice}', car_brand = '{$UpdateCarBrand}', car_description = '{$UpdateCarDescription}' where car_id=$id");
		
		
		redirect_to("profile.php?id={$_SESSION['user_id']}");
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
        
        
         


        
       
        
        <div class="container postnewcarbox">
        <h2 style="margin-top:30px;">Edit <span style="color:red;"><?php echo "{$user['username']}";?></span> profile</h2>
            <div class="container editcar">
                <div class="row">
      
                    <div class="carcubic">
                        <form class="form-horizontal" method="POST" action="">
                            <div class="form-group">
                                <label for="inputlength" class="col-sm-2 control-label"><p class=" pull-left">Name</p></label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="text" class="form-control" id="inputlength" name="first_name" value="<?php echo "{$user['first_name']}";?>">
                                </div>
                                
                                <label for="inputlength" class="col-sm-2 control-label"><p class=" pull-left">Surname</p></label>
                           		 <div class="col-sm-10 col-md-4">
                                	<input type="text" class="form-control" id="inputlength" name="last_name" value="<?php echo "{$user['last_name']}";?>">
                            	</div>
                                <label for="inputlength" class="col-sm-2 control-label"><p class=" pull-left">e-mail</p></label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="text" class="form-control" id="inputlength" name="email" value="<?php echo "{$user['email']}";?>">
                                </div>
                                 <label for="inputlength" class="col-sm-2 control-label"><p class=" pull-left">phone</p></label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="text" class="form-control" id="inputlength" name="phone" value="<?php echo "{$user['phone']}";?>">
                                </div>
                                <label for="inputlength" class="col-sm-2 control-label"><p class=" pull-left">adress</p></label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="text" class="form-control" id="inputlength" name="address" value="<?php echo "{$user['address']}";?>">
                                </div>
                                
                                <!--car-->
                                <label for="inputlength" class="col-sm-2 control-label"><p class=" pull-left">Cubic (cc)</p></label>
                                <div class="col-sm-10 col-md-4">
                                    <input type="text" class="form-control" id="inputlength" name="car_cc" value="<?php echo "{$car['car_cc']}";?>">
                                </div>
                                <label for="inputlength" class="col-sm-2 control-label"><p class="pull-left">Price/Day</p></label>
                                <div class="col-sm-12 col-md-4">
                                    <input type="text" class="form-control" id="inputlength" name="car_price" value="<?php echo "{$car['car_price']}";?>">
                                </div>
                               <label for="inputlength" class="col-sm-2 control-label"><p class="pull-left">Brand</p></label>
                                <div class="col-sm-12 col-md-4">
                                    <input type="text" class="form-control" id="inputlength" name="car_brand" value="<?php echo "{$car['car_brand']}";?>">
                                </div>
                                <label for="inputlocation" class="col-sm-12 control-label"><p class=" pull-left">Description</p></label>
                                <div class="col-sm-12 col-md-12">
                                    <textarea rows="10" cols="10" name="car_description"><?php echo "{$car['car_description']}";?></textarea>
                                </div>
                                
                                <div class="row">
                    				<div class="col-sm-8 col-md-12">
                                   
                                        <input type="submit" class="continue-btn" value="update" name="update"> 
                                    </div>
                				</div>   
                               
                            
                            </div>
                        </form>    
                    </div>      
                 
                </div>
            
            
            
           
                
            
            
            
                                                                            
                        
            
            
            
            
            
            
             
            
           <script type="text/javascript">
           /* Store dates brought from db into two arrays that will be handled by datepicker. One array for blocked dates and one for booked dates.*/
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
					minDate:0,
					dateFormat: 'yy-mm-dd',
					onSelect: function(date) {
							//alert(date);
						}
					});
				 });
				 
				 $(function() {
				 $( ".selection" ).datepicker({
					beforeShowDay: DisableSpecificDates,
					minDate:0,
					dateFormat: 'yy-mm-dd',
					onSelect: function(date) {
						   // alert(date);
						}
					});
				 });
				 
			</script>	  
				 
				 
			 
            
        
            
           
                
                  
                
                
                
                
            
            
            
            
           
            
            
            
            
           
            
           
            
                                                       
                        
            
        
                    </div>
                </div>
            
   
        
 

       
        

       









        <!-------------------------footer-------------------------->
        
        
        
        
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



    </body>

</html>