<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Password Reset 
--> 
<?php

include("config/defines.php");
include("config/settings.php");
$est =new settings();
$con=$est->connection();

$iSeller_id  = $_POST['iSeller_id'];
$cPassword   = md5(_COOKIE_KEY_.$_POST['cPassword']);

$query  = "UPDATE js_seller SET cPassword = '".$cPassword."' WHERE iSeller_id = '".$iSeller_id."' ;";
mysqli_query($con,$query);

header('Location: index.php?completed=reset');

?>