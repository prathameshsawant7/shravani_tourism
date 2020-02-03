<?php
/* Smarty version 3.1.30, created on 2018-03-21 15:21:45
  from "E:\Inetpub\takeabreaktourism.com\www\demo\templates\header.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ab22b319f6e76_90533517',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1db080948d00e65d72173bc63b768b3c3c488785' => 
    array (
      0 => 'E:\\Inetpub\\takeabreaktourism.com\\www\\demo\\templates\\header.tpl',
      1 => 1521625890,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:location_category_list.tpl' => 4,
  ),
),false)) {
function content_5ab22b319f6e76_90533517 (Smarty_Internal_Template $_smarty_tpl) {
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
	<link href="css/take-a-break.css" rel="stylesheet">
	<link href="css/log.css" rel="stylesheet">
</head>
<body>

<div class="container-fluid padding-none">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 padding-none">
		<div class="col-xs-12 hidden-sm hidden-md hidden-lg mobile_bunglow padding-none">
			<div class="div-xs-2 icon-place">
				<ul style="list-style:none;">
					<li class="mobile-icon col-xs-4 padding-none"><a href="mailto:info@takeabreaktourism.com" class="alink"><p><i class="fa fa-envelope" aria-hidden="true"></i></p></a></li>
					<li class="mobile-icon col-xs-4 padding-none"><a href="#" class="alink"><p><i class="fa fa-lock fa-lg" aria-hidden="true"></i></p></a></li>
					<li class="mobile-icon col-xs-4 padding-none"><a href="gift-holiday.php" target="_blank" class="alink"><p><i class="fa fa-gift gift-icon" aria-hidden="true"></i></p></a></li>
				</ul>
			</div>
		</div>

		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-3">
			<div class="logo">
				<a href="index.php"><img src="images/logo.jpg" class="img-responsive logo-img-res"></a>
			</div>
		</div>
		<div class="col-xs-12 col-sm-8 col-md-9 col-lg-9 hidden-xs">
			<div class="right-box-head">
				<ul style="list-style:none;">
					<li class="top-butt">CALL - <a href="tel:1800-103-0051" class="header-text">9819124690 / 9819124960 </a></li>
					
					<!--<li class="top-butt track_order">
						<a href="#" class="header-text">Sign-Up</a>
					</li>-->
					<!-- <?php if ($_smarty_tpl->tpl_vars['loggedIn']->value == 0) {?>
				 		<li class="dropdown top-butt track_order">
			                <a class="dropdown-toggle header-text" data-toggle="dropdown" href="#">Login<span class="caret"></span></a>
			               
			                 <ul class="dropdown-menu drop-padd">
			                  <li class="log-but"><button type="button" class="btn btn-success log-in-but" data-toggle="modal" data-target="#myModal">Log In</button></li>
			                  <li class="new-use-padd">New User?<a href="#myModalsign" class="red-text" data-toggle="modal">Sign Up</a></li>
			                  
			                </ul> 
					    </li> 
					<?php } else { ?>
						<li class="top-butt track_order"> Welcome <?php echo $_smarty_tpl->tpl_vars['firstname']->value;?>
</li>
					<?php }?> -->
					<li class="top-butt track_order">Mail Us - <a href="tel:1800-103-0051" class="header-text">info@takeabreaktourism.com</a></li>
					
					<li class="top-butt track_order">
						<a href="gift-holiday.php" target="_blank" class="header-text"><i class="fa fa-gift gift-icon" aria-hidden="true"></i>
Gift Holiday</a>
					</li>
					<!--
					<li class="top-butt track_order">
						<a href="#" class="header-text">Contact Us</a>
					</li>	
				    
					<li class="top-butt track_order">CALL - <a href="tel:9819124690" class="header-text">9819124690 / 9819124960 </a></li>
					-->
					<?php if ($_smarty_tpl->tpl_vars['loggedIn']->value == 1) {?>
					<li class="top-butt track_order">
						<a href="logout.php" class="header-text"> Logout</a>
					</li>
					<?php }?>				
				</ul>
			</div>			
		</div>
		 <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-md">
      <div class="modal-content1">
        <div class="modal-header1">
          <button type="button" class="close but-close" data-dismiss="modal">&times;</button>
          <h5 class="modal-title mod-til">Sign In</h5>
        </div>

        <form method="post" name="signinForm" id="signinForm">
        <div class="modal-body mod-body">
          <input type="hidden" name="action" id="action" value="signin">
          <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5 log-in-align" align="center">
          <div class="form-group fogp">
          <label style="color: #cc0000;font-size: 10px;float:left;display: none;" id="euser_email"></label>
		  <input type="email" class="form-control1" id="user_email" name="user_email" placeholder="Email">
		  <label style="color: #cc0000;font-size: 10px;float:left;display: none;" id="euser_password"></label>
		  <input type="Password" class="form-control1" id="user_password" name="user_password" placeholder="Password">
      <a href="#" class="forget">Forget Password?</a>
		  </div>
      <input type="button" class="btn btn-default submit" onclick="login()" value="Login">
      <div class="register"> Do not have an account?<a href="#myModalsign" class="regi"> Register</a></div>
      </div>
      </form>
    <!--
    <div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
    
        <div class="butt"><a href="#"><img src="images/google.png"></a></div>
        <div class="butt"><a href="#"><img src="images/facebook.png"></a></div>
        </div>
     </div> 
    -->
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
        <form method="post" name="signupForm" id="signupForm">
        <div class="modal-body mod-body">
          <input type="hidden" name="action" id="action" value="signup">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6" align="center">
	          <div class="form-group fogp">
	          	  <label style="color: #cc0000;font-size: 10px;float:left;display: none;" id="efirstname"></label>
				  <input type="text" class="form-control1" id="firstname" name="firstname" placeholder="First Name">
				  <label style="color: #cc0000;font-size: 10px;float:left;display: none;" id="epassword"></label>
				  <input type="Password" class="form-control1" id="password" name="password" placeholder="Password">
				  <label style="color: #cc0000;font-size: 10px;float:left;display: none;" id="emobile"></label>
				  <input type="text" class="form-control1" id="mobile" name="mobile" placeholder="Mobile No">
			  </div>
    	  </div>
    	<div class="col-xs-12 col-sm-12 col-md-5 col-lg-6">
    		<label style="color: #cc0000;font-size: 10px;float:left;display: none;" id="elastname"></label>
		    <input type="text" class="form-control1" id="lastname" name="lastname" placeholder="Last Name">
		    <label style="color: #cc0000;font-size: 10px;float:left;display: none;" id="ecpassword"></label>
		    <input type="password" class="form-control1" id="cpassword" name="cpassword" placeholder="Confirm Password">
		    <label style="color: #cc0000;font-size: 10px;float:left;display: none;" id="eemail"></label>
		    <input type="email" class="form-control1" id="email" name="email" placeholder="Email">
		    <input type="button" class="btn btn-default submit" onclick="register()" value="Sign Up">
        </div>
        </form>
     </div> 
      </div>
    </div>
  </div>
</div>
<!--Modal1-->
<!--SearchBox
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
						              <li><a href="index.php" class="text-up-case">Home</a></li>
						              <li class="dropdown">
						                <a class="dropdown-toggle text-up-case" data-toggle="dropdown" href="#">Group Tour <span class="caret"></span></a>
						             	<?php $_smarty_tpl->_subTemplateRender("file:location_category_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('cat'=>'1'), 0, false);
?>
 
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
						                <a class="dropdown-toggle text-up-case" data-toggle="dropdown" href="#">Corporate Tour <span class="caret"></span></a>
						                <?php $_smarty_tpl->_subTemplateRender("file:location_category_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('cat'=>'2'), 0, true);
?>
 
						              </li>

						              <li class="dropdown">
						                <a class="dropdown-toggle text-up-case" data-toggle="dropdown" href="#">Tailormade Tour <span class="caret"></span></a>
						                <!-- <?php $_smarty_tpl->_subTemplateRender("file:location_category_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('cat'=>'10'), 0, true);
?>
  -->
						                <?php $_smarty_tpl->_subTemplateRender("file:location_category_list.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('cat'=>'1'), 0, true);
?>
 
						              </li>

						               <li><a href="aboutus.php" class="text-up-case">About Us</a></li>

						               <li><a href="contactus.php" class="text-up-case">Contact Us</a></li>
<!--
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
-->
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
                  
                <!--menu code end--><?php }
}
