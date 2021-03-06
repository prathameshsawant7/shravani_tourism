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


			$query = "SELECT * FROM configurations WHERE id=1;";
			$result = mysqli_query($this->con,$query);
			$configs = $result->fetch_assoc();

			$service_charge = $configs['service_charge'];
			$gst = $configs['gst'];
			$discount = $configs['discount'];


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

			if($adult_single_rate == 0){
				$adult_single_rate = $adult_double_rate;
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
					//$service -= ($rooms[$i]['child']>0)?$service_charge_off:0;

 				}else if($rooms[$i]['adult'] == 3){
					$cost+= (2 * $adult_double_rate) + (1 * $extra_adult_rate);
					$cost+= $rooms[$i]['child'] * $child_rate;

					$service += ($rooms[$i]['adult'] +  $rooms[$i]['child']) * $service_charge;
					//$service -= ($rooms[$i]['child']>0)?$service_charge_off:0;	
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

	function generate_ticket(){
		return strtoupper(substr(sha1(time()), 0, 20));
	}

	function get_non_available_seats($id, $date, $type, $bus_no, $ref_ticket = ''){
		$query = "SELECT GROUP_CONCAT(seat_no) as bookings FROM ashtavinayak_bookings WHERE tour_id='".$id."' AND  tour_date='".$date."' AND tour_type='".$type."' AND bus_no='".$bus_no."' ";

		$query .= ($ref_ticket != '')?"AND ticket != '".$ref_ticket."';":";";
		$fetch_data = mysqli_query($this->con,$query);    
		$bookings = $fetch_data->fetch_assoc(); 

		$query = "SELECT REPLACE(GROUP_CONCAT(seats),'|',',') as reserved FROM reserved_seats WHERE tour_id='".$id."' AND date='".$date."' AND tour_type='".$type."' AND bus_no='".$bus_no."';" ;
		$fetch_data = mysqli_query($this->con,$query);    
		$reserved = $fetch_data->fetch_assoc(); 

		$booking_arr  = explode(',', $bookings['bookings']);
		$reserved_arr = explode(',', $reserved['reserved']);
		$non_available_seats = array_merge($booking_arr,$reserved_arr);
		return $non_available_seats;
	}

	function getIndianCurrencyInWords($number){
	    $decimal = round($number - ($no = floor($number)), 2) * 100;
	    $hundred = null;
	    $digits_length = strlen($no);
	    $i = 0;
	    $str = array();
	    $words = array(0 => '', 1 => 'one', 2 => 'two',
	        3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
	        7 => 'seven', 8 => 'eight', 9 => 'nine',
	        10 => 'ten', 11 => 'eleven', 12 => 'twelve',
	        13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
	        16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
	        19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
	        40 => 'forty', 50 => 'fifty', 60 => 'sixty',
	        70 => 'seventy', 80 => 'eighty', 90 => 'ninety');
	    $digits = array('', 'hundred','thousand','lakh', 'crore');
	    while( $i < $digits_length ) {
	        $divider = ($i == 2) ? 10 : 100;
	        $number = floor($no % $divider);
	        $no = floor($no / $divider);
	        $i += $divider == 10 ? 1 : 2;
	        if ($number) {
	            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
	            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
	            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
	        } else $str[] = null;
	    }
	    $Rupees = implode('', array_reverse($str));
	    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
	    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise . ' only';
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
