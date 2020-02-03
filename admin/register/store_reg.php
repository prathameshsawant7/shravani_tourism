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

$cName                       = mysqli_real_escape_string($con,$_POST['cName']);
$cEmail                      = mysqli_real_escape_string($con,$_POST['cEmail']);
$cPassword                   = mysqli_real_escape_string($con,$_POST['cPassword']);
$password                    = md5(_COOKIE_KEY_.$cPassword);

if(!empty($_POST['isAdmin']) && mysqli_real_escape_string($con,$_POST['isAdmin']) == 'on'){
    $isAdmin = 1;
}else{
    $isAdmin = 0;
}

//  print_r($_POST);

$query = "INSERT INTO admin_users (name,email,password,isAdmin) "
        . "VALUES ('$cName','$cEmail','$password',$isAdmin)";

//echo $query."<BR>";exit;
mysqli_query($con,$query);
$admin_id = mysqli_insert_id($con); 


// exit;
 //chmod("img/seller_documents/".$pan_link, 777);
 
// session_start(); 
// $_SESSION['cAdminID']              = $admin_id;
// $_SESSION['cAdminName']            = $cName;
// $_SESSION['isAdmin']               = $isAdmin;

//echo "hi1";exit; 
header('Location: ../index.php?completed=registration');

?>