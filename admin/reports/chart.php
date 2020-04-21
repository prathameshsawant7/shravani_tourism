<?php 
include_once("../../configs/defines.php");
include("../../configs/settings.php");
$est =new settings();
$con=$est->connection();
#session_start();

if(isset($_GET['tour_id']) && isset($_GET['tour_type']) && isset($_GET['tour_date']) && isset($_GET['bus_no'])){

	$tour_date    	= mysqli_escape_string($con,$_GET['tour_date']);
    $tour_id        = mysqli_escape_string($con,$_GET['tour_id']);
    $tour_type      = mysqli_escape_string($con,$_GET['tour_type']);
    $bus_no         = mysqli_escape_string($con,$_GET['bus_no']);

    try{
    	$query = "SELECT CONCAT(tour_code,' - ',tour_name) AS tour FROM tours WHERE id = '$tour_id';";
        $tour_fetch_data  = mysqli_query($con,$query);
        $tour_name = $tour_fetch_data->fetch_assoc();


		$query = "SELECT ticket,seat_data,contact_phone,tour_pickup,tour_drop,room_data FROM ashtavinayak_bookings WHERE tour_date='$tour_date' AND tour_id='$tour_id' AND tour_type='$tour_type' AND bus_no='$bus_no' AND active=1;";
        $fetch_data  = mysqli_query($con,$query);
    }catch(Exception $e){
    	echo "Invalid Request";exit;
    }

?>
<!DOCTYPE html>
<html>
<head>
<title>Tour Chart - Shravani Tourism</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
</head>
<style>
	
	.col-txt-1-cen{
		padding:5px;
		text-transform: uppercase;
		color:434343;
		font-size: 0.9rem;
		line-height: 1.5rem;
		height:2rem;
		text-align: center;
	}

.table-head{
		padding:5px;
		text-transform: uppercase;
		color:434343;
		font-size: 0.9rem;
		line-height: 1.5rem;
		height:2rem;
		text-align: center;
		font-weight: 600;
		background-color: #f1f1f1;
	}
	
</style>
<body>
	<div class="container"><BR>
	  <img src="../../images/printButton.gif" class="noPrint" onclick="javascript:window.print();" style="cursor:pointer; " width="85" height="24" /><BR>
	  <div class='text-center p-3'><h4>TOUR PASSENGERS CHART</h4></div>
	          
	  <table class="table table-bordered">
	    <thead>
	      <tr>
	        <th class="table-head">BUS</th>
	        <th class="table-head">TOUR DATE</th>
	        <th class="table-head">TOUR NAME</th>
	        <th class="table-head">TOUR TYPE</th>
	      </tr>
	    </thead>
	    <tbody>
	      <tr>
	        <td class="col-txt-1-cen"><?php echo $bus_no;?></td>
	        <td class="col-txt-1-cen"><?php echo $tour_date;?></td>
	        <td class="col-txt-1-cen"><?php echo $tour_name['tour'];?></td>
	        <td class="col-txt-1-cen"><?php echo $tour_type;?></td>
	      </tr>
	        
	    </tbody>
	  </table>
	  <table class="table table-bordered table-sm">
	    <thead>
	      <tr>
	      	<th class="table-head">TICKET</th>
	        <th class="table-head">SEAT</th>
	        <th class="table-head">NAME</th>
	        <th class="table-head">GENDER</th>
	        <th class="table-head">AGE</th>
	        <th class="table-head">CONTACT</th>
	        <th class="table-head">PICKUP</th>
	        <th class="table-head">DROP</th>
	        <th class="table-head">ROOMS</th>
	        <th class="table-head" style="width: 8%;">ROOM NO</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php 
	    	while ($booking_data = $fetch_data->fetch_assoc()) {
	    		$seats = json_decode($booking_data['seat_data'],true);
	    		$rooms = json_decode($booking_data['room_data'],true);
	    		$rooms_count = count($rooms);
	    		$row_span = count($seats);
	    		foreach ($seats as $k => $v) {
	        		$ticket = $booking_data['ticket'];
	        		$seat = (string)$v['seat'];
	        		$name = $v['name'];
	        		$gender = $v['gender'];
	        		$age = $v['age'];
	        		$phone = $booking_data['contact_phone'];
	        		$pickup = $booking_data['tour_pickup'];
	        		$drop = $booking_data['tour_drop'];

	    	?>
	    	<tr>
	    		<?php if($row_span != 0){ ?>
		        <td class="col-txt-1-cen" rowspan="<?php echo $row_span; ?>"><center><?php echo $ticket; ?></center></td>
		    	<?php } ?>
		        <td class="col-txt-1-cen"><?php echo $seat; ?></td>
		        <td class="col-txt-1-cen"><?php echo $name; ?></td>
		        <td class="col-txt-1-cen"><?php echo $gender; ?></td>
		        <td class="col-txt-1-cen"><?php echo $age; ?></td>
		        <?php if($row_span != 0){ ?>
		        <td class="col-txt-1-cen" rowspan="<?php echo $row_span; ?>"><?php echo $phone; ?></td>
		        <td class="col-txt-1-cen" rowspan="<?php echo $row_span; ?>"><?php echo $pickup; ?></td>
		        <td class="col-txt-1-cen" rowspan="<?php echo $row_span; ?>"><?php echo $drop; ?></td>
		        <td class="col-txt-1-cen" rowspan="<?php echo $row_span; ?>"><?php echo $rooms_count; ?></td>
		        <td class="col-txt-1-cen" rowspan="<?php echo $row_span; ?>"></td>
		        <?php } ?> 
		      </tr>
	    	<?php 
	    		$row_span = 0;
	    			} 

	    		} 
	    	?>
	      
	    </tbody>
  	</table>
</div>

</body>
</html>
<?php }else{ 
	echo "Invalid Data";
}?>