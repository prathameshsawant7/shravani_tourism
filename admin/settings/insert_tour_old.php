<?php 
include_once("../../configs/defines.php");
include("../../configs/settings.php");
$est =new settings();
$con=$est->connection();

//echo "<pre>";print_r($_POST);exit;

if(isset($_POST['data']) && $_POST['data'] == "tour") {
	// /echo "<pre>";print_r($_POST);exit;
	$id								= mysqli_escape_string($con,$_POST['id']);
	$id_tour 						= mysqli_escape_string($con,$_POST['id_tour']);
	$tour_name 						= mysqli_escape_string($con,$_POST['tour_name']);
	$id_tour_location_category 		= mysqli_escape_string($con,$_POST['id_tour_location_category']);
	$tour_type 						= mysqli_escape_string($con,$_POST['tour_type']);
	$twin_sharing 					= mysqli_escape_string($con,$_POST['twin_sharing']);
	$single 						= mysqli_escape_string($con,$_POST['single']);
	$extra_person_with_same_room 	= empty($_POST['extra_person_with_same_room']) ? 0:mysqli_escape_string($con,$_POST['extra_person_with_same_room']);
	$childrens_extra_matress 		= empty($_POST['childrens_extra_matress']) ? 0:mysqli_escape_string($con,$_POST['childrens_extra_matress']);
	$night_days 					= mysqli_escape_string($con,$_POST['night_days']);
	$travel_type 					= mysqli_escape_string($con,$_POST['travel_type']);
	$govt_tax 						= mysqli_escape_string($con,$_POST['govt_tax']);
	$package_inclusion 				= mysqli_escape_string($con,$_POST['package_inclusion']);
	$package_exclusion 				= mysqli_escape_string($con,$_POST['package_exclusion']);
	$price 							= mysqli_escape_string($con,$_POST['price']);
	$page_action					= mysqli_escape_string($con,$_POST['page_action']);

	if($page_action == 'edit'){
		$query = "UPDATE tours SET id_tour='".$id_tour."',tour_name='".$tour_name."',id_tour_location_category=".$id_tour_location_category.",tour_type='".$tour_type."',twin_sharing='".$twin_sharing."',single='".$single."',extra_person_with_same_room=".$extra_person_with_same_room.",childrens_extra_matress=".$childrens_extra_matress.",night_days='".$night_days."',travel_type='".$travel_type."',govt_tax='".$govt_tax."',package_inclusion='".$package_inclusion."',package_exclusion='".$package_exclusion."',price=".$price." WHERE id=".$id;
	}else{
		$query = "INSERT INTO tours (id_tour,tour_name,id_tour_location_category,tour_type,twin_sharing,single,extra_person_with_same_room,
				childrens_extra_matress,night_days,travel_type,govt_tax,package_inclusion,package_exclusion,price) VALUES ('".$id_tour."','".$tour_name."',".$id_tour_location_category.",'".$tour_type."','".$twin_sharing."','".$single."',".$extra_person_with_same_room.",".$childrens_extra_matress.",'".$night_days."','".$travel_type."','".$govt_tax."','".$package_inclusion."','".$package_exclusion."',".$price.")";
	}
	
	mysqli_query($con,$query);
	
	if($page_action == 'edit'){
		$query 	= "DELETE FROM tour_category_linking WHERE id_tour='".$id_tour."'";
		mysqli_query($con,$query);
	}else{
		$id 	= mysqli_insert_id($con);
	}

	foreach ($_POST['id_category'] as $key => $value) {
		$values 					= "(".$value.",'".$id_tour."')";
		$queryRecords			   .= $queryRecords == '' ? $values:",".$values;
	}

	$query = "INSERT INTO tour_category_linking (id_category,id_tour) VALUES ".$queryRecords.";";
	mysqli_query($con,$query);

	$action = ($page_action == 'edit')?'&action=edit':'';
	header("Location:add_tour_details.php?id=".$id.$action);
}
if(isset($_POST['data']) && $_POST['data'] == "tour_overview") {

	$id_tour 						= mysqli_escape_string($con,$_POST['id_tour']);
	$count							= mysqli_escape_string($con,$_POST['count']);
	$page_action					= mysqli_escape_string($con,$_POST['page_action']);
	$queryRecords					= '';

	if($page_action == 'edit'){
		$query 	= "DELETE FROM tour_overview WHERE id_tour='".$id_tour."'";
		mysqli_query($con,$query);
	}

	for($i=1;$i<=$count;$i++) {
		$day 						= mysqli_escape_string($con,$_POST['day_'.$i]);
		$activity				 	= mysqli_escape_string($con,$_POST['activity_'.$i]);
		$sightseeing				= mysqli_escape_string($con,$_POST['sightseeing_'.$i]);
		$values 					= "('".$id_tour."',".$day.",'".$activity."','".$sightseeing."')";
		$queryRecords			   .= $queryRecords == '' ? $values:",".$values;
	}


	$query = "INSERT INTO tour_overview(id_tour,day,activity,sightseens) VALUES ".$queryRecords.";";
	mysqli_query($con,$query);
	$id = $_POST['id'];
	$action = ($page_action == 'edit')?'&action=edit':'';
	header("Location:add_tour_hotels.php?id=".$id.$action);
}
if(isset($_POST['data']) && $_POST['data'] == "tour_hotels") {

	$id_tour 						= mysqli_escape_string($con,$_POST['id_tour']);
	$count							= mysqli_escape_string($con,$_POST['count']);
	$page_action					= mysqli_escape_string($con,$_POST['page_action']);
	$queryRecords					= '';

	if($page_action == 'edit'){
		$query 	= "DELETE FROM tour_hotels WHERE id_tour='".$id_tour."'";
		mysqli_query($con,$query);
	}

	for($i=1;$i<=$count;$i++) {
		$id_city 					= mysqli_escape_string($con,$_POST['id_city_'.$i]);
		$place				 		= mysqli_escape_string($con,$_POST['place_'.$i]);
		$hotel_name					= mysqli_escape_string($con,$_POST['hotel_name_'.$i]);
		$shikara 					= mysqli_escape_string($con,$_POST['shikara_'.$i]);
		$house_boat				 	= mysqli_escape_string($con,$_POST['house_boat_'.$i]);
		$hotel_category				= mysqli_escape_string($con,$_POST['hotel_category_'.$i]);
		$values 					= "('".$id_tour."',".$id_city.",'".$place."','".$hotel_name."','".$shikara."','".$house_boat."','".$hotel_category."')";
		$queryRecords			   .= $queryRecords == '' ? $values:",".$values;
	}


	$query = "INSERT INTO tour_hotels(id_tour,id_city,place,hotel_name,shikara,house_boat,hotel_category) VALUES ".$queryRecords.";";
	mysqli_query($con,$query);

	$id = $_POST['id'];
	$action = ($page_action == 'edit')?'&action=edit':'';
	header("Location:add_tour_rates.php?id=".$id.$action);
}
if(isset($_POST['data']) && $_POST['data'] == "tour_rates") {

	$id_tour 						= mysqli_escape_string($con,$_POST['id_tour']);
	$count							= mysqli_escape_string($con,$_POST['count']);
	$page_action					= mysqli_escape_string($con,$_POST['page_action']);
	$queryRecords					= '';

	if($page_action == 'edit'){
		$query 	= "DELETE FROM tour_rates WHERE id_tour='".$id_tour."'";
		mysqli_query($con,$query);
	}

	for($i=1;$i<=$count;$i++) {
		$hotel_category				= mysqli_escape_string($con,$_POST['hotel_category_'.$i]);
		$mapai  					= empty($_POST['mapai_'.$i]) ? 0:mysqli_escape_string($con,$_POST['mapai_'.$i]);
		$apai				 		= empty($_POST['apai_'.$i]) ? 0:mysqli_escape_string($con,$_POST['apai_'.$i]);
		$cost_per_person			= empty($_POST['cost_per_person_'.$i]) ? 0:mysqli_escape_string($con,$_POST['cost_per_person_'.$i]);
		$cost_for_couple			= empty($_POST['cost_for_couple_'.$i]) ? 0:mysqli_escape_string($con,$_POST['cost_for_couple_'.$i]);
		$cost_with_pax_2		 	= empty($_POST['cost_with_pax_2_'.$i]) ? 0:mysqli_escape_string($con,$_POST['cost_with_pax_2_'.$i]);
		$cost_with_pax_4		 	= empty($_POST['cost_with_pax_4_'.$i]) ? 0:mysqli_escape_string($con,$_POST['cost_with_pax_4_'.$i]);
		$cost_with_pax_6		 	= empty($_POST['cost_with_pax_6_'.$i]) ? 0:mysqli_escape_string($con,$_POST['cost_with_pax_6_'.$i]);
		$cost_with_pax_8		 	= empty($_POST['cost_with_pax_8_'.$i]) ? 0:mysqli_escape_string($con,$_POST['cost_with_pax_8_'.$i]);
		$supplement_meal		 	= empty($_POST['supplement_meal_'.$i]) ? 0:mysqli_escape_string($con,$_POST['supplement_meal_'.$i]);
		$extra_person_cost		 	= empty($_POST['extra_person_cost_'.$i]) ? 0:mysqli_escape_string($con,$_POST['extra_person_cost_'.$i]);
		$children_cost		 	= empty($_POST['children_cost_'.$i]) ? 0:mysqli_escape_string($con,$_POST['children_cost_'.$i]);
		
		$values 					= "('".$id_tour."','".$hotel_category."',".$mapai.",".$apai.",".$cost_per_person.",".$cost_for_couple.",".$cost_with_pax_2.",".$cost_with_pax_4.",".$cost_with_pax_6.",".$cost_with_pax_8.",".$supplement_meal.",".$extra_person_cost.",".$children_cost.")";
		$queryRecords			   .= $queryRecords == '' ? $values:",".$values;
	}


	$query = "INSERT INTO tour_rates(id_tour, hotel_category, mapai, apai, cost_per_person, cost_for_couple, cost_with_pax_2, cost_with_pax_4, cost_with_pax_6, cost_with_pax_8, supplement_meal, extra_person_cost, children_cost) VALUES ".$queryRecords.";";
	mysqli_query($con,$query);

	$id = $_POST['id'];
	$action = ($page_action == 'edit')?'&action=edit':'';
	header("Location:add_tour_images.php?id=".$id.$action);
}
if(isset($_POST['data']) && $_POST['data'] == "tour_images") {
	$id_tour 						= mysqli_escape_string($con,$_POST['id_tour']);
	$count							= mysqli_escape_string($con,$_POST['count']);
	$page_action					= mysqli_escape_string($con,$_POST['page_action']);
	$queryRecords					= '';

	if($page_action == 'edit'){
		$query 	= "DELETE FROM tour_images WHERE id_tour='".$id_tour."'";
		mysqli_query($con,$query);
		$mask = "../../images/tours/".$id_tour."*";
		array_map('unlink', glob($mask));
	}

	$slider_counter 	= 1;
	$thumb_counter 		= 1;
	$position 			= 1;
	$imageUploadStatus 	= true;
	for($i=1;$i<=$count;$i++) {
		$image_type					= mysqli_escape_string($con,$_POST['image_type_'.$i]);
		$imageFilename 				= explode(".", $_FILES["image_".$i]["name"]);
		$extension 					= end($imageFilename);
		if($image_type == '2x1'){
			$imageName 	= $id_tour."_".$image_type."_".$slider_counter.".".$extension;
			$position  	= $slider_counter;
			$slider_counter++;
		}else{
			$imageName = $id_tour."_".$image_type."_".$thumb_counter.".".$extension;
			$position  	= $thumb_counter;
			$thumb_counter++;
		}


		if (!move_uploaded_file($_FILES["image_".$i]["tmp_name"],"../../../images/tours/" .$imageName)) {
		    $imageUploadStatus = false;
		}
		$values 					= "('".$id_tour."','".$image_type."','".$imageName."',".$position.")";
		$queryRecords			   .= $queryRecords == '' ? $values:",".$values;
	}

	if($imageUploadStatus){
		$query = "INSERT INTO tour_images(id_tour, image_type, image, position) VALUES ".$queryRecords.";";
		mysqli_query($con,$query);
		header("Location:index.php?id_tour=".$id_tour);
	}else{
		echo "Image Upload error";
	}

	
}




?>
