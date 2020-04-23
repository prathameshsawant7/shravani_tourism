<?php

include_once("../../configs/defines.php");
include("../../configs/settings.php");
$est =new settings();
$con=$est->connection();

?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Shravani Tourism</title>
        <link rel="stylesheet" href="../css/foundation.css" />
        <link rel="stylesheet" href="../css/app.css" />
        <link rel="stylesheet" href="../css/sol.css" />
        <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
        <link rel="stylesheet" href="../css/multi-select.css" />
    </head>
    <body>
        <?php include '../menu.php'; ?>
        <div id="hiddenFields">
            <input  type="hidden" id="cFullpath" value="<?php echo FULLROOT; ?>">
            <input  type="hidden" id="cWebpath" value="<?php echo WEBROOT; ?>">
        </div>
        
        <center>
            <h4 style="color: green">
            <?php 
                $page_action = '';
                if(!empty($_GET['ticket'])){
                    $ticket          = $_GET['ticket'];
                    $query = "SELECT * FROM ashtavinayak_bookings WHERE ticket='$ticket' AND active=1;";
                    $fetch_data  = mysqli_query($con,$query);
                    $booking_data = $fetch_data->fetch_assoc();
                    $page_action = 'update_booking';
                }else{
                    $page_action = 'add_booking';
                }

                $query = "SELECT DISTINCT t.id, CONCAT(t.tour_code,' - ',t.tour_name) AS tour FROM tours as t LEFT JOIN bus_dates as d ON d.tour_id = t.id WHERE tour_name LIKE '%ASHTAVINAYAK%' AND date_format(STR_TO_DATE(d.date, '%d/%m/%Y'), '%Y%m%d') > date_format(curdate(), '%Y%m%d');";
                $tour_fetch_data  = mysqli_query($con,$query);
                
                $query = "SELECT type,point FROM ashtavinayak_pickup_drop;";
                $pickup_drop_fetch_data  = mysqli_query($con,$query);

                $query = "SELECT name,identifier FROM tour_type;";
                $tour_type_fetch_data  = mysqli_query($con,$query);

                $room_data_arr = json_decode($booking_data['room_data'], true);
                $room_counts = ($room_data_arr != null)?count($room_data_arr):0;
                
            ?>
            </h4>
        </center>
        <form action="insert_tour.php" name="register" method="post">
        <input type="hidden" id="data" name="data" value="ashtavinayak_booking" />
        <input type="hidden" id="room_counts" name="room_counts" value="<?php echo $room_counts;?>" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs" style="margin-left: 30%;">
                <BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="2">
                                <h3 style="color: #000"><center>Add/Edit Bookings</center></h3>
                
                           </th> 
                        </tr>
                        
                        <tr>
                            <th style="border:1px solid #000000;"><label>Booking ID: </label></th>
                            <td> <input type="text" id="id" name="id" value="<?php echo $booking_data['id'];?>" disabled /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Ticket: </label></th>
                            <td> <input type="text" id="ticket" name="ticket" value="<?php echo $booking_data['ticket'];?>" disabled /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour: </label></th>
                            <td >
                                <span style="margin-left: 21px;">
                                    <select id="tour_id" placeholder="Tour" value=""  name="tour_id" onchange="setTourDate()">
                                    <?php 
                                        while($tours = $tour_fetch_data->fetch_assoc()){ 
                                        $selected = ($tours['id'] == $booking_data['tour_id'])?'selected=selected':'';
                                        ?>
                                        <option value="<?php echo $tours['id'];?>" <?php echo $selected;?>>
                                            <?php echo $tours['tour'];?>
                                        </option>
                                        <?php
                                        }
                                    ?>
                                    </select>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour Type: </label></th>
                            <td>
                                <span style="margin-left: 21px;">
                                    <select id="tour_type" placeholder="Tour Type" value=""  name="tour_type" class="triggerSeatCheck" onchange="setTourDate()">
                                        <?php 
                                            while($tour_type = $tour_type_fetch_data->fetch_assoc()){ 
                                            $selected = ($tour_type['identifier'] == $booking_data['tour_type'])?'selected=selected':'';
                                            ?>
                                            <option value="<?php echo $tour_type['identifier'];?>" <?php echo $selected;?>>
                                                <?php echo $tour_type['name'];?>
                                            </option>
                                            <?php
                                            }
                                        ?>
                                    </select>
                                </span>
                            </td>
                        </tr>
                       <tr>
                            <th style="border:1px solid #000000;"><label>Tour Date: </label></th>
                            <td>
                                <span style="margin-left: 21px;">
                                    <input type="hidden" id="tour_date_hidden" value="<?php echo $booking_data['tour_date'];?>">
                                    <select id="tour_date" placeholder="Tour Date" value=""  name="tour_date" class="triggerSeatCheck">
                                    </select>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Pickup Point: </label></th>
                            <td >
                                <span style="margin-left: 21px;">
                                    <select id="pickup_point" value=""  name="pickup_point">
                                    <?php 
                                        while($pickup = $pickup_drop_fetch_data->fetch_assoc()){ 
                                            if($pickup['type'] == 'pickup'){
                                            $selected = ($pickup['point'] == $booking_data['tour_pickup'])?'selected=selected':'';
                                        ?>
                                            <option value="<?php echo $pickup['point'];?>"  <?php echo $selected;?>>
                                                <?php echo $pickup['point'];?>
                                            </option>
                                        <?php
                                            }
                                        }
                                    ?>
                                    </select>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Drop Point: </label></th>
                            <td >
                                <span style="margin-left: 21px;">
                                    <select id="drop_point" value=""  name="drop_point">
                                    <?php 
                                        mysqli_data_seek($pickup_drop_fetch_data,0);
                                        while($drop = $pickup_drop_fetch_data->fetch_assoc()){ 
                                            if($drop['type'] == 'drop'){
                                                $selected = ($drop['point'] == $booking_data['tour_drop'])?'selected=selected':'';
                                        ?>
                                            <option value="<?php echo $drop['point'];?>"  <?php echo $selected;?>>
                                                <?php echo $drop['point'];?>
                                            </option>
                                        <?php
                                            }
                                        }
                                    ?>
                                    </select>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Bus Number: </label></th>
                            <td>
                                <span style="margin-left: 21px;">
                                    <select id="bus_no" placeholder="Bus" value=""  name="bus_no">
                                        <?php 
                                        $buses = ['1','2'];
                                        for($i=0;$i<2;$i++){
                                            $selected = ($buses[$i] == $booking_data['bus_no'])?'selected=selected':'';
                                        ?>
                                            <option value="<?php echo $buses[$i];?>"  <?php echo $selected;?>>
                                                <?php echo $buses[$i];?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Book Seats: </label></th>
                            <td> 
                                <select id="seats" name="seats[]" class="triggerSeatCheck" multiple="multiple" >
                                    <?php
                                        $query = "SELECT seat FROM ashtavinayak_seat_numbers;";
                                        $fetch_data = mysqli_query($con,$query);
                                        $seat_arr = explode(',', $booking_data['seat_no']);
                                        while($seat_data  = $fetch_data->fetch_assoc()){
   
                                            $selected = (in_array($seat_data['seat'], $seat_arr))?'selected=selected':'';
                                            ?>
                                            <option value="<?php echo $seat_data['seat']; ?>" <?php echo $selected;?>>
                                                <?php echo $seat_data['seat']; ?>
                                            </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table id="passenger" border="3px">
                                    <tr>
                                         <th colspan="4" width="100%">Passenger Details</th>
                                    </tr>
                                    <tr>
                                        <th  width="15%">Seat No</th>
                                        <th  width="30%">Name</th>
                                        <th  width="20%">Gender</th>
                                        <th  width="15%">Age</th>
                                    </tr>
                                    <?php
                                    $seat_data_arr = json_decode($booking_data['seat_data'], true);
                                    foreach ($seat_data_arr as $key => $val) {
                                    ?>
                                    <tr class="seat_row" row="<?php echo $val['seat'];?>" id="row_<?php echo $val['seat'];?>" id="row_<?php echo $val['seat'];?>" >
                                        <td  width="15%">
                                            <center><?php echo $val['seat'];?></center>
                                        </td>
                                        <td  width="30%">
                                            <input type="text" id="p_name_<?php echo $val['seat'];?>" name="p_name_<?php echo $val['seat'];?>" value="<?php echo $val['name'];?>">
                                        </td>
                                        <td width="20%">
                                            <center>
                                            <label style="margin: 0px auto;">
                                            <?php
                                            $gender = array("M"=>"Male","F"=>"Female");
                                            foreach ($gender as $k => $v) {
                                            $selected = ($val['gender'] == $k)?'checked="checked"':'';
                                                ?>
                                                <input type="radio" value="<?php echo $k;?>"  name="p_gender_<?php echo $val['seat'];?>" <?php echo $selected;?>> <?php echo $v;?>
                                                <?php
                                            }
                                            ?>
                                            </label>
                                            </center>
                                        </td>
                                        <td  width="15%">
                                            <input type="number" tag="age" tag_id="<?php echo $val['seat'];?>" id="p_age_<?php echo $val['seat'];?>" name="p_age_<?php echo $val['seat'];?>" value="<?php echo $val['age'];?>">
                                        </td>
                                    </tr> 
                                    <?php
                                    }
                                    ?>

                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <p id="room_error" style="color: red;display:none;text-align: left;"></p>
                                <table id="room" border="3px" >
                                    <tr>
                                         <th colspan="3" width="100%">Rooms</th>
                                    </tr>
                                    <?php
                                    
                                    $room_counter = 0;
                                    foreach ($room_data_arr as $key => $val) {
                                        $room_counter += 1;
                                    ?>
                                        <tr class="room_row" id="room_row_<?php echo $room_counter; ?>">
                                            <td><center><b>Room <?php echo $room_counter; ?>: </b></center></td>
                                            <td ><center>
                                            Adults</center><select onchange="roomCountChecker(<?php echo $room_counter; ?>,'adult')" id="room_adult_<?php echo $room_counter; ?>">
                                            <?php
                                            $options = [0,1,2,3];
                                            foreach ($options as $k => $v) { 
                                            $selected = ($val['adult'] == $v)?'selected="selected"':'';   
                                            ?>
                                                <option value="<?php echo $v; ?>" <?php echo $selected; ?>><?php echo $v; ?></option>
                                            <?php } ?>
                                            </select>
                                            </td>
                                            <td>
                                            <center>Kids</center>
                                            <select onchange="roomCountChecker(<?php echo $room_counter; ?>,'child')" id="room_child_<?php echo $room_counter; ?>">
                                            <?php
                                            $options = [0,1,2];
                                            foreach ($options as $k => $v) { 
                                            $selected = ($val['child'] == $v)?'selected="selected"':'';   
                                            ?>
                                                <option value="<?php echo $v; ?>" <?php echo $selected; ?>><?php echo $v; ?></option>
                                            <?php } ?>
                                            </select>
                                            </td>
                                        </tr>
                                <?php } ?>
                                </table>
                                <table id="room_add">
                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <center>
                                            <input type="button" onclick="addRoom()" value="Add Room">
                                            <input type="button" onclick="roomRemove()"value="Remove Room">
                                            </center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table id="passenger" border="3px">
                                    <tr>
                                        <th colspan="2" width="100%">
                                         Calculate / Edit Cost
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000000;"><label>Update Package Cost: </label></th>
                                        <td>
                                            <input type="radio" name="update_cost" name="update_cost" value="y">Yes 
                                            <input type="radio" name="update_cost" value="n" checked="checked">No
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000000;"><label>Tour Cost: </label></th>
                                        <td>
                                            <input class="auto_costs" type="text" id="cost" name="cost" value="<?php echo $costs['cost'];?>" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000000;"><label>Service Charge: </label></th>
                                        <td>
                                             <input class="auto_costs" type="text" id="service_charge" name="service_charge" value="<?php echo $costs['service_charge'];?>" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000000;"><label>Discount: </label></th>
                                        <td>
                                            <input class="auto_costs" type="text" id="discount" name="discount" value="<?php echo $costs['discount'];?>" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000000;"><label>GST <input class="auto_costs" type="text" id="gst_percent" name="gst_percent" value="<?php echo $costs['gst_percent'];?>" style="width: 54px;text-align: center;" disabled>%: </label></th>
                                        <td>
                                            <input class="auto_costs" type="text" id="gst" name="gst" value="<?php echo $costs['gst'];?>" disabled>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000000;"><label>Total Cost: </label></th>
                                        <td>
                                            <input class="auto_costs" type="text" id="total_cost" name="total_cost" value="<?php echo $costs['total_cost'];?>" disabled>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php if($page_action == 'update_booking'){ ?>
                        <tr>
                            <td colspan="2">
                                <table  border="3px" >
                                    <?php
                                    $costs = json_decode($booking_data['cost_data'], true);
                                    ?>
                                    <tr>
                                         <th colspan="5" width="100%">Paid Amount</th>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000000;">
                                            <label>Tour Cost: </label>
                                        </th>
                                        <th style="border:1px solid #000000;">
                                            <label>Service Charge </label>
                                        </th>
                                        <th style="border:1px solid #000000;">
                                            <label>Discount </label>
                                        </th>
                                        <th style="border:1px solid #000000;">
                                            <label>GST <?php echo $costs['gst_percent'];?>%</label>
                                        </th>
                                        <th style="border:1px solid #000000;">
                                            <label>Total Cost </label>
                                        </th>
                                    </tr>
                                    <tr>
                                        
                                        <td><center>Rs. <?php echo $costs['cost'];?></center></td>
                                        <td><center>Rs. <?php echo $costs['service_charge'];?></center></td>
                                        <td><center>Rs. <?php echo $costs['discount'];?></center></td>
                                        <td><center>Rs. <?php echo $costs['gst'];?></center></td>
                                        <td><center>Rs. <?php echo $costs['total_cost'];?></center></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="2">
                                <table  border="3px" >
                                    <tr>
                                         <th colspan="2" width="100%">Contact Details</th>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000000;"><label>Contact Name: </label></th>
                                        <td>
                                            <input type="text" id="contact_name" name="contact_name" value="<?php echo $booking_data['contact_name'];?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000000;"><label>Contact Phone: </label></th>
                                        <td>
                                            <input type="text" id="contact_phone" name="contact_phone" value="<?php echo $booking_data['contact_phone'];?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000000;"><label>Contact Email: </label></th>
                                        <td>
                                            <input type="text" id="contact_email" name="contact_email" value="<?php echo $booking_data['contact_email'];?>">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000000;"><label>Contact Address: </label></th>
                                        <td>
                                            <textarea id="contact_address" name="contact_address"><?php echo $booking_data['contact_address'];?></textarea>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table  border="3px" >
                                    <tr>
                                         <td width="33%"><center>Status</center></td>
                                         <td>
                                             <select id="status" name="status">
                                                <?php
                                                $status = ['confirmed','cancelled','incomplete'];
                                                foreach ($status as $k => $v) {
                                                $selected = ($booking_data['status'] == $v)?'selected="selected"':'';
                                                ?>
                                                <option value="<?php echo $v;?>" <?php echo $selected;?>><?php echo ucwords($v);?></option>
                                                <?php
                                                }
                                                ?>
                                             </select>
                                         </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <input type="button" onclick="submitBooking()" class="small button" value="Submit" style="margin-bottom: -4px;"/>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
               
                <input type="hidden" id="page_action" name="page_action" value="<?php echo $page_action;?>" />
                <input type="hidden" id="id" name="id" value="<?php echo $id;?>" />
                
            </div>
        </div>
        <script src="../js/jquery-1.11.2.min.js"></script>
        <script src="../js/menu.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <script src="../js/vendor/what-input.min.js"></script>
        <script src="../js/foundation.min.js"></script>
        <script src="../js/jquery.reveal.js"></script>
        <script src="../js/app.js"></script>
        <script src="../js/sol.js"></script>
        <script src="../js/tinymce.min.js"></script>
        <script src="../js/jquery.multi-select.js"></script>
        <script>
            $('#seats').multiSelect();
        </script>
        <script type="text/javascript">
            var room_counter = '<?php echo $room_counts;?>';
            var seat_tracker = '';
            var page_action = '<?php echo $page_action;?>';
            $(document).ready(function(){
                setTourDate();
                resetCost();
                if(page_action == 'update_booking'){
                    calculate_tour_cost();
                }
                
            });

            $('input[type=radio][name=update_cost]').change(function() {
                var val = this.value;
                if(val == 'y'){
                    $('.auto_costs').removeAttr('disabled');
                }else{
                    $('.auto_costs').attr('disabled','disabled');
                }
            });


            function submitBooking(){
                var data = {}
                data['updated_by'] = "<?php echo !empty($_SESSION['cID'])?$_SESSION['cID']:''; ?>";
                data['contact_name'] = $('#contact_name').val();
                data['contact_phone'] = $('#contact_phone').val();
                data['contact_email'] = $('#contact_email').val();
                data['contact_address'] = $('#contact_address').val();
                data['id'] = $('#id').val();
                data['ticket'] = $('#ticket').val();
                data['tour_id'] = $('#tour_id').val();
                data['tour_date'] = $('#tour_date').val();
                data['tour_type'] = $('#tour_type').val();
                data['pickup_point'] = $('#pickup_point').val();
                data['drop_point'] = $('#drop_point').val();
                data['bus_no'] = $('#bus_no').val();
                data['seat_no'] = $('#seats').val().toString();
                data['status'] = $('#status').val();

                data['seat_data'] = {};
                counter = 0;
                $('.seat_row').each(function(){
                    seat = $(this).attr('row');
                    data['seat_data'][counter] = {}
                    data['seat_data'][counter]['seat'] = $(this).attr('row');
                    data['seat_data'][counter]['name'] = $('#p_name_'+seat).val();
                    data['seat_data'][counter]['gender'] = $('[name=p_gender_'+seat+']:checked').val();
                    data['seat_data'][counter]['age'] = $('#p_age_'+seat).val();
                    counter++;
                });

                data['room_data'] = {};
                counter = 0;
                $('.room_row').each(function(){
                    data['room_data'][counter] = {};
                    data['room_data'][counter]['adult'] = $('#room_adult_'+(counter+1)).val();
                    data['room_data'][counter]['child'] = $('#room_child_'+(counter+1)).val();
                    counter++;
                });

                data['update_cost'] = $('input[name=update_cost]').val();
                if(data['update_cost'] == 'y'){
                    data['cost']            = $('#cost').val();
                    data['service_charge']  = $('#service_charge').val();
                    data['discount']        = $('#discount').val();
                    data['gst_percent']     = $('#gst_percent').val();
                    data['gst']             = $('#gst').val();
                    data['total_cost']      = $('#total_cost').val();
                }


                console.log(data);

                $.post("ajax_calls.php",{request:page_action,data:data},function(data) {
                    if(data.trim() == 'success'){
                        if(page_action == 'update_booking'){
                            alert("Booking Updated");
                        }else{
                            alert("Booking Created");
                        }
                        
                        window.location.href = "../orders/ashtavinayak.php";
                    }
                }); 
            }


            function resetCost(){
                $('#total_cost').html("0");
                $('#cost').html("0");
                $('#service_charge').html("0");
                $('#gst').html("0");
                $('div[tag=gstDiv]').hide();
                $('#discount').html("0");
                $('div[tag=discountDiv]').hide();
                $('#submit').prop('disabled','disabled');
            }

            function calculate_tour_cost(){
                count = $('.room_row').length;
                if(count > 0){
                    rooms = {};
                    for(i=0;i<count;i++){
                        rooms[i] = {};
                        rooms[i]['adult'] = $('#room_adult_'+(i+1)).val();
                        rooms[i]['child'] = $('#room_child_'+(i+1)).val();
                    }
                }
               // console.log(rooms);

                var tour_id     = $('#tour_id').val();
                var tour_type   = $('#tour_type').val();

                $.get("../../requests.php",
                    {action:'getTourCost',id:tour_id,tour_type:tour_type,rooms:JSON.stringify(rooms)},
                    function(data) {

                    console.log(data);
                    $('.auto_costs').removeAttr('disabled');
                    var price = JSON.parse(data);
                    $('#total_cost').val(price['total_cost']);
                    $('#cost').val(price['cost']);
                    $('#service_charge').val(price['service_charge']);
                    if(price['gst'] != 0){
                        $('#gst').val(price['gst']);
                        $('#gst_percent').val(price['gst_percent']);
                        $('div[tag=gstDiv]').show();
                    }else{
                        $('div[tag=gstDiv]').hide();
                    }
                    if(price['discount'] != 0){
                        $('#discount').val(price['discount']);
                        $('div[tag=discountDiv]').show();
                    }else{
                        $('div[tag=discountDiv]').hide();
                    }
                    //$('#submit').removeAttr('disabled');
                    $('.auto_costs').attr('disabled','disabled');
                }); 

            }

            function num_to_rs(x){
                x=x.toString();
                var afterPoint = '';
                if(x.indexOf('.') > 0)
                   afterPoint = x.substring(x.indexOf('.'),x.length);
                x = Math.floor(x);
                x=x.toString();
                var lastThree = x.substring(x.length-3);
                var otherNumbers = x.substring(0,x.length-3);
                if(otherNumbers != '')
                    lastThree = ',' + lastThree;
                return res = otherNumbers.replace(/\B(?=(\d{2})+(?!\d))/g, ",") + lastThree + afterPoint;
            }


            $('.triggerSeatCheck').on('change',function() {
                var seat = ($('#seats').val());
                var action = "add";
                if(seat_tracker != null){
                    $.each(seat_tracker, function(idx, value) {
                        if (seat != null && $.inArray(value, seat) == -1) {
                            action = "remove";
                            removePassenger(value);
                        }else if(seat == null){
                            removePassenger(value);
                        }
                    });
                }
                seat_tracker = seat;

                if(action == 'add' && seat != null){
                    var tour_id = $('#tour_id').val();
                    var tour_date = $('#tour_date').val();
                    var tour_type = $('#tour_type').val();
                    var bus_no = $('#bus_no').val();
                    var ticket = $('#ticket').val();
                    $.get("ajax_calls.php",{request:'getNonAvailableSeats',id:tour_id,type:tour_type,date:tour_date,bus_no:bus_no,ticket:ticket},function(data) {
                        if(data != ''){
                            var non_available_seats = JSON.parse(data);
                            $.each(seat, function (index, value) {
                                if(non_available_seats.indexOf(value) > -1){
                                    $('#seats').multiSelect('deselect', value);
                                    if($('#row_'+value).length){
                                        removePassenger(value);
                                    }
                                    alert(value + " - Seat is already booked.");
                                }else{
                                    if(!$('#row_'+value).length){
                                        $('#passenger').append(createPassenger(value));
                                    }
                                    
                                }
                            });
                        }
                    }); 
                }
            });


            function createPassenger(id){
                var html = "";
                html += '<tr class="seat_row" row="'+id+'" id="row_'+id+'" id="row_'+id+'" >';
                html += '<td  width="15%"><center>'+id+'</center></td>';
                html += '<td  width="30%">';
                html += '<input type="text" id="p_name_'+id+'" name="p_name_'+id+'">';
                html += '</td>';
                html += '<td width="20%"><center>';
                html += '<label style="margin: 0px auto;">';
                html += '<input type="radio" value="M"  name="p_gender_'+id+'"> M ';
                html += '<input type="radio" value="F" name="p_gender_'+id+'"> F ';
                html += '</label>';
                html += '</center></td>';
                html += '<td  width="15%">';
                html += '<input type="number" tag="age" tag_id="'+id+'" id="p_age_'+id+'">';
                html += '</td>';
                html += '</tr>'; 

                return html;
            }

            function removePassenger(id){
                $('#row_'+id).remove();
            }


            function addRoom(){
                count = $('.room_row').length;
                id = count + 1;
                var html = "";
                html += '<tr class="room_row" id="room_row_'+id+'">';
                html += '<td><center><b>Room '+id+': </b></center></td>';
                html += '<td ><center>';
                html += 'Adults</center><select onchange="roomCountChecker('+id+',\'adult\')" id="room_adult_'+id+'">';
                html += '<option value="0">0</option>';
                html += '<option value="1">1</option>';
                html += '<option value="2">2</option>';
                html += '<option value="3">3</option>';
                html += '</select>';
                html += '</td>';
                html += '<td>';
                html += '<center>Kids</center><select onchange="roomCountChecker('+id+',\'child\')" id="room_child_'+id+'">';
                html += '<option value="0">0</option>';
                html += '<option value="1">1</option>';
                html += '<option value="2">2</option>';
                html += '</select>';
                html += '</td>';
                html += '</tr>'; 

                $('#room').append(html);
            }

            function roomCountChecker(id,event){
                switch(event){
                    case 'adult':
                        if($('#room_adult_'+id).val() > 2){
                            $('#room_child_'+id+' option[value="2"]').hide();
                        }else{
                            $('#room_child_'+id+' option[value="2"]').show();
                        }
                        break;
                    case 'child':
                        if($('#room_child_'+id).val() > 1){
                            $('#room_adult_'+id+' option[value="3"]').hide();
                        }else{
                            $('#room_adult_'+id+' option[value="3"]').show();
                        }
                        break;
                }
                checkSeatRoomSelection();
            }


            function roomRemove(id){
                count = $('.room_row').length;
                if(count > 1){
                    $('#room_row_'+count).remove();
                }
            }

            function setTourDate(){
                tour_id = $('#tour_id').val();
                tour_type = $('#tour_type').val();
                $.get("ajax_calls.php",{request:'getTourDatesByTourID',id:tour_id,type:tour_type},function(data) {
                    var dates_html = '';
                    var selected = '';
                    $.each(JSON.parse(data), function (index, value) {
                        if($('#tour_date_hidden').val() != '' && value['date'] == $('#tour_date_hidden').val()){
                            selected = 'selected=selected';
                            $('#tour_date_hidden').val('');
                        }else{
                            selected = '';
                        }


                        dates_html += "<option value='"+value['date']+"'"+selected+">"+value['date']+"</option>";
                    });
                    $('#tour_date').html(dates_html);
                    
                });
            }


            function checkSeatRoomSelection(){
                adult = 0; child = 0;
                //resetCost();
                $('input[tag=age]').each(function(){
                    id = $(this).attr('tag_id');
                    name = $('#p_name'+id).val();
                    gender = $('#p_gender'+id).val();
                    age = $(this).val();


                    if(name=='' || gender=='' || age==''){
                        $('#passenger_error').html('All fields are mandatory to check tour cost.').show();
                    }else{
                        if(age > 8){
                            $('#p_identifier_'+id).html('Adult');
                            adult += 1;
                        }else{
                            $('#p_identifier_'+id).html('Kid');
                            child += 1;
                        }
                        $('#passenger_error').hide();
                    }
                });

                
                if(adult != 0 || child != 0){
                    seat_adult = 0; seat_child = 0;
                    count = $('.room_row').length;
                    if(count > 0){
                        for(i=0;i<count;i++){
                            seat_adult += parseInt($('#room_adult_'+(i+1)).val());
                            seat_child += parseInt($('#room_child_'+(i+1)).val());
                        }

                        if(seat_adult != adult || seat_child != child){
                            $('#room_error').html('Room selection must match with passenger count.').show();
                        }else{
                            $('#room_error').hide();
                            calculate_tour_cost();
                        }
                    }
                }                
            }

            function trim(str){
                return str.replace(/^\s+|\s+$/g,"");
            }
        </script>
    </body>
</html>

