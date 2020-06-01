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
                $query      = "SELECT * FROM site_images WHERE id=1;";
                $fetch_data = mysqli_query($con,$query);
                $site_data  = $fetch_data->fetch_assoc();
            ?>
            </h4>
        </center>
        <form action="insert_tour.php" name="register" method="post" enctype="multipart/form-data">
        <input type="hidden" id="data" name="data" value="site_images" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs" style="margin-left: 2%;width:130%;">
                <BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="3">
                                <h3 style="color: #000"><center>Site Images</center></h3>               
                           </th> 
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;width:20%;"><label> Site Favicon: </label></th>
                            <td style="border:1px solid #000000;width:40%;">
                                <img src="../../images/tours/<?php echo $site_data['favicon']."?".time();?>" style="width: 70%;">
                            </td>
                            <td style="border:1px solid #000000;width:40%;">
                                <b>Upload Favicon Image</b>
                                <input type="file" id="favicon" onchange="readImage(this)" name="favicon"/>
                                 <div id="favicon_preview"></div> 
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;width:20%;"><label> Site Logo: </label></th>
                            <td style="border:1px solid #000000;width:40%;">
                                <img src="../../images/tours/<?php echo $site_data['logo']."?".time();?>" style="width: 70%;">
                            </td>
                            <td style="border:1px solid #000000;width:40%;">
                                <b>Upload Logo Image</b>
                                <input type="file" id="logo" onchange="readImage(this)" name="logo"/>
                                <div id="logo_preview"></div> 
                            </td>
                        </tr>
                    </tbody>
                </table>
                <BR><BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="3">
                                <h3 style="color: #000"><center>Homepage Images</center></h3>
                
                           </th> 
                        </tr>
                       <tr>
                            <th style="border:1px solid #000000;width:20%;"><label> Main Slider: </label></th>
                            <td style="border:1px solid #000000;width:40%;">
                                
                                 <?php
                                    foreach(json_decode($site_data['homepage_slider'],true) as $name){ ?>

                                        <img src="../../images/tours/<?php echo $name."?".time();?>" style="width: 70%;">
                                        <input type="checkbox" name="homepage_slider_delete[<?php echo $name;?>]" style="margin-left: 20px;"><B>Delete</B>
                                        <BR><BR>
                                <?php } ?>                               
                            </td>
                            <td style="border:1px solid #000000;width:40%;">
                                <b>Upload More Images:</b>
                                <input type="file" id="homepage_slider" onchange="preview_image(this)" name="homepage_slider[]" value="" multiple  /> 
                                <div id="homepage_slider_preview"></div>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;width:20%;"><label> Family Display Banner Image: </label></th>
                            <td style="border:1px solid #000000;width:40%;">
                                <img src="../../images/tours/<?php echo $site_data['homepage_family_display_image']."?".time();?>" style="width: 70%;">
                            </td>
                            <td style="border:1px solid #000000;width:40%;">
                                <b>Upload Banner Image</b>
                                <input type="file" id="homepage_family_display_image" onchange="readImage(this)" name="homepage_family_display_image"/>
                                 <div id="homepage_family_display_image_preview"></div> 
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <BR><BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="3">
                                <h3 style="color: #000"><center>Astavinayak Tour Page Images</center></h3>               
                           </th> 
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;width:20%;"><label> Display Image: </label></th>
                            <td style="border:1px solid #000000;width:40%;">
                                <img src="../../images/tours/<?php echo $site_data['astavinayak_display_image']."?".time();?>" style="width: 70%;">
                            </td>
                            <td style="border:1px solid #000000;width:40%;">
                                <b>Upload Display Image</b>
                                <input type="file" id="astavinayak_display_image" onchange="readImage(this)" name="astavinayak_display_image"/>
                                 <div id="astavinayak_display_image_preview"></div> 
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;width:20%;"><label> Banner Image: </label></th>
                            <td style="border:1px solid #000000;width:40%;">
                                <img src="../../images/tours/<?php echo $site_data['astavinayak_cover_image']."?".time();?>" style="width: 70%;">
                            </td>
                            <td style="border:1px solid #000000;width:40%;">
                                <b>Upload Banner Image</b>
                                <input type="file" id="astavinayak_cover_image" onchange="readImage(this)" name="astavinayak_cover_image"/>
                                <div id="astavinayak_cover_image_preview"></div> 
                            </td>
                        </tr>
                    </tbody>
                </table>
                <BR><BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="3">
                                <h3 style="color: #000"><center>Family Tour Page Images</center></h3>               
                           </th> 
                        </tr>
                        
                        <tr>
                            <th style="border:1px solid #000000;width:20%;"><label>Family Tour Slider: </label></th>
                            <td style="border:1px solid #000000;width:40%;">
                                 <?php
                                    foreach(json_decode($site_data['family_tour_slider'],true) as $name){ ?>

                                        <img src="../../images/tours/<?php echo $name."?".time();?>" style="width: 70%;">
                                        <input type="checkbox" name="family_tour_slider_delete[<?php echo $name;?>]" style="margin-left: 20px;"><B>Delete</B>
                                        <BR><BR>
                                <?php } ?>                               
                            </td>
                            <td style="border:1px solid #000000;width:40%;">
                                <b>Upload More Images:</b><input type="file" id="family_tour_slider" onchange="preview_image(this)" name="family_tour_slider[]" value="" multiple  />
                                <div id="family_tour_slider_preview"></div>
                            </td>
                        </tr>
                   </tbody>
                </table>
                <BR><BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="3">
                                <h3 style="color: #000"><center>About Us Page Images</center></h3>               
                           </th> 
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;width:20%;"><label> Banner Image: </label></th>
                            <td style="border:1px solid #000000;width:40%;">
                                <img src="../../images/tours/<?php echo $site_data['about_us_cover_image']."?".time();?>" style="width: 70%;">
                            </td>
                            <td style="border:1px solid #000000;width:40%;">
                                <b>Upload Banner Image</b>
                                <input type="file" id="about_us_cover_image" onchange="readImage(this)" name="about_us_cover_image"/>
                                <div id="about_us_cover_image_preview"></div> 
                            </td>
                        </tr>
                    </tbody>
                </table>
                <BR><BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="3">
                                <h3 style="color: #000"><center>Terms & Conditions Page Images</center></h3>               
                           </th> 
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;width:20%;"><label> Banner Image: </label></th>
                            <td style="border:1px solid #000000;width:40%;">
                                <img src="../../images/tours/<?php echo $site_data['tnc_cover_image']."?".time();?>" style="width: 70%;">
                            </td>
                            <td style="border:1px solid #000000;width:40%;">
                                <b>Upload Banner Image</b>
                                <input type="file" id="tnc_cover_image" onchange="readImage(this)" name="tnc_cover_image"/>
                                <div id="tnc_cover_image_preview"></div> 
                            </td>
                        </tr>
                    </tbody>
                </table>
                <center>
                    <input type="submit" class="small button" value="Submit" style="margin-bottom: -4px;"/>
                </center>
               
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
            function readImage(input) {
                var id = input.id;
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $('#'+id+'_preview').html("<img src='"+e.target.result+"' style='width:70%;'><BR><BR>");
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            function remove_image(input){
                $('#'+input.id).parent('div').remove();
            }

            function preview_image(input) {
                 var id = input.id;
                 var preview_id = id +"_preview";
                 var total_file=document.getElementById(id).files.length;
                 $('#'+preview_id).html("");
                 for(var i=0;i<total_file;i++){
                  $('#'+preview_id).append("<div><img src='"+URL.createObjectURL(event.target.files[i])+"' style='width:70%;'><BR><BR><div>");
                 }
            }
        </script>
    </body>
</html>

