<?php include 'queries.php'; ?>
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
<?php 
	include 'headers.php'; 
	$link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 
                "https" : "http") . "://" . $_SERVER['HTTP_HOST'] .  
                $_SERVER['REQUEST_URI']; 

	$query = "SELECT * FROM tours WHERE id=".$_GET['id'].";";
    $fetch_data = mysqli_query($con,$query);    
    $tour_data = $fetch_data->fetch_assoc();            
?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="images/tours/<?php echo $tour_data['display_image'];?>" class="img-fluid"></div>
<!--BreadCrumps-->
	<form>
		<div class="row m-4">
			<div class="col- col-sm-12 col-md-12 col-lg-12">
				<ul class="breadcrumb br-crum">
			    <li class="breadcrumb-item"><a href="<?php echo LIVEROOT;?>">Home</a></li>
			    <?php
			    if(isset($_GET['q']) && $_SERVER['HTTP_REFERER'] != '' && $_SERVER['HTTP_REFERER'] != $link){ 
			    ?>
			    	<li class="breadcrumb-item"><a href="<?php echo $_SERVER['HTTP_REFERER'];?>"><?php echo $_GET['q'];?></a></li>
				<?php } ?>
			    <li class="breadcrumb-item active"><?php echo $tour_data['tour_code']." - ".$tour_data['tour_name'];?></li>
			  </ul>
			</div>
		</div>
	</form>
	<!--BreadCrumps-->
	
	<!--Package Details-->
	<div class="container">
		<div class="row pack-bac">
			<div class="col-sm-4 col-md-4 col-lg-4">
				<span class="tour-search text-uppercase">Tour Id: <?php echo $tour_data['tour_code'];?></span>
				<h5><?php echo ucwords($tour_data['tour_name']);?></h5>
			</div>
			<div class="col-sm-2 col-md-2 col-lg-2">
				<span class="tour-search text-uppercase">Days</span>
				<h6><?php echo $tour_data['tour_duration'];?></h6>
			</div>
			<div class="col-sm-2 col-md-2 col-lg-2">
				<span class="tour-search text-uppercase">Cost Per Person</span>
				<h4>Rs.<?php echo $tour_data['tour_price'];?>/-</h4>
			</div>

			<!-- <div class="col-sm-2 col-md-2 col-lg-2 align-self-center bknowbox">
				<a href="ashtvinayak-bus-booking.php?tour_id=<?php echo $_GET['tour_id']; ?>" class="btn btn-primary bknow-butt">BOOK NOW</a>
			</div> -->

			<div class="col-sm-2 col-md-2 col-lg-2 bknowbox" id="group_dates_div">
				<span class="tour-search text-uppercase">Group Tour Dates</span>
					<input id="group_dates" >
			</div>

			<div class="col-sm-2 col-md-2 col-lg-2 align-self-center bknowbox">
				<a href="#" class="btn btn-primary bknow-butt" data-toggle="modal" data-target="#tour_page_enqiry">Tour Enquiry</a>


			<!-- The Modal -->
			<div class="modal fade" id="tour_page_enqiry">
			<div class="modal-dialog" style="position: absolute;">
			  <div class="modal-content mod-con">
			  
			    <!-- Modal Header -->
			    <div class="modal-header mod-header">
			      <h6 class="modal-title"><?php echo $tour_data['tour_code'];?> - <?php echo ucwords($tour_data['tour_name']);?> Enquiry</h6>
			      <button type="button" class="close" data-dismiss="modal">&times;</button>
			    </div>
			    
			    <!-- Modal body -->
			    <form method="post" name="enquiry_form" id="tour_enquiry_form" >
			    <div class="modal-body">
			    	<div class="row form-group">
			    		<label id="tour_enquiry_form_msg" class="enquiry-msg" style="display:none;"></label>
			    	</div>
			        <div class="row form-group" id="tour_enquiry_form_div">
			        	<input type="hidden" name="action" value="enquiry">
			        	<div class="col-sm-12 col-md-12 col-lg-12">
			        		<input type="Name" class="form-control mod-in" id="tour_enquiry_name" name="name" placeholder="Name">
			        		<p class="field-error"></p>
			        	</div>
			        	<div class="col-sm-12 col-md-12 col-lg-12">
			        		<input type="text" class="form-control mod-in" id="tour_enquiry_email" name="email" placeholder="Email Id">
			        		<p class="field-error"></p>
			        	</div>
			        	<div class="col-sm-6 col-md-6 col-lg-6">
			        		<input type="text" class="form-control mod-in" id="tour_enquiry_mobile" name="mobile" placeholder="Mobile Number">
			        		<p class="field-error"></p>
			        	</div>
			        	<div class="col-sm-6 col-md-6 col-lg-6">
			        		<input type="text" class="form-control mod-in" id="tour_enquiry_city_of_guest" name="city_of_guest" placeholder="City of Residence">
			        		<p class="field-error"></p>
			        	</div>
			        	
			        	<div class="col-sm-6 col-md-6 col-lg-6">
			        		<input type="text" class="form-control mod-in" id="tour_enquiry_time_to_travel" name="time_to_travel" placeholder="Time To Travel">
			        	</div>
			        			        	
			        	<div class="col-sm-6 col-md-6 col-lg-6">
			        		<select class="form-control mod-in dest-text bt-gr" id="tour_enquiry_mode_to_contact" name="mode_to_contact">
			        			<option value="">Connect By</option>
						        <option value="Call">Call</option>
						        <option value="Email">Email</option>
						        <option value="Text Message">Text Message</option>
						        <option value="Whatsapp">Whatsapp</option>
						    </select>
			        	</div>
			        	<input type="hidden" name="tour" value="<?php echo $tour_data['tour_code'];?> - <?php echo ucwords($tour_data['tour_name']);?>">
			        	<input type="hidden" name="duration" value="<?php echo $tour_data['tour_duration'];?>">
			        </div>	         
				</form>
			    </div>
			    <!-- Modal footer -->
			    <div class="modal-footer">
			      <button type="button" id="tour_enquiry_submit" class="btn btn-success" onclick="submitTourEnquiry()">Submit</button>
			    </div>
			    </form>
			  </div>
			</div>
			</div>

			<!--Modal-->





			</div>

		</div>
	</div>
	<!--Package Details-->
	<!--Package list-->
	<div class="container">
	
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			
	<!--TabPanel-->
			<div class="d-none d-sm-block">
				  <ul class="nav nav-tabs pan-nav-tab" role="tablist">
				    <li class="nav-item">
				      <a class="nav-link pan-tab active text-uppercase" data-toggle="tab" href="#home">Itinerary</a>
				    </li>
				   <!--  <li class="nav-item">
				      <a class="nav-link pan-tab text-uppercase" data-toggle="tab" href="#menu1">Hotel Details</a>
				    </li> -->
				    <li class="nav-item">
				      <a class="nav-link pan-tab text-uppercase" data-toggle="tab" href="#menu2">Tour Cost</a>
				    </li>
				    <li class="nav-item">
				      <a class="nav-link pan-tab text-uppercase" data-toggle="tab" href="#menu3">Inclusions & Exclusions</a>
				    </li>
			<!-- 	   
				    <li class="nav-item">
				      <a class="nav-link pan-tab text-uppercase" data-toggle="tab" href="#menu5">Terms & Conditions</a>
				    </li> -->
				    <li class="nav-item">
				      <a class="nav-link pan-tab text-uppercase" data-toggle="tab" href="#menu6">Terms and conditions</a>
				    </li>
				    <?php
				    	if(isset($tour_data['special_note']) && $tour_data['special_note']!=''){ ?>
				    <li class="nav-item">
				      <a class="nav-link pan-tab text-uppercase" data-toggle="tab" href="#menu7">Special Note</a>
				    </li>	

				    <?php } ?>
				  </ul>
		</div>
  <!-- Tab panes -->
			  <div class="tab-content d-none d-sm-block">
			    <div id="home" class="container tab-pane active"><br>
			    	<?php echo $tour_data['itenerary'];?>
			      <!-- <h3>Itinerary</h3>
			      	<?php 
			      		$itenerary = json_decode($tour_data['itenerary_json']);
			      		foreach ($itenerary as $key => $val){
			      	?>
			       		<div class="itnry_inr_row">
                          <div class="itnry_head_wrap">
                              <span class="days_box"><strong><?php echo $key;?></strong></span><strong> <span class="itnry_heading">: <?php echo $val->Title;?></span></strong>
                          </div>
                          <div class="touritnry-detail">
                            <p><?php echo $val->Description;?></p>                 
                          </div>
                     	</div>
                     <?php } ?> -->
			    </div>
			    <div id="menu1" class="container tab-pane fade"><br>
			      <h3>Hotel Details</h3>
			      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			    </div>
			    <div id="menu2" class="container tab-pane fade"><br>
			      <table border="1" style="width: 100%;">
			      	<?php 
			      		$rates = json_decode($tour_data['rates_json'],true);
			      	?>
			      	<tr>
				      	<th width="45%"></th>
				      	<?php foreach ($rates as $key => $val){ 
				      			foreach ($val as $type => $price){ 
				      	?>
				      			<th><center><?php echo strtoupper(str_replace("_"," ",$type));?></center></th>
				      	<?php } break; }?>
				    </tr>
				    <?php foreach ($rates as $key => $val){?>
			    		<tr>
			    			<?php
			    				if($val['standard'] != '' && $val['deluxe'] != '' && $val['super_deluxe'] != '' ){
			    			?>
			    			<th><?php echo $rate_identifiers[$key];?></th>
			    			<?php foreach ($val as $type => $price){ ?>
			    				<th><center><h6><?php echo '₹ '.money_format('%!i', $price);?>/-</h6></center></th>
			    			<?php  } } ?>
			    		</tr>
				    <?php } ?>	
				    
			      </table>
			      <BR>
			    </div>
			    <div id="menu3" class="container tab-pane fade"><br>
			      <h3>Inclusions</h3>
			      <span><?php echo $tour_data['inclusive'];?></span>
			      <BR>
			      <h3>Exclusions</h3>
			      <span><?php echo $tour_data['exclusive'];?></span>
			    </div>
			    
			    <div id="menu6" class="container tab-pane fade"><br>
			     	<div class="row">
						<?php echo $site_cms['atnc'];?>
					</div>
				</div>
				<div id="menu7" class="container tab-pane fade"><br>
			     	<div class="row">
						<?php echo $tour_data['special_note'];?>
					</div>
				</div>
			    </div>
			  </div>
			  <BR>
	<!--TabPanel-->

	<!--Accordian for mobile-->
	  <div id="accordion" class="d-lg-none">
    <div class="card">
      <div class="card-header">
        <a class="card-link" data-toggle="collapse" href="#collapseOne">
          Collapsible Group Item #1
        </a>
      </div>
      <div id="collapseOne" class="collapse show" data-parent="#accordion">
        <div class="card-body">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
        Collapsible Group Item #2
      </a>
      </div>
      <div id="collapseTwo" class="collapse" data-parent="#accordion">
        <div class="card-body">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </div>
      </div>
    </div>
    <div class="card">
      <div class="card-header">
        <a class="collapsed card-link" data-toggle="collapse" href="#collapseThree">
          Collapsible Group Item #3
        </a>
      </div>
      <div id="collapseThree" class="collapse" data-parent="#accordion">
        <div class="card-body">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </div>
      </div>
      <div id="collapseThree" class="collapse" data-parent="#accordion">
        <div class="card-body">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </div>
      </div>
      <div id="collapseThree" class="collapse" data-parent="#accordion">
        <div class="card-body">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </div>
      </div>
      <div id="collapseThree" class="collapse" data-parent="#accordion">
        <div class="card-body">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
        </div>
      </div>
    </div>
  </div>

	<!--Accordian for mobile-->
		</div>
	</div>
</div>
<?php include 'footer.php'; ?>
<script type="text/javascript">
	$(function () {
		<?php
			$query = "SELECT GROUP_CONCAT(date) as dates FROM `group_tour_dates` WHERE tour_id=".$_GET['id'].";";
	        $fetch_data = mysqli_query($con,$query);    
	        $records = $fetch_data->fetch_assoc();

	        if(isset($records['dates']) && $records['dates'] != ''){
    	?>

			var setDate = '';
			var enableDays = "<?php echo $records['dates'];?>";
			var date = new Date();
			date.setDate(date.getDate());
			
			$("#group_dates").datepicker({ 
		        maxViewMode: 2,
		        weekStart: 1,
		        startDate: date,
		        value: setDate,
		        disableDates: function(date){
		        	let today = new Date();
		        	today.setDate(today.getDate() - 1);
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
			<?php
		}else{ ?>
			$("#group_dates_div").hide();
		<?php } ?>

	});	

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

	function submitTourEnquiry(){
		error = false;
		$('.field-error').html("");
		var name = trim($('#tour_enquiry_name').val());
		var email = trim($('#tour_enquiry_email').val());
		var mobile = trim($('#tour_enquiry_mobile').val());
		var city_of_guest = trim($('#tour_enquiry_city_of_guest').val());

		if(name == ''){
			$('#tour_enquiry_name').next().html("Required field");
			error = true;
		}

		if(email == ''){
			$('#tour_enquiry_email').next().html("Required field");
			error = true;
		}

		if(mobile == ''){
			$('#tour_enquiry_mobile').next().html("Required field");
			error = true;
		}

		if(city_of_guest == ''){
			$('#tour_enquiry_city_of_guest').next().html("Required field");
			error = true;
		}

		if(!error){
			$.ajax({
				url:'requests.php',
				type: 'POST',
			    data:$('#tour_enquiry_form').serialize(),
			    success: function (data,status,xhr) {   // success callback function
			        console.log(data);
			        msg = "";
			        if(data.indexOf("token=") !== -1){
			        	token = data.replace("token=", "");
			        	msg = "Token "+token+" generated for the enquiry. Tour specialist will get in touch with you shorty.";
			        }else{
			        	msg = "Something went wrong. Please reload the page and try again.";
			        }
			        $('#tour_enquiry_form_div').hide();
			        $('#tour_enquiry_submit').hide();
			        $('#tour_enquiry_form_msg').html(msg).show();
			    },
			    error: function (jqXhr, textStatus, errorMessage) { // error callback 
			        console.log('Error: ' + errorMessage);
			    }
			});
		}
	}

</script>

</body>
</html>
