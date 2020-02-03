<?php   
session_start(); //to ensure you are using same session
$value = $_SESSION['cID'];
session_destroy(); //destroy the session
header("location:index.php"); //to redirect back to Admin "index.php" after logging out
exit;  
?>