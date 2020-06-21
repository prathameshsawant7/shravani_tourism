<?php include 'queries.php'; ?>
<!DOCTYPE html>
<html>
<head>
	<title>Shravani-Tourism</title>
	<meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/shravani.css" rel="stylesheet">
	<link rel="shortcut icon" type="image/png" href="images/tours/<?php echo $site_images['favicon'];?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
      
	<style>
    .con-wid{
        width:85%!important;
    }
    .inv-tab-bor{
        border:1px solid grey;

    }
    .inv-tab-bor1{
        border-bottom:1px solid grey;
        border-right:1px solid grey;
        
    }
    .inv-tab-bor2{
        border-bottom:1px solid grey;
                
    }
    .col-txt-1{
        padding:5px;
        text-transform: uppercase;
        color:434343;
        font-size: 0.7rem;
        line-height: 1.5rem;
        height:2rem;
        text-align: center;
    }
.col-txt-head-book{
        padding:5px;
        text-transform: uppercase;
        color:434343;
        font-size: 0.9rem;
        line-height: 1.5rem;
        height:3.5rem;
        text-align: center;
        font-weight: 600;
    }
    .col-txt-head-right{
        padding:5px;
        text-transform: uppercase;
        color:434343;
        font-size: 0.9rem;
        line-height: 1.5rem;
        height:2rem;
        text-align: right;
        font-weight: 600;
    }
    .col-txt-head-left{
        padding:5px;
        text-transform: uppercase;
        color:434343;
        font-size: 0.9rem;
        line-height: 1.5rem;
        height:2rem;
        text-align: left;
        font-weight: 600;
    }
    .col-txt-head-right2{
        padding:5px;
        text-transform: uppercase;
        color:grey;
        font-size: 0.7rem;
        line-height: 1.5rem;
        height:2rem;
        text-align: right;
        font-weight: 600;
    }
</style>
</head>
<body>
<div class="container-fluide">
<?php include 'headers.php'; ?>
<div class="container con-wid">
        <form>
        <div class="col- col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <div class='text-center p-3'><h4>Booking History</h4></div>
            <div class="form-group">
                <div class ="row inv-tab-bor">
                    
                    <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2  inv-tab-bor1 col-txt-head-book">
                        Ticket 
                    </div>
                    <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 inv-tab-bor1 col-txt-head-book">
                        Booking Date
                    </div>
                    <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 inv-tab-bor1 col-txt-head-book">
                        Tour Date
                    </div>
                    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 inv-tab-bor1 col-txt-head-book">
                        Tour DESTINATION
                    </div>
                    <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 inv-tab-bor1 col-txt-head-book">
                        Status
                    </div>
                    <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-head-book">
                        Download
                    </div>

                    <?php
                        $query = "SELECT b.id,b.ticket,t.tour_name,b.tour_date,DATE_FORMAT(b.added_on,'%d/%m/%Y') as booking_date,b.status FROM ashtavinayak_bookings as b LEFT JOIN tours as t ON t.id=b.tour_id WHERE b.added_by = ".$_SESSION['user_id']." ORDER BY b.id DESC";
                        $fetch_data = mysqli_query($con,$query);
                        $is_available=0;
                        while ($result = $fetch_data->fetch_assoc()) { 
                            $is_available=1;
                        ?>
                            <div class="col-sm-2 col-md-2 col-lg-2 col-xl-2  inv-tab-bor1 col-txt-1">
                                <?php echo $result['ticket']; ?>
                            </div>
                            <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 inv-tab-bor1 col-txt-1">
                                <?php echo $result['booking_date']; ?>
                            </div>
                            <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 inv-tab-bor1 col-txt-1">
                                <?php echo $result['tour_date']; ?>
                            </div>
                            <div class="col-sm-4 col-md-4 col-lg-4 col-xl-4 inv-tab-bor1 col-txt-1">
                                <?php echo $result['tour_name']; ?>
                            </div>
                            <div class="col-sm-1 col-md-1 col-lg-1 col-xl-1 inv-tab-bor1 col-txt-1">
                                <?php echo $result['status']; ?>
                            </div>
                            <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 inv-tab-bor2 col-txt-1">
                               <center>
                                  <a href="ticket.php?ticket=<?php echo $result['ticket']; ?>" target="_blank" >Ticket</a>
                                  &nbsp;&nbsp;&nbsp;&nbsp;
                                  <a href="receipt.php?ticket=<?php echo $result['ticket']; ?>" target="_blank">Receipt</a>
                                  &nbsp;&nbsp;&nbsp;&nbsp;
                                  <a href="invoice.php?ticket=<?php echo $result['ticket']; ?>" target="_blank">Invoice</a>
                                </center> 
                            </div>
                    <?php
                        }   

                        if($is_available==0){ ?>
                            <div class="col- col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                <center>No booking history</center>
                            </div>
                    <?php } ?>
                    

                    
                    
                    
                    
                </div>
                
            </div>
        </div>  
    </form>
    </div>


<?php include 'footer.php'; ?>
<script type="text/javascript">
$(document).ready(function(){
    $('#search_box').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length && inputVal.length > 1){
            $.get("requests.php", {action:'home_search',term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents(".search-box").find('input[type="text"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>

    
</body>
</html>