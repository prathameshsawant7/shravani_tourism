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
                $id         = $_GET['id'];
                $query      = "SELECT * FROM tour_enquiries WHERE id=$id;";
                $fetch_data = mysqli_query($con,$query);
                $enquiry_data  = $fetch_data->fetch_assoc();
            ?>
            </h4>
        </center>
        <form action="insert_tour.php" name="register" method="post">
        <input type="hidden" id="data" name="data" value="region" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs" style="margin-left: 17%;width: 100%;">
                <BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="2">
                                <h3 style="color: #000"><center>Enquiry</center></h3>
                
                           </th> 
                        </tr>
                        
                        <tr>
                            <th style="border:1px solid #000000;"><label>Enquiry ID: </label></th>
                            <td><label style="margin-left: 20px;"><?php echo $enquiry_data['id'];?></label></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Enquiry Token: </label></th>
                            <td><label style="margin-left: 20px;"><?php echo $enquiry_data['token'];?></label></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Name: </label></th>
                            <td ><label style="margin-left: 20px;"><?php echo $enquiry_data['name'];?></label></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Email: </label></th>
                            <td ><label style="margin-left: 20px;"><?php echo $enquiry_data['email'];?></label></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Mobile: </label></th>
                            <td ><label style="margin-left: 20px;"><?php echo $enquiry_data['mobile'];?></label></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>City of recidence: </label></th>
                            <td ><label style="margin-left: 20px;"><?php echo $enquiry_data['city_of_guest'];?></label></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Time to travel: </label></th>
                            <td ><label style="margin-left: 20px;"><?php echo $enquiry_data['time_to_travel'];?></label></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Travel Duration: </label></th>
                            <td ><label style="margin-left: 20px;"><?php echo $enquiry_data['duration'];?></label></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Place to travel: </label></th>
                            <td ><label style="margin-left: 20px;"><?php echo $enquiry_data['place_to_travel'];?></label></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Type of Travel: </label></th>
                            <td > <label style="margin-left: 20px;"><?php echo $enquiry_data['travel_type'];?></label></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Mode of communication: </label></th>
                            <td ><label style="margin-left: 20px;"><?php echo $enquiry_data['mode_to_contact'];?></label></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <BR>
                                <center>
                                <table border="3">
                                    <tr>
                                        <td style="border:1px solid #000000;"><center><b>Status</b></center></td>
                                        <td style="border:1px solid #000000;"><center><b>Comment</b></center></td>
                                    </tr>
                                    <tr>
                                        <td style="border:1px solid #000000;">
                                            
                                            <select id="status">
                                            <?php
                                            foreach ($enquiry_statuses as $key => $value) { 
                                                $selected = ($enquiry_data['status'] == $value)?"selected='selected'":"";
                                            ?>
                                                <option value="<?php echo $value;?>" style="text-transform: capitalize;" <?php echo $selected;?>><?php echo $value;?></option>;
                                            <?php } ?>
                                            </select>  
                                        </td>
                                        <td style="border:1px solid #000000;">
                                            <textarea id=comment></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2"><BR> 
                                             <center>
                                            <input type="button" onclick="update_status()" class="small button" value="Update Enquiry" style="margin-bottom: -4px;"/>
                                             </center> 
                                             <BR> 
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table border="3">
                                    <tr>
                                        <th colspan="4">Enquiry History</th>
                                    </tr>
                                    <tr>
                                        <th style="border:1px solid #000000;"><center><b>Status</b></center></th>
                                        <th style="border:1px solid #000000;width: 35%;"><center><b>Comment</b></center></th>
                                        <th style="border:1px solid #000000;"><center><b>Added By</b></center></th>
                                        <th style="border:1px solid #000000;"><center><b>Added On</b></center></th>
                                    </tr>
                                    <?php
                                        $query = "SELECT * FROM enquiry_history WHERE enquiry_id=$id ORDER BY id DESC;";
                                        $fetch_data = mysqli_query($con,$query);
                                        $count = true;
                                        while($data  = $fetch_data->fetch_assoc()){ $count = false;?>
                                            <tr>
                                                <td style="border:1px solid #000000;">
                                                    <center>
                                                        <label style="text-transform: capitalize;"><?php echo $data['status'];?></label>
                                                    </center>
                                                </td>
                                                <td style="border:1px solid #000000;">
                                                    <center>
                                                        <label><?php echo $data['comment'];?></label>
                                                    </center>
                                                </td>
                                                <td style="border:1px solid #000000;">
                                                    <center>
                                                        <label><?php echo $data['added_by'];?></label>
                                                    </center>
                                                </td>
                                                <td style="border:1px solid #000000;">
                                                    <center>
                                                        <label><?php echo $data['added_on'];?></label>
                                                    </center>
                                                </td>
                                            </tr>

                                    <?php } ?>
                                    <?php if($count == true){?>
                                        <tr>
                                            <td style="border:1px solid #000000;" colspan="4">
                                                <center><label>No enquiry history found.</label></center>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </table>
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
        <script type="text/javascript">
            function update_status(){
                var data = {}
                data['id'] = <?php echo $enquiry_data['id'];?>;
                data['status'] = $('#status').val();
                data['comment'] = $('#comment').val();

                $.post("ajax_calls.php",{request:'update_enquiry',data:data},function(data) {
                    console.log(data);
                    if(data.trim() == 'success'){
                        alert("Enquiry Updated");
                        location.reload();
                    }
                }); 
            }
        </script>
    </body>
</html>

