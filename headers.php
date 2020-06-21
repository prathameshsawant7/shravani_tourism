<header>
<style type="text/css">
	.field-error{
		font-size: 10px;
    	color: red;
    	float: right;
	}

	.enquiry-msg{
		padding: 50px;
	    font-family: auto;
	    color: darkmagenta;
	    font-size: 21px;
	}
</style>
<!--fixed-position-->
<div class="enquiryHover">
	  <div class="enquiryContain">
	    <button class="enquiryBtn mat-button" data-toggle="modal" data-target="#myModal" mat-button=""><span class="mat-button-wrapper">Quick Enquiry </span>
		    <div class="mat-button-ripple mat-ripple" matripple=""></div>
		    <div class="mat-button-focus-overlay"></div>
	    </button>
	  </div>
  </div>
     <!-- The Modal -->
  <div class="modal fade" id="myModal">
    <div class="modal-dialog">
      <div class="modal-content mod-con">
      
        <!-- Modal Header -->
        <div class="modal-header mod-header">
          <h6 class="modal-title">Quick Enquiry</h6>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <form method="post" name="enquiry_form" id="enquiry_form" >
        <div class="modal-body">
        	<div class="row form-group">
        		<label id="enquiry_form_msg" class="enquiry-msg" style="display:none;"></label>
        	</div>
	        <div class="row form-group" id="enquiry_form_div">
	        	<input type="hidden" name="action" value="enquiry">
	        	<div class="col-sm-12 col-md-12 col-lg-12">
	        		<input type="Name" class="form-control mod-in" id="enquiry_name" name="name" placeholder="Name">
	        		<p class="field-error"></p>
	        	</div>
	        	<div class="col-sm-12 col-md-12 col-lg-12">
	        		<input type="text" class="form-control mod-in" id="enquiry_email" name="email" placeholder="Email Id">
	        		<p class="field-error"></p>
	        	</div>
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<input type="text" class="form-control mod-in" id="enquiry_mobile" name="mobile" placeholder="Mobile Number">
	        		<p class="field-error"></p>
	        	</div>
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<input type="text" class="form-control mod-in" id="enquiry_city_of_guest" name="city_of_guest" placeholder="City of Residence">
	        		<p class="field-error"></p>
	        	</div>
	        	
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<input type="text" class="form-control mod-in" id="enquiry_time_to_travel" name="time_to_travel" placeholder="Time To Travel">
	        	</div>
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<input type="text" class="form-control mod-in" id="enquiry_duration" name="duration" placeholder="Travel Duration">
	        	</div>
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<select class="form-control mod-in dest-text bt-gr" id="enquiry_place_to_travel" name="place_to_travel">
	        			<option value="">Place to Travel</option>
	        			<?php 
				        while($fields  = $place_to_travel_data->fetch_assoc()) { ?>
				        	<option value="<?php echo $fields['state'];?>"><?php echo $fields['state'];?></option>
					    <?php } ?>
				     </select>

	        	</div>
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<select class="form-control mod-in dest-text bt-gr" id="enquiry_travel_type" name="travel_type">
	        			<option value="">Type Of Travel</option>
				        <option value="Group Tour">Group Tour</option>
				        <option value="Customized Tour">Customized Tour</option>
				        <option value="Honeymoon Tour">Honeymoon Tour</option>
				        <option value="Speciality Tour">Speciality Tour</option>
				        <option value="Maharashtra Tours">Maharashtra Tours</option>
				        <option value="International Tours">International Tours</option>
				    </select>
	        	</div>
	        	<div class="col-sm-12 col-md-12 col-lg-12">
	        		<select class="form-control mod-in dest-text bt-gr" id="enquiry_mode_to_contact" name="mode_to_contact">
	        			<option value="">Prefered mode of communication</option>
				        <option value="Call">Call Me</option>
				        <option value="Email">Email Me</option>
				        <option value="Text Message">Text Message Me</option>
				        <option value="Whatsapp">Whatsapp Me</option>
				    </select>
	        	</div>
	        </div>	         
		</form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" id="enquiry_submit" class="btn btn-success" onclick="submitEnquiry()">Submit</button>
        </div>
        </form>
      </div>
    </div>
  </div>
 
  <!--Modal-->
<!--Fixed-position-->
<div class="hr hr-bg"></div>
	<div class="row">
		<div class="col- col-sm-3 col-md-3 col-lg-3 logo">
			<a class="nav-link" href="index.php">
				<img src="images/tours/<?php echo $site_images['logo'];?>" class="img-fluid">
			</a>
		</div>
		<div class="col- col-sm-9 col-md-9 col-lg-9">
			<div class="col-sm-12 col-ms-12 col-lg-12 hidden-xs">
				<div class="right-box-head">
					<ul style="list-style:none;">
			         <!--  <li class="top-butt track_order"><div class="dropdown">
					    <button type="button" class="btn dropdown-toggle drop-down" data-toggle="dropdown">Call: 9819124692    </button>
					    <div class="dropdown-menu  drop-li drop-down">
					      <a class="dropdown-item" href="#">9819124960</a>
					      <a class="dropdown-item" href="#">9819124690</a>
					      <a class="dropdown-item drop-li" href="#">9819124960</a><hr/>
					      <p align="center">We are Open Today<br/>
					      <h6 align="center">11am to 9 pm<h6></p>
					    </div>
					  </div>
 					 </li> -->
 					 <!-- <li class="top-butt track_order">
			            <a href="#" class="header-text">Help</a>
			          </li> -->
			         <?php if($_SESSION && isset($_SESSION['name']) && $_SESSION['name'] != ''){ ?>	
				          <li class="top-butt track_order">
					        <a class="header-text nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: -7px;">
					          Welcome, <b><?php echo $_SESSION['name'];?></b>
					        </a>
					        <div class="dropdown-menu header-nav" style="margin-left:75px;" aria-labelledby="navbarDropdown">
					          <a class="dropdown-item" onclick="logout();" >Logout</a>
					        </div>
					     </li>
			      	  <?php } else { ?>

			      	  	<li class="top-butt track_order">
				            <a href="#myModal-log"  class="header-text" data-toggle="modal" >Login</a>
				        </li>
				        <li class="top-butt track_order">
				            <a href="#myModal-sign"  class="header-text" data-toggle="modal" >Sign Up</a>
				        </li>
			      	  <?php } ?>
			                   
			        </ul>
				</div>
				
<!-- The Login Modal -->
  <div class="modal fade" id="myModal-log">
    <div class="modal-dialog modal-lg">
      <div class="modal-content modal-content1">
       <!-- Modal body -->
        <div class="modal-body mod">
        <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4 mod-img1"></div>
        
          <div class="col-sm-8 col-md-8 col-lg-8" align="center">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <!-- Modal Header -->
        <div class="modal-header modal-header1">
          <h5 class="modal-title">Log In</h5></div>
	          <div class="form-group fogp">
	          	<form method="post" name="signinForm" id="signinForm" >
	          		<input type="hidden" name="action" value="login">
	          		<div>
			     		<input type="text" class="form-control form-control1 mod-in dest-text bt-gr" id="log_email" name="log_email" placeholder="Email / Mobile">
			     		<p class="field-error"></p>
		     		</div>
		     		<div>
		      			<input type="Password" class="form-control form-control1 mod-in dest-text bt-gr" id="log_password" name="log_password" placeholder="Password">
		      			<p class="field-error"></p>
		      		</div>
		     		<a href="#" class="forget">Forget Password?</a>
	     		</form>
	      	  </div>
      			<button type="button" class="btn btn-success log-butt" onclick="login();">Login</button>
      			<div class="register"> Do not have an account?<a href="#" class="regi"> Register</a>
      			</div>
      			<div class="aline-cen">
	    		<!-- <div class="line"><img src="images/orh.png"></div>
	        	<div class="butt"><a href="#"><img src="images/google.png"></a></div>
	        	<div class="butt"><a href="#"><img src="images/facebook.png"></a></div> -->
        	</div>
    	   </div>				    	   
        </div>        
        </div>
        <!-- Modal footer -->              
      </div>
    </div>
  </div>		
  <!--The Login Modal-->

  <!-- The register Modal -->
  <div class="modal fade" id="myModal-sign">
    <div class="modal-dialog modal-lg">
      <div class="modal-content modal-content1">
       <!-- Modal body -->
        <div class="modal-body mod">
        <div class="row">
        <div class="col-sm-4 col-md-4 col-lg-4 mod-img1"></div>
        	<div class="col-sm-8 col-md-8 col-lg-8" align="center">
          		<button type="button" class="close" data-dismiss="modal">&times;</button>
                <!-- Modal Header -->
                <form method="post" name="signupForm" id="signupForm" >
			        <div class="modal-header modal-header1 mod-head">
			          <h5 class="modal-title">Register with us for experience the Best... </h5></div>
			          <div class="row">
			          		<input type="hidden" name="action" value="register"/>
							<div class="col-sm-12 col-md-12 col-lg-12">
				        		<input type="text" class="form-control reg-in" id="reg_name" name="reg_name" placeholder="Name">
				        		<p class="field-error"></p>
				        	</div>
				        	<div class="col-sm-12 col-md-12 col-lg-12">
				        		<input type="text" class="form-control reg-in" id="reg_mobile" name="reg_mobile" placeholder="Mobile Number">
				        		<p class="field-error"></p>
				        	</div>
				        	<div class="col-sm-12 col-md-12 col-lg-12">
				        		<input type="text" class="form-control reg-in" id="reg_email" name="reg_email" placeholder="Email Id">
				        		<p class="field-error"></p>
				        	</div>
				        	<div class="col-sm-6 col-md-6 col-lg-6">
				        		<input type="password" class="form-control reg-in" id="reg_password" name="reg_password" placeholder="Password">
				        		<p class="field-error"></p>
				        	</div>
				        	<div class="col-sm-6 col-md-6 col-lg-6">
				        		<input type="password" class="form-control reg-in" id="reg_vpassword" name="reg_vpassword" placeholder="Verify Password">
				        		<p class="field-error"></p>
				        	</div><br/>
				        	<div class="regi-cen">
				      			<button type="button" class="btn btn-success log-butt text-uppercase" onclick="register()">Submit</button>
				      			<div class="register"> Welcome to Shravani Tourism</div> 			
							</div>
						</div>				    	   
					</div>      
				</form>  
       		</div>
        <!-- Modal footer -->
        </div>              
      </div>
    </div>
  </div>		
  <!--The register Modal-->

				</div>
				<div class="col-sm-12 col-ms-12 col-lg-12 hidden-xs row">
				<!--Navbar-->
				<nav class="navbar navbar-expand-lg navbar-light header-nav">
				  <a class="navbar-brand" href="#"></a>
				  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
				    <span class="navbar-toggler-icon"></span>
				  </button>

				  <div class="collapse navbar-collapse" id="navbarSupportedContent">
				    <ul class="navbar-nav mr-auto">
				      <li class="nav-item active">
				        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
				      </li>
				      <li class="nav-item dropdown space-nav text-center">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          Maharashtra <br/>Tours
				        </a>
				        <div class="dropdown-menu header-nav" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="<?php echo LIVEROOT;?>ashtavinayak-packages.php">Ashtavinayk Yatra</a>
				          <a class="dropdown-item" href="<?php echo LIVEROOT;?>packages.php?q=Maharashtra%20Tours&category=Maharashtra%20Tours&subcategory=Daily%20Tour">Daily Tours</a>
				          <a class="dropdown-item" href="<?php echo LIVEROOT;?>packages.php?q=Maharashtra%20Tours&category=Maharashtra%20Tours&subcategory=Religious%20Tour">Religious Tours</a>
				          <a class="dropdown-item" href="<?php echo LIVEROOT;?>packages.php?q=Maharashtra%20Tours&category=Maharashtra%20Tours&subcategory=Kokan%20Tour">Kokan Tours</a>
				          <a class="dropdown-item" href="<?php echo LIVEROOT;?>packages.php?q=Maharashtra%20Tours&category=Maharashtra%20Tours&subcategory=Holiday%20Tour">Holiday Tours</a>
				          <!-- <div class="dropdown-divider"></div>
				          <a class="dropdown-item" href="<?php echo LIVEROOT;?>packages.php?q=Maharashtra-Tours&category=Maharashtra-Tours">All Maharashtra Tours</a>
				        </div> -->
				      </li>
				      <li class="nav-item dropdown space-nav text-center">
				        <a class="nav-link dropdown-toggle" href="<?php echo LIVEROOT;?>packages.php?q=India-Tours&category=India-Tours" >
				          India <br/>Tours
				        </a>
				      </li>
				      <li class="nav-item dropdown space-nav text-center">
				        <a class="nav-link dropdown-toggle" href="<?php echo LIVEROOT;?>family-holiday-tours.php" >
				          Family Holiday <br/>Tours
				        </a>
				      </li>
				      <li class="nav-item dropdown space-nav text-center">
				        <a class="nav-link dropdown-toggle" href="<?php echo LIVEROOT;?>packages.php?q=Honeymoon-Tours&category=Honeymoon-Tours">
				          Honeymoon <br/>Tours
				        </a>
				      </li>
				      <li class="nav-item dropdown space-nav  text-center">
				        <a class="nav-link dropdown-toggle" href="<?php echo LIVEROOT;?>packages.php?q=Speciality-Tours&category=Speciality-Tours">
				          Speciality<br/> Tours
				        </a>
				      </li>
				      <li class="nav-item dropdown space-nav  text-center">
				        <a class="nav-link dropdown-toggle" href="<?php echo LIVEROOT;?>packages.php?q=International-Tours&category=International-Tours">
				          International<br/> Holidays
				        </a>
				      </li>
				      <li class="nav-item space-nav">
				        <a class="nav-link" href="<?php echo LIVEROOT;?>about-us.php">About <br/> &nbsp;&nbsp;&nbsp;US</a>
				      </li>
				      <li class="nav-item space-nav">
				        <a class="nav-link" href="<?php echo LIVEROOT;?>terms-and-conditions.php">Terms &nbsp;&nbsp;& <br/> Conditions</a>
				      </li>
				      <?php if($_SESSION && isset($_SESSION['name']) && $_SESSION['name'] != ''){ ?>
				      <li class="nav-item space-nav">
				        <a class="nav-link" href="<?php echo LIVEROOT;?>my-bookings.php">My &nbsp;&nbsp;<br/> Bookings</a>
				      </li>
				  	  <?php } ?>
				      <!-- <li class="nav-item space-nav">
				        <a class="nav-link" href="#">Contact US</a>
				      </li> -->
				  </div>
				</nav>
				<!--Navbar-->	
			</div>
		</div>
	</div>
<div class="hr hr-bg-grey"></div>
</header>

<script type="text/javascript">
	$( document ).ready(function() {
		

	});

	function submitEnquiry(){
		error = false;
		$('.field-error').html("");
		var name = trim($('#enquiry_name').val());
		var email = trim($('#enquiry_email').val());
		var mobile = trim($('#enquiry_mobile').val());
		var city_of_guest = trim($('#enquiry_city_of_guest').val());
		var time_to_travel = trim($('#enquiry_time_to_travel').val());
		var duration = trim($('#enquiry_duration').val());
		var place_to_travel = trim($('#enquiry_place_to_travel').val());
		var travel_type = trim($('#enquiry_travel_type').val());
		var mode_to_contact = trim($('#enquiry_mode_to_contact').val());

		if(name == ''){
			$('#enquiry_name').next().html("Required field");
			error = true;
		}

		if(email == ''){
			$('#enquiry_email').next().html("Required field");
			error = true;
		}

		if(mobile == ''){
			$('#enquiry_mobile').next().html("Required field");
			error = true;
		}

		if(city_of_guest == ''){
			$('#enquiry_city_of_guest').next().html("Required field");
			error = true;
		}

		if(!error){
			$.ajax({
				url:'requests.php',
				type: 'POST',
			    data:$('#enquiry_form').serialize(),
			    success: function (data,status,xhr) {   // success callback function
			        console.log(data);
			        msg = "";
			        if(data.indexOf("token=") !== -1){
			        	token = data.replace("token=", "");
			        	msg = "Token "+token+" generated for the enquiry. Tour specialist will get in touch with you shorty.";
			        }else{
			        	msg = "Something went wrong. Please reload the page and try again.";
			        }
			        $('#enquiry_form_div').hide();
			        $('#enquiry_submit').hide();
			        $('#enquiry_form_msg').html(msg).show();
			    },
			    error: function (jqXhr, textStatus, errorMessage) { // error callback 
			        console.log('Error: ' + errorMessage);
			    }
			});
		}


	}

	function register() {
		var error = false;
		var name = trim($('#reg_name').val());
		var mobile = trim($('#reg_mobile').val());
		var email = trim($('#reg_email').val());
		var password = trim($('#reg_password').val());
		var vpassword = trim($('#reg_vpassword').val());
		$('.error-field').html();

		if(name == ''){
			$('#reg_name').next().html("Required field");
			error = true;
		}else if(name.length > 255){
			$('#reg_name').next().html("Characters length must be less than 255.");
			error = true;
		}

		if(mobile == ''){
			$('#reg_mobile').next().html("Required field");
			error = true;
		}

		if(email == ''){
			$('#reg_email').next().html("Required field");
			error = true;
		}else if(email.length > 255){
			$('#reg_email').next().html("Characters length must be less than 255.");
			error = true;
		}else if(!validateEmail(email)){
			$('#reg_email').next().html("Invalid Email.");
			error = true;
		}

		if(password == ''){
			$('#reg_password').next().html("Required field");
			error = true;
		}else if(password.length > 255){
			$('#reg_password').next().html("Characters length must be less than 255.");
			error = true;
		}

		if(vpassword == ''){
			$('#reg_vpassword').next().html("Required field");
			error = true;
		}else if(vpassword.length > 255){
			$('#reg_vpassword').next().html("Characters length must be less than 255.");
			error = true;
		}

		if(password != vpassword){
			$('#reg_vpassword').next().html("Password and Verify Password doesn't match.");
			error = true;
		}

		if(!error){
			$.ajax({
				url:'requests.php',
				type: 'POST',
			    data:$('#signupForm').serialize(),
			    success: function (data,status,xhr) {   // success callback function
			        if(trim(data) == 'success'){
		            	location.reload();
		            } 
		            else{
		            	$('#reg_email').next().html('Email already used.').show();
		            }
			    },
			    error: function (jqXhr, textStatus, errorMessage) { // error callback 
			        console.log('Error: ' + errorMessage);
			    }
			});
		}
	}

	function login(){
		var email = trim($('#log_email').val());
		var password = trim($('#log_password').val());

		$.ajax({
			url:'requests.php',
			type: 'POST',
		    data:$('#signinForm').serialize(),
		    success: function (data) {   // success callback function
		        if(trim(data) == 'success'){
	            	location.reload();
	            } else if(trim(data) == 'fail'){
	            	$('#log_password').next().html('Invalid Email/Mobile and Password Combination.').show();
	            }
		    },
		    error: function (jqXhr, textStatus, errorMessage) { // error callback 
		        console.log("Error");
		    }
		});
	}

	function logout(){
		window.location.href = 'logout.php';
	}


	function validateEmail(email) {
	    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
	    return re.test(email);
	}

	function trim (str) {
	    return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
	}
	
</script>