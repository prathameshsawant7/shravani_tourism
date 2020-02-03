function tourEnquiry(){
	var name		=	trim($('#enquiry_name').val());
	var email		=	trim($('#enquiry_email').val());
	var contact		=	trim($('#enquiry_mobile').val());
	error			=   false;
	
	$('#eenquiry_name').hide();
	$('#eenquiry_email').hide();
	$('#eenquiry_mobile').hide();
	$('#enquiry_msg').hide();
	

	if(name == ''){
		$('#eenquiry_name').html('*Required').show();
		error	= true;
	}
	
	if(email == ''){
		$('#eenquiry_email').html('*Required').show();
		error	= true;
	}
	else if(!validateEmail(email)){
		$('#eenquiry_email').html('*Invalid Email').show();
		error	= true;
	}

	if(contact == ''){
		$('#eenquiry_mobile').html('*Required').show();
		error	= true;
	}

	if(!error){
		$.ajax({
	        type:"POST",
	        url: 'ajaxcalls.php',
	        data:$('#tourEnquiryForm').serialize(),
	        success: function(response){
	        	if(trim(response)  == 1){
	            	$('#enquiry_msg').html("Form submitted successfully, we'll contact you soon.").show();
	            	$('#enquiry_name').val('');
					$('#enquiry_email').val('');
					$('#enquiry_mobile').val('');
	            } 
	            else{
	            	$('#enquiry_msg').html("Something went wrong, check internet connection").show();
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