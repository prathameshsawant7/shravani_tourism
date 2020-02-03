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
        <h4 style="color: green">
        <?php 
            $page_action = '';
            if(!empty($_GET['id_tour'])){
                echo $_GET['id_tour']." tour as being recorded successfully.";
            }else if(!empty($_GET['action']) && $_GET['action'] == 'edit'){
                $id         = $_GET['id'];
                $query      = "SELECT * FROM tours WHERE id=$id;";
                $fetch_data = mysqli_query($con,$query);
                $tour_data  = $fetch_data->fetch_assoc();
                $page_action= $_GET['action'];
            }


        ?>
        </h4>
        <form action="insert_tour.php" name="register" method="post">
        <input type="hidden" id="data" name="data" value="tour" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
               <table id="" class="" border="1">
                    <tbody>
                        <tr>
                            <th colspan="2" style="text-align: left;">Tour:</th>
                        </tr>
                        <tr>
                            <td><label>Tour ID: </label></td>
                            <td> <input type="text" id="id_tour" name="id_tour" value="<?php echo $tour_data['id_tour'];?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Tour Name: </label></td>
                            <td> <input type="text" id="tour_name" name="tour_name" value="<?php echo $tour_data['tour_name'];?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Tour Location Category: </label></td>
                            <td>
                                <select id="id_tour_location_category" name="id_tour_location_category">
                                    <option value="">Please Select</option>
                                    <?php
                                        $query = "SELECT * FROM tour_location_category";
                                        $fetch_data = mysqli_query($con,$query);
                                        while($row = $fetch_data->fetch_assoc()){
                                            ?>
                                            <option value="<?php echo $row['id_tour_location_category'];?>" <?php echo ($row['id_tour_location_category'] == $tour_data['id_tour_location_category'])?'selected="selected"':'';?>><?php echo $row['tour_location_category_name'];?></option>
                                            <?php 
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Tour Category: </label></td>
                            <td>
                                <select id="id_category" name="id_category[]" multiple="multiple">
                                    <?php
                                        $selectedCategory = array();
                                        $query      = "SELECT id_category FROM tour_category_linking WHERE id_tour = '".$tour_data['id_tour']."'";
                                        $fetch_data = mysqli_query($con,$query);
                                        while($row = $fetch_data->fetch_assoc()){
                                            array_push($selectedCategory, $row['id_category']);
                                        }
                                        $selectedCategory = array_unique($selectedCategory);
                                        $query = "SELECT * FROM tour_category";
                                        $fetch_data = mysqli_query($con,$query);
                                        while($row = $fetch_data->fetch_assoc()){
                                            ?>
                                            <option value="<?php echo $row['id_category'];?>" <?php echo (in_array($row['id_category'], $selectedCategory) == 1)?'selected="selected"':'';?>><?php echo $row['category'];?></option>
                                            <?php 
                                        }
                                    ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Tour type: </label></td>
                            <td> <input type="text" id="tour_type" name="tour_type" value="<?php echo $tour_data['tour_type'];?>"  /></td>
                        </tr>
                        <tr>
                            <td><label>Twin Sharing: </label></td>
                            <td> <input type="text" id="twin_sharing" name="twin_sharing" value="<?php echo $tour_data['twin_sharing'];?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Single: </label></td>
                            <td> <input type="text" id="single" name="single" value="<?php echo $tour_data['single'];?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Extra Person with same room: (Numeric)</label></td>
                            <td> <input type="text" id="extra_person_with_same_room" name="extra_person_with_same_room" value="<?php echo $tour_data['extra_person_with_same_room'];?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Childrens extra matress: (Numeric)</label></td>
                            <td> <input type="text" id="childrens_extra_matress" name="childrens_extra_matress" value="<?php echo $tour_data['childrens_extra_matress'];?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Night Days: </label></td>
                            <td> <input type="text" id="night_days" name="night_days" value="<?php echo $tour_data['night_days'];?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Travel Type: </label></td>
                            <td> <input type="text" id="travel_type" name="travel_type" value="<?php echo $tour_data['travel_type'];?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Govt Tax: </label></td>
                            <td> <input type="text" id="govt_tax" name="govt_tax" value="<?php echo $tour_data['govt_tax'];?>" /></td>
                        </tr>
                        <tr>
                            <td><label>Package Inclusion: </label></td>
                            <td><textarea id="package_inclusion" name="package_inclusion"><?php echo $tour_data['package_inclusion'];?></textarea></td>
                        </tr>
                        <tr>
                            <td><label>Package Exclusion: </label></td>
                            <td><textarea id="package_exclusion" name="package_exclusion"><?php echo $tour_data['package_exclusion'];?></textarea></td>
                        </tr>
                        <tr>
                            <td><label>Price: (Numeric)</label></td>
                            <td> <input type="text" id="price" name="price" value="<?php echo $tour_data['price'];?>" /></td>
                        </tr>
                    </tbody>
                </table>
                <input type="hidden" id="page_action" name="page_action" value="<?php echo $page_action;?>" />
                <input type="hidden" id="id" name="id" value="<?php echo $id;?>" />
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
        <script src="../js/sol.js"></script>
        <script src="../js/tinymce.min.js"></script>
        <script src="../js/jquery.multi-select.js"></script>
        <script>
                tinymce.init({ selector:'textarea' });
            $('#id_category').multiSelect();
        </script>
    </body>
</html>

