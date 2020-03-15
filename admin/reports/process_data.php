<?php 
include_once("../../configs/defines.php");
include("../../configs/settings.php");
$est =new settings();
$con=$est->connection();
session_start();

if(isset($_POST['data']) && $_POST['data'] == "bus_chart"){
		#print_r($_POST);
		$tour_date    	= mysqli_escape_string($con,$_POST['tour_date']);
	    $tour_id        = mysqli_escape_string($con,$_POST['tour_id']);
	    $tour_type      = mysqli_escape_string($con,$_POST['tour_type']);
	    $bus_no         = mysqli_escape_string($con,$_POST['bus_no']);

	    $query = "SELECT CONCAT(tour_code,' - ',tour_name) AS tour FROM tours WHERE id = '$tour_id';";
        $tour_fetch_data  = mysqli_query($con,$query);
        $tour_name = $tour_fetch_data->fetch_assoc();


		$query = "SELECT ticket,seat_data,contact_phone FROM ashtavinayak_bookings WHERE tour_date='$tour_date' AND tour_id='$tour_id' AND tour_type='$tour_type' AND bus_no='$bus_no' AND active=1;";
        $fetch_data  = mysqli_query($con,$query);

        // filename for download
		$filename = $tour_date."_".$tour_name['tour']."_".ucwords($tour_type)."_BUS_".$bus_no.".xls";

		header("Content-Disposition: attachment; filename=\"$filename\"");
		header("Content-Type: application/vnd.ms-excel");
		$data = [];

		$fields = [];
		$fields['Bus'] 		 = $bus_no;
		$fields['Tour Date'] = $tour_date;
		$fields['Tour Name'] = $tour_name['tour'];
		$fields['Tour Type'] = ucwords($tour_type);
		
		array_push($data,$fields);
		$fields = [];
		array_push($data,$fields);

		$flag = false;
		foreach($data as $row) {
			if(!$flag) {
			  // display field/column names as first row
			  echo implode("\t", array_keys($row)) . "\r\n";
			  $flag = true;
			}
			array_walk($row, __NAMESPACE__ . '\cleanData');
			echo implode("\t", array_values($row)) . "\r\n";
		}


		$data = [];
        while ($booking_data = $fetch_data->fetch_assoc()) {

        	$seats = json_decode($booking_data['seat_data'],true);

        	foreach ($seats as $k => $v) {
        		$fields = [];
        		$fields['Ticket'] = $booking_data['ticket'];
        		$fields['Seat'] = (string)$v['seat'];
        		$fields['Name'] = $v['name'];
        		$fields['Gender'] = $v['gender'];
        		$fields['Age'] = $v['age'];
        		$fields['Phone'] = $booking_data['contact_phone'];
        		array_push($data,$fields);
        	}
        }
        

		function cleanData(&$str){
			$str = preg_replace("/\t/", "\\t", $str);
			$str = preg_replace("/\r?\n/", "\\n", $str);
			if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
		}

		// $data = [
		//     ["firstname" => "Mary", "lastname" => "Johnson", "age" => 25],
		//     ["firstname" => "Amanda", "lastname" => "Miller", "age" => 18],
		//     ["firstname" => "James", "lastname" => "Brown", "age" => 31],
		//     ["firstname" => "Patricia", "lastname" => "Williams", "age" => 7],
		//     ["firstname" => "Michael", "lastname" => "Davis", "age" => 43],
		//     ["firstname" => "Sarah", "lastname" => "Miller", "age" => 24],
		//     ["firstname" => "Patrick", "lastname" => "Miller", "age" => 27]
		//   ];

		
		$flag = false;
		foreach($data as $row) {
			if(!$flag) {
			  // display field/column names as first row
			  echo implode("\t", array_keys($row)) . "\r\n";
			  $flag = true;
			}
			array_walk($row, __NAMESPACE__ . '\cleanData');
			echo implode("\t", array_values($row)) . "\r\n";
		}
		

		exit;
	}
?>