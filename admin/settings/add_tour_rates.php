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
        <title>Shravani-Tourism</title>
        <link rel="stylesheet" href="../css/foundation.css" />
        <link rel="stylesheet" href="../css/app.css" />
        <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
    </head>
    <body>
        <?php include '../menu.php'; ?>
        <div id="hiddenFields">
            <input  type="hidden" id="cFullpath" value="<?php echo FULLROOT; ?>">
            <input  type="hidden" id="cWebpath" value="<?php echo WEBROOT; ?>">
        </div>

        <form action="insert_tour.php" name="register" method="post">
        <?php 
            $id         = $_GET['id'];
            $query      = "SELECT id FROM tours WHERE id=$id;";
            $fetch_data = mysqli_query($con,$query);
            $row        = $fetch_data->fetch_assoc();
            $id_tour    = $row['id'];
            $page_action= '';
            $count      = 1;
        ?>
        <div class="medium-25 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
               <table id="" class="" border="1" width="80%">
                    <tbody>
                        <tr>
                            <th colspan="9" style="text-align: left;">Tour Rates:</th>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Tour ID:</th>
                            <th style="text-align: left;">Hotel Category:</th>
                            <th style="text-align: left;">Rate Per Person with Double Occupancy:</th>
                            <th style="text-align: left;">Extra Person with Same Room Sharing (Above+ 8yrs) with Extra Mattress:</th>
                            <th style="text-align: left;">Per Child with Same Room Sharing (Above+ 4yrs) without Extra Mattress:</th>
                            <th style="text-align: left;">Rate Per Person with Single Occupancy:</th>
                        </tr>
                        <?php 
                            // $query      = "SELECT count(*) AS count FROM tour_rates WHERE id_tour='".$id_tour."';";
                            // $fetch_data = mysqli_query($con,$query);
                            // $countData  = $fetch_data->fetch_assoc();

                            if(!empty($_GET['action']) && $_GET['action'] == 'edit' && $countData['count'] > 0){ 
                                $counter    = 0;
                                $page_action= $_GET['action'];
                                $query      = "SELECT * FROM tour_rates WHERE id_tour='".$id_tour."';";
                                $fetch_data = mysqli_query($con,$query);    
                                while($tour_data = $fetch_data->fetch_assoc()){
                                    $counter++;
                        ?>
                                    <tr>
                                        <td> <input type="text" id="id_tour_<?php echo $counter;?>" name="id_tour_<?php echo $counter;?>" value="<?php echo $id_tour;?>" disabled /></td>
                                        <td>
                                            <select id="hotel_category_<?php echo $counter;?>" name="hotel_category_<?php echo $counter;?>">
                                                <option value="">Please Select</option>
                                                <option value="Budget" <?php echo ("Budget" == $tour_data['hotel_category'])?'selected="selected"':'';?>>Budget</option>
                                                <option value="Economy" <?php echo ("Economy" == $tour_data['hotel_category'])?'selected="selected"':'';?>>Economy</option>
                                                <option value="Standard" <?php echo ("Standard" == $tour_data['hotel_category'])?'selected="selected"':'';?>>Standard</option>
                                                <option value="Deluxe" <?php echo ("Deluxe" == $tour_data['hotel_category'])?'selected="selected"':'';?>>Deluxe</option>
                                                <option value="Luxury" <?php echo ("Luxury" == $tour_data['hotel_category'])?'selected="selected"':'';?>>Luxury</option>
                                                <option value="Premium" <?php echo ("Premium" == $tour_data['hotel_category'])?'selected="selected"':'';?>>Premium</option>
                                                <option value="Standard AC" <?php echo ("Standard AC" == $tour_data['hotel_category'])?'selected="selected"':'';?>>Standard AC</option>
                                                <option value="Heritage(B-Tub)" <?php echo ("Heritage(B-Tub)" == $tour_data['hotel_category'])?'selected="selected"':'';?>>Heritage(B-Tub)</option>
                                                <option value="Heritage (B-Tub) AC" <?php echo ("Heritage (B-Tub) AC" == $tour_data['hotel_category'])?'selected="selected"':'';?>>Heritage (B-Tub) AC</option>
                                                <option value="Executive (Jacuzzi)" <?php echo ("Executive (Jacuzzi)" == $tour_data['hotel_category'])?'selected="selected"':'';?>>Executive (Jacuzzi)</option>
                                                <option value="Executive  (Jacuzzi) AC" <?php echo ("Executive  (Jacuzzi) AC" == $tour_data['hotel_category'])?'selected="selected"':'';?>>Executive  (Jacuzzi) AC</option>
                                            </select>
                                        </td>
                                        <td><input type="text" id="mapai_<?php echo $counter;?>" name="mapai_<?php echo $counter;?>" value="<?php echo $tour_data['mapai'];?>" /></td>
                                        <td><input type="text" id="apai_<?php echo $counter;?>" name="apai_<?php echo $counter;?>" value="<?php echo $tour_data['apai'];?>" /></td>
                                        <td><input type="text" id="cost_per_person_<?php echo $counter;?>" name="cost_per_person_<?php echo $counter;?>" value="<?php echo $tour_data['cost_per_person'];?>" /></td>
                                        <td><input type="text" id="cost_for_couple_<?php echo $counter;?>" name="cost_for_couple_<?php echo $counter;?>" value="<?php echo $tour_data['cost_for_couple'];?>" /></td>
                                        <td><input type="text" id="cost_with_pax_2_<?php echo $counter;?>" name="cost_with_pax_2_<?php echo $counter;?>" value="<?php echo $tour_data['cost_with_pax_2'];?>" /></td>
                                        <td><input type="text" id="cost_with_pax_4_<?php echo $counter;?>" name="cost_with_pax_4_<?php echo $counter;?>" value="<?php echo $tour_data['cost_with_pax_4'];?>" /></td>
                                        <td><input type="text" id="cost_with_pax_6_<?php echo $counter;?>" name="cost_with_pax_6_<?php echo $counter;?>" value="<?php echo $tour_data['cost_with_pax_6'];?>" /></td>
                                        <td><input type="text" id="cost_with_pax_8_<?php echo $counter;?>" name="cost_with_pax_8_<?php echo $counter;?>" value="<?php echo $tour_data['cost_with_pax_8'];?>" /></td>
                                        <td><input type="text" id="supplement_meal_<?php echo $counter;?>" name="supplement_meal_<?php echo $counter;?>" value="<?php echo $tour_data['supplement_meal'];?>" /></td>
                                        <td><input type="text" id="extra_person_cost_<?php echo $counter;?>" name="extra_person_cost_<?php echo $counter;?>" value="<?php echo $tour_data['extra_person_cost'];?>" /></td>
                                        <td><input type="text" id="children_cost_<?php echo $counter;?>" name="children_cost_<?php echo $counter;?>" value="<?php echo $tour_data['children_cost'];?>" /></td>
                                        
                                    </tr>
                        <?php 
                                }
                                $count = $counter;
                            } else { ?>
                        <tr>
                            <td> <input type="text" id="id_tour_1" name="id_tour_1" value="<?php echo $id_tour;?>" disabled /></td>
                            <td>
                                <select id="hotel_category_1" name="hotel_category_1">
                                    <option value="">Please Select</option>
                                    <option value="Budget">Standard</option>
                                    <option value="Economy">Deluxe</option>
                                    <option value="Standard">Super Deluxe</option>
                                </select>
                            </td>
                            <td><input type="text" id="rate1_1" name="rate1_1" /></td>
                            <td><input type="text" id="rate2_1" name="rate2_1" /></td>
                            <td><input type="text" id="rate3_1" name="rate3_1" /></td>
                            <td><input type="text" id="rate4_1" name="rate4_1" /></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <input type="hidden" id="data" name="data" value="tour_rates" />
                <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>" />
                <input type="hidden" id="id_tour" name="id_tour" value="<?php echo $id_tour;?>" />
                <input type="hidden" id="page_action" name="page_action" value="<?php echo $page_action;?>" />
                <input type="hidden" id="count" name="count" value="<?php echo $count;?>" />
                <button type="button" class='small button addmore'>Add</button>
                <button type="button" class='small button delete'>Remove</button>
                <BR>
                <input type="submit" class="small button" value="Submit"/>
                
            </div>
        </div>
        <script src="../js/jquery-1.11.2.min.js"></script>
        <script src="../js/menu.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <script src="../js/vendor/what-input.min.js"></script>
        <script src="../js/foundation.min.js"></script>
        <script src="../js/jquery.reveal.js"></script>
        <script src="../js/app.js"></script>  
        <script src="../js/tinymce.min.js"></script>
        <script>tinymce.init({ selector:'textarea' });</script>
        <script>
          
          $(".addmore").on('click',function(){
                i = $('#count').val();
                //i++;
                var id_tour   = $('#id_tour_1').val();
                var $tr = $('#id_tour_'+i).closest('tr');
                var allTrs = $tr.closest('table').find('tr');
                var lastTr = allTrs[allTrs.length-1];
                var $clone = $(lastTr).clone();
                $clone.find('td').each(function(){ 
                    var el = $(this).find(':first-child');
                    var id = el.attr('id') || null;
                    if(id) {
                        var i = id.substr(id.length-1);
                        var prefix = id.substr(0, (id.length-1));
                        el.attr('id', prefix+(+i+1));
                        el.attr('name', prefix+(+i+1));
                    }
                });
                $clone.find('input:text').val('');
                $tr.closest('table').append($clone);
                i++;
                $('#id_tour_'+i).val(id_tour);
                $('#count').val(i);
            });

            $(".delete").on('click', function() {
                var i         = $('#count').val();
                if(i>1){
                    $('#id_tour_'+i).parents("tr").remove();
                    i--;
                    $('#count').val(i);
                }       
            });

        </script>
    </body>
</html>

