function register() {
	var firstname 	=   trim($('#firstname').val());
	var lastname	=	trim($('#lastname').val());
	var password	=	trim($('#password').val());
	var cpassword	=	trim($('#cpassword').val());
	var mobile		=	trim($('#mobile').val());
	var email		=	trim($('#email').val());
	error			=   false;
	
	$('#efirstname').hide();
	$('#elastname').hide();
	$('#epassword').hide();
	$('#ecpassword').hide();
	$('#emobile').hide();
	$('#eemail').hide();

	
	if(firstname == ''){
		$('#efirstname').html('*Required').show();
		error	= true;
	}

	if(lastname == ''){
		$('#elastname').html('*Required').show();
		error	= true;
	}

	if(password == ''){
		$('#epassword').html('*Required').show();
		error	= true;
	}
	
	if(cpassword == ''){
		$('#ecpassword').html('*Required').show();
		error	= true;
	}

	if(password != '' && cpassword != '' && password != cpassword){
		$('#epassword').html('*Password and Confirm Password should match.').show();
		error	= true;
	}

	if(mobile == ''){
		$('#emobile').html('*Required').show();
		error	= true;
	}

	if(email == ''){
		$('#eemail').html('*Required').show();
		error	= true;
	}

	else if(!validateEmail(email)){
		$('#eemail').html('*Invalid Email').show();
		error	= true;
	}

	if(!error){
		$.ajax({
	        type:"POST",
	        url: 'ajaxcalls.php',
	        data:$('#signupForm').serialize(),
	        success: function(response){
	        	if(trim(response)  == 1){
	            	location.reload();
	            } 
	            else{
	            	$('#eemail').html('*Email already used.').show();
	            }
	        }
    	});
	}

}

function login(){
	var email		=	trim($('#user_email').val());
	var password	=	trim($('#user_password').val());
	error			=   false;
	
	$('#euser_email').hide();
	$('#euser_password').hide();
	

	if(password == ''){
		$('#euser_password').html('*Required').show();
		error	= true;
	}
	
	if(email == ''){
		$('#euser_email').html('*Required').show();
		error	= true;
	}

	else if(!validateEmail(email)){
		$('#euser_email').html('*Invalid Email').show();
		error	= true;
	}

	if(!error){
		$.ajax({
	        type:"POST",
	        url: 'ajaxcalls.php',
	        data:$('#signinForm').serialize(),
	        success: function(response){
	        	if(trim(response)  == 1){
	            	location.reload();
	            } 
	            else{
	            	$('#euser_email').html("*Email & Password didn't match.").show();
	            }
	        }
    	});
	}
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function trim (str) {
    return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
}