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
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
                    $id         = $_GET['id'];
                    $query      = "SELECT * FROM tours WHERE id=$id;";
                    $fetch_data = mysqli_query($con,$query);
                    $tour_data  = $fetch_data->fetch_assoc();
                    $page_action= $_GET['action'];

                    if(!empty($_GET['msg']) && $_GET['msg'] == 'update_success'){
                        echo "Tour ID - ".$_GET['id']. " has been updated successfully.";
                    }
                }else if(!empty($_GET['id'])){
                    echo "Tour ID ".$_GET['id']. " as being recorded successfully.";
                }


            ?>
            </h4>
        </center>
        <form action="insert_tour.php" name="register" method="post" enctype="multipart/form-data">
        <input type="hidden" id="data" name="data" value="tour" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs" style="margin-left: 17%;width: 100%">
                <BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="2">
                                <h3 style="color: #000"><center>Add/Edit Tour</center></h3>
                
                           </th> 
                        </tr>
                        
                        <tr>
                            <th style="border:1px solid #000000;width: 25%;"><label>Tour ID: </label></th>
                            <td> <input type="text" id="id" name="id" value="<?php echo $tour_data['id'];?>" disabled /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour Code: </label></th>
                            <td> <input type="text" id="tour_code" name="tour_code" value="<?php echo $tour_data['tour_code'];?>" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour Name: </label></th>
                            <td > <input type="text" id="tour_name" name="tour_name" value="<?php echo $tour_data['tour_name'];?>" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour Description: </label></th>
                            <td> 
                                <textarea class="mce" id="tour_desc" name="tour_desc"/>
                                    <?php echo $tour_data['tour_desc'];?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour Categories: </label></th>
                            <td >
                                <select id="tour_categories" name="tour_categories[]" multiple="multiple" onchange="build_subcategory();">
                                    <?php
                                        $query = "SELECT id,name FROM tour_categories;";
                                        $fetch_data = mysqli_query($con,$query);
                                        while($label_data  = $fetch_data->fetch_assoc()){ 
                                            $selected = (in_array($label_data['id'], explode(",",$tour_data['tour_categories'])))?'selected=selected':'';
                                            ?>
                                            <option value="<?php echo $label_data['id']; ?>" <?php echo $selected; ?>>
                                                <?php echo $label_data['name']; ?>
                                            </option>
                                            <?php
                                        }
                                    ?> 
                                </select>   
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour Sub Categories: </label></th>
                            <td >
                                <div id="subcategory_div">
                                    <select id="tour_subcategories" name="tour_subcategories[]" multiple="multiple">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Cover Image: </label></th>
                            <td >
                                <input type="file" id="cover_image" onchange="readImage(this)" name="cover_image" value="" />
                                <img id="cover_image_preview" src="../../images/tours/<?php echo $tour_data['cover_image']."?".time();?>" />

                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Display Image: </label></th>
                            <td >
                                <input type="file" id="display_image" onchange="readImage(this)" name="display_image" value="" />
                                <img id="display_image_preview" src="../../images/tours/<?php echo $tour_data['display_image']."?".time();?>" />

                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour region: </label></th>
                            <td >
                                <span style="margin-left: 21px;">
                                <select id="tour_region" name="tour_region" value="" >
                                    <option value="">Please Select</option>
                                    <?php
                                        $query      = "SELECT * FROM regions WHERE active=1;";
                                        $fetch_data = mysqli_query($con,$query);
                                        while($region_data = $fetch_data->fetch_assoc()){
                                            $selected = '';
                                            if($tour_data['tour_region'] == $region_data['id']){
                                                $selected = "selected='selected'";
                                            } 
                                            ?>
                                            <option value="<?php echo $region_data['id']; ?>" <?php echo $selected; ?> >
                                                <?php echo $region_data['name']; ?>
                                            </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour states: </label></th>
                            <td >
                                <span style="margin-left: 21px;">
                                <select id="tour_state" name="tour_state" value="" >
                                    <option value="">Please Select</option>
                                    <?php
                                        $query      = "SELECT * FROM states WHERE active=1;";
                                        $fetch_data = mysqli_query($con,$query);
                                        while($state_data = $fetch_data->fetch_assoc()){
                                            $selected = '';
                                            if($tour_data['tour_state'] == $state_data['id_state']){
                                                $selected = "selected='selected'";
                                            } 
                                            ?>

                                            <option value="<?php echo $state_data['id_state'];?>" <?php echo $selected; ?>>
                                                <?php echo $state_data['state']; ?>
                                            </option>
                                            <?php
                                        }
                                    ?>
                                </select>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour Base Price: </label></th>
                            <td > <input type="text" id="tour_price" name="tour_price" value="<?php echo $tour_data['tour_price'];?>" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour Places: </label></th>
                            <td > <input type="text" id="tour_places" name="tour_places" value="<?php echo $tour_data['tour_places'];?>" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour Duration: </label></th>
                            <td > <input type="text" id="tour_duration" name="tour_duration" value="<?php echo $tour_data['tour_duration'];?>" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Itenerary: </label></th>
                            <td> 
                                <textarea class="mce" id="itenerary" name="itenerary"/>
                                    <?php echo $tour_data['itenerary'];?>
                                </textarea>
                                <!-- <input type="file" id="itenerary_upload" onchange="readItenerary(this)" name="itenerary_upload" value="" />
                                <a href="../files/sample_tour_itenerary.csv" style="font-size: 10px;">Click here to download sample itenerary CSV File</a>
                                <textarea id="itenerary_json" name="itenerary_json" style="display:none;"><?php echo trim($tour_data['itenerary_json']);?></textarea> -->
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Rates: </label></th>
                            <td>
                                <label>* Please enter numbers only <b>(Example Price= 4563)</b></label>
                                <label>* Keep fields blank if not required.</b></label>
                                <?php
                                    $rates =  json_decode($tour_data['rates_json'],true);
                                 ?>
                                <table border=3>
                                    <tr>
                                        <th></th>
                                        <th><label>STANDARD</label></th>  
                                        <th><label>DELUXE</label></th>
                                        <th><label>SUPER DELUXE</label></th>  
                                    </tr>
                                    <tr>
                                        <th><label>SINGLE OCCUPANCY</label></th>
                                        <td><input type="input" name="rates[adult_single][standard]" value="<?php echo $rates['adult_single']['standard'];?>"></td>
                                        <td><input type="input" name="rates[adult_single][deluxe]" value="<?php echo $rates['adult_single']['deluxe'];?>"></td>
                                        <td><input type="input" name="rates[adult_single][super_deluxe]" value="<?php echo $rates['adult_single']['super_deluxe'];?>"></td>
                                    </tr>
                                    <tr>
                                        <th><label>DOUBLE OCCUPANCY</label></th>
                                        <td><input type="input" name="rates[adult_double][standard]" value="<?php echo $rates['adult_double']['standard'];?>"></td>
                                        <td><input type="input" name="rates[adult_double][deluxe]" value="<?php echo $rates['adult_double']['deluxe'];?>"></td>
                                        <td><input type="input" name="rates[adult_double][super_deluxe]" value="<?php echo $rates['adult_double']['super_deluxe'];?>"></td>
                                    </tr>
                                    <tr>
                                        <th><label>CHILD</label></th>
                                        <td><input type="input" name="rates[child][standard]" value="<?php echo $rates['child']['standard'];?>"></td>
                                        <td><input type="input" name="rates[child][deluxe]" value="<?php echo $rates['child']['deluxe'];?>"></td>
                                        <td><input type="input" name="rates[child][super_deluxe]" value="<?php echo $rates['child']['super_deluxe'];?>"></td>
                                    </tr>
                                    <tr>
                                        <th><label>EXTRA ADULT</label></th>
                                        <td><input type="input" name="rates[extra_adult][standard]" value="<?php echo $rates['extra_adult']['standard'];?>"></td>
                                        <td><input type="input" name="rates[extra_adult][deluxe]" value="<?php echo $rates['extra_adult']['deluxe'];?>"></td>
                                        <td><input type="input" name="rates[extra_adult][super_deluxe]" value="<?php echo $rates['extra_adult']['super_deluxe'];?>"></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>

                        <!-- <tr>
                            <th style="border:1px solid #000000;"><label>Rates CSV File: </label></th>
                            <td> 
                                <input type="file" id="rates_upload" onchange="readRates(this)" name="rates_upload" value="" />
                                <a href="../files/sample_tour_rates.csv" style="font-size: 10px;">Click here to download sample rates CSV File</a>
                                <textarea id="rates_json" name="rates_json" style="display:none;"><?php echo trim($tour_data['rates_json']);?></textarea>
                            </td>
                        </tr> -->
                        <tr>
                            <th style="border:1px solid #000000;"><label>Inclusive: </label></th>
                            <td> 
                                <textarea class="mce" id="inclusive" name="inclusive"/>
                                    <?php echo $tour_data['inclusive'];?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Exclusive: </label></th>
                            <td> 
                                <textarea class="mce" id="exclusive" name="exclusive"/>
                                    <?php echo $tour_data['exclusive'];?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Special Note: </label></th>
                            <td> 
                                <textarea class="mce" id="special_note" name="special_note"/>
                                    <?php echo $tour_data['special_note'];?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Active: </label></th>
                            <td> 
                                <span style="margin-left: 21px;">
                                    <select id="active" placeholder="Active/Inactive" value=""  name="active" >
                                        <?php
                                        echo $tour_data['active'];
                                            if(isset($tour_data['active']) && $tour_data['active'] == 0){
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
            tinymce.init({ selector:'textarea.mce' });
            $('#tour_categories').multiSelect();
            $('#tour_subcategories').multiSelect();
        </script>
        <script>
            var tour_categories = '<?php echo $tour_data['tour_subcategories'];?>'.split(",");
                $(document).ready(function(){
                    
                    console.log(tour_categories);
                    build_subcategory();
                });
                function build_subcategory(){
                    var categories = String($('#tour_categories').val());
                    $.get("ajax_calls.php",{request:'getSubcategories',categories:categories},
                    function(data) {
                        console.log(data);
                        var select_subcategory = '<select id="tour_subcategories" name="tour_subcategories[]" multiple="multiple"><option value=""></option>';
                        var data_arr = JSON.parse(data);
                        $.each(data_arr, function (index, value) {
                            var selected =  (tour_categories.includes(value['id']))?'selected="selected"':'';
                            select_subcategory += '<option value="'+value['id']+'" '+selected+'>'+value['category_name']+" >> "+value['name']+'</option>';
                        });
                        select_subcategory += '</select>';
                        console.log(select_subcategory);
                        $('#ms-tour_subcategories').remove();
                        $('#subcategory_div').html(select_subcategory);
                        $('#tour_subcategories').multiSelect();
                    }); 
                }


                function readImage(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function (e) {
                            $('#'+input.id+'_preview').attr('src', e.target.result);
                        }
                        reader.readAsDataURL(input.files[0]);
                    }
                }


                function readItenerary(input){
                    if (input.files && input.files[0]) {
                        var file_data = $('#itenerary_upload').prop('files')[0];
                        var form_data = new FormData();                  
                        form_data.append('file', file_data);
                        form_data.append('data', 'readItenerary');
                        $('#itenerary_json').val('');
                        $.ajax({
                            url: 'insert_tour.php', 
                            dataType: 'text', 
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,                         
                            type: 'post',
                            success: function(response){
                                data = $.trim(response);
                                if(data == "invalid"){
                                    alert("Invalid Itenerary CSV");
                                }else{
                                    $('#itenerary_json').val(data);
                                }
                            }
                         });
                    }
                }

                function readRates(input){
                    if (input.files && input.files[0]) {
                        var file_data = $('#rates_upload').prop('files')[0];
                        var form_data = new FormData();                  
                        form_data.append('file', file_data);
                        form_data.append('data', 'readRates');
                        $('#rates_json').val('');
                        $.ajax({
                            url: 'insert_tour.php', 
                            dataType: 'text', 
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: form_data,                         
                            type: 'post',
                            success: function(response){
                                data = $.trim(response);
                                if(data == "invalid"){
                                    $('#rates_upload').val('');
                                    alert("Invalid Rates CSV");
                                }else{
                                    $('#rates_json').val(data);
                                }
                            }
                         });
                    }
                }
        </script>
    </body>
</html>

