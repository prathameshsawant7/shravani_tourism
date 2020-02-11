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
</head>
<body>
<div class="container-fluide">
	<div class="container">
		<BR>
		<div class="row pack-bac">
			<table class="table" border="2">
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
			</table>
		</div>
	</div>
</div>
