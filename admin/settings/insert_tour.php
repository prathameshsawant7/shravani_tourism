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
	$id_state		= mysqli_escape_string($con,$_POST['id']);
	$state 			= mysqli_escape_string($con,$_POST['state']);
	$active 		= mysqli_escape_string($con,$_POST['active']);
	$page_action	= mysqli_escape_string($con,$_POST['page_action']);

	if(isset($_FILES['cover_image']['name']) && $_FILES['cover_image']['name']!=''){
		$displayImageFilename 	= explode(".", $_FILES["cover_image"]["name"]);
		$displayImageextension 	= end($displayImageFilename);
		$imageNewName = 'cover_image_'.$id_state;
		$imageNewName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $imageNewName).".".$displayImageextension;

		$imageUploadStatus =true;
		if (file_exists("../../images/tours/" .$imageNewName)) {
    		unlink("../../images/tours/" .$imageNewName);
    	}
		if (!move_uploaded_file($_FILES["cover_image"]["tmp_name"],"../../images/tours/" .$imageNewName)){
			    $imageUploadStatus = false;
		}
		$query_display_image = ",cover_image = '".$imageNewName."'";
		$display_image = $imageNewName;

	}else{
		$query_display_image = '';
	}

	if($page_action == 'edit'){
		echo $query = "UPDATE states SET state='".$state."',active=".$active."  ".$query_display_image." WHERE id_state=".$id_state;
	}else{
		$query = "INSERT INTO states (state,cover_image,active) VALUES ('".$state."','".$imageNewName."','".$active."');";
	}
	mysqli_query($con,$query);
	//print($data);exit;
	$action = ($page_action == 'edit')?'&action=edit':'';
	$id_state = ($id_state == '')? mysqli_insert_id($con):$id_state;
	header("Location:add_state.php?id_state=".$id_state.$action);
}else if(isset($_POST['data']) && $_POST['data'] == "tour"){
	$page_action = mysqli_escape_string($con,$_POST['page_action']);
	$id = mysqli_escape_string($con,$_POST['id']);
	$tour_code = mysqli_escape_string($con,$_POST['tour_code']);
	$tour_categories = implode(',', $_POST['tour_categories']);
	$tour_subcategories = implode(',', $_POST['tour_subcategories']);
	$tour_name = mysqli_escape_string($con,$_POST['tour_name']);
	$tour_desc = mysqli_escape_string($con,$_POST['tour_desc']);

	if(isset($_FILES['display_image']['name']) && $_FILES['display_image']['name']!=''){
		$displayImageFilename 	= explode(".", $_FILES["display_image"]["name"]);
		$displayImageextension 	= end($displayImageFilename);
		$imageNewName = 'display_image_'.$tour_code.".".$displayImageextension;
		$imageNewName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $imageNewName);

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
	
	print_r($rates_json);

	if($page_action == 'edit'){
		$query = "UPDATE tours SET tour_code='".$tour_code."',tour_name='".$tour_name."',tour_desc='".trim($tour_desc)."',tour_categories='".$tour_categories."',tour_subcategories='".$tour_subcategories."'".$query_display_image.",tour_region='".$tour_region."',tour_state='".$tour_state."',tour_places='".$tour_places."',tour_duration='".$tour_duration."',tour_price='".$tour_price."',itenerary='".$itenerary."',rates_json='".$rates_json."',inclusive='".trim($inclusive)."',exclusive='".trim($exclusive)."',special_note='".trim($special_note)."',active='".$active."' WHERE id='".$id."'";

	}else{
		$query = "INSERT INTO tours (tour_code,tour_name,tour_desc,tour_categories,tour_subcategories,display_image,tour_region,tour_state,tour_places,tour_duration,tour_price,itenerary,rates_json,inclusive,exclusive,special_note,active) VALUES ('".$tour_code."','".$tour_name."','".$tour_desc."','".$tour_categories."','".$tour_subcategories."','".$display_image."',".$tour_region.",".$tour_state.",'".$tour_places."','".$tour_duration."','".$tour_price."','".$itenerary."','".$rates_json."','".$inclusive."','".$exclusive."','".$special_note."',".$active.");";
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
}else if(isset($_POST['data']) && $_POST['data'] == "categories") {
    $id             = mysqli_escape_string($con,$_POST['id']);
    $name          = mysqli_escape_string($con,$_POST['name']);
    $user_id        = $_SESSION['cID'];
    $page_action    = mysqli_escape_string($con,$_POST['page_action']);
    if(isset($_FILES['cover_image']['name']) && $_FILES['cover_image']['name']!=''){
		$displayImageFilename 	= explode(".", $_FILES["cover_image"]["name"]);
		$displayImageextension 	= end($displayImageFilename);
		$imageNewName = 'cat_cover_image_'.$name.".".$displayImageextension;
		$imageNewName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $imageNewName);

		$imageUploadStatus =true;
		if (file_exists("../../images/tours/" .$imageNewName)) {
    		unlink("../../images/tours/" .$imageNewName);
    	}
		if (!move_uploaded_file($_FILES["cover_image"]["tmp_name"],"../../images/tours/" .$imageNewName)){
			    $imageUploadStatus = false;
		}
		$query_display_image = ",cover_image = '".$imageNewName."'";
		$display_image = $imageNewName;

	}else{
		$query_display_image = '';
	}

    if($page_action == 'edit'){
       $query = "UPDATE tour_categories SET name='".$name."' ".$query_display_image." WHERE id=".$id;
    }else{
        $query = "INSERT INTO tour_categories (name,cover_image,added_by) VALUES ('".$name."','".$imageNewName."','".$user_id."');";
    }
    mysqli_query($con,$query);
	$action = ($page_action == 'edit')?'&msg=update_success&action=edit':'';
    $id = ($id == '')? mysqli_insert_id($con):$id;
    header("Location:add_categories.php?id=".$id.$action);
}else if(isset($_POST['data']) && $_POST['data'] == "subcategories") {
    $id             = mysqli_escape_string($con,$_POST['id']);
    $category_id    = mysqli_escape_string($con,$_POST['category_id']);
    $name           = mysqli_escape_string($con,$_POST['name']);
    $user_id        = $_SESSION['cID'];
    $page_action    = mysqli_escape_string($con,$_POST['page_action']);
    if(isset($_FILES['display_image']['name']) && $_FILES['display_image']['name']!=''){
		$displayImageFilename 	= explode(".", $_FILES["display_image"]["name"]);
		$displayImageextension 	= end($displayImageFilename);
		$imageNewName = 'sub_cat_display_image_'.$category_id."_".$name;
		$imageNewName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $imageNewName).".".$displayImageextension;

		$imageUploadStatus =true;
		if (file_exists("../../images/tours/" .$imageNewName)) {
    		unlink("../../images/tours/" .$imageNewName);
    	}
		if (!move_uploaded_file($_FILES["display_image"]["tmp_name"],"../../images/tours/" .$imageNewName)){
			    $imageUploadStatus = false;
		}
		$query_display_image = ",display_image = '".$imageNewName."'";
		$display_image = $imageNewName;

	}else{
		$query_display_image = '';
	}


    if($page_action == 'edit'){
       $query = "UPDATE tour_subcategories SET category_id=".$category_id.",name='".$name."' ".$query_display_image." WHERE id=".$id;
    }else{
       $query = "INSERT INTO tour_subcategories (category_id,name,display_image,added_by) VALUES (".$category_id.",'".$name."','".$imageNewName."','".$user_id."');";
    }
    mysqli_query($con,$query);
	$action = ($page_action == 'edit')?'&msg=update_success&action=edit':'';
    $id = ($id == '')? mysqli_insert_id($con):$id;
    header("Location:add_subcategories.php?id=".$id.$action);
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
				$query      = "SELECT count(tour_id) AS count FROM bus_dates WHERE tour_id=$tour_id AND tour_type='$tour_type' AND is_ashtavinayak='$is_ashtavinayak' AND date='$date' AND buses='$buses' AND active=1;";
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
}else if(isset($_POST['data']) && $_POST['data'] == "import_group_tour_dates") {
	$filename=$_FILES["file"]["tmp_name"];
	$user_id = $_SESSION['cID'];
	$msg = "";
	if($_FILES["file"]["size"] > 0){
		$file = fopen($filename, "r");
		$counter = 0;
		while (($getData = fgetcsv($file, 10000, ",")) !== FALSE){
			if($counter != 0){
				$tour_id = $getData[0];
				$date = $getData[1];
				$query      = "SELECT count(tour_id) AS count FROM group_tour_dates WHERE tour_id=$tour_id AND date='$date' AND active=1;";
	            $fetch_data = mysqli_query($con,$query);
	            $records  = $fetch_data->fetch_assoc();
	            if($records['count']<1){
	            	$sql = "INSERT into group_tour_dates (tour_id,date,added_by) 
				   values (".$tour_id.",'".$date."',".$user_id.")";
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
	header("Location:import_group_tour_dates.php?msg=".$msg); 
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
		$data = $_POST;
		foreach ($data as $key => $value) {
			if($key != 'data'){
				$query = "UPDATE site_cms SET content='".mysqli_escape_string($con,$value)."' WHERE name='".mysqli_escape_string($con,$key)."'";
				mysqli_query($con, $query);
			}
		}
		header("Location:site_cms.php?msg=Updated successfully");

	}
	else if(isset($_POST['data']) && $_POST['data'] == "site_images") {
		$data = $_POST;
		//echo "<pre>";print_r($data);echo "</pre>";
		//echo "<pre>";print_r($_FILES);echo "</pre>";
		$query = "SELECT * FROM site_images WHERE id=1;";
        $fetch_data = mysqli_query($con,$query);
        $db_data  = $fetch_data->fetch_assoc();
		//echo "<pre>";print_r($db_data);echo "</pre>";
		$update_param = '';
		$deleted_slider_images = array('homepage_slider' => [], 'family_tour_slider' => []);
		foreach ($data['homepage_slider_delete'] as $key => $value) {
			array_push($deleted_slider_images['homepage_slider'], $key);	
		}

		foreach ($data['family_tour_slider_delete'] as $key => $value) {
			array_push($deleted_slider_images['family_tour_slider'], $key);	
		}

		foreach ($_FILES as $key => $data) {
			if($key == 'homepage_slider' || $key == 'family_tour_slider'){
				$image_list = [];
				foreach (json_decode($db_data[$key],true) as $k => $v) {
					if(!in_array($v, $deleted_slider_images[$key])){
						array_push($image_list,$v);
					}else{
						if (file_exists("../../images/tours/" .$v)) {
				    		unlink("../../images/tours/" .$v);
				    	}
					}
				}
				foreach ($data['name'] as $num => $name) {
					if($name != ''){
						$image_name 	= explode(".", $_FILES[$key]["name"][$num]);
						$image_extension 	= end($image_name);
						$image_new_name = $key."_".microtime();
						$image_new_name = preg_replace('/[^A-Za-z0-9_\-]/', '_', $image_new_name).".".$image_extension;

						$image_upload_status =true;
						if (file_exists("../../images/tours/" .$image_new_name)) {
				    		unlink("../../images/tours/" .$image_new_name);
				    	}
						if (!move_uploaded_file($_FILES[$key]["tmp_name"][$num],"../../images/tours/" .$image_new_name)){
							    $image_upload_status = false;
						}
						if($image_upload_status){
							array_push($image_list,$image_new_name);
						}
					}
				}
				if($update_param == '')
					$update_param = $key." = '".json_encode($image_list)."'";
				else{
					$update_param .= ", ".$key." = '".json_encode($image_list)."'";
				}	
			}else{
				if($data['name'] != ''){
					$image_name 	= explode(".", $_FILES[$key]["name"]);
					$image_extension 	= end($image_name);
					$image_new_name = $key.".".$image_extension;
					$image_new_name = preg_replace('/[^A-Za-z0-9_\-]/', '_', $image_new_name);
					$image_upload_status =true;
					if (file_exists("../../images/tours/" .$image_new_name)) {
			    		unlink("../../images/tours/" .$image_new_name);
			    	}
					if (!move_uploaded_file($_FILES[$key]["tmp_name"],"../../images/tours/" .$image_new_name)){
						    $image_upload_status = false;
					}
					if($update_param == '')
						$update_param = $key." = '".$image_new_name."'";
					else{
						$update_param .= ", ".$key." = '".$image_new_name."'";
					}
				}
			}
		}
		$query = "UPDATE site_images SET ".$update_param." WHERE id=1";
		mysqli_query($con, $query);

		header("Location:site_images.php?msg=Updated successfully");

	}else if(isset($_POST['data']) && $_POST['data'] == "site_content") {
		$data = $_POST;

		print_r($data);
		
		foreach ($data as $key => $value) {
			if($key != 'data'){
				$val = implode(', ', $value);
				echo $query = "UPDATE site_content SET content_ids='".$val."' WHERE content_name='".mysqli_escape_string($con,$key)."'";
				mysqli_query($con, $query);
			}
		}
		header("Location:site_content.php?msg=Updated successfully");

	}
?>
