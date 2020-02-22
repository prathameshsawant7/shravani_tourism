<?php
include_once("../configs/defines.php");
include("../configs/settings.php");
$est =new settings();
$con=$est->connection();
session_start(); 
include_once("Razorpay.php");


use Razorpay\Api\Api;

$api = new Api(RAZOR_KEY_ID, RAZOR_KEY_SECRET);


$booking_id = $_SESSION['booking_id'];
$query = "SELECT * FROM ashtavinayak_bookings WHERE id = ".$booking_id;
$fetch_data = mysqli_query($con,$query);
$result = $fetch_data->fetch_assoc();

$order = $api->order->create(array(
  'receipt' => $booking_id,
  'amount' => intval($result['total_cost'])*100,
  'payment_capture' => 1,
  'currency' => 'INR'
  )
);


$name = $result['contact_name'];
$phone = $result['contact_phone'];
$email = $result['contact_email'];
$total_cost = $result['total_cost'];


?>
<!DOCTYPE html>
<html>
<head>
	<title>Package Details</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<link href="css/shravani.css" rel="stylesheet">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
     <style>
     	.pay{
     		width:80%;
     		display: inline-block;
     		margin: 0 auto;
     		padding: 3px;
     		background-color: #dfdfdf;
     		border:1px solid #838383;
     	}
     	.o-pay{
     		border-bottom: border:1px solid #838383!important;
     		padding:2rem;
     	}
     	.text1{
     		font-size: 0.8rem;
     		padding-left:0.5rem;
     		background-color: #acacac;
     		color: #212221;
     		font-weight: 400;
     		text-align: left;
     		line-height: 25px;
     		letter-spacing: 1.3px;
     	}
     </style>
</head>
<body>
<div class="container-fluide">
	<div class="container text-center">
		<BR>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 pay">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 o-pay"><h2>Online Payment</h2></div>
			<div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text1">
					Name:
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<?php echo $name;?>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text1">
					Phone:
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<?php echo $phone;?>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text1">
					Email:
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<?php echo $email;?>
				</div>
				<div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 text1">
					Total Amount:
				</div>
				<div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
					<?php echo $total_cost;?>
				</div>
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<form action="../booking_confirmed.php" method="POST">
						<script
						    src="https://checkout.razorpay.com/v1/checkout.js"
						    data-key=<?php echo RAZOR_KEY_ID; ?> // Enter the Key ID generated from the Dashboard
						    data-amount=<?php echo ($total_cost);?> // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise or INR 500.
						    data-currency="INR"
						    data-order_id=<?php echo $order['id']; ?>  // is a sample Order ID. Create an Order using Orders API. (https://razorpay.com/docs/payment-gateway/orders/integration/#step-1-create-an-order)
						    data-buttontext="Pay with Razorpay"
						    data-name="Shravani Tourism"
						    data-description=""
						    data-image="../images/logo.png"
						    data-prefill.name="<?php echo $name;?>"
						    data-prefill.email="<?php echo $email;?>"
						    data-prefill.contact="<?php echo $phone;?>"
						    data-theme.color="#F37254"
						></script>
						<input type="hidden" custom="Hidden Element" name="hidden">
						</form>
				</div>
			</div>
		</div>
			<!--<table class="table" border="2">
			  <thead class="thead-dark">
			    <tr>
			      <td colspan="2">
			      	<center>
			      		<h2>Online Payment</h2>
			      	</center>
			      </td>
			     </tr>
			  </thead>
			  <thead class="thead-dark">
			    <tr>
			      <th scope="col">Name</th>
			      <td><?php echo $name;?></td>
			    </tr>
			  </thead>
			   <thead class="thead-dark">
			    <tr>
			      <th scope="col">Phone</th>
			      <td><?php echo $phone;?></td>
			    </tr>
			  </thead>
			   <thead class="thead-dark">
			    <tr>
			      <th scope="col">Email</th>
			      <td><?php echo $email;?></td>
			    </tr>
			  </thead>
			   <thead class="thead-dark">
			    <tr>
			      <th scope="col">Total Amount</th>
			      <td><?php echo $total_cost;?></td>
			    </tr>
			  </thead>
			   <thead class="thead-dark">
			    <tr>
			      <td colspan="2">
			      	<center>
			      		<form action="../booking_confirmed.php" method="POST">
						<script
						    src="https://checkout.razorpay.com/v1/checkout.js"
						    data-key=<?php echo RAZOR_KEY_ID; ?> // Enter the Key ID generated from the Dashboard
						    data-amount=<?php echo ($total_cost);?> // Amount is in currency subunits. Default currency is INR. Hence, 50000 refers to 50000 paise or INR 500.
						    data-currency="INR"
						    data-order_id=<?php echo $order['id']; ?>  // is a sample Order ID. Create an Order using Orders API. (https://razorpay.com/docs/payment-gateway/orders/integration/#step-1-create-an-order)
						    data-buttontext="Pay with Razorpay"
						    data-name="Shravani Tourism"
						    data-description=""
						    data-image="../images/logo.png"
						    data-prefill.name="<?php echo $name;?>"
						    data-prefill.email="<?php echo $email;?>"
						    data-prefill.contact="<?php echo $phone;?>"
						    data-theme.color="#F37254"
						></script>
						<input type="hidden" custom="Hidden Element" name="hidden">
						</form>
			      	</center>
			      </td>
			    </tr>
			  </thead>
			</table>-->
		</div>
	</div>
</div>
