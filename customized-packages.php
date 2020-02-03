<!DOCTYPE html>
<html>
<head>
	<title>Customize Package</title>
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
	<?php include 'headers.php'; ?>
	<form>
		<div class="m-1">
			<div class="col- col-sm-12 col-md-12 col-lg-12">
				<ul class="breadcrumb br-crum">
			    <li class="breadcrumb-item"><a href="#">Home</a></li>
			    <li class="breadcrumb-item active">Customize Packages</li>
			  </ul>
			</div>
		</div>
	</form>
<!--Carousel-->
<div id="carouselExampleFade" class="carousel slide carousel-fade" data-ride="carousel">
  <div class="carousel-inner">
    <div class="carousel-item active">
      <img class="d-block w-100" src="images/custmize01.jpg" alt="First slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="images/custmize02.jpg" alt="Second slide">
    </div>
    <div class="carousel-item">
      <img class="d-block w-100" src="images/custmize03.jpg" alt="Third slide">
    </div>
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
<!--Search-->
	<form>
		<div class="row m-4">
			
		<!--Hotel Category-->	
			<div class="col-sm-2 col-md-2 col-lg-2 form-group bor-right">
				<h6>Hotel Category</h6>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 pr-5">
						 	 <select class="custom-select tour-search" id="sel1">
						    <option selected>2 Star *</option>
						    <option>3 Star *</option>
						    <option>4 Star *</option>
						    <option>5 Star *</option>
						  </select>
					</div>
				</div>
			</div>
			<!--Hotel Category-->
			<!--TourDestinations-->
			<div class="col-sm-2 col-md-2 col-lg-2 form-group bor-right">
				<h6>Select Your Tour</h6>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 pr-5">
						  <select class="custom-select tour-search" id="sel1">
						    <option selected>Ashtvinayak</option>
						    <option>Mahabaleshwar</option>
						    <option>Kokan Darshan</option>
						    <option>Sindhudurg</option>
						  </select>
					</div>
				</div>
			</div>
			<!--TourDestinations-->
			<!--Tour Budget-->
			<div class="col-sm-4 col-md-4 col-lg-4 form-group bor-right">
					<h6>Budget Per Person</h6>
						<div class="row">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="col-sm-12 col-md-12 col-lg-12 nopadd-mar">
									  <select class="custom-select tour-search" id="sel1">
									    <option selected>1000</option>
									    <option>5000</option>
									    <option>10000</option>
									    <option>15000</option>
									  </select>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="col-sm-12 col-md-12 col-lg-12 nopadd-mar">
									  <select class="custom-select tour-search" id="sel1">
									    <option selected>5000</option>
									    <option>10000</option>
									    <option>15000</option>
									    <option>20000</option>
									  </select>
								</div>
							</div>	
						</div>
			</div>
			<!--Tour Budget-->
			<!--Tour Duration-->
			<div class="col-sm-2 col-md-2 col-lg-2 form-group bor-right">
						<h6>Duration</h6>
						<div class="row">
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="col-sm-12 col-md-12 col-lg-12 nopadd-mar">
									  <select class="custom-select tour-search" id="sel1">
									    <option selected>1 N</option>
									    <option>2 N</option>
									    <option>3 N</option>
									    <option>4 N</option>
									  </select>
								</div>
							</div>
							<div class="col-sm-6 col-md-6 col-lg-6">
								<div class="col-sm-12 col-md-12 col-lg-12 nopadd-mar">
									  <select class="custom-select tour-search" id="sel1">
									    <option selected>2 N</option>
									    <option>3 N</option>
									    <option>4 N</option>
									    <option>5 N</option>
									  </select>
								</div>
							</div>
						</div>
					</div>
			<!--Tour Duration-->
			<!--TravelType-->
			<div class="col-sm-2 col-md-2 col-lg-2 form-group ">
				<h6>Travel Type</h6>
				<div class="row">
					<div class="col-sm-12 col-md-12 col-lg-12 pr-5">
						  <select class="custom-select tour-search" id="sel1">
						    <option selected>Bus</option>
						    <option>Car</option>
						  </select>
					</div>
				</div>
			</div>
			<!--TravelType-->
		</div>
	</form>
	<!--Search-->
	<!--Package list-->
	<div class="container">
	<!-- Multiple Image Slider-->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pad-none">
		<h4 class="text-left text-uppercase pt-4 pb-4">Themed Holiday Packages</h4>
		<div id="mixedSlider">
                    <div class="MS-content">
                        <div class="item">
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
                        </div>
                       
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
			<div class="col-6 col-sm-4 col-md-4 col-lg-4 mb-4">
				<div class="card card-bor-rad">
				  <img class="card-img-top card-img-red" src="images/cust-kerala.jpg" alt="Card image cap">
				  <div class="card-body ca-bo-pa">
				   <div class="row">
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Honeymoon in Kerala</div></a>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹35,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Highlights of Kerala</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹25,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Kerala Family Trip</a></div>
				   <div class="col-sm-5 col-md-5 col-lg-5 text-right"><a href="#" class="card-text">₹18,000</a></div>
				   <div class="col-sm-7 col-md-7 col-lg-7 text-left"><a href="#" class="card-text">Kerala Special</a></div>
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
			</div>			
		</div>
	</div>
	<!--Top Domestic Holidays-->

	<!--Top International Holidays-->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
	</div>
	<!--Top International Holidays-->
	<!--multiple Image Slider-->
	<div class="col-12-xs col-sm-12 col-md-12 col-lg-12">
		<h4 class="text-left text-uppercase pt-4 pb-4">Special Holiday Packages</h4>
		<div class="pana-accordion" id="accordion">
		  <div class="pana-accordion-wrap">
		    <div class="pana-accordion-item"><img width="570" height="400" src="images/cust-01.jpg" /></div>
		    <div class="pana-accordion-item"><img width="570" height="400" src="images/cust-02.jpg" /></div>
		    <div class="pana-accordion-item"><img width="570" height="400" src="images/cust-03.jpg" /></div>
		    <div class="pana-accordion-item"><img width="570" height="400" src="images/cust-04.jpg" /></div>
		  </div>
		</div>
	</div>
	<!--multiple Image Slider-->
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
