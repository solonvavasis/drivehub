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
	
	
	
	//store starting and ending dates into variables
$date1 = mysqli_real_escape_string($mysqli,$_POST['from']);
$new_date1 = date('Y-m-d',strtotime($date1));

$date2 = mysqli_real_escape_string($mysqli,$_POST['to']);
$new_date2 = date('Y-m-d',strtotime($date2));


$start_date = $new_date1;
$end_date = $new_date2;

//count the number of days
$total_days = round(abs(strtotime($end_date) - strtotime($start_date)) / 86400, 0) + 1;

if ($end_date >= $start_date)
{
  for ($day = 0; $day < $total_days; $day++)
  {
	$single_day = array(date("Y-m-d", strtotime("{$start_date} + {$day} days")));  
   
	foreach ($single_day as $tmp){
	
	    echo "<br />".$tmp;
		$exists = "";
		$result = $mysqli->query("SELECT blocked_dates from testdate WHERE blocked_dates = '{$tmp}' AND date_id = '{$id}' AND is_owner = 1");
		if ($result->num_rows > 0) {
			$exists .= "u";
		}
		//check if any the selected days exist in the db. if yes, delete them, making them available for booking. 
		//is_owner column is used to seperate blocked dates(owner) from booked dates(buyer).
		//blocked dates are inserted into database with an is_owner value of 1. booked dates are inserted into database with an is_owner value of 0.
		//blocked dates will be added into database only by the owner. booked dates will be added into database only by buyers.
		//in this case the dates are disabled by the owner, so we will handle them as blocked dates, not as booked.
		if ($exists == "u"){
			if(isset($_POST["unblock"])){
			$sql = $mysqli->query ("DELETE from testdate WHERE blocked_dates = '{$tmp}' AND date_id = '{$id}' AND is_owner = 1 ");
			redirect_to("editdates.php?id={$id}");
			}else{
				redirect_to("editdates.php?id={$id}");
			}
			
		}else{
			//check if on any the selected days exist in the db. if not ,insert them, making them unavailable for booking
			if(isset($_POST["block"])){
				$search = $mysqli->query("SELECT blocked_dates from testdate WHERE blocked_dates = '{$tmp}' AND date_id = '{$id}' AND is_owner = 0");
				if ($search->num_rows>0){
				redirect_to("editdates.php?id={$id}");
				}else{
			$sql = $mysqli->query ("INSERT  INTO testdate (date_id,blocked_dates,is_owner) VALUES ('$id','$tmp','1')");
			redirect_to("editdates.php?id={$id}");}
			}else{
				redirect_to("editdates.php?id={$id}");
			}
			
		}	
		
		
	}
	
	unset($tmp);
                                 
  }
}

}
	
			
?>

