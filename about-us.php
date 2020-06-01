<?php include 'queries.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>About Us</title>
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
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="images/tours/<?php echo $site_images['about_us_cover_image'];?>" class="img-fluid"></div>

<!--Search-->
	<form>
		<div class="row m-4">
			<div class="col- col-sm-12 col-md-12 col-lg-12">
				<ul class="breadcrumb br-crum">
			    <li class="breadcrumb-item"><a href="<?php echo LIVEROOT;?>">Home</a></li>
			    <li class="breadcrumb-item active">About Us</li>
			  </ul>
			</div>
		
	<!--Package list-->
	<div class="container">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			<?php echo $site_cms['about_us'];?>
		</div>
	</div>
	<!--Package list-->
</div>
<?php include 'footer.php'; ?>
</body>
</html>
