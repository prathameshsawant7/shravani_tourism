<?php
include_once("../../configs/defines.php");
include("../../configs/settings.php");
include("../../functions.php");

$est =new settings();
$con=$est->connection();
session_start();
$func = new Functions();

$request = isset($_POST['request'])?$_POST['request']:$_GET['request'];

if($request == 'add_enquiry'){
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
        echo "id=".$id;
    }else{
        echo "fail";
    }

}else if($request == 'update_enquiry'){
	$data = $_POST['data'];
    $id     = $data['id'];
    $status = $data['status'];
    $comment = $data['comment'];
    $user_id = $_SESSION['cID'];

    $query = "INSERT INTO enquiry_history (enquiry_id,status,comment,added_by,added_on) VALUES ('".$id."','".$status."','".$comment."','".$user_id."',now())";
    mysqli_query($con,$query);  


    $query = "UPDATE tour_enquiries SET status='".$status."' WHERE id=".$id;
    mysqli_query($con,$query);

    echo "success";
}
?>