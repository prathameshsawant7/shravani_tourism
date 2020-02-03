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
                            <th colspan="5" style="text-align: left;">Tour Overview:</th>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Tour ID:</th>
                            <th style="text-align: left;">Day:</th>
                            <th style="text-align: left;">Activity:</th>
                            <th style="text-align: left;">Sightseeing:</th>
                        </tr>
                                    
                        <?php 
                            $query      = "SELECT count(*) AS count FROM tour_overview WHERE id_tour='".$id_tour."';";
                            $fetch_data = mysqli_query($con,$query);
                            $countData  = $fetch_data->fetch_assoc();

                            if(!empty($_GET['action']) && $_GET['action'] == 'edit' && $countData['count'] > 0){ 
                                $counter    = 0;
                                $page_action= $_GET['action'];
                                $query      = "SELECT * FROM tour_overview WHERE id_tour='".$id_tour."';";
                                $fetch_data = mysqli_query($con,$query);
                                while($tour_data = $fetch_data->fetch_assoc()){
                                    $counter++;
                            ?>
                                    <tr>
                                        <td> <input type="text" id="id_tour_<?php echo $counter;?>" name="id_tour_<?php echo $counter;?>" value="<?php echo $id_tour;?>" disabled /></td>
                                        <td><input type="text" id="day_<?php echo $counter;?>" name="day_<?php echo $counter;?>" value="<?php echo $counter;?>"/></td>
                                        <td><input type="text" id="activity_<?php echo $counter;?>" name="activity_<?php echo $counter;?>" value ="<?php echo $tour_data['activity'];?>"/></td>
                                        <td><textarea id="sightseeing_<?php echo $counter;?>" name="sightseeing_<?php echo $counter;?>"><?php echo $tour_data['sightseens'];?></textarea></td>
                                    </tr>
                        <?php 
                                }
                                $count = $counter;
                            }else{ ?>
                            <tr>
                                <td> <input type="text" id="id_tour_1" name="id_tour_1" value="<?php echo $id_tour;?>" disabled /></td>
                                <td><input type="text" id="day_1" name="day_1" value="1"/></td>
                                <td><input type="text" id="activity_1" name="activity_1" /></td>
                                <td><textarea id="sightseeing_1" name="sightseeing_1"></textarea></td>
                            </tr>
                        <? } ?>
                    </tbody>
                </table>
                <input type="hidden" id="data" name="data" value="tour_overview" />
                <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>" />
                <input type="hidden" id="id_tour" name="id_tour" value="<?php echo $id_tour;?>" />
                <input type="hidden" id="page_action" name="page_action" value="<?php echo $page_action;?>" />
                <input type="hidden" id="count" name="count" value="<?php echo $count;?>" />
                <input type="submit" class="small button" value="Submit"/>
                <button type="button" class='small button addmore'>Add More</button>
                <button type="button" class='small button delete'>Delete</button>
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
            i++;
            var id_tour   = $('#id_tour_1').val();
            var data='<tr></td><td><input type="text" id="id_tour_'+i+'" name="id_tour_'+i+'" value="'+id_tour+'" disabled /></td><td><input type="text" id="day_'+i+'" name="day_'+i+'" value="'+i+'"/></td><td><input type="text" id="activity_'+i+'" name="activity_'+i+'" /></td><td><textarea id="sightseeing_'+i+'" name="sightseeing_'+i+'"></textarea></td></tr>';
                $('tbody').append(data);
                tinymce.init({ selector:'#sightseeing_'+i });
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

