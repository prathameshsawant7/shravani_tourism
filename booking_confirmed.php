<?php
include_once("configs/defines.php");
include("configs/settings.php");
include("emailer.php");
$est =new settings();
$con=$est->connection();
session_start();
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
     <!--Calender-->
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script>
    <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <!--Calender-->
   
</head>
<body>
<div class="container-fluide">
<?php include 'headers.php'; ?>
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><img src="images/ashtvinayak-ban01.jpg" class="img-fluid"></div>


    <BR>
    <div class="container">
      <BR>
      <?php
        $confirmed = false;
        if(isset($_SESSION['booking_id'])){
          $booking_id = $_SESSION['booking_id'];
          $query = "SELECT * FROM ashtavinayak_bookings WHERE id = ".$booking_id;
          $fetch_data = mysqli_query($con,$query);
          $result = $fetch_data->fetch_assoc();    
          if(isset($_POST['razorpay_payment_id'])){
            $confirmed = true;
            $razorpay_payment_id = $_POST['razorpay_payment_id'];
            $razorpay_order_id = $_POST['razorpay_order_id'];
            $ticket = $result['ticket'];
            $name = $result['contact_name'];
            $phone = $result['contact_phone'];
            $email = $result['contact_email'];
            $total_cost = $result['total_cost'];
            $status = 'confirmed';
            $query = "INSERT IGNORE INTO payments(booking_id,razorpay_payment_id,razorpay_order_id,amount) VALUE 
          (".$booking_id.",'".$razorpay_payment_id."','".$razorpay_order_id."',".$total_cost.")";
            mysqli_query($con,$query);
            $id = mysqli_insert_id($con);
          }else{
            $status = 'payment_failed';
          }

          if($result['status'] == 'incomplete'){
            $email_data = array("ticket"=>$ticket, "name"=>$name);
            $emailer = new Emailer($con, "booking_confirmation" , array($email), $email_data);
            $emailer->generate();
          }

          $query = "UPDATE ashtavinayak_bookings SET status='$status' WHERE id='$booking_id' AND status='incomplete';";
          mysqli_query($con,$query);
        }
        
        

      if($confirmed){
      ?>
      <div class="row pack-bac">
        <table class="table" border="2">
        <thead >
          <tr>
            <td colspan="2">
              <center>
                <h2>Booking Confirmed</h2>
              </center>
            </td>
           </tr>
        </thead>
        <thead class="thead-dark">
          <tr>
            <th scope="col">Ticket no.</th>
            <td><?php echo $ticket;?></td>
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
      </table>
      <h2>
        <center>
          <a href="receipt.php?ticket=<?php echo $ticket;?>" target="_blank" class="btn btn-primary">View Receipt</a>
        </center>
      </h2>

    </div>
<?php

  }else{
    echo "Something went wrong.";
  }

?>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
