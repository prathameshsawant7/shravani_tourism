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
        <link rel="stylesheet" href="../css/alertify.core.css" />
        <link rel="stylesheet" href="../css/alertify.default.css" id="toggleCSS" />
        <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
    </head>
    <body>
        <?php include '../menu.php'; ?>
        <div id="hiddenFields">
            <input  type="hidden" id="cFullpath" value="<?php echo FULLROOT; ?>">
            <input  type="hidden" id="cWebpath" value="<?php echo WEBROOT; ?>">
        </div>

        <h3 style="color: #000"><center>Tour Listings</center></h3>
        <section>
            <label style="float: left">Number of rows to display: &nbsp;&nbsp;&nbsp;</label>
            <select id="cRows" style="width: 50px;float: left">
                <option value="10" selected="selected">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
                <option value="40">40</option>
                <option value="50">50</option>
                <option value="60">60</option>
                <option value="70">70</option>
                <option value="80">80</option>
                <option value="90">90</option>
                <option value="100">100</option>
            </select>

       </section>
        </div><BR>
        <div class="large-12 columns no-pad" id="loading" style="display: none">
            <center>    
                <img id="img_Loading" src="../img/loading.gif" alt="" height="100%" width="100%"/>
            </center>
        </div>
        <div id= "table_tour_list">
            <center>    
                <img id="img_Loading" src="../img/loading.gif" alt="" height="100%" width="100%"/>
            </center>
        </div>
    
    <script src="../js/jquery-1.11.2.min.js"></script>
    <script src="../js/menu.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/vendor/what-input.min.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script src="../js/jquery.reveal.js"></script>
    <script src="../js/app.js"></script>  
    <script src="../js/sol.js"></script>
    <script src="../js/alertify.min.js"></script> 
    <script src="js/listing.js"></script>
  </body>
</html>
