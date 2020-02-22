<?php
include_once("configs/defines.php");
include("configs/settings.php");
$est =new settings();
$con=$est->connection();
session_start(); 

$query = "SELECT * FROM tours WHERE id=".$_GET['tour_id'].";";
$fetch_data = mysqli_query($con,$query);    
$tour_data = $fetch_data->fetch_assoc();  
?>
<!DOCTYPE html>
<html>
<head>
	<title>Package Details</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="css/shravani.css" rel="stylesheet">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <!--Calender-->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!--Calender-->
   
</head>
<body>
<div class="container-fluide">
<?php include 'headers.php'; ?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="images/ashtvinayak-ban01.jpg" class="img-fluid"></div>
<!--BreadCrumps-->
	<form>
		<div class="row m-4">
			<div class="col- col-sm-12 col-md-12 col-lg-12">
				<ul class="breadcrumb br-crum">
			    <li class="breadcrumb-item"><a href="#">Home</a></li>
			    <li class="breadcrumb-item active">Maharashtra Tour</li>
			    <li class="breadcrumb-item active">Ashtavinayak</li>
			  </ul>
			</div>
		</div>
	</form>
	<!--BreadCrumps-->
	<!--Bus Booking-->
	<div class="container">
		<div id="booking">
			<div class="row pack-bac form-group">
				<div class="col-sm-2 col-md-2 col-lg-2">
					<span class="tour-search text-uppercase">Tour Date</span>
					<input id="tour_date" width="170"  />
				    <script>

				 //    var enableDays = ["24/01/2020","20/01/2020"];
					// $("#tour_date").datepicker({ 
				 //        maxViewMode: 2,
				 //        weekStart: 1,
				 //        startDate: "+1d",
				 //        beforeShowDay: function(date){
				 //          if (enableDays.indexOf(formatDate(date)) < 0)
				 //            return {
				 //              enabled: false
				 //            }
				 //          else
				 //            return {
				 //              enabled: true
				 //            }
				 //        },
				 //        todayHighlight: true,
				 //        format: "dd/mm/yyyy", 
				 //        clearBtn: true,
				 //        enabled: true,
				 //        autoclose: true,
				 //        uiLibrary: 'bootstrap4'
				 //  	});
				    </script>
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3">
					<span class="tour-search text-uppercase">Pick Up From</span>
						<select class="form-control mod-in dest-text bt-gr-booking" id="pickup" name="pickup" onchange="updatePickupDropText()">
							<?php
								$query = "SELECT * FROM ashtavinayak_pickup_drop WHERE type='pickup';";
					            $fetch_data = mysqli_query($con,$query);    
					            while($pick_drop = $fetch_data->fetch_assoc()){ 
					        ?>
					        <option><?php echo $pick_drop['point']; ?></option>
					    	<?php } ?>
					     </select>
				</div>
				<div class="col-sm-3 col-md-3 col-lg-3">
					<span class="tour-search text-uppercase">Drop To</span>
						 <select class="form-control mod-in dest-text bt-gr-booking" id="drop" name="drop" onchange="updatePickupDropText()">
						 	<?php
								$query = "SELECT * FROM ashtavinayak_pickup_drop WHERE type='drop';";
					            $fetch_data = mysqli_query($con,$query);    
					            while($pick_drop = $fetch_data->fetch_assoc()){           
							?>
					        <option><?php echo $pick_drop['point']; ?></option>
					    <?php } ?>
					     </select>
				</div>
				<div class="col-sm-2 col-md-2 col-lg-2">
					<span class="tour-search text-uppercase">Tour Type</span>
						 <select class="form-control mod-in dest-text bt-gr-booking" id="tour_type" name="tour_type">
						 	<?php
								$query = "SELECT name, identifier FROM tour_type WHERE tour_id=".$_GET['tour_id'].";";
					            $fetch_data = mysqli_query($con,$query);    
					            while($tour_type = $fetch_data->fetch_assoc()){           
							?>
					        <option value="<?php echo $tour_type['identifier']; ?>"><?php echo $tour_type['name']; ?></option>
					        <?php } ?>
					     </select>
				</div>
				<div class="col-sm-2 col-md-2 col-lg-2 align-self-center bknowbox">
					<button class="btn btn-primary bknow-butt" onclick="selectSeat();">Select Seat</button>
				</div>
			</div>
			<!--Bus Booking-->
			<!--Bus Booking Chart-->

			<?php
				$date = isset($_GET['date'])?$_GET['date']:'';
				$type = isset($_GET['type'])?$_GET['type']:'';

				if($date != '' && $type != ''){
					$query = "SELECT id FROM `bus_dates` WHERE tour_id=".$_GET['tour_id']." AND date = '".$date."' AND tour_type = '".$type."';";
			        $fetch_data = mysqli_query($con,$query);    
			        $records = $fetch_data->fetch_assoc();
			        if(!empty($records['id'])){
		        	?>
		        	<div class="container bus-seat-chart bor">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="row bor-bott">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
						<form class="form-inline">
						  <label for="seat" class="tour-search text-uppercase">Selected Seats:</label>
						  <input type="seat" class="form-control seat-sele ml-3" placeholder="Seat No" id="seat-no" disabled="disabled">
						</form>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
							<div class="row">
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<form class="form-inline">				  
									  <label id="pickup_text" class="sele-place ml-3"></label> 
									</form>
								</div>
								<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
									<form class="form-inline">				  
									  <label id="drop_text" class="sele-place ml-3"></label>
									</form>
								</div>
							</div>
						</div>
					</div>
					<?php
						$query = "SELECT * FROM ashtavinayak_seat_numbers;";
			            $fetch_data = mysqli_query($con,$query); 
			            $i= 0;   
			            while($seats = $fetch_data->fetch_assoc()){
			            	$seat[$i] = $seats['seat'];
			            	$i++;
			            }        
					?>
					<div class="row">
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-2 mt-2">
							<p class="text-left table-text-head mb-0"><u>Select Your Seats</u></p>
							<div class="seats">
						        <div class="row row-padd">
						            <div class="col-sm-1 whee-sty">
						                <img src="images/wheel.jpg">
						            </div>

						            <?php

									$seatOrder = ['D','C','B','A','E','F','G','H','L','K','J','I','2','1','N','M','3','4','5','6','10','9','8','7','14','13','12','11','18','17','16','15','22','21','20','19','23','24','25','26','29','30','31','28','27'];
									for($i=0;$i<count($seatOrder);){
									  $counter = ($i == 40)?5:4;

									  echo '<div class="col-sm-1">';
									  for($j=$counter;$j>0;$j--){
									  	$glapClass = ($counter-$j == 1 && $counter!=5)?'mr-bott sp-sty pt-1':'sp-sty pt-1';
									  	$cStatus = ''; //[reserved,booked]
									?>
									    <label class="<?php echo $cStatus;?>">
									     	<input id="seat_<?php echo $seatOrder[$i];?>" type="checkbox" class="cust-checkbox" >
									     	<span class="<?php echo $glapClass;?>"><?php echo $seatOrder[$i];?></span>
									    </label>
									<?php
									    $i++;
									  }
									  echo '</div>';
									}

									?>
						        </div>				       
							</div>
							<div class="col-sm-12 col-md-12 col-lg-12">
								<div class="row">
									<div class="col-sm-1 col-md-1 col-lg-1 pad-none">
										<img src ="images/un-booked.png">
									</div>
									<div class="col-sm-2 col-md-2 col-lg-2 se-tx pad-none">
										Available Seats
									</div>
									<div class="col-sm-1 col-md-1 col-lg-1 pad-none">
										<img src ="images/booked.png">
									</div>
									<div class="col-sm-2 col-md-2 col-lg-2 se-tx pad-none">
										Booked Seats
									</div>
									<div class="col-sm-1 col-md-1 col-lg-1 pad-none">
										<img src ="images/selected.png">
									</div>
									<div class="col-sm-2 col-md-2 col-lg-2 se-tx pad-none">
										Selected Seats
									</div>
									<div class="col-sm-1 col-md-1 col-lg-1 pad-none">
										<img src ="images/reserved.png">
									</div>
									<div class="col-sm-2 col-md-2 col-lg-2 se-tx pad-none">
										Reserved Seats
									</div>
									
								</div>
							</div>
						</div>
						<div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 mb-2 mt-2" style="border-left:1px solid #ccc">
							<p class="text-left table-text-head mb-0"><u>Passengers Details</u></p>
							<p id="passenger_error" style="color: red;display:none;text-align: left;"></p>
							<table id="passenger" class="table-borderless">
							    <thead>
							      <tr>
							        <th class="table-head" width="15%">Seat No</th>
							        <th class="table-head" width="30%">Name</th>
							        <th class="table-head" width="20%">Gender</th>
							        <th class="table-head" width="15%">Age</th>
							        <th class="table-head" width="20%">Cost</th>
							      </tr>
							    </thead>
							    <tbody>
							    </tbody>
							</table>
							<hr></hr>
							<p class="text-left table-text-head mb-0"><u>Room Selection</u></p>
							<p id="room_error" style="color: red;display:none;text-align: left;"></p>
							<table id="room" class="table-borderless">
							    <tbody>
							    </tbody>
						  	</table>
						  	</BR>
						  	<table id="room_add" class="table-borderless">
							    <tbody>
							    	<tr>
							    		<td><button onclick="addRoom()">Add Room</button></td>
							    		<td><button onclick="roomRemove()">Remove Room</button></td>
							    	</tr>
							    </tbody>
						  	</table>
						  	<hr></hr>
							  <div class="row">
							  	<p class="text-left con-det mb-0">Fare Details</p>
							  	<div class="col-sm-12 col-md-12 col-lg-12 con-det">	
							  	<div class="row">				  		
							  		<div class="col-sm-8 col-md-8 col-lg-8">
									 <div class="row ml-1">
									 	<div tag="costDiv" class="col-sm-5 col-md-5 col-lg-5 tic-txt">
									 		Tour Cost
									 	</div>
									 	<div tag="costDiv" class="col-sm-1 col-md-1 col-lg-1 tic-txt">
									 		:
									 	</div>
									 	<div tag="costDiv" class="col-sm-6 col-md-6 col-lg-6 tic-txt">
									 		Rs.<span id="cost">0</span>
									 	</div>
									 	<div tag="serviceChargeDiv" class="col-sm-5 col-md-5 col-lg-5 tic-txt">
									 		Service Charge
									 	</div>
									 	<div tag="serviceChargeDiv" class="col-sm-1 col-md-1 col-lg-1 tic-txt">
									 		:
									 	</div>
									 	<div tag="serviceChargeDiv" class="col-sm-6 col-md-6 col-lg-6 tic-txt">
									 		Rs.<span id="service_charge">0</span>
									 	</div>
									 	<div tag="discountDiv" class="col-sm-5 col-md-5 col-lg-5 tic-txt">
									 		Discount
									 	</div>
									 	<div  tag="discountDiv" class="col-sm-1 col-md-1 col-lg-1 tic-txt">
									 		:
									 	</div>
									 	<div tag="discountDiv" class="col-sm-6 col-md-6 col-lg-6 tic-txt">
									 		Rs.<span id="discount">0</span>
									 	</div>
									 	<div tag="gstDiv" class="col-sm-5 col-md-5 col-lg-5 tic-txt">
									 		GST <span id="gst_percent"></span>%
									 	</div>
									 	<div tag="gstDiv" class="col-sm-1 col-md-1 col-lg-1 tic-txt">
									 		:
									 	</div>
									 	<div tag="gstDiv" class="col-sm-6 col-md-6 col-lg-6 tic-txt">
									 		Rs.<span id="gst">0</span>
									 	</div>
									 </div>
									  
									</div>
								<div class="col-sm-3 col-md-3 col-lg-3 total-fare">
									 	<p class="fare">Total Cost</p>
									 	<p class="fare">Rs.<span id="total_cost">0</span></p>
									 </div>
								</div>
								<div class="col-sm-1 col-md-1 col-lg-1"></div>
							  	</div>					  	
							  </div>
							   <hr></hr>
							  <div class="row">
							  	<p class="text-left con-det mb-0">Contact Details</p>
							  	<div class="col-sm-12 col-md-12 col-lg-12 con-det">
							  		<form class="form-inline">	
							  		  <input type="text" class="form-control in-text mr-3" placeholder="Name" id="contact_name">			 
									  <input type="text" class="form-control in-text mr-3" placeholder="Phone No" id="phone">
									  
									</form>
							  	</div>
							  	<div class="col-sm-12 col-md-12 col-lg-12 con-det">
							  		<form>
							  		<input type="text" class="form-control in-text mr-3" placeholder="Email" id="email">
							  		<BR>
							  		<textarea class="form-control in-text" rows="3" id="address" placeholder="Address" name="text"></textarea>  	
							  		</form>
							  	</div>	
							  	<div class="col-sm-12 col-md-12 col-lg-12 text-center">
							  		<?php if(empty($_SESSION)){ ?>
									<button id="submit" href="#myModal-log" class="btn btn-primary" data-toggle="modal">Submit</button>
									<?php }else{ ?>
									<button id="submit" type="button" onclick="openConfirm()" class="btn btn-primary">Submit</button>
									<?php } ?>
							  		
							  	</div>
							  </div>						
						</div>
					</div>
						</div>
					</div>
					<script>
						var tour_found = true;
					</script>
		        	<?php
			        }
				}
			?>
			

		</div>
	
		<!--Bus Booking Chart-->
		<BR>
		<div id='confirm_booking' style="display: none;">
			<div class="container bus-seat-chart bor" >
				<center><h2>Confirm Booking</h2></center>
				<BR>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="row bor-bott">
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-4">
							<table border="1" width="100%">
								<tr>
									<th colspan="6" class="tour-search text-uppercase">
										<center>Tour Details</center></th>
								</tr>
								<tr>
									<td>
										<label class="tour-search text-uppercase">Tour Name:</label>
									</td>
									<td>
										<label id="text_tour_id" class="sele-place ml-3">
											<?php echo $tour_data['tour_code']." - ".$tour_data['tour_name'];?>
										</label>
									</td>
									<td>
										<label class="tour-search text-uppercase">Duration</label>
									</td>
									<td>
										<label id="text_duration" class="sele-place ml-3">
											<?php echo $tour_data['tour_duration'];?>
										</label>
									</td>
									<td>
										<label for="seat" class="tour-search text-uppercase">Tour Date</label>
									</td>
									<td>
										<label id="text_tour_date" class="sele-place ml-3"></label>
									</td>
								</tr>
								
								<tr>
									<td>
										<label class="tour-search text-uppercase">Pickup Pont</label>
									</td>
									<td>
										<label id="text_pickup" class="sele-place ml-3"></label>
									</td>
									<td>
										<label class="tour-search text-uppercase">Drop Point</label>
									</td>
									<td>
										<label id="text_drop" class="sele-place ml-3"></label>
									</td>
									<td>
										<label class="tour-search text-uppercase">Tour Type</label>
									</td>
									<td>
										<label id="text_tour_type" class="sele-place ml-3"></label>
									</td>
								</tr>
								
							</table>
						</div>
						<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 pad-none">
							<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-4">
									<table border="1" width="100%">
										<tr>
											<th colspan="6" class="tour-search text-uppercase"><center>Contact details</center></th>
										</tr>
										<tr>
											<td>
												<label class="tour-search text-uppercase">Name</label>
											</td>
											<td>
												<label id="text_contact_name" class="sele-place ml-3"></label>
											</td>
											<td>
												<label class="tour-search text-uppercase">Phone No.</label>
											</td>
											<td>
												<label id="text_phone" class="sele-place ml-3"></label>
											</td>
											<td>
												<label class="tour-search text-uppercase">Email</label>
											</td>
											<td>
												<label id="text_email" class="sele-place ml-3"></label>
											</td>
										</tr>
																			
										<tr>
											<td>
												<label class="tour-search text-uppercase">Address</label>
											</td>
											<td colspan="5">
												<label id="text_address" class="sele-place ml-3"></label>
											</td>
										</tr>
									</table>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 mb-2">
									<table border="1" id="text_passenger" width="100%"></table>
								</div>
							</div>
							<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3 pad-none">
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pad-none mb-3">
									<table border="1" width="100%" id="text_cost"></table>
								</div>
								<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pad-none">
									<table border="1" id="text_rooms" width="100%"></table>
								</div>
							</div>
						</div>
						
<!--Contact Details-->


<!--Contact Details-->
					</div>
					<BR>
					<center>
						<button id="back" onclick="backToBooking()" type="button" class="btn btn-primary">Back</button>
						<button id="proceed" onclick="proceed_to_pay()" type="button" class="btn btn-primary">Proceed to Pay</button>
					</center>
					<BR>
				</div>
				
			</div>
		</div>
	</div>	
<BR>

<script>
var room_counter = 0;
$(document).ready(function(){

	$(".bus-seat-chart").hide();
	addRoom();
	resetCost();
    $("label").click(function(){
        if(!$(this).hasClass("reserved")){
            if($(this).find("input").is(":checked")){
            $(this).addClass("selected");
            }else{
                console.log("selected");
                $(this).removeClass("selected");
            }
        }
        else{
            alert("Already booked");
        }
       	checkSeatRoomSelection();
       	resetCost();
    });

	var text = "";
    var td ="";
    var counter = "";
    
    $(".cust-checkbox").click(function(){
   		if(!$(this).hasClass("reserved")){    	
            if($(this).parent().prop('className') == 'selected'){
            	var textArr = text.split(',');
            	textArr = textArr.filter(item => item != trim($(this).next('span').html()));
            	text = textArr.toString();
	   			removePassenger($(this).next('span').html());
	   		}else{
	   			text += (text == '')?"":", "
            	text += $(this).next('span').html();
	   			$('#passenger').append(createPassenger($(this).next('span').html()));
	   		}
        }
    	$('#seat-no').val(text); 
   	});

   	if(typeof tour_found !== 'undefined' && tour_found){
   		updatePickupDropText();
		$('.bus-seat-chart').show();
		window.location.hash ='tour_date'
   	}
	
});

function resetCost(){
	$('#total_cost').html("0");
  	$('#cost').html("0");
  	$('#service_charge').html("0");
  	$('#gst').html("0");
  	$('div[tag=gstDiv]').hide();
  	$('#discount').html("0");
  	$('div[tag=discountDiv]').hide();
  	$('#submit').prop('disabled','disabled');
}

function checkSeatRoomSelection(){
	adult = 0; child = 0;
	resetCost();
	$('input[tag=age]').each(function(){
    	id = $(this).attr('tag_id');
    	name = $('#p_name'+id).val();
    	gender = $('#p_gender'+id).val();
    	age = $(this).val();


    	if(name=='' || gender=='' || age==''){
    		$('#passenger_error').html('All fields are mandatory to check tour cost.').show();
    	}else{
    		if(age > 8){
	    		$('#p_identifier_'+id).html('Adult');
	    		adult += 1;
	    	}else{
	    		$('#p_identifier_'+id).html('Kid');
	    		child += 1;
	    	}
	    	$('#passenger_error').hide();
    	}
	});

	
	if(adult != 0 || child != 0){
		seat_adult = 0; seat_child = 0;
		count = $('.room_row').length;
		if(count > 0){
			for(i=0;i<count;i++){
				seat_adult += parseInt($('#room_adult_'+(i+1)).val());
				seat_child += parseInt($('#room_child_'+(i+1)).val());
			}

			if(seat_adult != adult || seat_child != child){
				$('#room_error').html('Room selection must match with passenger count.').show();
			}else{
				$('#room_error').hide();
				calculate_tour_cost();
			}
		}
	}
	
	
}

function proceed_to_pay(){
	var request = {}
	request['action'] = 'create_booking';
	request['user_id'] = "<?php echo !empty($_SESSION['user_id'])?$_SESSION['user_id']:''; ?>";
	request['contact_name'] = $('#contact_name').val();
	request['phone'] = $('#phone').val();
	request['email'] = $('#email').val();
	request['address'] = $('#address').val();
	request['tour_id'] = "<?php echo $_GET['tour_id']; ?>";
	request['tour_date'] = $('#tour_date').val();
	request['tour_type'] = $('#tour_type').val();
	request['pickup'] = $('#pickup').val();
	request['drop'] = $('#drop').val();
	request['seat_no'] = $('#seat-no').val();

	request['seat_data'] = {};
	counter = 0;
	$('.seat_row').each(function(){
		request['seat_data'][counter] = {}
	    request['seat_data'][counter]['seat'] = $(this).attr('row');
	    request['seat_data'][counter]['name'] = $('#p_name_'+seat).val();
	    request['seat_data'][counter]['gender'] = $('[name=p_gender_'+seat+']:checked').val();
	    request['seat_data'][counter]['age'] = $('#p_age_'+seat).val();
	    counter++;
    });

	request['room_data'] = {};
	counter = 0;
	$('.room_row').each(function(){
		request['room_data'][counter] = {};
		request['room_data'][counter]['adult'] = $('#room_adult_'+(counter+1)).val();
		request['room_data'][counter]['child'] = $('#room_child_'+(counter+1)).val();
		counter++;
	});

	$.ajax({
		url:'requests.php',
		type: 'POST',
	    data:request,
	    success: function (data,status,xhr) {   // success callback function
	        console.log(data);
	        if(trim(data) == 'success'){
	        	window.location.href = "<?php echo WEBROOT;?>" +"payment/index.php"
	        } else if(trim(data) == 'fail'){
	            location.reload();
	        }
	    },
	    error: function (jqXhr, textStatus, errorMessage) { // error callback 
	        console.log('Error: ' + errorMessage);
	    }
	});
}

function openConfirm(){
	var contact_name = trim($('#contact_name').val());
	var phone = trim($('#phone').val());
	var email = trim($('#email').val());
	var address = trim($('#address').val());
	var error = '';

	if(contact_name == ''){
		error += 'Name is mandatory.\n';
	}

	if(phone == ''){
		error += 'Phone is mandatory.\n';
	}else if(!ValidatePhone(phone)){
		error += 'Enter validate phone number.\n';
	}

	if(email == ''){
		error += 'Email is mandatory.\n';
	}else if(!ValidateEmail(email)){
		error += 'Enter validate email.\n';
	}

	if(address == ''){
		error += 'Address is mandatory.\n';
	}

	if(error == ''){
		$('#text_tour_date').html($('#tour_date').val());
		$('#text_pickup').html($('#pickup').val());
		$('#text_drop').html($('#drop').val());
		$('#text_tour_type').html($('#tour_type').val());
		$('#text_contact_name').html($('#contact_name').val());
		$('#text_phone').html($('#phone').val());
		$('#text_email').html($('#email').val());
		$('#text_address').html($('#address').val());


		var text_passenger = '<tr><th colspan="4" class="tour-search text-uppercase">';
		text_passenger += '<center>Passenger Details</center></th></tr>';
		
		$('.seat_row').each(function(){
		    seat = $(this).attr('row');
		    name = $('#p_name_'+seat).val();
		    gender = ($('[name=p_gender_'+seat+']:checked').val() == 'M')?'Male':'Female';
		    age = $('#p_age_'+seat).val();

		    text_passenger += '<tr>';
		    text_passenger += '<td>';
		    text_passenger += '<label class="sele-place ml-3">';
		    text_passenger += seat;
		    text_passenger += '</label>';
		    text_passenger += '</td>';

		    text_passenger += '<td>';
		    text_passenger += '<label class="sele-place ml-3">';
		    text_passenger += name;
		    text_passenger += '</label>';
		    text_passenger += '</td>';

		    text_passenger += '<td>';
		    text_passenger += '<label class="sele-place ml-3">';
		    text_passenger += gender;
		    text_passenger += '</label>';
		    text_passenger += '</td>';

		    text_passenger += '<td>';
		    text_passenger += '<label class="sele-place ml-3">';
		    text_passenger += age;
		    text_passenger += '</label>';
		    text_passenger += '</td>';
		    text_passenger += '</tr>';
		    
		});

		

		var text_rooms = '<tr><th colspan="3" class="tour-search text-uppercase">';
		text_rooms += '<center>Room Details</center></th></tr>';
		text_rooms += '<tr><td><center>No.</center></td>';
		text_rooms += '<td><center>Adults</center></td>';
		text_rooms += '<td><center>Kids</center></td><tr>';
		counter = 1;
		$('.room_row').each(function(){
			text_rooms += '<tr>';
		    text_rooms += '<td>';
		    text_rooms += '<label class="sele-place ml-3">';
		    text_rooms += 'Room No. '+counter;
		    text_rooms += '</label>';
		    text_rooms += '</td>';

		    text_rooms += '<td>';
		    text_rooms += '<label class="sele-place ml-3">';
		    text_rooms += $('#room_adult_'+counter).val();
		    text_rooms += '</label>';
		    text_rooms += '</td>';

		    text_rooms += '<td>';
		    text_rooms += '<label class="sele-place ml-3">';
		    text_rooms += $('#room_child_'+counter).val();
		    text_rooms += '</label>';
		    text_rooms += '</td>';
		    text_rooms += '</tr>';
		    counter++;
		});


		var text_cost = '<tr><th colspan="3" class="tour-search text-uppercase">';
		text_cost += '<center>Cost Details</center></th></tr>';
		text_cost += '<tr>';
	    text_cost += '<td>';
	    text_cost += '<label class="sele-place ml-3">Tour Cost</label>';
	    text_cost += '</td>';
	    text_cost += '<td>';
	    text_cost += '<label class="sele-place ml-3">Rs. '+$('#cost').html()+'</label>';
	    text_cost += '</td>';
		text_cost += '</tr>';

		text_cost += '<tr>';
	    text_cost += '<td>';
	    text_cost += '<label class="sele-place ml-3">Service charge</label>';
	    text_cost += '</td>';
	    text_cost += '<td>';
	    text_cost += '<label class="sele-place ml-3">Rs. '+$('#service_charge').html()+'</label>';
	    text_cost += '</td>';
		text_cost += '</tr>';

		if($('#discount').html() != ''){
			text_cost += '<tr>';
		    text_cost += '<td>';
		    text_cost += '<label class="sele-place ml-3">Discount</label>';
		    text_cost += '</td>';
		    text_cost += '<td>';
		    text_cost += '<label class="sele-place ml-3">Rs. '+$('#discount').html()+'</label>';
		    text_cost += '</td>';
			text_cost += '</tr>';
		}

		if($('#gst_percent').html() != ''){
			text_cost += '<tr>';
		    text_cost += '<td>';
		    text_cost += '<label class="sele-place ml-3">GST</label>';
		    text_cost += '</td>';
		    text_cost += '<td>';
		    text_cost += '<label class="sele-place ml-3">Rs. '+$('#gst').html()+'</label>';
		    text_cost += '</td>';
			text_cost += '</tr>';
		}

		if($('#total_cost').html() != ''){
			text_cost += '<tr>';
		    text_cost += '<td>';
		    text_cost += '<label class="sele-place ml-3">Total cost</label>';
		    text_cost += '</td>';
		    text_cost += '<td>';
		    text_cost += '<label class="sele-place ml-3">Rs. '+$('#total_cost').html()+'</label>';
		    text_cost += '</td>';
			text_cost += '</tr>';
		}

		$('#text_passenger').html(text_passenger);
		$('#text_rooms').html(text_rooms);
		$('#text_cost').html(text_cost);
		$('#confirm_booking').show();
		$('#booking').hide();
	}else{
		alert(error);
	}
	
}

function backToBooking(){
	$('#confirm_booking').hide();
	$('#booking').show();
}


function ValidateEmail(email){
	return (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))? true:false;
}

function ValidatePhone(phone){
	return phone.match(/^\d{10}$/)? true:false;
}



function calculate_tour_cost(){
	count = $('.room_row').length;
	if(count > 0){
		rooms = {};
		for(i=0;i<count;i++){
			rooms[i] = {};
			rooms[i]['adult'] = $('#room_adult_'+(i+1)).val();
			rooms[i]['child'] = $('#room_child_'+(i+1)).val();
		}
	}
	console.log(rooms);

	$.get("requests.php",
		{action:'getTourCost',id:<?php echo $_GET['tour_id'];?>,tour_type:$('#tour_type').val(),rooms:JSON.stringify(rooms)},
		function(data) {

		console.log(data);

	  	var price = JSON.parse(data);
	  	$('#total_cost').html(num_to_rs(price['total_cost']));
	  	$('#cost').html(num_to_rs(price['cost']));
	  	$('#service_charge').html(num_to_rs(price['service_charge']));
	  	if(price['gst'] != 0){
	  		$('#gst').html(num_to_rs(price['gst']));
	  		$('#gst_percent').html(price['gst_percent']);
			$('div[tag=gstDiv]').show();
	  	}else{
	  		$('div[tag=gstDiv]').hide();
	  	}
	  	if(price['discount'] != 0){
	  		$('#discount').html(num_to_rs(price['discount']));
	  		$('div[tag=discountDiv]').show();
	  	}else{
	  		$('div[tag=discountDiv]').hide();
	  	}
	  	$('#submit').removeAttr('disabled');
	});	

}


function addRoom(){
	count = $('.room_row').length;
	id = count + 1;
	var html = "";
	html += '<tr class="room_row" id="room_row_'+id+'">';
	html += '<td class="table-text"><b>Room '+id+': </b></td>';
	html += '<td class="table-text"><form class="form-inline">';
	html += 'Adults&nbsp&nbsp<select onchange="roomCountChecker('+id+',\'adult\')" id="room_adult_'+id+'">';
	html += '<option value="0">0</option>';
	html += '<option value="1">1</option>';
	html += '<option value="2">2</option>';
	html += '<option value="3">3</option>';
	html += '</select>';
	html += '</form></td>';
	html += '<td class="table-text">';
	html += '<form class="form-inline">';
	html += 'Kids&nbsp&nbsp<select onchange="roomCountChecker('+id+',\'child\')" id="room_child_'+id+'">';
	html += '<option value="0">0</option>';
	html += '<option value="1">1</option>';
	html += '<option value="2">2</option>';
	html += '</select>';
	html += '</form>';
	html += '</td>';
	html += '</tr>'; 

	$('#room').append(html);
}

function roomCountChecker(id,event){
	switch(event){
		case 'adult':
			if($('#room_adult_'+id).val() > 2){
				$('#room_child_'+id+' option[value="2"]').hide();
			}else{
				$('#room_child_'+id+' option[value="2"]').show();
			}
			break;
		case 'child':
			if($('#room_child_'+id).val() > 1){
				$('#room_adult_'+id+' option[value="3"]').hide();
			}else{
				$('#room_adult_'+id+' option[value="3"]').show();
			}
			break;
	}
	checkSeatRoomSelection();
}


function roomRemove(id){
	count = $('.room_row').length;
	if(count > 1){
		$('#room_row_'+count).remove();
	}
}

function selectSeat(){

	tour_type = $("#tour_type").val();
	tour_date = $("#tour_date").val();

	if(tour_type != '' &&  tour_date != ''){
		window.location.href = window.location.href + "&date=" + tour_date + "&type=" +tour_type;
	}

}

function updatePickupDropText(){
	$("#pickup_text").html($("#pickup").val());
	$("#drop_text").html($("#drop").val());
}


function formatDate(d) {
  var day = String(d.getDate())
  //add leading zero if day is is single digit
  if (day.length == 1)
    day = '0' + day
  var month = String((d.getMonth()+1))
  //add leading zero if month is is single digit
  if (month.length == 1)
    month = '0' + month
 //console.log(day + "/" + month + "/" + d.getFullYear());
  return day + "/" + month + "/" + d.getFullYear()
}


function createPassenger(id){
	var html = "";
	html += '<tr row="'+id+'" class="seat_row" id="row_'+id+'">';
	html += '<td class="table-text" width="15%">'+id+'</td>';
	html += '<td class="table-text" width="30%"><form class="form-inline">				 ';
	html += '<input type="text" class="form-control in-text" placeholder="Passenger Name" id="p_name_'+id+'">';
	html += '</form></td>';
	html += '<td class="table-text" width="20%">';
	html += '<form class="form-inline">';
	html += '<label class="form-check-label" style="margin: 0px auto;">';
	html += '<input type="radio" value="M" class="form-check-input table-text mr-1" name="p_gender_'+id+'">M';
	html += '<input type="radio" value="F" class="form-check-input table-text ml-1" name="p_gender_'+id+'">F';
	html += '</label>';
	html += '</form>';
	html += '</td>';
	html += '<td class="table-text" width="15%"><form class="form-inline">				 ';
	html += '<input type="number" tag="age" tag_id="'+id+'" class="form-control in-text in-age" placeholder="Age" id="p_age_'+id+'" onchange="checkSeatRoomSelection();">';
	html += '</form></td>';
	html += '<td class="table-text" width="20%"><label id="p_identifier_'+id+'"></label></td>';
	html += '</tr>'; 

	return html;
}

function removePassenger(id){
	alert(id);
	$('#row_'+id).remove();
}


function num_to_rs(x){
	x=x.toString();
	var afterPoint = '';
	if(x.indexOf('.') > 0)
	   afterPoint = x.substring(x.indexOf('.'),x.length);
	x = Math.floor(x);
	x=x.toString();
	var lastThree = x.substring(x.length-3);
	var otherNumbers = x.substring(0,x.length-3);
	if(otherNumbers != '')
	    lastThree = ',' + lastThree;
	return res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
}


function trim(str){
	return str.replace(/^\s+|\s+$/g,"");
}

$(function () {
	<?php
		$query = "SELECT GROUP_CONCAT(date) as dates FROM `bus_dates` WHERE tour_id=".$_GET['tour_id'].";";
        $fetch_data = mysqli_query($con,$query);    
        $records = $fetch_data->fetch_assoc();
    ?>
    var setDate = '<?php echo isset($_GET["date"]) ? $_GET['date'] : "" ; ?>';
	var enableDays = "<?php echo $records['dates'];?>";
	var date = new Date();
	date.setDate(date.getDate());
	$("#tour_date").datepicker({ 
        maxViewMode: 2,
        weekStart: 1,
        startDate: date,
        value: setDate,
        disableDates: function(date){
        	let today = new Date();
          	let current = formatDate(date);
          	if(today>=date){
          		return false;
          	}
      		return enableDays.indexOf(current) != -1
        },
        todayHighlight: true,
        format: "dd/mm/yyyy", 
        clearBtn: true,
        enabled: false,
        autoclose: true,
        uiLibrary: 'bootstrap4'
  	});

	// if(setDate != ''){
	// 	$("#tour_date").val(setDate);
	// }
  	

});	



</script>
</body>
</html>
