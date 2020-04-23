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
                $data = [];
                $query      = "SELECT * FROM site_cms;";
                $fetch_data = mysqli_query($con,$query);
                ;
                while($fields  = $fetch_data->fetch_assoc()) {
                    $data[$fields['name']] = $fields['content'];
                }
            ?>
            </h4>
        </center>
        <form action="insert_tour.php" name="register" method="post" enctype="multipart/form-data">
        <input type="hidden" id="data" name="data" value="site_cms" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs" style="margin-left: 30%;">
                <BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="2">
                                <h3 style="color: #000"><center>Site Pages CMS</center></h3>
                
                           </th> 
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Email Address: </label></th>
                            <td> 
                                <input type="text" id="site_email" class="filter" name="site_email" value="<?php echo $data['site_email'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Phone Numbers: </label></th>
                            <td> 
                                <input type="text" id="site_phone" class="filter" name="site_phone" value="<?php echo $data['site_phone'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Whatsapp Number: </label></th>
                            <td> 
                                <input type="text" id="whatsapp" class="filter" name="whatsapp" value="<?php echo $data['whatsapp'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Facebook url: </label></th>
                            <td> 
                                <input type="text" id="facebook" class="filter" name="facebook" value="<?php echo $data['facebook'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Ashtavinayak Tours Terms and Conditions: </label></th>
                            <td> 
                                <textarea class="mce" id="atnc" name="atnc"/>
                                    <?php echo $data['atnc'];?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Terms and Conditions: </label></th>
                            <td> 
                                <textarea class="mce" id="tnc" name="tnc"/>
                                    <?php echo $data['tnc'];?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Privacy Policy: </label></th>
                            <td> 
                                <textarea class="mce" id="privacy" name="privacy"/>
                                    <?php echo $data['privacy'];?>
                                </textarea>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>About Us: </label></th>
                            <td> 
                                <textarea class="mce" id="about_us" name="about_us"/>
                                    <?php echo $data['about_us'];?>
                                </textarea>
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

