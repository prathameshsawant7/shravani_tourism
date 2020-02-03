<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Display product list
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
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
  
    <BR>

    <div id="hiddenFields">
        <input  type="hidden" id="iSeller_id" value="<?php echo $iSeller_id; ?>">
        <input  type="hidden" id="cSeller_template" value="<?php echo $cSeller_template; ?>">
        <input  type="hidden" id="cAdmin" value="<?php echo $_SESSION['cAdmin']; ?>">
    </div>
    
    <div class="row">
        <div><BR>
            <?php
                if($_SESSION['cAdmin'] ==  1)
                {
                    /** Set Seller Tab **/ 
                    include '../setSeller.html';
                }
            ?>
        </div>
        <div>
            <h3 style="color: #000"><center>Product List</center></h3>
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
            <div id= "table_product_list">
                <center>    
                    <img id="img_Loading" src="../img/loading.gif" alt="" height="100%" width="100%"/>
                </center>
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
    <script src="../js/alertify.min.js"></script> 
    <script src="js/product_list.js"></script>   
    <script src="../js/setSellers.js"></script> 
    
  </body>
</html>  