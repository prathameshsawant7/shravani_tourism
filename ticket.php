<?php
	include_once("configs/defines.php");
	include("configs/settings.php");
	include("functions.php");
	$est =new settings();
	$con=$est->connection();
	session_start(); 

	if(isset($_GET['ticket'])){
	  $ticket = $_GET['ticket'];
	  $query = "SELECT t.tour_name,t.tour_duration, DATE_FORMAT(b.added_on, '%d/%m/%Y') as booking_date, b.* FROM ashtavinayak_bookings as b LEFT JOIN tours as t ON t.id = b.tour_id WHERE ticket = '".$ticket."'";
	  $fetch_data = mysqli_query($con,$query);
	  $result = $fetch_data->fetch_assoc();    
	  $tour_name = $result['tour_name'];
	  $ticket = $result['ticket'];
	  $seat_data = json_decode($result['seat_data'],true);
	  $rooms  = count(json_decode($result['room_data'],true));
	  $cost_data = json_decode($result['cost_data'],true);
	  $qty = count($seat_data);


	  // $query = "SELECT t.name FROM `tour_type` as t LEFT JOIN ashtavinayak_bookings as b ON b.tour_type = t.identifier WHERE b.ticket = '".$ticket."'";
	  // $fetch_data = mysqli_query($con,$query);
	  // $tour_type = $fetch_data->fetch_assoc(); 
	  #print_r($result);
	  $func = new Functions();
	  $total_cost_in_words=$func->getIndianCurrencyInWords($result['total_cost']);

	  $query = "SELECT * FROM configurations WHERE id=1;";
	  $result_configs = mysqli_query($con,$query);
	  $configs = $result_configs->fetch_assoc();
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Tour Ticket - Shravani Tourism</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<style>
	.con-wid-pass{
		width:80%!important;
	}
	.inv-tab-bor{
		border:1px solid grey;
	}
	.inv-tab-bor1{
		border-bottom:1px solid grey;
		border-right:1px solid grey;		
	}
	.inv-tab-bor2{
		border-bottom:1px solid grey;
	}
	.col-txt-1{
		padding:5px;
		text-transform: uppercase;
		color:434343;
		font-size: 0.9rem;
		line-height: 1.5rem;
		height:2rem;
		text-align: left;
	}
.col-txt-head{
		padding:5px;
		text-transform: uppercase;
		color:434343;
		font-size: 0.9rem;
		line-height: 1.5rem;
		height:2rem;
		text-align: center;
		font-weight: 600;
	}
	.col-txt-head-right{
		padding:5px;
		text-transform: uppercase;
		color:434343;
		font-size: 0.9rem;
		line-height: 1.5rem;
		height:2rem;
		text-align: right;
		font-weight: 600;
	}
	.col-txt-head-left{
		padding:5px;
		text-transform: uppercase;
		color:434343;
		font-size: 0.9rem;
		line-height: 1.5rem;
		height:2rem;
		text-align: left;
		font-weight: 600;
	}
	.col-txt-head-right2{
		padding:5px;
		text-transform: uppercase;
		color:grey;
		font-size: 0.7rem;
		line-height: 1.5rem;
		height:2rem;
		text-align: right;
		font-weight: 600;
	}
</style>
<body>
	<div class="container con-wid-pass">
		<form><BR>
		<img src="images/printButton.gif" class="noPrint" onclick="javascript:window.print();" style="cursor:pointer; " width="85" height="24" /><BR>
		<div class="col- col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class='text-center p-3'><h4>TOUR TICKET</h4></div>
			<div class="form-group">
				<div class ="row inv-tab-bor">
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1 col-txt-head-left">
						Ticket:
					</div>
					<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 inv-tab-bor2 col-txt-1">
						<?php echo $ticket;?>					
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1 col-txt-head-left">
						Tour:
					</div>
					<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 inv-tab-bor2 col-txt-1">
						<?php echo $result['tour_name'];?>					
					</div>
					
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1 col-txt-head-left">
						Bus:
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						<?php echo $result['tour_type'];?>					
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1 col-txt-head-left">
						Bus No:
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						<?php echo $result['bus_no'];?>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1 col-txt-head-left">
						Rooms:
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						<?php echo count($result['room_data']);?>					
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1 col-txt-head-left">
						Booking Date:
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						<?php echo $result['booking_date'];?>
					</div>
					
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1 col-txt-head-left">
						Pickup:
					</div>
					<div class="col-sm-6 col-md-9 col-lg-9 col-xl-9 inv-tab-bor2 col-txt-1">
						<?php echo $result['tour_pickup'];?>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1 col-txt-head-left">
						Drop:
					</div>
					<div class="col-sm-6 col-md-9 col-lg-9 col-xl-9 inv-tab-bor2 col-txt-1">
						<?php echo $result['tour_drop'];?>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 inv-tab-bor1 col-txt-1 col-txt-head">
						Details
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2  inv-tab-bor1 col-txt-head">
						Seat No.
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 inv-tab-bor1 col-txt-head">
						Passenger Names
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 col-txt-head">
						Age
					</div>
					<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 col-txt-head">
						Gender
					</div>
					<?php
						$rows = (count($seat_data)>5)?count($seat_data):5;
						for($i=0;$i<=$rows;$i++){

						$seat = '-';
						$name = '-';
						$age = '-';
						$gender = '-';

						if(isset($seat_data[$i])){
							$seat = $seat_data[$i]['seat'];
							$name = $seat_data[$i]['name'];
							$age = $seat_data[$i]['age'];
							$gender = ($seat_data[$i]['gender'] == 'M')?'Male':'Female';	
						}		
					?>
						<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2  inv-tab-bor1 ">
							<center><?php echo $seat; ?></center>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 inv-tab-bor1 ">
							<?php echo $name; ?>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 ">
							<center><?php echo $age; ?></center>
						</div>
						<div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 ">
							<center><?php echo $gender; ?></center>
						</div>
					<?php } ?>

					<div class="col- col-sm-12 col-md-12 col-lg-12 col-xl-12 col-txt-1"></div>
				</div>
			</div>
		</div>	
	</form>
	</div>
</body>
</html>
