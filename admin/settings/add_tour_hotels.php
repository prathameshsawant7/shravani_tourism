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
        <title>Seller Hub</title>
        <link rel="stylesheet" href="../css/foundation.css" />
        <link rel="stylesheet" href="../css/app.css" />
        <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
        <script src="../js/jquery-1.11.2.min.js"></script>
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
            $query      = "SELECT id_tour FROM tours WHERE id=$id;";
            $fetch_data = mysqli_query($con,$query);
            $row        = $fetch_data->fetch_assoc();
            $id_tour    = $row['id_tour'];
            $page_action= '';
            $count      = 1;
        ?>
        <div class="medium-25 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
               <table id="" class="" border="1" width="80%">
                    <tbody>
                        <tr>
                            <th colspan="7" style="text-align: left;">Tour Hotels:</th>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Tour ID:</th>
                            <th style="text-align: left;">City:</th>
                            <th style="text-align: left;">Hotel Place:</th>
                            <th style="text-align: left;">Hotel name:</th>
                            <th style="text-align: left;">Shikara:</th>
                            <th style="text-align: left;">House Boat:</th>
                            <th style="text-align: left;">Hotel Category:</th>
                        </tr>
                        <?php 
                            $query      = "SELECT count(*) AS count FROM tour_hotels WHERE id_tour='".$id_tour."';";
                            $fetch_data = mysqli_query($con,$query);
                            $countData  = $fetch_data->fetch_assoc();

                            if(!empty($_GET['action']) && $_GET['action'] == 'edit' && $countData['count'] > 0){ 
                                $counter    = 0;
                                $page_action= $_GET['action'];
                                $query = "SELECT ci.id_city,ci.city FROM cities ci 
                                            LEFT JOIN states s ON s.id_state = ci.id_state 
                                            LEFT JOIN countries c ON c.id_country = s.id_country 
                                            WHERE country = 'India'";
                                $fetch_data = mysqli_query($con,$query);
                                $citySelect = '';
                                while($row = $fetch_data->fetch_assoc()){
                                    $citySelect .='<option value="'.$row['id_city'].'" >'.$row['city'].'</option>';
                                }
                                $query      = "SELECT * FROM tour_hotels WHERE id_tour='".$id_tour."';";
                                $fetch_data = mysqli_query($con,$query);
                                while($tour_data = $fetch_data->fetch_assoc()){
                                    $counter++;
                        ?>
                                    <tr>
                                        <td> <input type="text" id="id_tour_<?php echo $counter;?>" name="id_tour_<?php echo $counter;?>" value="<?php echo $id_tour;?>" disabled /></td>
                                        <td>
                                            <select id="id_city_<?php echo $counter;?>" name="id_city_<?php echo $counter;?>">
                                                <option value="">Please Select</option>
                                                <?php echo $citySelect; ?>
                                            </select>
                                            <script type="text/javascript">
                                                var pointer = <?php echo $counter;?>;
                                                var value   = <?php echo $tour_data['id_city'];?>;
                                                $('#id_city_'+pointer).val(value);
                                            </script>
                                        </td>
                                        <td><input type="text" id="place_<?php echo $counter;?>" name="place_<?php echo $counter;?>" value ="<?php echo $tour_data['place'];?>"/></td>
                                        <td><input type="text" id="hotel_name_<?php echo $counter;?>" name="hotel_name_<?php echo $counter;?>" value ="<?php echo $tour_data['hotel_name'];?>" /></td>
                                        <td><input type="text" id="shikara_<?php echo $counter;?>" name="shikara_<?php echo $counter;?>" value ="<?php echo $tour_data['shikara'];?>" /></td>
                                        <td><input type="text" id="house_boat_<?php echo $counter;?>" name="house_boat_<?php echo $counter;?>" value ="<?php echo $tour_data['house_boat'];?>" /></td>
                                        <td>
                                            <select id="hotel_category_1" name="hotel_category_<?php echo $counter;?>">
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
                                    </tr>
                        <?php 
                                }
                            } else { ?>
                            <tr>
                                <td> <input type="text" id="id_tour_1" name="id_tour_1" value="<?php echo $id_tour;?>" disabled /></td>
                                <td>
                                    <select id="id_city_1" name="id_city_1">
                                        <option value="">Please Select</option>
                                        <?php
                                            $query = "SELECT ci.id_city,ci.city FROM cities ci 
                                                        LEFT JOIN states s ON s.id_state = ci.id_state 
                                                        LEFT JOIN countries c ON c.id_country = s.id_country 
                                                        WHERE country = 'India'";
                                            $fetch_data = mysqli_query($con,$query);
                                            while($row = $fetch_data->fetch_assoc()){
                                                ?>
                                                <option value="<?php echo $row['id_city'];?>"><?php echo $row['city'];?></option>
                                                <?php 
                                            }
                                        ?>
                                    </select>
                                </td>
                                <td><input type="text" id="place_1" name="place_1" /></td>
                                <td><input type="text" id="hotel_name_1" name="hotel_name_1" /></td>
                                <td><input type="text" id="shikara_1" name="shikara_1" /></td>
                                <td><input type="text" id="house_boat_1" name="house_boat_1" /></td>
                                <td>
                                    <select id="hotel_category_1" name="hotel_category_1">
                                        <option value="">Please Select</option>
                                        <option value="Budget">Budget</option>
                                        <option value="Economy">Economy</option>
                                        <option value="Standard">Standard</option>
                                        <option value="Deluxe">Deluxe</option>
                                        <option value="Luxury">Luxury</option>
                                        <option value="Premium">Premium</option>
                                    </select>
                                </td>
                            </tr>
                        <?php } 
                            $count = $counter;
                        ?>
                    </tbody>
                </table>
                <input type="hidden" id="data" name="data" value="tour_hotels" />
                <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>" />
                <input type="hidden" id="id_tour" name="id_tour" value="<?php echo $id_tour;?>" />
                <input type="hidden" id="page_action" name="page_action" value="<?php echo $page_action;?>" />
                <input type="hidden" id="count" name="count" value="<?php echo $count;?>" />
                <input type="submit" class="small button" value="Submit"/>
                <button type="button" class='small button addmore'>Add More</button>
                <button type="button" class='small button delete'>Delete</button>
            </div>
        </div>
        
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

