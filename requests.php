<?php 
include_once("configs/defines.php");
include("configs/settings.php");
include("functions.php");
$est =new settings();
$con=$est->connection();
if(isset($_POST['action']) && $_POST['action'] == 'register') {
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
	$data = $func->calculate_tour_cost($_GET['id'],$_GET['hotel_type'], json_decode($_GET['rooms'], True));
	echo json_encode($data);
}

?>