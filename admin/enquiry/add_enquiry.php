<?php

include_once("../../configs/defines.php");
include("../../configs/settings.php");

$est =new settings();
$con=$est->connection();

$query = "SELECT state FROM states WHERE id_state IN (SELECT DISTINCT tour_state FROM tours WHERE active=1);";
$place_to_travel_data = mysqli_query($con,$query);
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

        </center>
        <form id="enquiry_form" name="enquiry_form" method="post">
        <input type="hidden" id="request" name="request" value="add_enquiry" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs" style="margin-left: 30%;">
                <BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="2">
                                <h3 style="color: #000"><center>Add Enquiry</center></h3>
                
                           </th> 
                        </tr>
                        
                        <tr>
                            <th style="border:1px solid #000000;"><label>Name: </label></th>
                            <td > <input type="text" id="name" name="name" value="" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Email: </label></th>
                            <td > <input type="text" id="email" name="email" value="" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Mobile: </label></th>
                            <td > <input type="text" id="mobile" name="mobile" value="" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour: </label></th>
                            <td > <input type="text" id="tour" name="tour" value="" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>City of Residence: </label></th>
                            <td > <input type="text" id="city_of_guest" name="city_of_guest" value="" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Time to travel: </label></th>
                            <td > <input type="text" id="time_to_travel" name="time_to_travel" value="" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Travel Duration: </label></th>
                            <td > <input type="text" id="duration" name="duration" value="" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Place to Travel: </label></th>
                            <td > 
                                <select id="place_to_travel" name="place_to_travel">
                                    <option value="">Please select</option>
                                <?php 
                                while($fields  = $place_to_travel_data->fetch_assoc()) { ?>
                                    <option value="<?php echo $fields['state'];?>"><?php echo $fields['state'];?></option>
                                <?php } ?>
                             </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Type Of Travel: </label></th>
                            <td >
                                <select id="travel_type" name="travel_type">
                                    <option value="">Please select</option>
                                    <option value="Group Tour">Group Tour</option>
                                    <option value="Customized Tour">Customized Tour</option>
                                    <option value="Honeymoon Tour">Honeymoon Tour</option>
                                    <option value="Speciality Tour">Speciality Tour</option>
                                    <option value="Maharashtra Tours">Maharashtra Tours</option>
                                    <option value="International Tours">International Tours</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Prefered mode of communication: </label></th>
                            <td >
                                <select id="mode_to_contact" name="mode_to_contact">
                                    <option value="">Please select</option>
                                    <option value="Call">Call Me</option>
                                    <option value="Email">Email Me</option>
                                    <option value="Text Message">Text Message Me</option>
                                    <option value="Whatsapp">Whatsapp Me</option>
                                </select> 
                            </td>
                        </tr>
                        
                        <tr>
                            <td colspan="2">
                                <center>
                                    <input type="button" onclick="submitEnquiry()" class="small button" value="Submit" style="margin-bottom: -4px;"/>
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
        <script type="text/javascript">
        
        function submitEnquiry(){
            
            $.ajax({
                url:'ajax_calls.php',
                type: 'POST',
                data:$('#enquiry_form').serialize(),
                success: function (data,status,xhr) {   // success callback function
                    console.log(data);
                    msg = "";
                    if(data.indexOf("id=") !== -1){
                        id = data.replace("id=", "");
                        msg = "Added Successfully";
                    }else{
                        msg = "Something went wrong. Please reload the page and try again.";
                    }
                    alert(msg);
                    window.location.href = 'view.php?id='+id;
                },
                error: function (jqXhr, textStatus, errorMessage) { // error callback 
                    console.log('Error: ' + errorMessage);
                }
            });
        }  

        </script>
    </body>
</html>

