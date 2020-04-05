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
	<title>Shravani-Tourism</title>
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
			$query = "SELECT id,tour_code,tour_name,tour_duration,tour_desc,display_image FROM tours WHERE tour_name LIKE '%ashtavinayak%';";
            $fetch_data = mysqli_query($con,$query);    
            while($tour_data = $fetch_data->fetch_assoc()){
            ?>
            
			<div class="col-12 col-sm-4 col-md-4 col-lg-4 mb-5">
				<a href="ashtvinayak-package-detail.php?tour_id=<?php echo $tour_data['id'];?>" border="0px">
			   		 	<img src="images/tours/<?php echo $tour_data['display_image'];?>" class="img-thumbnail card-img-bor-rad img-fluid" alt="Cinque Terre"  style="width:95%">
			   		 </a>
			</div>
			<div class="col-12 col-sm-8 col-md-8 col-lg-8 mb-5">
				<div class="tx-al-le text-uppercase col-sm-12 col-md-12 col-lg-12 nopadd-mar"><?php echo $tour_data['tour_code'];?> / <?php echo $tour_data['tour_name'];?><br></div>
	      		
	      		<div class="ca-tx nopadd-mar"><?php echo $tour_data['tour_duration'];?><br><br>
				<?php echo $tour_data['tour_desc'];?></div>
				<div class="nopadd-mar mt-5">
					<a href="ashtvinayak-package-detail.php?tour_id=<?php echo $tour_data['id'];?>"><label class="btn btn-default more-det">More Details</label>
					</a>
				</div>
			</div>
				
	  		<?php
			}
			?>	
		</div>
		

			
	</div>
</div>
	<!--Pagination-->
	<!-- <div class="col- col-sm-12 col-md-12 col-lg-12">
		<ul class="pagination pagination-sm">
		    <li class="page-item"><a class="page-link pg-link" href="#">Previous</a></li>
		    <li class="page-item"><a class="page-link pg-link" href="#">1</a></li>
		    <li class="page-item"><a class="page-link pg-link" href="#">2</a></li>
		    <li class="page-item"><a class="page-link pg-link" href="#">3</a></li>
		    <li class="page-item"><a class="page-link pg-link" href="#">Next</a></li>
		</ul>
	</div> -->
	<!--Pagination-->
	</div>
	<!--Package list-->
</div>
<?php include 'footer.php'; ?>


</body>
</html>
