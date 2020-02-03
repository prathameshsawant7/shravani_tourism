<?php 
// include_once("configs/defines.php");
// include("configs/settings.php");

class Functions
{
	
	function __construct(){
		$est =new settings();
		$this->con=$est->connection();
	}


	function calculate_tour_cost($tour_id, $hotel_type, $rooms){
		$est =new settings();
		$con=$est->connection();
		
		if($tour_id != '' && $hotel_type != ''){
			$price = [];
			$price['cost'] = 0;
			$price['service_charge'] = 0;
			$price['total_cost'] = 0;
			$price['adult'] = 0;
			$price['child'] = 0;
			$adult_double_rate = 0;
			$extra_adult_rate = 0;
			$child_rate = 0;
			$adult_single_rate = 0;

			$service_charge = 200;
			$service_charge_off = 200;
			$gst = 0;
			$discount = 0;
			

			$query = "SELECT identifier, rate FROM tour_rates WHERE tour_id=".$tour_id." && hotel_type='".$hotel_type."';";

			$result = mysqli_query($this->con,$query);
			while($row = $result->fetch_assoc()){

				switch($row['identifier']){
					case 'adult_double':
						$adult_double_rate = $row['rate'];
						break;
					case 'extra_adult':
						$extra_adult_rate = $row['rate'];
						break;
					case 'child':
						$child_rate = $row['rate'];
						break;
					case 'adult_single':
						$adult_single_rate = $row['rate'];
						break;
				}
			}

			for($i=0;$i<count($rooms);$i++){
				$cost = 0;
				$service = 0;
				if($rooms[$i]['adult'] == 1){
					if($rooms[$i]['child'] == 0){
						$cost += $adult_single_rate;
					}else if($rooms[$i]['child'] == 1){
						$cost+= 2 * $adult_double_rate;
					}else if($rooms[$i]['child'] == 2){
						$cost+= 2 * $adult_double_rate;
						$cost+= $child_rate;
					}

					$service += ($rooms[$i]['adult'] +  $rooms[$i]['child']) * $service_charge;

					#TODO: Logic remaining for child
				}else if($rooms[$i]['adult'] == 2){
					$cost+= $rooms[$i]['adult'] * $adult_double_rate;
					$cost+= $rooms[$i]['child'] * $child_rate;

					$service += ($rooms[$i]['adult'] +  $rooms[$i]['child']) * $service_charge;
					$service -= ($rooms[$i]['child']>0)?$service_charge_off:0;

 				}else if($rooms[$i]['adult'] == 3){
					$cost+= (2 * $adult_double_rate) + (1 * $extra_adult_rate);
					$cost+= $rooms[$i]['child'] * $child_rate;

					$service += ($rooms[$i]['adult'] +  $rooms[$i]['child']) * $service_charge;
					$service -= ($rooms[$i]['child']>0)?$service_charge_off:0;	
				}
			


				$price['cost'] += $cost;
				$price['service_charge'] += $service;
				$price['room'][$i+1] = $cost + $service;
				$price['adult'] += $rooms[$i]['adult'];
				$price['child'] += $rooms[$i]['child'];

				// echo '<pre>';print_r($price);
				// echo '</pre>';exit;

			}
			$price['gst_percent'] = $gst;
			$price['gst'] = ($price['cost'] * $gst) / 100;
			$price['discount'] = $discount;
			$price['total_cost'] = $price['cost'] + $price['service_charge'] + $price['gst'] - $price['discount'];

			return $price;

		}

	}
}

function test(){
	$rooms = [];
	$rooms[0]['adult'] = 1;
	$rooms[0]['child'] = 0;

	$rooms[1]['adult'] = 3;
	$rooms[1]['child'] = 0;

	$func = new Functions();
	$data = $func->calculate_tour_cost(3,'standard', $rooms);

	echo '<pre>';print_r($data);
	echo '</pre>';
}

//test();

?>
