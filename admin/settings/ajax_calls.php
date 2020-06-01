<?php
include_once("../../configs/defines.php");
include("../../configs/settings.php");
include("../../functions.php");
include("../../emailer.php");


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
}else if($request == 'delete_bus_dates'){
    $ids         = implode(",",$_POST['data']);
    $query      = "UPDATE bus_dates SET active=-1 WHERE id IN (".$ids.")";
    mysqli_query($con,$query);  

    echo 'success';
}else if($request == 'delete_group_tour_dates'){
    $ids         = implode(",",$_POST['data']);
    $query      = "UPDATE group_tour_dates SET active=-1 WHERE id IN (".$ids.")";
    mysqli_query($con,$query);  

    echo 'success';
}else if($request == 'deleteAshtavinayakPickup' || $request == 'deleteAshtavinayakDrop'){
    $id         = $_POST['id'];
    $query      = "DELETE FROM ashtavinayak_pickup_drop WHERE id = '".$id."'";
    mysqli_query($con,$query);  

    echo $id;
}else if($request == 'deleteCategory'){
    $id         = $_POST['id'];
    $query      = "DELETE FROM tour_categories WHERE id = '".$id."'";
    mysqli_query($con,$query);  

    echo $id;
}else if($request == 'deleteSubCategory'){
    $id         = $_POST['id'];
    $query      = "DELETE FROM tour_subcategories WHERE id = '".$id."'";
    mysqli_query($con,$query);  

    echo $id;
}else if($request == 'deleteReservedSeats'){
    $id         = $_POST['id'];
    $query      = "DELETE FROM reserved_seats WHERE id = '".$id."'";
    mysqli_query($con,$query);  

    echo $id;
}else if($request == 'getTourTypesByTourID'){
    //$id         = $_GET['id'];
    $query = "SELECT * FROM tour_type";
    $fetch_data = mysqli_query($con,$query);
    $data = [];$i=0;
    while($order_data = $fetch_data->fetch_assoc()){
        $data[$i] = $order_data;
        $i++;
    }
    echo json_encode($data);
}else if($request == 'getTourDatesByTourID'){
    $id         = $_GET['id'];
    $type       = $_GET['type'];
    $query = "SELECT date FROM bus_dates WHERE tour_id = ".$id." AND tour_type = '".$type."'   AND date_format(STR_TO_DATE(date, '%d/%m/%Y'), '%Y%m%d') > date_format(curdate(), '%Y%m%d')";
    $fetch_data = mysqli_query($con,$query);
    $data = [];$i=0;
    while($tour_data = $fetch_data->fetch_assoc()){
        $data[$i] = $tour_data;
        $i++;
    }
    echo json_encode($data);
}else if($request == 'getNonAvailableSeats'){
    $id           = $_GET['id'];
    $type         = $_GET['type'];
    $date         = $_GET['date'];
    $bus_no       = $_GET['bus_no'];
    $ticket       = $_GET['ticket']; 
    $func = new Functions();
    $data = $func->get_non_available_seats($id, $date, $type, $bus_no, $ticket);
    echo json_encode($data);
}else if($request == 'getSubcategories'){
    $categories  = $_GET['categories'];
    $query = "SELECT t.*,c.name as category_name FROM `tour_subcategories` as t  LEFT JOIN tour_categories as c ON c.id = t.category_id WHERE t.category_id IN (".$categories.");";
    $fetch_data = mysqli_query($con,$query);
    $data = [];$i=0;
    while($tour_data = $fetch_data->fetch_assoc()){
        $data[$i] = $tour_data;
        $i++;
    }
    echo json_encode($data);

}else if($request == 'update_booking'){
    try{
        $data = $_POST['data'];
        $query = "INSERT INTO ashtavinayak_bookings  (ticket,tour_id,tour_date,tour_type,tour_pickup,tour_drop,bus_no,seat_no,seat_data,room_data,cost_data,total_cost,contact_name,contact_phone,contact_email,contact_address,status,added_by,added_on,updated_by,updated_on,active) 
    SELECT  ticket,tour_id,tour_date,tour_type,tour_pickup,tour_drop,bus_no,seat_no,seat_data,room_data,cost_data,total_cost,contact_name,contact_phone,contact_email,contact_address,status,added_by,added_on,updated_by,updated_on,active 
    FROM ashtavinayak_bookings WHERE id = ".$data['id'].";";
        mysqli_query($con,$query);
        $new_id = mysqli_insert_id($con);

        $query = "UPDATE ashtavinayak_bookings SET active = -1 WHERE id = ".$data['id'].";";
        mysqli_query($con,$query);

        $update_cost_fields = '';
        if($data['update_cost'] == 'y'){
            $cost_data = [];
            $cost_data['cost']              = $data['cost'];
            $cost_data['service_charge']    = $data['service_charge'];
            $cost_data['discount']          = $data['discount'];
            $cost_data['gst_percent']       = $data['gst_percent'];
            $cost_data['gst']               = $data['gst'];
            $cost_data['total_cost']        = $data['total_cost'];

            $update_cost_fields = ", cost_data = '".json_encode($cost_data)."', total_cost = '".$data['total_cost']."'";
        }

        $query = "UPDATE ashtavinayak_bookings SET ticket = '".$data['ticket']."', tour_id = '".$data['tour_id']."', tour_date = '".$data['tour_date']."', tour_type = '".$data['tour_type']."', tour_pickup = '".$data['pickup_point']."', tour_drop = '".$data['drop_point']."', bus_no = '".$data['bus_no']."', seat_no = '".$data['seat_no']."', seat_data = '".json_encode($data['seat_data'])."', room_data = '".json_encode($data['room_data'])."', contact_name = '".$data['contact_name']."', contact_phone = '".$data['contact_phone']."', contact_email = '".$data['contact_email']."', contact_address = '".$data['contact_address']."',status = '".$data['status']."', updated_by = '".$data['updated_by']."', updated_on = now()".$update_cost_fields." WHERE id = ".$new_id.";";
        mysqli_query($con,$query);

        if($data['notify'] == 'y'){
            $email_data = array("ticket"=>$data['ticket'], "name"=>$data['contact_name'], "booking"=>"update");
            $emailer = new Emailer($con, "booking_confirmation" , array($data['contact_email']), $email_data);
            $emailer->generate();
        }
        

        echo "success";
    }catch(Exception $e){
        echo 'fail';
    }
}else if($request == 'add_booking'){
    try{
        $data = $_POST['data'];
        $func = new Functions();
        if($data['update_cost'] == 'y'){
            $cost_data = [];
            $cost_data['cost']              = $data['cost'];
            $cost_data['service_charge']    = $data['service_charge'];
            $cost_data['discount']          = $data['discount'];
            $cost_data['gst_percent']       = $data['gst_percent'];
            $cost_data['gst']               = $data['gst'];
            $cost_data['total_cost']        = $data['total_cost'];
        }else{
           $cost_data = $func->calculate_tour_cost($data['tour_id'],$data['tour_type'], $data['room_data']); 
        }     

        $ticket = $func->generate_ticket();

        $query = "INSERT INTO ashtavinayak_bookings(ticket,tour_id,tour_date,tour_type,tour_pickup,tour_drop,seat_no,seat_data, room_data, cost_data, total_cost, contact_name, contact_phone, contact_email, contact_address, status , updated_by, updated_on) VALUE 
                    ('".$ticket."',".$data['tour_id'].",'".$data['tour_date']."','".$data['tour_type']."','".$data['pickup_point']."','".$data['drop_point']."','".$data['seat_no']."','".json_encode($data['seat_data'])."','".json_encode($data['room_data'])."','".json_encode($cost_data)."',".$cost_data['total_cost'].",'".$data['contact_name']."','".$data['contact_phone']."','".$data['contact_email']."','".$data['contact_address']."','confirmed',".$data['updated_by'].",now())";
        mysqli_query($con,$query);

        if($data['notify'] == 'y'){
            $email_data = array("ticket"=>$ticket, "name"=>$data['contact_name'], "booking"=>"new");
            $emailer = new Emailer($con, "booking_confirmation" , array($data['contact_email']), $email_data);
            $emailer->generate();
        }

        $id = mysqli_insert_id($con);
        echo "success";
    }catch(Exception $e){
        echo 'fail';
    }
}

?>
