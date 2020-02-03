<?php
/* Smarty version 3.1.30, created on 2016-12-25 15:48:18
  from "C:\xampp\htdocs\takeabreak\templates\index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_585fdc329a3707_80316321',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd727f3ac94fa8e8cbf176289212d61371ab02900' => 
    array (
      0 => 'C:\\xampp\\htdocs\\takeabreak\\templates\\index.tpl',
      1 => 1482673676,
      2 => 'file',
    ),
    'a6e11216dbae24168094d90789bda5edaac111f4' => 
    array (
      0 => 'C:\\xampp\\htdocs\\takeabreak\\templates\\header.tpl',
      1 => 1482673327,
      2 => 'file',
    ),
    '04c8ef54bf31840edd38a6d096bcd4d51e4d788d' => 
    array (
      0 => 'C:\\xampp\\htdocs\\takeabreak\\templates\\location_category_list.tpl',
      1 => 1482672379,
      2 => 'file',
    ),
    '9b2e35009929438b00b89e9c037d9fca48bf749f' => 
    array (
      0 => 'C:\\xampp\\htdocs\\takeabreak\\templates\\footer.tpl',
      1 => 1482658190,
      2 => 'file',
    ),
  ),
  'cache_lifetime' => 120,
),true)) {
function content_585fdc329a3707_80316321 (Smarty_Internal_Template $_smarty_tpl) {
?>

<!DOCTYPE html>
<html>
<head>
	<title>Take a Break</title>
	 <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> 
   <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="font-awesome-4.6.3/css/font-awesome.min.css">
	<!--<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
	<link href="css/materialize.min.css" rel="stylesheet">-->
	<link href="css/take-a-break.css" rel="stylesheet">
	<link href="css/log.css" rel="stylesheet">


</head>
<body>

<div class="container-fluid padding-none">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-none">
		<div class="col-xs-12 hidden-sm hidden-md hidden-lg mobile_bunglow padding-none">
			<div class="div-xs-2 icon-place">
				<ul style="list-style:none;">
					<li class="mobile-icon"><a href="tel:1800-103-0051"><p><i class="fa fa-phone fa-lg aria-hidden="true""></i></p></a></li>
					<li class="mobile-icon"><a href="#"><p><i class="fa fa-lock fa-lg" aria-hidden="true"></i></p></a></li>
				</ul>
			</div>
		</div>

		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
			<div class="logo">
				<a href="#"><img src="images/weekend-logo.png" class="img-responsive"></a>
			</div>
		</div>
		<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9 hidden-xs">
			<div class="right-box-head">
				<ul style="list-style:none;">
					<li class="top-butt">CALL - <a href="tel:1800-103-0051" class="header-text">9819124690 / 9819124960 </a></li>
					
					<!--<li class="top-butt track_order">
						<a href="#" class="header-text">Sign-Up</a>
					</li>-->
					 <li class="dropdown top-butt track_order">
						                <a class="dropdown-toggle header-text" data-toggle="dropdown" href="#">Login<span class="caret"></span></a>
						               
						                 <ul class="dropdown-menu drop-padd">
						                  <li class="log-but"><button type="button" class="btn btn-success log-in-but" data-toggle="modal" data-target="#myModal">Log In</button></li>
						                  <li class="new-use-padd">New User?<a href="#myModalsign" class="red-text" data-toggle="modal">Sign Up</a></li>
						                  
						                </ul>  
					</li>
					
					<li class="top-butt track_order">
						<a href="#" class="header-text"><i class="fa fa-gift gift-icon" aria-hidden="true"></i>
Gift Holiday</a>
					</li>
					<li class="top-butt track_order">
						<a href="#" class="header-text">Contact Us</a>
					</li>					
				</ul>
			</div>			
		</div>
		 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content1">
        <div class="modal-header1">
          <button type="button" class="close but-close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title mod-til">Sign Up</h5>
        </div>
        <div class="modal-body mod-body">
          <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 log-in-align" align="center">
          <div class="form-group fogp">
		  <input type="email" class="form-control1" id="exampleInputEmail1" placeholder="Email / Mobile">

		  <input type="Password" class="form-control1" id="exampleInputPassword1" placeholder="Password">
      <a href="#" class="forget">Forget Password?</a>
		  </div>
      <button type="submit" class="btn btn-default submit">Login</button>
      <div class="register"> Do not have an account?<a href="#" class="regi"> Register</a></div>
    </div>
    
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
    
        <div class="butt"><a href="#"><img src="images/google.png"></a></div>
        <div class="butt"><a href="#"><img src="images/facebook.png"></a></div>
        </div>
     </div> 
      </div>
    </div>
  </div>
</div>
<!--Mymodal-->
<!-- Modal1 -->
  <div class="modal fade" id="myModalsign" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content1">
        <div class="modal-header1">
          <button type="button" class="close but-close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title mod-til">Sign Up</h5>
        </div>
        <div class="modal-body mod-body">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" align="center">
	          <div class="form-group fogp">
				  <input type="email" class="form-control1" id="exampleInputEmail1" placeholder="First Name">
				  <input type="Password" class="form-control1" id="exampleInputPassword1" placeholder="Password">
				  <input type="Password" class="form-control1" id="exampleInputPassword1" placeholder="Gender">
		      	  <input type="Password" class="form-control1" id="exampleInputPassword1" placeholder="Enter Your Mobile No">
			  </div>
    	  </div>
    	<div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
		    <input type="email" class="form-control1" id="exampleInputEmail1" placeholder="Last Name">
		    <input type="email" class="form-control1" id="exampleInputEmail1" placeholder="Confirm Password">
		    <input type="email" class="form-control1" id="exampleInputEmail1" placeholder="Date of Birth">
		    <button type="submit" class="btn btn-default submit">Sign Up</button>
        </div>
     </div> 
      </div>
    </div>
  </div>
</div>
<!--Modal1-->
<!--SearchBox-->
		<div class="right-box-head col-sm-4 col-lg-4">
			<div class="input-group add-on">
      <input class="form-control searh-box" placeholder="Find Your Destination" name="srch-term" id="srch-term" type="text">
      <div class="input-group-btn">
        <button class="btn btn-default ser-butt" type="submit"><i class="glyphicon glyphicon-search"></i></button>
      </div>
    </div>

	</div>
	<!--SearchBox-->
	<!--menu code start-->               
                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-none">
                             <nav class="navbar nav-mar navbar-inverse no-radius menu-gredient">
						        <div class="container-fluid">
						          <div class="navbar-header">
						            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						              <span class="icon-bar"></span>
						              <span class="icon-bar"></span>
						              <span class="icon-bar"></span>                        
						            </button>
						            
						          </div>
						          <div class="collapse navbar-collapse" id="myNavbar">
						            <ul class="nav navbar-nav">
						              <li class="dropdown">
						                <a class="dropdown-toggle text-up-case" data-toggle="dropdown" href="#">Group Tour <span class="caret"></span></a>
						             	<ul class="dropdown-menu menu-dropdown">
	<li class="col-sm-7 padding-none">
		<ul style="list-style:none;">
			<li class="active"><strong><u>India</u></strong></li>
			<li><a href="listing.php?loc_cat=1&cat=1" class="sublink">Andman</a></li>
			<li><a href="listing.php?loc_cat=2&cat=1" class="sublink">Maharashtra</a></li>
		    <li><a href="listing.php?loc_cat=3&cat=1" class="sublink">Goa</a></li>
		    <li><a href="listing.php?loc_cat=4&cat=1" class="sublink">Gujarat</a></li>
		    <li><a href="listing.php?loc_cat=5&cat=1" class="sublink">Himachal</a></li>
		    <li><a href="listing.php?loc_cat=6&cat=1" class="sublink">Kailash Mansarovar</a></li>
			<li><a href="listing.php?loc_cat=7&cat=1" class="sublink">Kashmir</a></li>
		    <li><a href="listing.php?loc_cat=8&cat=1" class="sublink">Kerala</a></li>
		    <li><a href="listing.php?loc_cat=9&cat=1" class="sublink">Madhya Pradesh</a></li>
		    <li><a href="listing.php?loc_cat=10&cat=1" class="sublink">Nainital-Mussoorie-Corbett</a></li>
		    <li><a href="listing.php?loc_cat=11&cat=1" class="sublink">Nepal-Bhutan</a></li>
		    <li><a href="listing.php?loc_cat=12&cat=1" class="sublink">North East</a></li>
		    <li><a href="listing.php?loc_cat=13&cat=1" class="sublink">North India</a></li>
		    <li><a href="listing.php?loc_cat=14&cat=1" class="sublink">Rajasthan</a></li>
		    <li><a href="listing.php?loc_cat=15&cat=1" class="sublink">Sikkim-Darjeeling</a></li>
		</ul>
	</li>
	<li class="col-sm-5 padding-none">
		<ul style="list-style:none;">
			<li class="active"><strong><u>World</u></strong></li>
			<li><a href="listing.php?loc_cat=16&cat=1" class="sublink">Singapore-Malaysia</a></li>
			<li><a href="listing.php?loc_cat=17&cat=1" class="sublink">Dubai</a></li>								 
			<li><a href="listing.php?loc_cat=18&cat=1" class="sublink">Srilanka</a></li>               
		</ul>
	</li>
</ul> 
						              </li>
						              <li class="dropdown">
						                <a class="dropdown-toggle text-up-case" data-toggle="dropdown" href="#">Speciality Tour <span class="caret"></span></a>
						               
						                 <ul class="dropdown-menu">
						                  <li><a href="listing.php?cat=3" class="sublink">Chota Break</a></li>
						                  <li><a href="listing.php?cat=4" class="sublink">Pilgrims Special</a></li>
						                  <li><a href="listing.php?cat=5" class="sublink">Short Break</a></li>
						                  <li><a href="listing.php?cat=6" class="sublink">Honeymoon Special</a></li>
						                  <li><a href="listing.php?cat=7" class="sublink">Women's Special</a></li>
						                  <li><a href="listing.php?cat=8" class="sublink">Senior's Special</a></li>
						                  <li><a href="listing.php?cat=9" class="sublink">Student's Special</a></li>
						                </ul>  
						              </li>
						              
						              <li class="dropdown">
						                <a class="dropdown-toggle text-up-case" data-toggle="dropdown" href="#">Tailormade Tour <span class="caret"></span></a>
						                <ul class="dropdown-menu menu-dropdown">
	<li class="col-sm-7 padding-none">
		<ul style="list-style:none;">
			<li class="active"><strong><u>India</u></strong></li>
			<li><a href="listing.php?loc_cat=1&cat=2" class="sublink">Andman</a></li>
			<li><a href="listing.php?loc_cat=2&cat=2" class="sublink">Maharashtra</a></li>
		    <li><a href="listing.php?loc_cat=3&cat=2" class="sublink">Goa</a></li>
		    <li><a href="listing.php?loc_cat=4&cat=2" class="sublink">Gujarat</a></li>
		    <li><a href="listing.php?loc_cat=5&cat=2" class="sublink">Himachal</a></li>
		    <li><a href="listing.php?loc_cat=6&cat=2" class="sublink">Kailash Mansarovar</a></li>
			<li><a href="listing.php?loc_cat=7&cat=2" class="sublink">Kashmir</a></li>
		    <li><a href="listing.php?loc_cat=8&cat=2" class="sublink">Kerala</a></li>
		    <li><a href="listing.php?loc_cat=9&cat=2" class="sublink">Madhya Pradesh</a></li>
		    <li><a href="listing.php?loc_cat=10&cat=2" class="sublink">Nainital-Mussoorie-Corbett</a></li>
		    <li><a href="listing.php?loc_cat=11&cat=2" class="sublink">Nepal-Bhutan</a></li>
		    <li><a href="listing.php?loc_cat=12&cat=2" class="sublink">North East</a></li>
		    <li><a href="listing.php?loc_cat=13&cat=2" class="sublink">North India</a></li>
		    <li><a href="listing.php?loc_cat=14&cat=2" class="sublink">Rajasthan</a></li>
		    <li><a href="listing.php?loc_cat=15&cat=2" class="sublink">Sikkim-Darjeeling</a></li>
		</ul>
	</li>
	<li class="col-sm-5 padding-none">
		<ul style="list-style:none;">
			<li class="active"><strong><u>World</u></strong></li>
			<li><a href="listing.php?loc_cat=16&cat=2" class="sublink">Singapore-Malaysia</a></li>
			<li><a href="listing.php?loc_cat=17&cat=2" class="sublink">Dubai</a></li>								 
			<li><a href="listing.php?loc_cat=18&cat=2" class="sublink">Srilanka</a></li>               
		</ul>
	</li>
</ul> 
						              </li>

						              <li><a href="#" class="text-up-case">Corporate</a></li>

						               <li><a href="#" class="text-up-case">About Us</a></li>

						               <li class="dropdown">
						                <a class="dropdown-toggle text-up-case" data-toggle="dropdown" href="#">Ticket Bookings<span class="caret"></span></a>
						                <ul class="dropdown-menu">
						                  <li><a href="#" class="sublink">Railway</a></li>
						                  <li><a href="#" class="sublink">Flight</a></li>
						                  <li><a href="#" class="sublink">Bus</a></li>
						                  <li><a href="#" class="sublink">Car</a></li>
						                </ul>
						              </li>

						              <li class="dropdown">
						                <a class="dropdown-toggle text-up-case" data-toggle="dropdown" href="#">Bunglows<span class="caret"></span></a>
						                <ul class="dropdown-menu menu-dropdown">
						                  <li class="col-sm-7 padding-none">
						                  	<ul style="list-style:none;">
						                  		<li class="active"><strong><u>Bungalows</u></strong></li>
						                  		<li><a href="#" class="sublink">Mahabaleshwar</a></li>
						                  		<li><a href="#" class="sublink">Panchgani</a></li>
								                <li><a href="#" class="sublink">Alibaugh</a></li>
								                <li><a href="#" class="sublink">Khandala</a></li>
								                <li><a href="#" class="sublink">Satara</a></li>
								                <li><a href="#" class="sublink">Goa</a></li>
						                  	</ul>
						                  </li>
						                   <li class="col-sm-5 padding-none">
						                  	<ul style="list-style:none;">
						                  		<li class="active"><strong><u>Agro Farm House</u></strong></li>
						                  		<li><a href="#" class="sublink">Mahabaleshwar</a></li>
						                  		<li><a href="#" class="sublink">Panchgani</a></li>
								                <li><a href="#" class="sublink">Alibaugh</a></li>
								                <li><a href="#" class="sublink">Khandala</a></li>
								                <li><a href="#" class="sublink">Satara</a></li>
								                <li><a href="#" class="sublink">Goa</a></li>							                
						                  	</ul>
						                  </li>
						                </ul>
						              </li>

						              <li><a href="#" class="text-up-case">Travel Guide</a></li>

						              <li><a href="#" class="text-up-case">Contact Us</a></li>

						            </ul>
						      </nav>

 <!-- <nav>
    <div class="nav-wrapper">
      <a href="#" data-activates="mobile-demo" class="button-collapse"><i class="material-icons">menu</i></a>
      <ul class="right hide-on-med-and-down">
        <li><a href="sass.html">Group Tours</a></li>
        <li><a href="badges.html">Speciality Tour</a></li>
        <li><a href="collapsible.html">Tailormade Holidays</a></li>
        <li><a href="mobile.html">Corporate Travel</a></li>
        <li><a href="mobile.html">About Us</a></li>
        <li>
		  <!-- Dropdown Trigger -->
		 <!-- <a class='dropdown-button btn' href='#' data-activates='dropdown1'>Ticket Bookings</a>

		  <!-- Dropdown Structure -->
		  <!--<ul id='dropdown1' class='dropdown-content'>
		    <li><a href="#!">Railway</a></li>
		    <li><a href="#!">Bus</a></li>
		    <li><a href="#!">Flight</a></li>
		    <li><a href="#!">Car</a></li>
		      </ul>
   		 </li>   
        <li>
		  <!-- Dropdown Trigger -->
		  <!--<a class='dropdown-button btn' href='#' data-activates='dropdown1'>Bungalows</a>

		  <!-- Dropdown Structure -->
		  <!--<ul id='dropdown1' class='dropdown-content'>
		    <li><a href="#!">Agro Farm House</a></li>
		      </ul>
   		 </li>    
        <li><a href="mobile.html">Travel Guide</a></li>
        <li><a href="mobile.html">Contact Us</a></li>
      </ul>
      <ul class="side-nav" id="mobile-demo">
        i><a href="sass.html">Group Tours</a></li>
        <li><a href="badges.html">Speciality Tour</a></li>
        <li><a href="collapsible.html">Tailormade Holidays</a></li>
        <li><a href="mobile.html">Corporate Travel</a></li>
        <li><a href="mobile.html">About Us</a></li>
        <li><a href="mobile.html">Ticket Bookings</a></li>
        <li><a href="mobile.html">Bunglows / Farm House</a></li>
        <li><a href="mobile.html">Travel Guide</a></li>
        <li><a href="mobile.html">Contact Us</a></li>
      </ul>
    </div>
  </nav>-->
             
                        </div>
                  
                <!--menu code end-->


<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
   
    </div>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner carou-bor-radius">
        <div class="item active">
          <img src="images/family1.jpg" alt="...">
          
        </div>
        <div class="item">
          <img src="images/rajasthan1.jpg" alt="...">
          
        </div>
        <div class="item">
          <img src="images/shimala1.jpg" alt="...">
         
        </div>
      </div>
            <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div>
    <!--Social Media-->
      <div class="social_doc">
    <ul>
      <li><a class="sprite icon_social_fb-small" target="_blank" href="#"> </a></li>
      <li><a class="sprite icon_social_insta-small" target="_blank" href="#"> </a></li>
      <li><a class="sprite icon_social_twitter-small" target="_blank" href="#"> </a></li>
      <li><a class="sprite icon_social_google-small" target="_blank" href="#"> </a></li>
      <li><a class="sprite icon_social_linkedin-small" target="_blank" href="#"> </a></li>
    </ul>
  </div>
      <!--Social Media-->
    <!--Indian Tour-->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bann-slider">
        <div class="slider-top-text">Indian Tour</div>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/raja2.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Rajasthan</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="listing.php?loc_cat=14" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
               <div class="item"><img src="images/anda2.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Andman</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="listing.php?loc_cat=1" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/Himachal2.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Himachal</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="listing.php?loc_cat=5" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/Kerala1.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Kerala</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="listing.php?loc_cat=8" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
    </div>
    <!--Indian Tour-->
    <!--International Tour-->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bann-slider">
        <div class="slider-top-text">International Tour</div>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/dubai.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Dubai</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="listing.php?loc_cat=17" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
               <div class="item"><img src="images/singapore.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Singapore</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="listing.php?loc_cat=16" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/malaysia.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Malaysia</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="listing.php?loc_cat=16" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/srilanka.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Sri Lanka</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="listing.php?loc_cat=18" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
    </div>
    <!--International Tour-->
     <!--Speciality Tour-->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bann-slider">
        <div class="slider-top-text">Speciality Tour</div>


        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/pilgrims.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height2">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-none">
                  <p><strong>Pilgrims Special</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 hidden-xs">
                <a href="listing.php?cat=4" class="btn btn-primary small-but" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/short-break.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height2">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-none">
                  <p><strong>Short Break</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 hidden-xs">
                <a href="listing.php?cat=5" class="btn btn-primary small-but" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 padd">
            <div class="thumbnail padd-none">
               <div class="item"><img src="images/honey-moon.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height2">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-none">
                  <p><strong>Honeymoon Special</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 hidden-xs">
                <a href="listing.php?cat=6" class="btn btn-primary small-but" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/womens.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height2">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-none">
                  <p><strong>Women's Special</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 hidden-xs">
                <a href="listing.php?cat=7" class="btn btn-primary small-but" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/senior.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height2">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-none">
                  <p><strong>Senior's Special</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 hidden-xs">
                <a href="listing.php?cat=8" class="btn btn-primary small-but" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/students.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height2">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-none">
                  <p><strong>Student's Special</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 hidden-xs">
                <a href="listing.php?cat=9" class="btn btn-primary small-but" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
        
    </div>
<!--Speciality Tour-->
    <footer>
    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 footer-bg">
    		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
    			<ul style="list-style:none;">
    				<li class="footer-top-text">Group Tours</li>
    				<li><a href="#" class="footer-link">India</a></li>
    				<li><a href="#" class="footer-link">International</a></li>
    				<li class="footer-top-text">Tailormade Tours</li>
    				<li><a href="#" class="footer-link">India</a></li>
    				<li><a href="#" class="footer-link">International</a></li>
    				<li><a href="#" class="footer-link"></a></li>
    			</ul>
    		</div>

    		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
    			<ul style="list-style:none;">
    				<li class="footer-top-text">Speciality Tours</li>
    				<li><a href="#" class="footer-link">Pilgrims Special</a></li>
    				<li><a href="#" class="footer-link">Short Break</a></li>
    				<li><a href="#" class="footer-link">Honeymoon Special</a></li>
    				<li><a href="#" class="footer-link">Women's Special</a></li>
    				<li><a href="#" class="footer-link">Senior's Special</a></li>
    				<li><a href="#" class="footer-link">Students's Special</a></li>
    			</ul>
    		</div>

    		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
    			<ul style="list-style:none;">
    				<li class="footer-top-text">Others</li>
    				<li><a href="#" class="footer-link">Corporate</a></li>
    				<li><a href="#" class="footer-link">Travel Guide</a></li>
    				<li><a href="#" class="footer-link">Gift Holiday</a></li>
    			</ul>
    		</div>

    		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
    			<ul style="list-style:none;">
    				<li class="footer-top-text">Ticket Bookings</li>
    				<li><a href="#" class="footer-link">Railway Booking</a></li>
    				<li><a href="#" class="footer-link">Flight Booking</a></li>
    				<li><a href="#" class="footer-link">Bus Booking</a></li>
    				<li><a href="#" class="footer-link">Car Booking</a></li>
    			</ul>
    		</div>

    		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
    			<ul style="list-style:none;">
    				<li class="footer-top-text">Bungalows</li>
    				<li><a href="#" class="footer-link">Bungalows</a></li>
    				<li><a href="#" class="footer-link">Farm House</a></li>
    			</ul>
    		</div>

    		<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
    			<ul style="list-style:none;">
    				<li class="padd-top-bottom"><a href="#" class="footer-link-black">About Us</a></li>
    				<li class="padd-top-bottom"><a href="#" class="footer-link-black">Contact Us</a></li>
    				<li class="padd-top-bottom"><a href="#" class="footer-link-black">Terms & Conditions</a></li>
    				<li class="padd-top-bottom"><a href="#" class="footer-link-black">FAQ's</a></li>
    				<li class="padd-top-bottom"><a href="#" class="footer-link-black">Best Offers</a></li>
    				<li class="padd-top-bottom"><a href="#" class="footer-link-black">Guest Experience</a></li>
    			</ul>
    		</div>
    	</div>
    	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"></div>
    </footer>
  </div>

</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script type="text/javascript" src="js/materialize.min.js"></script>-->
<script type="text/javascript" src="js/jquery.js"></script>

<?php }
}
