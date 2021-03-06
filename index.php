<?php include 'queries.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Shravani-Tourism</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/shravani.css" rel="stylesheet">
	<link rel="shortcut icon" type="image/png" href="images/tours/<?php echo $site_images['favicon'];?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      
	<style type="text/css">
    body{
        font-family: Arail, sans-serif;
    }
    /* Formatting search box */
    .search-box{
        width: 300px;
        position: relative;
        display: inline-block;
        font-size: 14px;
    }
    .search-box input[type="text"]{
        height: 32px;
        padding: 5px 10px;
        border: 1px solid #CCCCCC;
        font-size: 14px;
    }
    .result{
        position: absolute;        
        z-index: 999;
        top: 100%;
        left: 0;
    }
    .search-box input[type="text"], .result{
        width: 100%;
        box-sizing: border-box;
    }
    /* Formatting result items */
    .result p{
        margin: 0;
        padding: 7px 10px;
        border: 1px solid #CCCCCC;
        border-top: none;
        cursor: pointer;
        background: #f5f3f3;
        margin-left: 30px;
    	width: 78%;
    }

    .result a{
    	color: rgba(0,0,0,.5);
    	font-size: 14px;
    	font-weight: bolder;
    }

    .result p:hover{
        background: #f2f2f8;
    }
</style>
</head>
<body>
<div class="container-fluide">
<?php include 'headers.php'; ?>
<!--SearchBox-->
<div class="main">
	<div class="input-group md-form form-sm form-2 pl-0">
  		<div class="input-group has-search ">
		    <span class="fa fa-search form-control-feedback ser-icon"></span>
		    <input id="search_box" type="text" class="form-control ser-in" placeholder="Search Tour Packages">
		    <div class="result"></div>
		    <div class="input-group-append">
		      <button class="btn btn-secondary search-btn" type="button" onclick="redirect_search()">
		        Let's Go
		      </button>
	    	</div>
   		</div>
	</div>
</div>
<!--SearchBox-->

<!--Carousel-->
<div class="bd-example">
  <div id="carouselExampleCaptions" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleCaptions" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="1"></li>
      <li data-target="#carouselExampleCaptions" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
    	<?php
    		$texts= [
    			'Holidays are meant for relaxation, to rejuvenate your energy moreover to spend Your quality time with your loved ones.',
    			'It is imperative to have the best Tour Operator to be your travel planner.',
    			'And we got the experience, Infrastructure, commitment and who is a real professional to plan your precious holidays.'
    		];
    		$slider_images = json_decode($site_images['homepage_slider'],true);
    		$active = "active";
    		for($i=0;$i<count($slider_images);$i++){ ?>
    			<div class="carousel-item <?php echo $active;?>">
			        <img src="images/tours/<?php echo $slider_images[$i];?>" class="d-block w-100 img-fluid" alt="...">
			        <div class="carousel-caption d-none d-md-block">
			          <h5>Shravni Tourism</h5>
			          <p><?php echo $texts[$i];?>	</p>
			        </div>
		      </div>
    		<?php	
    			$active = '';
    		} ?>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleCaptions" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleCaptions" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
</div>
<!--Carousel-->
<div class="container">
	<h4 class="text-center text-uppercase pt-4 pb-4">Maharashtra Tours</h4>

	<div class="row">
		<div class="col-sm-6 col-lg-3">
		   <div class="card card-bor">
		   		<a href="ashtavinayak-packages.php">
		   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/tours/<?php echo $site_images['astavinayak_display_image'];?>" alt="Card image" style="width:100%">
		   		 <div class="card-body">
		      		<h6 class="card-title text-al text-uppercase">Ashtvinayak</h6>
		      	 </div>
		      	</a>
	  		</div>
		</div>
		<?php
			$query = "SELECT * FROM tours WHERE id IN (".$site_content['home_maharashtra_tours'].");";
			$fetch_data = mysqli_query($con,$query);
			while($fields  = $fetch_data->fetch_assoc()) {?>
			    <div class="col-sm-6 col-lg-3">
				    <div class="card card-bor">
				    	<a href="<?php echo LIVEROOT;?>package-details.php?id=<?php echo $fields['id']; ?>">

				   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/tours/<?php echo $fields['display_image']; ?>" alt="Card image" style="width:100%">
				   		 <div class="card-body">
				      		<h6 class="card-title text-al text-uppercase">
				      			<?php echo $fields['tour_name']; ?>
				      		</h6>		      		
				   		 </div>
				   		</a>
			  		</div>
				</div>
		<?php } ?>	
		<!-- <div class="col-sm-6 col-lg-3">
		    <div class="card card-bor">
		   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/mahabaleshwar.jpg" alt="Card image" style="width:100%">
		   		 <div class="card-body">
		      		<h6 class="card-title text-al text-uppercase">Mahabaleshwar</h6>		      		
		   		 </div>
	  		</div>
		</div>	
		<div class="col-sm-6 col-lg-3">
		   <div class="card card-bor">
		   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/shirdi.jpg" alt="Card image" style="width:100%">
		   		 <div class="card-body">
		      		<h6 class="card-title text-al text-uppercase">Nashik-Shirdi</h6>
		      	 </div>
	  		</div>
		</div>	
		<div class="col-sm-6 col-lg-3">
		  <div class="card card-bor">
		   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/kokan01.jpg" alt="Card image" style="width:100%">
		   		 <div class="card-body">
		      		<h6 class="card-title text-al text-uppercase">Kokan Darshan</h6>
		      	 </div>
	  		</div>
		</div>	 -->

	</div>
	<div class="col text-center"><button type="button" class="btn btn-primary purple-btn mt-4 mb-4" href="#">View All Tours</button></div>
<div class="row why-travel">
		<div class="col-sm-6 col-lg-4">
			<div class="card  card-alin bg-light">
			    <img class="card-img-center img-fluid" src="images/personal-match.jpg" alt="Card image" style="width:100%">
			      <div class="card-body text-center">
			        <p class="card-text car-tx">PERSONALISED MATCHING</p>
			      </div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-4">
			<div class="card  card-alin bg-light">
			    <img class="card-img-center img-fluid" src="images/wide-variety.jpg" alt="Card image" style="width:100%">
			      <div class="card-body text-center">
			        <p class="card-text car-tx">WIDE VARIETY OF DESTINATION</p>
			      </div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-4">
			<div class="card  card-alin bg-light">
			    <img class="card-img-center img-fluid" src="images/high-quality.jpg" alt="Card image" style="width:100%">
			      <div class="card-body text-center">
			        <p class="card-text car-tx">HIGHLY QUALIFIED SERVICE</p>
			      </div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-4">
			<div class="card  card-alin bg-light">
			    <img class="card-img-center img-fluid" src="images/24x7.jpg" alt="Card image" style="width:100%">
			      <div class="card-body text-center">
			        <p class="card-text car-tx">24 x 7 SUPPORT</p>
			      </div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-4">
			<div class="card  card-alin bg-light">
			    <img class="card-img-center img-fluid" src="images/handpicked-hotels.jpg" alt="Card image" style="width:100%">
			      <div class="card-body text-center">
			        <p class="card-text car-tx">HANDPICKED HOTELS</p>
			      </div>
			</div>
		</div>
		<div class="col-sm-6 col-lg-4">
			<div class="card  card-alin bg-light">
			    <img class="card-img-center img-fluid" src="images/best-price-gurantee.jpg" alt="Card image" style="width:100%">
			      <div class="card-body text-center">
			        <p class="card-text car-tx">BEST PRICE GURANTEE</p>
			      </div>
			</div>
		</div>
</div>

<div class="container">
	<h4 class="text-center text-uppercase pt-4 pb-4">Domestic Group Tours</h4>

	<div class="row">
		<?php
			$query = "SELECT * FROM tours WHERE id IN (".$site_content['home_india_tours'].");";
			$fetch_data = mysqli_query($con,$query);
			while($fields  = $fetch_data->fetch_assoc()) {?>
				<a href="<?php echo LIVEROOT;?>package-details.php?id=<?php echo $fields['id']; ?>">
			    <div class="col-xs-6 col-sm-4 col-md-4">
				   <div class="card card-bor" style="width:325px">
				   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/tours/<?php echo $fields['display_image']; ?>" alt="Card image" style="width:100%">
				   		 <div class="card-body ca-bo row">
				      		<div class="card-title tx-al-le text-uppercase col-sm-6"><?php echo $fields['tour_name']; ?></div>
				      		<div class="card-title tx-al-ri text-uppercase col-sm-6 nopadd-mar">Rs. <?php echo $fields['tour_price']; ?></div>
				      	 </div>
			  		</div>
				</div>
				</a>
		<?php } ?>

		<!-- <div class="col-xs-6 col-sm-4 col-md-4">
		   <div class="card card-bor" style="width:325px">
		   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/Kerala.jpg" alt="Card image" style="width:100%">
		   		 <div class="card-body ca-bo row">
		      		<div class="card-title tx-al-le text-uppercase col-sm-6">Kerala</div>
		      		<div class="card-title tx-al-ri text-uppercase col-sm-6 nopadd-mar">Rs.50000</div>
		      		<p class="card-text ca-tx">Kerala is extremely unique from the rest of India features lush greenery, stunning backwaters,friendly people and more!</p>
		      	 </div>
	  		</div>
		</div>	
		<div class="col-xs-6 col-sm-4 col-md-4">
		    <div class="card card-bor" style="width:325px">
		   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/Himachal2.jpg" alt="Card image" style="width:100%">
		   		 <div class="card-body ca-bo row">
		      		<div class="card-title tx-al-le text-uppercase col-sm-6">Himachal</div>
		      		<div class="card-title tx-al-ri text-uppercase col-sm-6 nopadd-mar">Rs.60000</div>
		      		<p class="card-text ca-tx">Best places to visit in India with best things to do in Rajasthan, golden triangle tour. pink city, blue city, golden city, city of lakes.</p>		      		
		   		 </div>
	  		</div>
		</div>	
		<div class="col-xs-6 col-sm-4 col-md-4 ">
		   <div class="card card-bor" style="width:325px">
		   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/goa01.jpg" alt="Card image" style="width:100%">
		   		 <div class="card-body ca-bo row">
		      		<div class="card-title tx-al-le text-uppercase col-sm-6">Goa</div>
		      		<div class="card-title tx-al-ri text-uppercase col-sm-6 nopadd-mar">R.45000</div>
		      		<p class="card-text ca-tx">Goa the best places to visit in Goa for tourists,from beautiful churches to ancient forts and the best markets in Goa India.</p>
		      	 </div>
	  		</div>
		</div>	 -->
		
	</div>
	<div class="row cus-pack" style="background-image: url('images/tours/<?php echo $site_images['homepage_family_display_image'];?>');">
		<div class="cus-text" height="300px">
			Customized Travel Perfection<br/>
With the Professionalism of Experts<br/>
<button type="button" class="btn btn-primary cus-tour-button" href="#">View All Tours</button>
		</div>

	</div>
</div>
</div>
<!--
<div class="container-fluide">
<div class="hr hr-bg"></div>
<footer>
	<div class="row">
		
			<div class="col-sm-3 col-md-3 col-lg-3">
			<h6>Shravani Tours</h6>
			<div class="row  foo-ter">
				<ul>
					<li>East Zone</li>
					<li>West Zone</li>
					<li>South Zone</li>
					<li>North Zone</li>
				</ul>
			</div>

			</div>
			<div class="col-sm-3 col-md-3 col-lg-3">
			<h6>Main Links</h6>
			<div class="row  foo-ter">
				<ul>
					<li>Home</li>
					<li>About Us</li>
					<li>Maharashtra Tours</li>
					<li>Domestic Tours</li>
					<li>Customized Tours</li>
					<li>Honeymoon Tours</li>
					<li>Speciality Tours</li>
					<li>International Holidays</li>
				</ul>
			</div>
			</div>
			<div class="col-sm-3 col-md-3 col-lg-3 foo-ter">
			<h6>Service Links</h6>
			<div class="row  foo-ter">
				<ul>
					<li>About Us</li>
					<li>Contact Us</li>
					<li>Careers</li>
					<li>FAQs</li>
					<li>Privacy Policy</li>
					<li>Terms & Conditions</li>
				</ul>
			</div>
			</div>
			<div class="col-sm-3 col-md-3 col-lg-3">Links</div>
	</div>
</footer>
</div>-->
<?php include 'footer.php'; ?>
<script type="text/javascript">
var live_url = '<?php echo LIVEROOT;?>';
$(document).ready(function(){
    $('#search_box').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length && inputVal.length > 1){
            $.get("requests.php", {action:'home_search',term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});


function redirect_search(){
	var search_text = $('#search_box').val();
	window.location.href = live_url+"packages.php?q="+search_text+"&search="+search_text;
}
</script>

	
</body>
</html>