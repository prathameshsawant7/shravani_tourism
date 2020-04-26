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
	$tour_desc = mysqli_escape_string($con,$_POST['tour_desc']);

	if(isset($_FILES['display_image']['name']) && $_FILES['display_image']['name']!=''){
		$displayImageFilename 	= explode(".", $_FILES["display_image"]["name"]);
		$displayImageextension 	= end($displayImageFilename);
		$imageNewName = 'display_image_'.$tour_code.".".$displayImageextension;
		$imageUploadStatus =true;
		if (file_exists("../../images/tours/" .$imageNewName)) {
    		unlink("../../images/tours/" .$imageNewName);
    	}
		if (!move_uploaded_file($_FILES["display_image"]["tmp_name"],"../../images/tours/" .$imageNewName)) {
			    $imageUploadStatus = false;
		}
		$query_display_image = ",display_image = '".$imageNewName."'";
		$display_image = $imageNewName;

	}else{
		$query_display_image = '';
	}
	$tour_region = mysqli_escape_string($con,$_POST['tour_region']);
	$tour_state = mysqli_escape_string($con,$_POST['tour_state']);
	$tour_places = mysqli_escape_string($con,$_POST['tour_places']);
	$tour_duration = mysqli_escape_string($con,$_POST['tour_duration']);
	$tour_price = mysqli_escape_string($con,$_POST['tour_price']);
	$itenerary= mysqli_escape_string($con,$_POST['itenerary']);
	#$itenerary_json = trim(mysqli_escape_string($con,$_POST['itenerary_json']));
	$rates_json = json_encode($_POST['rates']);
	$inclusive = mysqli_escape_string($con,$_POST['inclusive']);
	$exclusive = mysqli_escape_string($con,$_POST['exclusive']);
	$special_note = mysqli_escape_string($con,$_POST['special_note']);
	$active = mysqli_escape_string($con,$_POST['active']);
	
	//mysql_set_charset( $con, 'utf8');
	

	if($page_action == 'edit'){
		$query = "UPDATE tours SET tour_code='".$tour_code."',tour_name='".$tour_name."',tour_desc='".trim($tour_desc)."',tour_labels='".$tour_labels."'".$query_display_image.",tour_region='".$tour_region."',tour_state='".$tour_state."',tour_places='".$tour_places."',tour_duration='".$tour_duration."',tour_price='".$tour_price."',itenerary='".$itenerary."',rates_json='".$rates_json."',inclusive='".trim($inclusive)."',exclusive='".trim($exclusive)."',special_note='".trim($special_note)."',active='".$active."' WHERE id='".$id."'";

	}else{
		$query = "INSERT INTO tours (tour_code,tour_name,tour_desc,tour_labels,display_image,tour_region,tour_state,tour_places,tour_duration,tour_price,itenerary,rates_json,inclusive,exclusive,special_note,active) VALUES ('".$tour_code."','".$tour_name."','".$tour_desc."','".$tour_labels."','".$display_image."',".$tour_region.",".$tour_state.",'".$tour_places."','".$tour_duration."','".$tour_price."','".$itenerary."','".$rates_json."','".$inclusive."','".$exclusive."','".$special_note."',".$active.");";
	}
	//echo "<pre>".$query."</pre>";exit;
	//print($query);exit;
	
	mysqli_query($con,$query);
	$action = ($page_action == 'edit')?'&msg=update_success&action=edit':'';
	$id = ($id == '')? mysqli_insert_id($con):$id;

	$rates = $_POST['rates'];

	$tour_rates_query = '';
	foreach ($rates as $identifier => $values) {
		foreach ($values as $type => $rate) {
			if($rate != 0){
				$tour_rates_query .= "('".$id."','".$identifier."','".$type."',".$rate."),";

			}
		}
	}

	$query = "DELETE FROM tour_rates WHERE tour_id='".$id."'";
	mysqli_query($con,$query);

	$tour_rates_query = substr($tour_rates_query, 0, -1);

	$query = "INSERT INTO tour_rates (tour_id,identifier,hotel_type,rate) VALUES ".$tour_rates_query.";";
	mysqli_query($con,$query);

	header("Location:index.php");
	//header("Location:add_tour_rates.php?id=".$id.$action);

}else if(isset($_POST['data']) && $_POST['data'] == "readItenerary"){
	try{
		$tmpName = $_FILES['file']['tmp_name'];
		$itenerary_arr = array_map('str_getcsv', file($tmpName));
		$result = [];
		if($itenerary_arr[0][0] == 'Day'){
			for($i=1;$i<count($itenerary_arr);$i++){
				$result['Day '.$i] = [];
				$result['Day '.$i]['Title'] = $itenerary_arr[$i][1];
				$result['Day '.$i]['Description'] = $itenerary_arr[$i][2];
			}
			echo json_encode($result);
		}else{
			echo "invalid";
		}
	}catch (exception $e) {
		echo "invalid";
	}
	
}else if(isset($_POST['data']) && $_POST['data'] == "readRates"){
	try{
		$tmpName = $_FILES['file']['tmp_name'];
		$rates_arr = array_map('str_getcsv', file($tmpName));
		
		$result = [];
		if($rates_arr[0][0] == 'Tour Type'){
			for($i=1;$i<count($rates_arr);$i++){
				$result[$rates_arr[$i][0]] = [];
				for($j=1;$j<count($rates_arr[$i]);$j++){
					$result[$rates_arr[$i][0]][$rates_arr[0][$j]] = $rates_arr[$j][$i];
				}
			}
			echo json_encode($result);
		}else{
			echo "invalid";
		}
	}catch (exception $e) {
		echo "invalid";
	}
	
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
    $tour_type      = mysqli_escape_string($con,$_POST['tour_type']);
    $bus_no         = mysqli_escape_string($con,$_POST['bus_no']);
    $user_id        = $_SESSION['cID'];
    $page_action    = mysqli_escape_string($con,$_POST['page_action']);
    $seats = '';
	foreach ($_POST['seats'] as $key => $value) {
		$seats .=  ($seats == '')?$value : "|".$value;
	}

    if($page_action == 'edit'){
       $query = "UPDATE reserved_seats SET date='".$date."',tour_id='".$tour_id."',tour_type='".$tour_type."',bus_no='".$bus_no."',seats='".$seats."',updated_by=".$user_id." WHERE id=".$id;
    }else{
       $query = "INSERT INTO reserved_seats (date,tour_id,tour_type,bus_no,seats,added_by,updated_by) VALUES ('".$date."',".$tour_id.",'".$tour_type."','".$bus_no."','".$seats."',".$user_id.",".$user_id.");";
    }
    mysqli_query($con,$query);
    $action = ($page_action == 'edit')?'&msg=update_success&action=edit':'';
    $id = ($id == '')? mysqli_insert_id($con):$id;
    header("Location:add_reserved_seats.php?id=".$id.$action);
}else if(isset($_POST['data']) && $_POST['data'] == "import_bus_dates") {
	$filename=$_FILES["file"]["tmp_name"];
	$user_id = $_SESSION['cID'];
	$msg = "";
	if($_FILES["file"]["size"] > 0){
		$file = fopen($filename, "r");
		$counter = 0;
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
			if($counter != 0){
				$tour_id = $getData[0];
				$tour_type = $getData[1];
				$is_ashtavinayak = $getData[2];
				$date = $getData[3];
				$buses = $getData[4];
				$query      = "SELECT count(tour_id) AS count FROM bus_dates WHERE tour_id=$tour_id AND tour_type='$tour_type' AND is_ashtavinayak='$is_ashtavinayak' AND date='$date' AND buses='$buses';";
	            $fetch_data = mysqli_query($con,$query);echo "<BR>";
	            $records  = $fetch_data->fetch_assoc();
	            if($records['count']<1){
	            	$sql = "INSERT into bus_dates (tour_id,tour_type,is_ashtavinayak,date,buses,added_by) 
				   values (".$tour_id.",'".$tour_type."','".$is_ashtavinayak."','".$date."','".$buses."',".$user_id.")";
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
	header("Location:import_bus_dates.php?msg=".$msg); 
	}else if(isset($_POST['data']) && $_POST['data'] == "configurations") {
		$user_id = $_SESSION['cID'];
		$gst_no         = mysqli_escape_string($con,$_POST['gst_no']);
		$gst            = mysqli_escape_string($con,$_POST['gst']);
	    $service_charge	= mysqli_escape_string($con,$_POST['service_charge']);
	    $discount       = mysqli_escape_string($con,$_POST['discount']);

	    $query = "UPDATE configurations SET gst_no='".$gst_no."',gst=".$gst.",service_charge=".$service_charge.",discount=".$discount.",updated_by=".$user_id." WHERE id=1";
	    $result = mysqli_query($con, $query);
	    header("Location:configurations.php?msg=Updated successfully");
	}else if(isset($_POST['data']) && $_POST['data'] == "site_cms") {
		// $user_id = $_SESSION['cID'];
		// $gst_no         = mysqli_escape_string($con,$_POST['gst_no']);
		// $gst            = mysqli_escape_string($con,$_POST['gst']);
	 //    $service_charge	= mysqli_escape_string($con,$_POST['service_charge']);
	 //    $discount       = mysqli_escape_string($con,$_POST['discount']);

	 //    $query = "UPDATE configurations SET gst_no='".$gst_no."',gst=".$gst.",service_charge=".$service_charge.",discount=".$discount.",updated_by=".$user_id." WHERE id=1";
	 //    $result = mysqli_query($con, $query);
	 //    header("Location:configurations.php?msg=Updated successfully");
		$data = $_POST;
		foreach ($data as $key => $value) {
			if($key != 'data'){
				$query = "UPDATE site_cms SET content='".mysqli_escape_string($con,$value)."' WHERE name='".mysqli_escape_string($con,$key)."'";
				mysqli_query($con, $query);
			}
		}
		header("Location:site_cms.php?msg=Updated successfully");

	}
?>
