<?php 
include_once("configs/defines.php");
include("configs/settings.php");
include("functions.php");
include("emailer.php");
$est =new settings();
$con=$est->connection();

$func = new Functions();
if(isset($_POST['action']) && $_POST['action'] == 'enquiry') {
	$token = "Q".$func->generate_ticket();
	$name = trim($_POST['name']);
	$email = trim($_POST['email']);
	$mobile = trim($_POST['mobile']);
	$city_of_guest = trim($_POST['city_of_guest']);
	$time_to_travel = trim($_POST['time_to_travel']);
	$duration = trim($_POST['duration']);
	$place_to_travel = trim($_POST['place_to_travel']);
	$travel_type = trim($_POST['travel_type']);
	$mode_to_contact = trim($_POST['mode_to_contact']);
	$tour = (isset($_POST['tour']) && trim($_POST['tour']) != '')?trim($_POST['tour']):"NULL";
	$status = 'new';
	$query = "INSERT INTO tour_enquiries(token,name,mobile,email,time_to_travel,duration,city_of_guest,place_to_travel,travel_type,mode_to_contact,tour,status,added_on) VALUE 
				('".$token."','".$name."','".$mobile."','".$email."','".$time_to_travel."','".$duration."','".$city_of_guest."','".$place_to_travel."','".$travel_type."','".$mode_to_contact."','".$tour."','".$status."',now())"; 

	mysqli_query($con,$query);
	$id = mysqli_insert_id($con);
	//echo $query;exit;
	if(!empty($id)){
		echo "token=".$token;
		$email_data = array("token"=>$token, "name"=>$name);
                $emailer = new Emailer($con, "enquiry" , array($email), $email_data);
                $emailer->generate();
	}else{
		echo "fail";
	}
}else if(isset($_POST['action']) && $_POST['action'] == 'register') {
	$query = "SELECT id FROM users WHERE email = '".$_POST['reg_email']."'";
	$result = mysqli_query($con,$query);
	$rows = mysqli_num_rows($result);

	if($rows == 0){
		$password = md5(_COOKIE_KEY_.$_POST['reg_password']);
		$query = "INSERT INTO users(name,mobile,email,password) VALUE 
				('".$_POST['reg_name']."','".$_POST['reg_mobile']."','".$_POST['reg_email']."','".$password."')";

		mysqli_query($con,$query);
		$id = mysqli_insert_id($con);
		//echo $query;exit;
		if(!empty($id)){
			session_start(); 
			$_SESSION['user_id']= $id;
			$_SESSION['name']   = $_POST['reg_name'];
			$_SESSION['email']  = $_POST['reg_email'];
			echo 'success';
		}
	}
	else {
		echo 'fail';
	}
}else if(isset($_POST['action']) && $_POST['action'] == 'login'){
	$password = md5(_COOKIE_KEY_.trim($_POST['log_password']));
	$query = "SELECT * FROM users WHERE (email = '".trim($_POST['log_email'])."' ||  mobile = '".trim($_POST['log_email'])."') AND  password = '".$password."';";
	$result = mysqli_query($con,$query);
	$fetch_data = mysqli_query($con,$query);
	while($row = $fetch_data->fetch_assoc()){
		$id 		= $row['id'];
		$name 		= $row['name'];
		$email 		= $row['email'];
	}
	if(isset($id)){
		session_start(); 
		$_SESSION['user_id']= $id;
		$_SESSION['name']   = $name;
		$_SESSION['email']  = $email;
		echo 'success';
	} else {
		echo 'fail';
	}
}else if(isset($_GET['action']) && $_GET['action'] == 'getTourCost'){
	$func = new Functions();
	$data = $func->calculate_tour_cost($_GET['id'],$_GET['tour_type'], json_decode($_GET['rooms'], True));
	echo json_encode($data);
}elseif (isset($_POST['action']) && $_POST['action'] == 'create_booking') {
	try{
		
		$cost_data = $func->calculate_tour_cost($_POST['tour_id'],$_POST['tour_type'], $_POST['room_data']);

		$ticket = $func->generate_ticket();

		$query = "INSERT INTO ashtavinayak_bookings(ticket,tour_id,tour_date,tour_type,tour_pickup,tour_drop,seat_no,seat_data, room_data, cost_data, total_cost, contact_name, contact_phone, contact_email, contact_address, status , added_by, added_on) VALUE 
					('".$ticket."',".$_POST['tour_id'].",'".$_POST['tour_date']."','".$_POST['tour_type']."','".$_POST['pickup']."','".$_POST['drop']."','".$_POST['seat_no']."','".json_encode($_POST['seat_data'])."','".json_encode($_POST['room_data'])."','".json_encode($cost_data)."',".$cost_data['total_cost'].",'".$_POST['contact_name']."','".$_POST['phone']."','".$_POST['email']."','".$_POST['address']."','new',".$_POST['user_id'].",now())";

		mysqli_query($con,$query);
		$id = mysqli_insert_id($con);

		if(!empty($id)){
			session_start(); 
			$_SESSION['booking_id']  = $id;
			echo 'success';
		}else{
			echo 'fail';
		}
	}catch(Exception $e){
		echo 'fail';
	}	
}else if(isset($_GET['action']) && $_GET['action'] == 'home_search'){
	$term = $_GET['term'];

	if(strlen($term)>1){
		$query = "SELECT t.id,t.tour_code,t.tour_name  FROM `tours` as t  LEFT JOIN states as s ON s.id_state = t.tour_state LEFT JOIN regions as r ON r.id = t.tour_region  WHERE (t.tour_name LIKE '%$term%'  OR t.tour_code LIKE '%$term%' OR t.tour_places LIKE '%$term%' OR s.state  LIKE '%$term%'  OR r.name  LIKE '%$term%'  OR FIND_IN_SET((SELECT id FROM tour_categories WHERE name LIKE '%$term%' LIMIT 1), t.tour_categories) OR FIND_IN_SET((SELECT id FROM tour_subcategories WHERE name LIKE '%$term%' LIMIT 1), t.tour_subcategories)) AND t.active = 1";
		$result = mysqli_query($con,$query);
		$fetch_data = mysqli_query($con,$query);
		$records = False;

		while($row = $fetch_data->fetch_assoc()){
			$url = LIVEROOT."package-details.php?id=".$row["id"];
			echo "<p><a href='$url'>" . $row["tour_code"].' - '.$row["tour_name"] . "</a></p>";
			$records = True;
		}
		if(!$records){
			echo "<p>No Records Found</p>";
		}

	}
	
}

?>
