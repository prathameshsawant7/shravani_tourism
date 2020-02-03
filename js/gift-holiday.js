function submitHolidayForm(){
	var fromName = trim($('#fromName').val());
	var fromEmail = trim($('#fromEmail').val());
	var fromMobile = trim($('#fromMobile').val());
	var fromAmount = trim($('#fromAmount').val());
	var fromAddress = trim($('#fromAddress').val());
	var toName = trim($('#toName').val());
	var toEmail = trim($('#toEmail').val());
	var toMobile = trim($('#toMobile').val());
	var toAddress = trim($('#toAddress').val());
	$('#error_msg').hide();
	error			=   '';

	if(fromName== '' || fromEmail== '' || fromMobile== '' || fromAmount== '' || fromAddress== '' || toName== '' || toEmail== '' || toMobile== '' || toAddress== ''){
		error = 'Please fill all fields. All fields are compulsory.';
	}else if(!validateEmail(fromEmail)){
		error = 'Enter Valid Senders Email Address.';
	}else if(!validateEmail(toEmail)){
		error = 'Enter Valid Recievers Email Address.';
	}

	if(!error){
		$.ajax({
	        type:"POST",
	        url: 'ajaxcalls.php',
	        data:$('#giftHolidayForm').serialize(),
	        success: function(response){
	        	if(trim(response)  == 1){
	            	$('#error_msg').html("Form submitted successfully, we'll contact you soon.").show();
	            	$('#fromName').val('');
					$('#fromEmail').val('');
					$('#fromMobile').val('');
					$('#fromAmount').val('');
					$('#fromAddress').val('');
					$('#toName').val('');
					$('#toEmail').val('');
					$('#toMobile').val('');
					$('#toAddress').val('');
	            } 
	            else{
	            	$('#error_msg').html("Something went wrong, check internet connection").show();
	            }
	        }
		});
	}else{
		$('#error_msg').html(error).show();
	}
} 


function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(email);
}

function trim (str) {
    return str.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
}