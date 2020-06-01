<?php

include_once("configs/defines.php");
include("configs/settings.php");
$est =new settings();
$con=$est->connection();
session_start();

$query      = "SELECT * FROM site_cms;";
$fetch_data = mysqli_query($con,$query);
while($fields  = $fetch_data->fetch_assoc()) {
    $site_cms[$fields['name']] = $fields['content'];
} 

$query      = "SELECT * FROM site_content;";
$fetch_data = mysqli_query($con,$query);
while($fields  = $fetch_data->fetch_assoc()) {
    $site_content[$fields['content_name']] = $fields['content_ids'];
}

$query      = "SELECT * FROM site_images WHERE id=1;";
$fetch_data = mysqli_query($con,$query);
$site_images  = $fetch_data->fetch_assoc();
#print_r($site_images);

$query = "SELECT state FROM states WHERE id_state IN (SELECT DISTINCT tour_state FROM tours WHERE active=1);";
$place_to_travel_data = mysqli_query($con,$query);

?>