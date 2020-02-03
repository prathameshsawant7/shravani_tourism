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

        <form action="insert_tour.php" name="register" method="post" enctype="multipart/form-data">
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
                            <th colspan="9" style="text-align: left;">Slider Images(2x1):</th>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Tout ID</th>
                            <th style="text-align: left;">Type</th>
                            <th style="text-align: left;">Browse</th>
                            <th style="text-align: left;">Preview</th>
                        </tr>
                        <?php 
                            $query      = "SELECT count(*) AS count FROM tour_images WHERE id_tour='".$id_tour."';";
                            $fetch_data = mysqli_query($con,$query);
                            $countData  = $fetch_data->fetch_assoc();

                            if(!empty($_GET['action']) && $_GET['action'] == 'edit' && $countData['count'] > 0){ 
                                $counter    = 0;
                                $page_action= $_GET['action'];
                                $query      = "SELECT * FROM tour_images WHERE id_tour='".$id_tour."';";
                                $fetch_data = mysqli_query($con,$query);
                                while($tour_data = $fetch_data->fetch_assoc()){
                                    $counter++;
                        ?>
                                    <tr>
                                        <td> <input type="text" id="id_tour_<?php echo $counter;?>" name="id_tour_<?php echo $counter;?>" value="<?php echo $id_tour;?>" disabled /></td>
                                        <td>
                                            <select id="image_type_<?php echo $counter;?>" name="image_type_<?php echo $counter;?>">
                                                <option value="2x1" <?php echo ("2x1" == $tour_data['image_type'])?'selected="selected"':'';?>>Slider images - (2x1)</option>
                                                <option value="10x11" <?php echo ("10x11" == $tour_data['image_type'])?'selected="selected"':'';?>>Thumbnails images - (10x11)</option>
                                            </select>
                                        </td>
                                        <td><input type="file" onchange="readImage(this)" id="image_<?php echo $counter;?>" name="image_<?php echo $counter;?>" value="<?php echo $tour_data['image'];?>" /></td>
                                        <td style="width: 50%"><img id="image_preview_<?php echo $counter;?>" src="../../images/tours/<?php echo $tour_data['image'];?>"  /></td>
                                    </tr>
                        <?php 
                                }
                                $count = $counter;
                            } else { ?>
                        <tr>
                            <td> <input type="text" id="id_tour_1" name="id_tour_1" value="<?php echo $id_tour;?>" disabled /></td>
                            <td>
                                <select id="image_type_1" name="image_type_1">
                                    <option value="2x1">Slider images - (2x1)</option>
                                    <option value="10x11">Thumbnails images - (10x11)</option>
                                </select>
                            </td>
                            <td><input type="file" onchange="readImage(this)" id="image_1" name="image_1" value="" /></td>
                            <td style="width:50%"><img id="image_preview_1" src=""/></td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <input type="hidden" id="data" name="data" value="tour_images" />
                <input type="hidden" id="id" name="id" value="<?php echo $_GET['id']; ?>" />
                <input type="hidden" id="id_tour" name="id_tour" value="<?php echo $id_tour;?>" />
                <input type="hidden" id="page_action" name="page_action" value="<?php echo $page_action;?>" />
                <input type="hidden" id="count" name="count" value="<?php echo $count;?>" />
                <input type="submit" class="small button" value="Submit"/>
                <button type="button" class='small button addmore'>Add More</button>
                <button type="button" class='small button delete'>Delete</button>
                <?php if(!empty($_GET['action']) && $_GET['action'] == 'edit'){ ?>
                    <a href="index.php?id_tour=<?php echo $id_tour;?>" class='small button delete'>Keep same and submit</a>
                <?php } ?>
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

            function readImage(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(input).closest('tr').find('img').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $(".addmore").on('click',function(){
                i = $('#count').val();
                
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
                    if(el.attr('type') == 'file'){
                        el.attr('value', '');
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

