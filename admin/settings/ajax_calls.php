<?php
include_once("../../configs/defines.php");
include("../../configs/settings.php");
$est =new settings();
$con=$est->connection();

$request = isset($_POST['request'])?$_POST['request']:$_GET['request'];

if($request == 'deleteRegion'){
    $id         = $_POST['id'];
    $query      = "DELETE FROM regions WHERE id = '".$id."'";
    mysqli_query($con,$query);  

    echo $id;
}else if($request == 'deleteTour'){
    $id         = $_POST['id'];
    $query      = "DELETE FROM tours WHERE id = '".$id."'";
    mysqli_query($con,$query);  

    echo $id;
}else if($request == 'deleteAshtavinayakPickup' || $request == 'deleteAshtavinayakDrop'){
    $id         = $_POST['id'];
    $query      = "DELETE FROM ashtavinayak_pickup_drop WHERE id = '".$id."'";
    mysqli_query($con,$query);  

    echo $id;
}else if($request == 'deleteReservedSeats'){
    $id         = $_POST['id'];
    $query      = "DELETE FROM reserved_seats WHERE id = '".$id."'";
    mysqli_query($con,$query);  

    echo $id;
}else if($request == 'getBusesByTourID'){
    $id         = $_GET['id'];
    $query = "SELECT * FROM buses WHERE tour_id = ".$id;
    $fetch_data = mysqli_query($con,$query);
    $data = [];$i=0;
    while($order_data = $fetch_data->fetch_assoc()){
        $data[$i] = $order_data;
        $i++;
    }
    echo json_encode($data);
}

?>