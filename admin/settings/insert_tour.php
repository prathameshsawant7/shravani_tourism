<?php 
include_once("../../configs/defines.php");
include("../../configs/settings.php");
$est =new settings();
$con=$est->connection();
session_start();

if(isset($_POST['data']) && $_POST['data'] == "region") {
	$id				= mysqli_escape_string($con,$_POST['id']);
	$name 			= mysqli_escape_string($con,$_POST['name']);
	$active 		= mysqli_escape_string($con,$_POST['active']);
	$page_action	= mysqli_escape_string($con,$_POST['page_action']);

	if($page_action == 'edit'){
		$query = "UPDATE regions SET name='".$name."',active=".$active." WHERE id=".$id;
	}else{
		$query = "INSERT INTO regions (name,active) VALUES ('".$name."','".$active."');";
	}
	mysqli_query($con,$query);
	//print($data);exit;
	$action = ($page_action == 'edit')?'&action=edit':'';
	$id = ($id == '')? mysqli_insert_id($con):$id;
	header("Location:add_region.php?id=".$id.$action);
}else if(isset($_POST['data']) && $_POST['data'] == "state") {
	$id_state		= mysqli_escape_string($con,$_POST['id_state']);
	$state 			= mysqli_escape_string($con,$_POST['state']);
	$active 		= mysqli_escape_string($con,$_POST['active']);
	$page_action	= mysqli_escape_string($con,$_POST['page_action']);

	if($page_action == 'edit'){
		$query = "UPDATE states SET state='".$state."',active=".$active." WHERE id_state=".$id_state;
	}else{
		$query = "INSERT INTO states (state,active) VALUES ('".$state."','".$active."');";
	}
	mysqli_query($con,$query);
	//print($data);exit;
	$action = ($page_action == 'edit')?'&action=edit':'';
	$id_state = ($id_state == '')? mysqli_insert_id($con):$id_state;
	header("Location:add_state.php?id=".$id_state.$action);
}else if(isset($_POST['data']) && $_POST['data'] == "tour"){
	$page_action = mysqli_escape_string($con,$_POST['page_action']);
	$id = mysqli_escape_string($con,$_POST['id']);
	$tour_code = mysqli_escape_string($con,$_POST['tour_code']);
	$tour_labels = implode(',', $_POST['tour_labels']);
	$tour_name = mysqli_escape_string($con,$_POST['tour_name']);
	print_r($_FILES);
	if(isset($_FILES['display_image']['name'])){
		$displayImageFilename 	= explode(".", $_FILES["display_image"]["name"]);
		$displayImageextension 	= end($displayImageFilename);
		$imageNewName = 'display_image_'.$tour_code.".".$displayImageextension;
		$imageUploadStatus =true;
		echo "exi-".file_exists("../../images/tours/" .$imageNewName);
		if (file_exists("../../images/tours/" .$imageNewName)) {
    		unlink("../../images/tours/" .$imageNewName);
    		echo "In";
    	}
		if (!move_uploaded_file($_FILES["display_image"]["tmp_name"],"../../images/tours/" .$imageNewName)) {
			    $imageUploadStatus = false;echo "In1";
		}
		$display_image = $imageNewName;
	}else{
		$display_image = '';
	}
	echo $display_image;
	$tour_region = mysqli_escape_string($con,$_POST['tour_region']);
	$tour_state = mysqli_escape_string($con,$_POST['tour_state']);
	$tour_places = mysqli_escape_string($con,$_POST['tour_places']);
	$tour_duration = mysqli_escape_string($con,$_POST['tour_duration']);
	$itenerary_json = mysqli_escape_string($con,$_POST['itenerary_json']);
	$rates_json = mysqli_escape_string($con,$_POST['rates_json']);
	$inclusive = mysqli_escape_string($con,$_POST['inclusive']);
	$exclusive = mysqli_escape_string($con,$_POST['exclusive']);
	$special_note = mysqli_escape_string($con,$_POST['special_note']);
	$active = mysqli_escape_string($con,$_POST['active']);
	

	if($page_action == 'edit'){
		$query = "UPDATE tours SET tour_code='".$tour_code."',tour_name='".$tour_name."',tour_labels='".$tour_labels."',display_image='".$display_image."',tour_region=".$tour_region.",tour_state=".$tour_state.",tour_places='".$tour_places."',tour_duration='".$tour_duration."',itenerary_json='".$itenerary_json."',rates_json='".$rates_json."',inclusive='".$inclusive."',exclusive='".$exclusive."',special_note='".$special_note."',active=".$active." WHERE id=".$id;
	}else{
		$query = "INSERT INTO tours (tour_code,tour_name,tour_labels,display_image,tour_region,tour_state,tour_places,tour_duration,itenerary_json,rates_json,inclusive,exclusive,special_note,active) VALUES ('".$tour_code."','".$tour_name."','".$tour_labels."','".$display_image."',".$tour_region.",".$tour_state.",'".$tour_places."','".$tour_duration."','".$itenerary_json."','".$rates_json."','".$inclusive."','".$exclusive."','".$special_note."',".$active.");";
	}
	//echo "<pre>".$query."</pre>";exit;
	//print($query);exit;
	mysqli_query($con,$query);
	$action = ($page_action == 'edit')?'&msg=update_success&action=edit':'';
	$id = ($id == '')? mysqli_insert_id($con):$id;
	header("Location:add_tour.php?id=".$id.$action);
	//header("Location:add_tour_rates.php?id=".$id.$action);

}else if(isset($_POST['data']) && $_POST['data'] == "tour_rates"){

	$id_tour 						= mysqli_escape_string($con,$_POST['id_tour']);
	$count							= mysqli_escape_string($con,$_POST['count']);
	$page_action					= mysqli_escape_string($con,$_POST['page_action']);
	$queryRecords					= '';

	if($page_action == 'edit'){
		$query 	= "DELETE FROM tour_rates WHERE id_tour='".$id_tour."'";
		mysqli_query($con,$query);
	}

	for($i=1;$i<=$count;$i++) {
		$hotel_category	= mysqli_escape_string($con,$_POST['hotel_category_'.$i]);
		$rate_1 = empty($_POST['rate1_'.$i]) ? 0:mysqli_escape_string($con,$_POST['rate1_'.$i]);
		$rate_2 = empty($_POST['rate2_'.$i]) ? 0:mysqli_escape_string($con,$_POST['rate2_'.$i]);
		$rate_3 = empty($_POST['rate3_'.$i]) ? 0:mysqli_escape_string($con,$_POST['rate3_'.$i]);
		$rate_4 = empty($_POST['rate4_'.$i]) ? 0:mysqli_escape_string($con,$_POST['rate4_'.$i]);
		
	//	print_r($_SESSION);
		$values = "('".$id_tour."','".$hotel_category."',".$rate_1.",".$rate_2.",".$rate_3.",".$rate_4.",".$_SESSION['cID'].",".$_SESSION['cID'].")";
		$queryRecords .= $queryRecords == '' ? $values:",".$values;
	}
	$query = "INSERT INTO tour_rates(id_tour, hotel_category, rate_1, rate_2, rate_3, rate_4, added_by, updated_by) VALUES ".$queryRecords.";";
	mysqli_query($con,$query);

	$id = $_POST['id'];
	$action = ($page_action == 'edit')?'&msg=update_success&action=edit':'';
	header("Location:add_tour_details.php?id=".$id.$action);
}else if(isset($_POST['data']) && $_POST['data'] == "ashtavinayak_pickup") {
    $id             = mysqli_escape_string($con,$_POST['id']);
    $type           = 'pickup';
    $point          = mysqli_escape_string($con,$_POST['point']);
    $user_id        = $_SESSION['cID'];
    $page_action    = mysqli_escape_string($con,$_POST['page_action']);

    if($page_action == 'edit'){
       echo  $query = "UPDATE ashtavinayak_pickup_drop SET type='".$type."',point='".$point."',updated_by=".$user_id." WHERE id=".$id;//exit;
    }else{
        $query = "INSERT INTO ashtavinayak_pickup_drop (type,point,added_by,updated_by) VALUES ('".$type."','".$point."','".$user_id."','".$user_id."');";
    }
    mysqli_query($con,$query);
	$action = ($page_action == 'edit')?'&msg=update_success&action=edit':'';
    $id = ($id == '')? mysqli_insert_id($con):$id;
    header("Location:add_ashtavinayak_pickup.php?id=".$id.$action);
}else if(isset($_POST['data']) && $_POST['data'] == "ashtavinayak_drop") {
    $id             = mysqli_escape_string($con,$_POST['id']);
    $type           = 'drop';
    $point          = mysqli_escape_string($con,$_POST['point']);
    $user_id        = $_SESSION['cID'];
    $page_action    = mysqli_escape_string($con,$_POST['page_action']);

    if($page_action == 'edit'){
       $query = "UPDATE ashtavinayak_pickup_drop SET type='".$type."',point='".$point."',updated_by=".$user_id." WHERE id=".$id;//exit;
    }else{
        $query = "INSERT INTO ashtavinayak_pickup_drop (type,point,added_by,updated_by) VALUES ('".$type."','".$point."','".$user_id."','".$user_id."');";
    }
    mysqli_query($con,$query);
	$action = ($page_action == 'edit')?'&msg=update_success&action=edit':'';
    $id = ($id == '')? mysqli_insert_id($con):$id;
    header("Location:add_ashtavinayak_drop.php?id=".$id.$action);
}else if(isset($_POST['data']) && $_POST['data'] == "reserved_seats") {
    $id             = mysqli_escape_string($con,$_POST['id']);
    $date          	= mysqli_escape_string($con,$_POST['date']);
    $tour_id        = mysqli_escape_string($con,$_POST['tour_id']);
    $bus_id         = mysqli_escape_string($con,$_POST['bus']);
    $user_id        = $_SESSION['cID'];
    $page_action    = mysqli_escape_string($con,$_POST['page_action']);
    $seats = '';
	foreach ($_POST['seats'] as $key => $value) {
		$seats .=  ($seats == '')?$value : "|".$value;
	}

    if($page_action == 'edit'){
       $query = "UPDATE reserved_seats SET date='".$date."',tour_id='".$tour_id."',bus_id='".$bus_id."',seats='".$seats."',updated_by=".$user_id." WHERE id=".$id;
    }else{
       $query = "INSERT INTO reserved_seats (date,tour_id,bus_id,seats,added_by,updated_by) VALUES ('".$date."',".$tour_id.",".$bus_id.",'".$seats."',".$user_id.",".$user_id.");";
    }
    mysqli_query($con,$query);
    $action = ($page_action == 'edit')?'&msg=update_success&action=edit':'';
    $id = ($id == '')? mysqli_insert_id($con):$id;
    header("Location:add_reserved_seats.php?id=".$id.$action);
}else if(isset($_POST['data']) && $_POST['data'] == "export_bus_dates") {
	$filename=$_FILES["file"]["tmp_name"];
	$user_id = $_SESSION['cID'];
	$msg = "";
	if($_FILES["file"]["size"] > 0){
		$file = fopen($filename, "r");
		$counter = 0;
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
			if($counter != 0){
				$tour_id = $getData[0];
				$bus_id = $getData[1];
				$is_ashtavinayak = $getData[2];
				$date = $getData[3];
				$query      = "SELECT count(tour_id) AS count FROM bus_dates WHERE tour_id=$tour_id AND bus_id=$bus_id AND is_ashtavinayak='$is_ashtavinayak' AND date='$date';";
	            $fetch_data = mysqli_query($con,$query);echo "<BR>";
	            $records  = $fetch_data->fetch_assoc();
	            if($records['count']<1){
	            	$sql = "INSERT into bus_dates (tour_id,bus_id,is_ashtavinayak,date,added_by) 
				   values (".$tour_id.",".$bus_id.",'".$is_ashtavinayak."','".$date."',".$user_id.")";
					$result = mysqli_query($con, $sql);
					if(!isset($result)){
					    $msg = "Invalid File:Please Upload CSV File.";    
					}
	            }
	        }
	        $counter++;
		}

		   fclose($file);  
	}else{
		$msg = "Invalid File:Please Upload CSV File.";
	} 

	if($msg == ''){
		$msg = "Bus dates has been successfully Imported.";
	}
	header("Location:export_bus_dates.php?msg=".$msg); 
}
?>