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
                    $id         = $_GET['id'];
                    $query      = "SELECT * FROM ashtavinayak_pickup_drop WHERE id=$id and type='pickup';";
                    $fetch_data = mysqli_query($con,$query);
                    $pickup_data  = $fetch_data->fetch_assoc();
                    $page_action= $_GET['action'];
                }else if(!empty($_GET['id'])){
                    echo $_GET['point']. "as being recorded successfully.";
                }
            ?>
            </h4>
        </center>
        <form action="ajax_calls.php" name="register" method="post">
        <input type="hidden" id="data" name="data" value="ashtavinayak_pickup" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs" style="margin-left: 30%;">
                <BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="2">
                                <h3 style="color: #000"><center>Add/Edit Pickup Points</center></h3>
                
                           </th> 
                        </tr>
                        
                        <tr>
                            <th style="border:1px solid #000000;"><label>Pickup ID: </label></th>
                            <td> <input type="text" id="id" name="id" value="<?php echo $pickup_data['id'];?>" disabled /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Pickup Point: </label></th>
                            <td > <input type="text" id="point" name="point" value="<?php echo $pickup_data['point'];?>" /></td>
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
                tinymce.init({ selector:'textarea' });
            $('#id_category').multiSelect();
        </script>
    </body>
</html>

