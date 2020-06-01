<?php include 'queries.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Shravani-Tourism</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/accordion1.css">
	<link rel="stylesheet" href="css/shravani.css" >
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<!-- Multilple Images Slider -->
    <link rel="stylesheet" href="http://netdna.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link href="http://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
 	<!-- Multiple Images Slider -->
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 
	<script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script type="text/javascript" src="js/pana-accordion.js"></script>
</head>
<body>
<div class="container-fluide">
	<?php 
		include 'headers.php'; 
		$query = "SELECT * FROM tour_categories WHERE name LIKE '%Family Holiday Tours%' limit 1;";
    	$fetch_data = mysqli_query($con,$query);
    	$tour_category_data = $fetch_data->fetch_assoc();


    	$query = "SELECT * FROM tour_subcategories WHERE category_id = '".$tour_category_data['id']."';";
    	$tour_subcategory = mysqli_query($con,$query);
	?>
	<form>
		<div class="m-1">
			<div class="col- col-sm-12 col-md-12 col-lg-12">
				<ul class="breadcrumb br-crum">
			    <li class="breadcrumb-item"><a href="<?php echo LIVEROOT;?>">Home</a></li>
			    <li class="breadcrumb-item active">Family Holiday Tours</li>
			  </ul>
			</div>
		</div>
	</form>
<!--Carousel-->
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">
  	<?php
    		$slider_images = json_decode($site_images['family_tour_slider'],true);
    		$active = "active";
    		for($i=0;$i<count($slider_images);$i++){ ?>
    			 <div class="carousel-item <?php echo $active;?>">
			      <img class="d-block w-100" src="images/tours/<?php echo $slider_images[$i];?>" >
			    </div>
    		<?php	
    			$active = '';
    		} ?>
  </div>
  <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
<!--Carousel-->

	<!--Package list-->
	<div class="container">
	<!-- Multiple Image Slider-->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pad-none">
		<h4 class="text-left text-uppercase pt-4 pb-4">Themed Holiday Packages</h4>
		<div id="mixedSlider">
                    <div class="MS-content">
                    	<?php while($subcat_data = $tour_subcategory->fetch_assoc()) { ?>
                    		<div class="item">
                    			<a href="<?php echo LIVEROOT;?>packages.php?q=<?php echo $subcat_data['name'];?>&category=<?php echo $tour_category_data['name'];?>&subcategory=<?php echo $subcat_data['name'];?>">
		                            <div class="imgTitle">
		                                <div class="blogTitle"><?php echo $subcat_data['name'];?></div>
		                                <img src="images/tours/<?php echo $subcat_data['display_image'];?>" alt="" />
		                            </div>
		                        </a>
	                           <!--  <p>Lorem ipsum dolor sit amet...</p> -->
	                            
	                        </div>
                    	<?php }?>
                        <!-- <div class="item">
                            <div class="imgTitle">
                                <div class="blogTitle">Pilgrim Special</div>
                                <img src="images/pl-01.jpg" alt="" />
                            </div>
                            <p>Lorem ipsum dolor sit amet...</p>
                            <a href="#">View More</a>
                        </div>
                        <div class="item">
                            <div class="imgTitle">
                                <div class="blogTitle">Family Trip</div>
                                <img src="images/fa-01.jpg" alt="" />
                            </div>
                           <p>Lorem ipsum dolor sit amet...</p>
                            <a href="#">View More</a>
                        </div>
                        <div class="item">
                            <div class="imgTitle">
                                <div class="blogTitle">Honeymoon</div>
                                <img src="images/ho-01.jpg" alt="" />
                            </div>
                           <p>Lorem ipsum dolor sit amet...</p>
                            <a href="#">View More</a>
                        </div>
                        <div class="item">
                            <div class="imgTitle">
                                <div class="blogTitle">Short Break</div>
                                <img src="images/sb-01.jpg" alt="" />
                            </div>
                            <p>Lorem ipsum dolor sit amet...</p>
                            <a href="#">View More</a>
                        </div>
                        <div class="item">
                            <div class="imgTitle">
                                <div class="blogTitle">Women's Special</div>
                                <img src="images/ws-01.jpg" alt="" />
                            </div>
                           <p>Lorem ipsum dolor sit amet...</p>
                            <a href="#">View More</a>
                        </div> -->
                       
                    </div>
                    <div class="MS-controls">
                        <button class="MS-left"><i class="fa fa-angle-left" aria-hidden="true"></i></button>
                        <button class="MS-right"><i class="fa fa-angle-right" aria-hidden="true"></i></button>
                    </div>
                </div>

	</div>
	<!-- Multiple Image Slider-->
	<!--Top Domestic Holidays-->
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<h4 class="text-left text-uppercase pt-4 pb-4">Top Domestic Holidays</h4>
		<div class="row">
			<?php
			$query = "SELECT * FROM states WHERE id_state IN (".$site_content['family_tour_states'].");";
			$fetch_data = mysqli_query($con,$query);
			while($fields  = $fetch_data->fetch_assoc()) {?>
				<div class="col-6 col-sm-4 col-md-4 col-lg-4 mb-4">
					<div class="card card-bor-rad">
					  <img class="card-img-top card-img-red" src="images/tours/<?php echo $fields['cover_image']; ?>" alt="Card image cap">
					  <div class="card-body ca-bo-pa">
					   <div class="row">

					   <?php
							$query = "SELECT * FROM tours WHERE tour_state = ".$fields['id_state']." ORDER BY id DESC LIMIT 4;";
							$tour_fetch_data = mysqli_query($con,$query);
							while($tour_fields  = $tour_fetch_data->fetch_assoc()) {?>
							   <div class="col-sm-7 col-md-7 col-lg-7 text-left">
							   	<a href="<?php echo LIVEROOT;?>package-details.php?id=<?php echo $tour_fields['id']; ?>" class="card-text">
							   		<?php echo $tour_fields['tour_name']; ?>
							   	</a>
							   </div>

							   <div class="col-sm-5 col-md-5 col-lg-5 text-right">
							   		<a href="<?php echo LIVEROOT;?>package-details.php?id=<?php echo $tour_fields['id']; ?>" class="card-text">₹<?php echo $tour_fields['tour_price']; ?></a>
							   </div>
						<?php } ?>

					  <!--  <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Kerala Family Trip</a></div>
					   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹18,000</a></div>
					   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Kerala Special</a></div>
					   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹32,000</a></div> -->
					    <div class="col-sm-12 col-md-12 col-lg-12 text-center pad-none">
					   	<button class="btn btn-default view-but">View More</button>
					   </div>
					   </div>
					  </div>
					</div>
				</div>

			<?php } ?>

					
		<!-- 	<div class="col-6 col-sm-4 col-md-4 col-lg-4 mb-4">
				<div class="card card-bor-rad">
				  <img class="card-img-top card-img-red" src="images/cust-kashmir.jpg" alt="Card image cap">
				  <div class="card-body ca-bo-pa">
				   <div class="row">
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Honeymoon in Kashmir</div></a>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹35,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Highlights of Kashmir</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹25,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Kashmir Family Trip</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹18,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Kashmir Special</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹32,000</a></div>
				   </div>
				   <div class="col-sm-12 col-md-12 col-lg-12 text-center pad-none">
				   	<button class="btn btn-default view-but">ViewMore</button>
				   </div>
				  </div>
				</div>
			</div>		
			<div class="col-6 col-sm-4 col-md-4 col-lg-4 mb-4">
				<div class="card card-bor-rad">
				  <img class="card-img-top card-img-red" src="images/cust-rajasthan.jpg" alt="Card image cap">
				  <div class="card-body ca-bo-pa">
				    <div class="row">
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Honeymoon in Rajasthan</div></a>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹35,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Highlights of Rajasthan</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹25,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Rajasthan Family Trip</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹18,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Rajasthan Special</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹32,000</a></div>
				    <div class="col-sm-12 col-md-12 col-lg-12 text-center pad-none">
				   	<button class="btn btn-default view-but">View More</button>
				   </div>
				   </div>
				  </div>
				</div>
			</div> -->			
		</div>
	</div>
	<!--Top Domestic Holidays-->

	<!--Top International Holidays-->
	<!-- <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
	<h4 class="text-left text-uppercase pt-4 pb-4">Top International Holidays</h4>
		<div class="row">
			<div class="col-6 col-sm-4 col-md-4 col-lg-4 mb-4">
				<div class="card card-bor-rad">
				  <img class="card-img-top card-img-red" src="images/cust-int-andaman.jpg" alt="Card image cap">
				  <div class="card-body ca-bo-pa">
				   <div class="row">
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Honeymoon in Andaman</div></a>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹35,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Highlights of Andaman</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹25,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Andaman Family Trip</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹18,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Andaman Special</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹32,000</a></div>
				    <div class="col-sm-12 col-md-12 col-lg-12 text-center pad-none">
				   	<button class="btn btn-default view-but">View More</button>
				   </div>
				   </div>
				  </div>
				</div>
			</div>		
			<div class="col-6 col-sm-4 col-md-4 col-lg-4 mb-4">
				<div class="card card-bor-rad">
				  <img class="card-img-top card-img-red" src="images/cust-int-bali.jpg" alt="Card image cap">
				  <div class="card-body ca-bo-pa">
				   <div class="row">
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Honeymoon in Bali</div></a>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹35,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Highlights of Bali</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹25,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Bali Family Trip</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹18,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Bali Special</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹32,000</a></div>
				   </div>
				   <div class="col-sm-12 col-md-12 col-lg-12 text-center pad-none">
				   	<button class="btn btn-default view-but">ViewMore</button>
				   </div>
				  </div>
				</div>
			</div>		
			<div class="col-6 col-sm-4 col-md-4 col-lg-4 mb-4">
				<div class="card card-bor-rad">
				  <img class="card-img-top card-img-red" src="images/cust-int-dubai.jpg" alt="Card image cap">
				  <div class="card-body ca-bo-pa">
				    <div class="row">
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Honeymoon in Dubai</div></a>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹35,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Highlights of Dubai</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹25,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Dubai Family Trip</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹18,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Dubai Special</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹32,000</a></div>
				    <div class="col-sm-12 col-md-12 col-lg-12 text-center pad-none">
				   	<button class="btn btn-default view-but">View More</button>
				   </div>
				   </div>
				  </div>
				</div>
			</div>			
		</div>
	</div> -->
	<!--Top International Holidays-->
	<!--multiple Image Slider-->
	<div class="col-12-xs col-sm-12 col-md-12 col-lg-12">
		<h4 class="text-left text-uppercase pt-4 pb-4">Special Holiday Packages</h4>
		<div class="pana-accordion" id="accordion">
		  <div class="pana-accordion-wrap">
		  	<?php
			$query = "SELECT * FROM tours WHERE id IN (".$site_content['family_tour_special_packages'].");";
			$fetch_data = mysqli_query($con,$query);
			while($fields  = $fetch_data->fetch_assoc()) {?>
		    <div class="pana-accordion-item">
		    	<a href="<?php echo LIVEROOT;?>package-details.php?id=<?php echo $fields['id']; ?>">
		    	<img width="570" height="400" src="images/tours/<?php echo $fields['display_image']; ?>" />
		    	</a>
		    </div>
		    <?php } ?>
		    <!-- <div class="pana-accordion-item"><img width="570" height="400" src="images/cust-02.jpg" /></div>
		    <div class="pana-accordion-item"><img width="570" height="400" src="images/cust-03.jpg" /></div>
		    <div class="pana-accordion-item"><img width="570" height="400" src="images/cust-04.jpg" /></div> -->
		  </div>
		</div>
	</div>
	<!--multiple Image Slider-->
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
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script> 
<script src="js/multislider.js"></script> 
<script type="text/javascript">
 $(function(){
      accordion.init({
        id: 'accordion'
      });
    });
$('#basicSlider').multislider({
			continuous: true,
			duration: 2000
		});
		$('#mixedSlider').multislider({
			duration: 750,
			interval: 3000
		});
</script>
<?php include 'footer.php'; ?>
</body>
</html>
