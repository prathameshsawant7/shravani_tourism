<?php
include_once("../../configs/defines.php");
include("../../configs/settings.php");
include("../../functions.php");

$est =new settings();
$con=$est->connection();

$request = isset($_POST['request'])?$_POST['request']:$_GET['request'];

if($request == 'delete_site_user'){
    $id         = $_POST['id'];
    $query      = "DELETE FROM users WHERE id = '".$id."'";
    mysqli_query($con,$query);  

    echo $id;
}elseif ($request == 'delete_admin_user'){
    $id         = $_POST['id'];
    $query      = "DELETE FROM admin_users WHERE id = '".$id."'";
    mysqli_query($con,$query);  

    echo $id;
}

?>