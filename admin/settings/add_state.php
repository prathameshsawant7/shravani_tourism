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
                if(!empty($_GET['action']) && $_GET['action'] == 'edit'){
                    $id_state   = $_GET['id_state'];
                    $query      = "SELECT * FROM states WHERE id_state=$id_state;";
                    $fetch_data = mysqli_query($con,$query);
                    $state_data  = $fetch_data->fetch_assoc();
                    $page_action= $_GET['action'];
                }else if(!empty($_GET['id_state'])){
                    echo "State ID ".$_GET['id_state']. "as being recorded successfully.";
                }


            ?>
            </h4>
        </center>
        <form action="insert_tour.php" name="register" method="post" method="post" enctype="multipart/form-data">
        <input type="hidden" id="data" name="data" value="state" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs" style="margin-left: 30%;">
                <BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="2">
                                <h3 style="color: #000"><center>Add/Edit State</center></h3>
                
                           </th> 
                        </tr>
                        
                        <tr>
                            <th style="border:1px solid #000000;"><label>State ID: </label></th>
                            <td> <input type="text" id="id_state" name="id_state" value="<?php echo $state_data['id_state'];?>" disabled /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>State Name: </label></th>
                            <td > <input type="text" id="state" name="state" value="<?php echo $state_data['state'];?>" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Cover Image: </label></th>
                            <td >
                                <input type="file" id="cover_image" onchange="readImage(this)" name="cover_image" value="" />
                                <?php if(isset($state_data['cover_image']) && $state_data['cover_image'] != ''){?>
                                <img id="cover_image_preview" src="../../images/tours/<?php echo $state_data['cover_image']."?".time();?>" />
                            <?php } ?>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Active: </label></th>
                            <td> 
                                <span style="margin-left: 21px;">
                                    <select id="active" placeholder="Active/Inactive" value=""  name="active" >
                                        <?php
                                        echo $state_data['active'];
                                            if(isset($state_data['active']) && $state_data['active'] == 0){
                                                ?>
                                                <option value="1" >Yes</option>
                                                <option value="0" selected="selected">No</option>
                                                <?php
                                            }else{
                                                ?>
                                                <option value="1" selected="selected">Yes</option>
                                                <option value="0">No</option>
                                                <?php
                                            }
                                        ?>
                                       
                                    </select>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <input type="submit" class="small button" value="Submit" style="margin-bottom: -4px;"/>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
               
                <input type="hidden" id="page_action" name="page_action" value="<?php echo $page_action;?>" />
                <input type="hidden" id="id" name="id" value="<?php echo $id_state;?>" />
                
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
            function readImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#cover_image_preview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        </script>
    </body>
</html>

