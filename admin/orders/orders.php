<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Orders Display Page
--> 
<?php
include_once("../config/defines.php");
include("../config/start_session.php");
include("../config/settings.php");
$est =new settings();
$con=$est->connection();

?>

<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seller Hub</title>
    <link rel="stylesheet" href="../css/foundation.css" />
    <link rel="stylesheet" href="../css/app.css" />
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <link rel="stylesheet" href="../css/reveal.css" />
    <link rel="stylesheet" href="../css/sol.css" />
    <link rel="stylesheet" href="../css/alertify.core.css" />
    <link rel="stylesheet" href="../css/alertify.default.css" id="toggleCSS" />
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="../js/menu.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
    
<!--    <link href="../css/progressbar_static.min.css" rel="stylesheet"/>
    <link href="../css/progress_bar.css" rel="stylesheet"/>
    -->
    </head>
    <body>
    <?php
        include '../menu.php';
        if($_SESSION['cAdmin'] ==  1)
        {
            if(isset($_SESSION['cSellerID']))
                $iSeller_id = $_SESSION['cSellerID'];
            else 
                $iSeller_id = 1;

            if(isset($_SESSION['cSeller_Template']))
                $cSeller_template = $_SESSION['cSeller_Template'];
            else 
                $cSeller_template = '';

        }
        else 
            $iSeller_id = $_SESSION['cSellerID'];


    ?>
  
    <div id="hiddenFields">
        <input  type="hidden" id="iSeller_id" value="<?php echo $iSeller_id; ?>">
        <input  type="hidden" id="cSeller_template" value="<?php echo $cSeller_template; ?>">
        <input  type="hidden" id="cAdmin" value="<?php echo $_SESSION['cAdmin']; ?>">
        <input  type="hidden" id="iUpdate_Status_id" value="">
    </div>
 
        <div id="myModal" class="updates-modal reveal-modal" style="z-index: 999999;">
        <h1>Status</h1>
        <ul class="tabs horizontal" id="example-vert-tabs" data-tabs  >
            <li class="tabs-title is-active" style="width: 50%"><a href="#status1v" aria-selected="true"><i class="fa fa-upload"></i>Update Status</a></li>
            <li class="tabs-title" style="width: 50%"><a href="#status2v"><i class="fa fa-floppy-o"></i>Shipping Details</a></li>
        </ul>

        <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
            <div class="tabs-panel is-active" id="status1v">
                <div id="status_list_div">
                    <select id='status_list'></select>
                </div><BR>
                <input type="button" class="small button filter_btn" value="Update" onclick="updateStatus('Status')">
            </div>
            <div class="tabs-panel" id="status2v">
                <span>
                    <label>Select Carrier</label><select id="carrier_list"></select>
                </span>
                <span>
                    <label>Tracking Number</label><input id="cTracking_number"  value=""></input>
                </span>
                <input type="button" class="small button filter_btn" value="Update" onclick="updateStatus('Shipping')">
            </div>
        </div>
       <a class="close-reveal-modal">&#215;</a>
    </div>
      
    <div class="row">
<!--        <h6>Seller Product Orders</h6>-->
        <div>
            <?php
                if($_SESSION['cAdmin'] ==  1)
                {
                    /** Set Seller Tab **/ 
                    include '../setSeller.html';
                }
            ?>
        </div>
        
        <div>
            <h3 style="color: #000"><center>Orders List</center></h3>
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
        <div class="large-12 columns" id="loading" style="display: none">
            <center>    
                <img id="img_Loading" src="../img/loading.gif" alt="" height="100%" width="100%"/>
            </center>
        </div>

        <div id= "table_orders">
            <center>    
                <img id="img_Loading" src="../img/loading.gif" alt="" height="100%" width="100%"/>
            </center>
        </div>
       
    </div>
    <script src="../js/vendor/jquery.min.js"></script>
    <script src="../js/jquery-1.11.2.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/vendor/what-input.min.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script src="../js/jquery.reveal.js"></script>
    <script src="../js/sol.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/alertify.min.js"></script>
    <script src="js/orders.js"></script>
    <script src="../js/setSellers.js"></script> 

</body>
</html>