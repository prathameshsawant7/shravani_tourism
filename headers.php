<header>
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
        <form>
        <div class="modal-body">
	        <div class="row form-group">
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<input type="Name" class="form-control mod-in" id="name" placeholder="Name">
	        	</div>
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<input type="Last name" class="form-control mod-in" id="lname" placeholder="Last Name">
	        	</div><br/>
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<input type="text" class="form-control mod-in" id="name" placeholder="Mobile Number">
	        	</div>
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<input type="text" class="form-control mod-in" id="lname" placeholder="Email Id">
	        	</div>
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<input type="text" class="form-control mod-in" id="name" placeholder="Time To Travel">
	        	</div>
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<input type="text" class="form-control mod-in" id="lname" placeholder="Travel Duration">
	        	</div>
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<input type="text" class="form-control mod-in" id="name" placeholder="City of Residence">
	        	</div>
	        	<div class="col-sm-6 col-md-6 col-lg-6">
	        		<select class="form-control mod-in dest-text bt-gr" id="sel1" name="sellist1">
				        <option>Mahabaleshwar</option>
				        <option>Kokan</option>
				        <option>Goa</option>
				        <option>Rajasthan</option>
				        <option>Kerala</option>
				        <option>Hyderabad</option>
				        <option>Shimla</option>
				        <option>Manali</option>
				        <option>Darjeeling</option>
				        <option>Sikkim</option>
				        <option>Gujrath</option>
				        <option>Mysore</option>
				        <option>Ooty</option>
				        <option>Mumbai</option>
				     </select>

	        	</div>
	        	<div class="col-sm-12 col-md-12 col-lg-12">
	        		<select class="form-control mod-in dest-text bt-gr" id="sel1" name="sellist1">
	        			<option>Type Of Travel</option>
				        <option>Group Tour</option>
				        <option>Customized Tour</option>
				        <option>Honeymoon Tour</option>
				        <option>Speciality Tour</option>
				        <option>Maharashtra Tours</option>
				        <option>International Tours</option>
				    </select>
	        	</div>
	        	<div class="col-sm-12 col-md-12 col-lg-12">
	        		<select class="form-control mod-in dest-text bt-gr" id="sel1" name="sellist1">
	        			<option>Prefferd mode of communication</option>
				        <option>Call Me</option>
				        <option>Email Me</option>
				        <option>Msg/What's App Me</option>
				    </select>
	        	</div>
	        </div>	         
		</form>
        </div>
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
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
				<img src="images/logo.png" class="img-fluid">
			</a>
		</div>
		<div class="col- col-sm-9 col-md-9 col-lg-9">
			<div class="col-sm-12 col-ms-12 col-lg-12 hidden-xs">
				<div class="right-box-head">
					<ul style="list-style:none;">
			          <li class="top-butt track_order"><div class="dropdown">
					    <button type="button" class="btn dropdown-toggle drop-down" data-toggle="dropdown">Call: 9819124692    </button>
					    <div class="dropdown-menu  drop-li drop-down">
					      <a class="dropdown-item" href="#">9819124960</a>
					      <a class="dropdown-item" href="#">9819124690</a>
					      <a class="dropdown-item drop-li" href="#">9819124960</a><hr/>
					      <p align="center">We are Open Today<br/>
					      <h6 align="center">11am to 9 pm<h6></p>
					    </div>
					  </div>
 					 </li>
 					 <li class="top-butt track_order">
			            <a href="#" class="header-text">Help</a>
			          </li>
 					 <?php if(!$_SESSION){ ?>
				          <li class="top-butt track_order">
				            <a href="#myModal-log"  class="header-text" data-toggle="modal" >Login</a>
				          </li>
				          <li class="top-butt track_order">
				            <a href="#myModal-sign"  class="header-text" data-toggle="modal" >Sign Up</a>
				          </li>
			      	  <?php } else { ?>

			      	  	<li class="top-butt track_order">
					        <a class="header-text nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="margin-top: -7px;">
					          Welcome, <b><?php echo $_SESSION['name'];?></b>
					        </a>
					        <div class="dropdown-menu header-nav" style="margin-left:75px;" aria-labelledby="navbarDropdown">
					          <a class="dropdown-item" onclick="logout();" >Logout</a>
					        </div>
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
				      <li class="nav-item space-nav">
				        <a class="nav-link" href="#">About US</a>
				      </li>
				      <li class="nav-item dropdown space-nav text-center">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          Maharashtra <br/>Tours
				        </a>
				        <div class="dropdown-menu header-nav" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="#">Action</a>
				          <a class="dropdown-item" href="#">Another action</a>
				          <div class="dropdown-divider"></div>
				          <a class="dropdown-item" href="#">Something else here</a>
				        </div>
				      </li>
				      <li class="nav-item dropdown space-nav text-center">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          Domestic <br/>Tours
				        </a>
				        <div class="dropdown-menu header-nav" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="#">Action</a>
				          <a class="dropdown-item" href="#">Another action</a>
				          <div class="dropdown-divider"></div>
				          <a class="dropdown-item" href="#">Something else here</a>
				        </div>
				      </li>
				      <li class="nav-item dropdown space-nav text-center">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          Customized <br/>Tours
				        </a>
				        <div class="dropdown-menu header-nav" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="#">Action</a>
				          <a class="dropdown-item" href="#">Another action</a>
				          <div class="dropdown-divider"></div>
				          <a class="dropdown-item" href="#">Something else here</a>
				        </div>
				      </li>
				      <li class="nav-item dropdown space-nav text-center">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          Honeymoon <br/>Tours
				        </a>
				        <div class="dropdown-menu header-nav" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="#">Action</a>
				          <a class="dropdown-item" href="#">Another action</a>
				          <div class="dropdown-divider"></div>
				          <a class="dropdown-item" href="#">Something else here</a>
				        </div>
				      </li>
				      <li class="nav-item dropdown space-nav  text-center">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          Speciality<br/> Tours
				        </a>
				        <div class="dropdown-menu header-nav" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="#">Action</a>
				          <a class="dropdown-item" href="#">Another action</a>
				          <div class="dropdown-divider"></div>
				          <a class="dropdown-item" href="#">Something else here</a>
				        </div>
				      </li>
				      <li class="nav-item dropdown space-nav  text-center">
				        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				          International<br/> Holidays
				        </a>
				        <div class="dropdown-menu header-nav" aria-labelledby="navbarDropdown">
				          <a class="dropdown-item" href="#">Action</a>
				          <a class="dropdown-item" href="#">Another action</a>
				          <a class="dropdown-item" href="#">Something else here</a>
				        </div>
				      </li>
				      <li class="nav-item space-nav">
				        <a class="nav-link" href="#">Contact US</a>
				      </li>
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