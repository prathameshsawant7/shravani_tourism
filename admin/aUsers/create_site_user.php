<?php

include("../../configs/defines.php");
include("../../configs/settings.php");
$est =new settings();
$con=$est->connection();

$page_action                 = mysqli_real_escape_string($con,$_POST['page_action']);
$cName                       = mysqli_real_escape_string($con,$_POST['sName']);
$cEmail                      = mysqli_real_escape_string($con,$_POST['sEmail']);
$cMobile                     = mysqli_real_escape_string($con,$_POST['sMobile']);
$cPassword                   = mysqli_real_escape_string($con,$_POST['sPassword']);
$password                    = md5(_COOKIE_KEY_.$cPassword);

if($page_action == ''){
	$query = "INSERT INTO users (name,email,mobile,password) "
	        . "VALUES ('$cName','$cEmail','$cMobile','$password')";

	mysqli_query($con,$query);
	$admin_id = mysqli_insert_id($con); 
}else if($page_action == 'edit'){
	$id = mysqli_real_escape_string($con,$_POST['id']);
	$update_pass = ($cPassword != '')?',password='.$password:'';
	$query = "UPDATE users SET name = '$cName' , email = '$cEmail' , mobile = $cMobile $update_pass WHERE id = '$id';";
	mysqli_query($con,$query);
}	


header('Location: ../aUsers/site_index.php');

?>