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
                if(!empty($_GET['msg'])){
                    echo $_GET['msg'];
                }
                $query      = "SELECT * FROM configurations WHERE id=1;";
                $fetch_data = mysqli_query($con,$query);
                $data  = $fetch_data->fetch_assoc();
            ?>
            </h4>
        </center>
        <form action="insert_tour.php" name="register" method="post" enctype="multipart/form-data">
        <input type="hidden" id="data" name="data" value="configurations" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs" style="margin-left: 30%;">
                <BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="2">
                                <h3 style="color: #000"><center>Configurations</center></h3>
                
                           </th> 
                        </tr>
                        
                        <tr>
                            <th style="border:1px solid #000000;"><label>GST Percent: </label></th>
                            <td> 
                                <input type="text" id="gst" class="filter" placeholder="GST Percent" name="gst" value="<?php echo $data['gst'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Service Charge: </label></th>
                            <td> 
                                <input type="text" id="service_charge" class="filter" placeholder="Service Charge" name="service_charge" value="<?php echo $data['service_charge'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Discount: </label></th>
                            <td> 
                                <input type="text" id="discount" class="filter" placeholder="Discount" name="discount" value="<?php echo $data['discount'];?>"/>
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

