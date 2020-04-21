
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

                $query = "SELECT id, CONCAT(tour_code,' - ',tour_name) AS tour FROM tours WHERE tour_name LIKE '%ASHTAVINAYAK%';";
                $tour_fetch_data  = mysqli_query($con,$query);

                $query = "SELECT name,identifier FROM tour_type ;";
                $tour_type_fetch_data  = mysqli_query($con,$query);

                

            ?>
            </h4>
        </center>
        <form action="process_data.php" name="register" method="post">
        <input type="hidden" id="data" name="data" value="bus_chart" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs" style="margin-left: 30%;">
                <BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="2">
                                <h3 style="color: #000"><center>Generate Bus Chart</center></h3>
                
                           </th> 
                        </tr>
                        
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour : </label></th>
                            <td>
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
                                    <select id="tour_type" placeholder="Tour Type" value=""  name="tour_type"  onchange="setTourDate()">
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
                            <td > 
                                <span style="margin-left: 21px;">
                                    <input type="hidden" id="tour_date_hidden" value="<?php echo $booking_data['tour_date'];?>">
                                    <select id="tour_date" placeholder="Tour Date" value=""  name="tour_date" class="triggerSeatCheck">
                                    </select>
                                </span>
                            </td>
                        </tr>
                       	<tr>
                            <th style="border:1px solid #000000;"><label>Bus number: </label></th>
                            <td > 
                                <span style="margin-left: 21px;">
                                    <select id="bus_no" placeholder="Bus number" value=""  name="bus_no">
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                    </select>
                                </span>
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                                <center>
                                    <label id="error_msg" style="color: red;"></label>
                                    <BR>
                                    <input type="submit" class="small button" value="Submit" style="margin-bottom: -4px;"/>
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
            $(document).ready(function(){
                getTourTypesByTourID();
                setTourDate();
            });

            // function enableFields(){
            //     tour = $('#tour_id').val();
            //     tour_type = $('#tour_type').val();
            //     tour_date = $('#tour_date').val();
            //     bus_no = $('#bus_no').val();
            //     if(tour != '' && tour_type!= '' && tour_date != '' && bus_no)
            // }

            $('form').submit(function () {
                $('#error_msg').html("");
                tour_id = $.trim($('#tour_id').val());
                tour_type = $.trim($('#tour_type').val());
                tour_date = $.trim($('#tour_date').val());
                bus_no = $.trim($('#bus_no').val());
                if(tour_id != '' && tour_type!= '' && tour_date != '' && bus_no!=''){
                    window.open(
                      'chart.php?tour_id='+tour_id+'&tour_type='+tour_type+'&tour_date='+tour_date+'&bus_no='+bus_no,
                      '_blank' // <- This is what makes it open in a new window.
                    );
                }
                $('#error_msg').html("No booking available for current selections."); 
                return false;
            });

            $('#tour_id').on('change',function() {
                getTourTypesByTourID();
                setTourDate();
            });

        	function getTourTypesByTourID(){
        		var tour_id = $('#tour_id').val();
        		if(tour_id != ''){
        			 $.get("../settings/ajax_calls.php",{request:'getTourTypesByTourID',id:tour_id},function(data) {
        			 	var tour_type = JSON.parse(data);
        			 	select_html = "";
        			 	Object.keys(tour_type).forEach(function (key) {
						   select_html += '<option value="'+tour_type[key]['identifier']+'">';
						   select_html += tour_type[key]['name'];
						   select_html += '</option>';
						});
						$('#tour_type').html(select_html);
        			 });
        		}
        	}

            function setTourDate(){
                tour_id = $('#tour_id').val();
                tour_type = $('#tour_type').val();
                $.get("../settings/ajax_calls.php",{request:'getTourDatesByTourID',id:tour_id,type:tour_type},function(data) {
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



        </script>
    </body>
</html>

