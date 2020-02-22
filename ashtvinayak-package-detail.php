<?php

include_once("configs/defines.php");
include("configs/settings.php");
$est =new settings();
$con=$est->connection();
session_start(); 
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
	<?php
			$query = "SELECT * FROM tours WHERE id=".$_GET['tour_id'].";";
            $fetch_data = mysqli_query($con,$query);    
            $tour_data = $fetch_data->fetch_assoc();            
    ?>
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

			<div class="col-sm-2 col-md-2 col-lg-2 align-self-center bknowbox">
				<a href="ashtvinayak-bus-booking.php?tour_id=<?php echo $_GET['tour_id']; ?>" class="btn btn-primary bknow-butt">BOOK NOW</a>
			</div>
			<div class="col-sm-2 col-md-2 col-lg-2 bknowbox">
			<span class="tour-search text-uppercase">Group Tour Dates</span>
				<a href="#"><i class="fa fa-calendar fa-2x fa-purple" aria-hidden="true" data-toggle="modal" data-target="#myModal"></i></a>
				 <!-- The Modal -->
					  <div class="modal fade" id="myModal">
					    <div class="modal-dialog modal-sm">
					      <div class="modal-content gr-dt-modal">
					      
					        <!-- Modal Header -->
					        <div class="modal-header gr-dt-top">
					          <h6 class="modal-title text-uppercase">Group Tour Dates</h6>
					          <button type="button" class="close" data-dismiss="modal">&times;</button>
					        </div>
					        
					        <!-- Modal body -->
					        <div class="modal-body text-left">
					          November 2019 : 1, 8, 15, 22, 29<br/>
					          December 2019 : 7, 14, 21, 28
					        </div>
					       				       		        
					      </div>
					    </div>
					  </div>
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
				      <a class="nav-link pan-tab text-uppercase" data-toggle="tab" href="#menu6">PickUp-Drop Point & Timing</a>
				    </li>
				  </ul>
		</div>
  <!-- Tab panes -->
			  <div class="tab-content d-none d-sm-block">
			    <div id="home" class="container tab-pane active"><br>
			      <h3>Itinerary</h3>
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
                     <?php } ?>
			    </div>
			    <div id="menu1" class="container tab-pane fade"><br>
			      <h3>Hotel Details</h3>
			      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
			    </div>
			    <div id="menu2" class="container tab-pane fade"><br>
			      <h3>Tour Cost</h3>
			      <table border="1" style="width: 100%;">
			      	<?php 
			      		$rates = json_decode($tour_data['rates_json']);
			      		
			      	?>
			      	<tr>
				      	<th width="300px"></th>
				      	<?php foreach ($rates as $key => $val){ 
				      		foreach ($val as $type => $price){ 
				      	?>
				      		<th><center><?php echo $type;?></center></th>
				      	<?php } break; }?>
				    </tr>
				    <?php foreach ($rates as $key => $val){?>
			    		<tr>
			    			<th><?php echo $key;?></th>
			    			<?php foreach ($val as $type => $price){ ?>
			    				<th><center><h6>Rs.<?php echo $price;?>/-</h6></center></th>
			    			<?php } ?>
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
			    
			    <div id="menu5" class="container tab-pane fade"><br>
			      <h3>Terms & Conditions</h3>
			      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
			    </div>
			    <div id="menu6" class="container tab-pane fade"><br>
			      <div class="row">
					<div class="col-sm-6 col-lg-6">
					   <div class="card card-bor">
					   		<table border="1">
					   			<tr>
					   				<thead><center><h5>PickUp Point & Timing</h5></center></thead>
					   			</tr>
					   			<?php
								$query = "SELECT * FROM ashtavinayak_pickup_drop WHERE type='pickup';";
					            $fetch_data = mysqli_query($con,$query);    
					            while($pick_drop = $fetch_data->fetch_assoc()){           
							    ?>
							    	<tr>
					   					<th><center><h6><?php echo $pick_drop['point'];?></h6></center></th>
					   				</tr>
								<?php } ?>
					   		</table>
				  		</div>
					</div>	
					<div class="col-sm-6 col-lg-6">
					    <div class="card card-bor">
					   		 <table border="1">
					   			<tr>
					   				<thead><center><h5>Drop Point & Timing</h5></center></thead>
					   			</tr>
					   			<?php
								$query = "SELECT * FROM ashtavinayak_pickup_drop WHERE type='drop';";
					            $fetch_data = mysqli_query($con,$query);    
					            while($pick_drop = $fetch_data->fetch_assoc()){           
							    ?>
							    	<tr>
					   					<th><center><h6><?php echo $pick_drop['point'];?></h6></center></th>
					   				</tr>
								<?php } ?>
					   		</table>
				  		</div>
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
</body>
</html>
