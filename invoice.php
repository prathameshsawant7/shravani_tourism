<?php
	include_once("configs/defines.php");
	include("configs/settings.php");
	include("functions.php");
	$est =new settings();
	$con=$est->connection();
	#session_start(); 

	if(isset($_GET['ticket'])){
	  $ticket = $_GET['ticket'];
	  $query = "SELECT t.tour_name,t.tour_duration, DATE_FORMAT(b.added_on, '%d/%m/%Y') as invoice_date, b.* FROM ashtavinayak_bookings as b LEFT JOIN tours as t ON t.id = b.tour_id WHERE ticket = '".$ticket."'";
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
<title>Tour Invoice - Shravani Tourism</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<style>
	.con-wid{
		width:65%!important;
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
	.col-txt-2{
	    padding:5px;
	    text-transform: uppercase;
	    color:434343;
	    font-size: 0.9rem;
	    line-height: 1.5rem;
	    height:4rem;
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
	.col-txt-left{
	    padding:5px;
	    color:434343;
	    font-size: 0.9rem;
	    line-height: 1.5rem;
	    height:2rem;
	    text-align: left;
	    font-weight: 300;
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
	<div class="container con-wid">
		<form><BR>
		<img src="images/printButton.gif" class="noPrint" onclick="javascript:window.print();" style="cursor:pointer; " width="85" height="24" /><BR>
		<div class="col- col-sm-12 col-md-12 col-lg-12 col-xl-12">
			<div class='text-center p-3'><h3>TOUR INVOICE</h3></div>
			<div class="form-group">
				<div class ="row inv-tab-bor">
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						Invoice No:
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						I<?php echo $ticket; ?>					
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						Invoce Date:
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						<?php echo $result['invoice_date'];?>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						NAME:
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						<?php echo $result['contact_name'];?>					
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						CONTACT NO:
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						<?php echo $result['contact_phone'];?>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						GST NO:
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						<?php echo $configs['gst_no'];?>					
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						TICKET:
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						<?php echo $ticket; ?>
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-2">
						TRAVEL DESTINATION :
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-2">
						<?php echo $result['tour_name'];?> 					
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-2">
						DURATION OF THE TOUR:
					</div>
					<div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-2">
						<?php echo $result['tour_duration'];?>
					</div>
					<!-- <div class="col-sm-6 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						Invoice Due Date:
					</div>
					<div class="col-sm-6 col-md-9 col-lg-9 col-xl-9 inv-tab-bor2 col-txt-1">
											
					</div> -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6  inv-tab-bor1 col-txt-head">
						PARTICULAR
					</div>
					<!-- <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 col-txt-head">
						RATE
					</div> -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-head">
						QTY
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-head">
						AMOUNT
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 inv-tab-bor1 col-txt-1">
						<center>Tour Package</center>
					</div>
					<!-- <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 col-txt-1">
						
					</div> -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						<center><?php echo $qty;?></center>
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						<center>
						<?php echo '₹ '.money_format('%!i', $cost_data['cost']);?>
						</center>
					</div>
					<!-- Row 2 -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 inv-tab-bor1 col-txt-1">
						
					</div>
					<!-- <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 col-txt-1">
						
					</div> -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						
					</div>
					<!-- Row 3 -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 inv-tab-bor1 col-txt-1">
						
					</div>
					<!-- <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 col-txt-1">
						
					</div> -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						
					</div>
					<!-- Row 4 -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 inv-tab-bor1 col-txt-1">
						
					</div>
					<!-- <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 col-txt-1">
						
					</div> -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1">
						
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						
					</div>
					<!-- Row 6 -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 inv-tab-bor1 col-txt-1">
						
					</div>
					<!-- <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 col-txt-1">
						
					</div> -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-head-right">
						SUB TOTAL
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						<center>
						<?php echo '₹ '.money_format('%!i', $cost_data['cost']);?>
						</center>
					</div>
					<!-- Row 5 -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 inv-tab-bor1 col-txt-1">
						
					</div>
					<!-- <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 col-txt-1">
						
					</div> -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-1 col-txt-head-right">
						Service Charge
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						<center>
						<?php echo '₹ '.money_format('%!i', $cost_data['service_cost']);?>
						</center>
					</div>
					<!-- Row 7 -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 inv-tab-bor1 col-txt-1">
						
					</div>
					<!-- <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 col-txt-1">
						
					</div> -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-head-right">
						SGST (<?php echo ($cost_data['gst_percent']/2);?>%)
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						<center>
						<?php echo '₹ '.money_format('%!i', ($cost_data['gst']/2));?>
						</center>
					</div>
					<!-- Row 8 -->
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 inv-tab-bor1 col-txt-1">
						
					</div>
					<!-- <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 col-txt-1">
						
					</div> -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-head-right">
						CGST (<?php echo ($cost_data['gst_percent']/2);?>%)
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						<center>
						<?php echo '₹ '.money_format('%!i', ($cost_data['gst']/2));?>
						</center>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 inv-tab-bor1 col-txt-1">
						
					</div>
					<!-- <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 col-txt-1">
						
					</div> -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-head-right">
						DISCOUNT
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						<center>
						<?php echo '₹ '.money_format('%!i', $cost_data['discount']);?>
						</center>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6 col-xl-6 inv-tab-bor1 col-txt-1">
						
					</div>
					<!-- <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2 inv-tab-bor1 col-txt-1">
						
					</div> -->
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor1 col-txt-head-right ">
						TOTAL
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
						<center>
						<?php echo '₹ '.money_format('%!i', $result['total_cost']);?>
						</center>
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-head-left">
						Amounts in words:
					</div>
					<div class="col-sm-9 col-md-9 col-lg-9 col-xl-9 inv-tab-bor2 col-txt-1">
						<?php echo $total_cost_in_words;?>
					</div>
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-txt-left">
		            Thanks & Regards
		            </div>
		            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-txt-head-left">
		            Shravani Tourism
		            </div>
					<div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-txt-head-right2">
						THIS IS COMPUTER GENERATED INVOICE NO SIGNATURE REQUIRED
					</div>
				</div>				
			</div>
		</div>
	</form>
	</div>
</body>
</html>