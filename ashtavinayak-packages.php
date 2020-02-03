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
	<title>Index</title>
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

<!--Search-->
	<form>
		<div class="row m-4">
			<div class="col- col-sm-12 col-md-12 col-lg-12">
				<ul class="breadcrumb br-crum">
			    <li class="breadcrumb-item"><a href="#">Home</a></li>
			    <li class="breadcrumb-item active">Ashtavinayak Tours</li>
			  </ul>
			</div>
		
	<!--Package list-->
	<div class="container">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<h4 class="text-center text-uppercase pt-4 pb-4">Ashtavinayak Tours</h4>
		<div class="row">
			<?php
			$query = "SELECT id,tour_name,tour_duration FROM tours WHERE tour_name LIKE '%ashtavinayak%';";
            $fetch_data = mysqli_query($con,$query);    
            while($tour_data = $fetch_data->fetch_assoc()){
               //	 print_r($tour_data);
            ?>
			<div class="col-12 col-sm-4 col-md-4 col-lg-4 mb-4">
				<div class="card card-bor">
			   		 <a href="ashtvinayak-package-detail.php?tour_id=<?php echo $tour_data['id'];?>" border="0px"><img class="card-img-top card-img-bor-rad img-fluid" src="images/ashtvinayak01.jpg" alt="Card image" style="width:100%"></a>
			   		 <div class="card-body ca-bo row">
		      		<div class="card-title tx-al-le text-uppercase col-sm-8">
		      			<?php echo $tour_data['tour_name'];?><br>
		      		</div>
		      		<div class="card-title tx-al-ri text-uppercase col-sm-4 nopadd-mar"><?php echo $tour_data['tour_duration'];?></div>
		      		<!-- <p class="card-text ca-tx pl-3">Shastrokt Ashtavinayak Yatra...3N/4D</p> -->
		      	 </div>
	  			</div>
			</div>
			<?php
			}
			?>
			</div>
	</div>
	<!--Pagination-->
	<div class="col- col-sm-12 col-md-12 col-lg-12">
		<ul class="pagination pagination-sm">
		    <li class="page-item"><a class="page-link pg-link" href="#">Previous</a></li>
		    <li class="page-item"><a class="page-link pg-link" href="#">1</a></li>
		    <li class="page-item"><a class="page-link pg-link" href="#">2</a></li>
		    <li class="page-item"><a class="page-link pg-link" href="#">3</a></li>
		    <li class="page-item"><a class="page-link pg-link" href="#">Next</a></li>
		</ul>
	</div>
	<!--Pagination-->
	</div>
	<!--Package list-->
</div>
<?php include 'footer.php'; ?>


</body>
</html>
