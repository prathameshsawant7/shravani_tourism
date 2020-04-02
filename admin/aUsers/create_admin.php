<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Store Registrations
*/ 
include("../../configs/defines.php");
include("../../configs/settings.php");
$est =new settings();
$con=$est->connection();


$page_action                 = mysqli_real_escape_string($con,$_POST['page_action']);
$cName                       = mysqli_real_escape_string($con,$_POST['cName']);
$cEmail                      = mysqli_real_escape_string($con,$_POST['cEmail']);
$cPassword                   = mysqli_real_escape_string($con,$_POST['cPassword']);
$password                    = md5(_COOKIE_KEY_.$cPassword);

if(!empty($_POST['isAdmin']) && mysqli_real_escape_string($con,$_POST['isAdmin']) == 'on'){
	$isAdmin = 1;
}else{
    $isAdmin = 0;
}

if($page_action == ''){

	$query = "INSERT INTO admin_users (name,email,password,isAdmin) "
	        . "VALUES ('$cName','$cEmail','$password',$isAdmin)";

	mysqli_query($con,$query);
	$admin_id = mysqli_insert_id($con); 

}else if($page_action == 'edit'){
	$id = mysqli_real_escape_string($con,$_POST['id']);
	$update_pass = ($cPassword != '')?',password='.$password:'';
	echo $query = "UPDATE admin_users SET name = '$cName' , email = '$cEmail' , isAdmin = $isAdmin $update_pass WHERE id = '$id';";
	mysqli_query($con,$query);
}
header('Location: ../aUsers/index.php');



?>