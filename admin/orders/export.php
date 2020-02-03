<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Order Export Page
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

        
        $query = "SELECT DISTINCT name,id_feature FROM js_feature_lang GROUP BY name ORDER BY name";
        $fetch_data  = mysqli_query($con,$query);

    ?>
  
    <div id="hiddenFields">
        <input  type="hidden" id="iSeller_id" value="<?php echo $iSeller_id; ?>">
        <input  type="hidden" id="cSeller_template" value="<?php echo $cSeller_template; ?>">
        <input  type="hidden" id="cAdmin" value="<?php echo $_SESSION['cAdmin']; ?>">
        <input  type="hidden" id="iUpdate_Status_id" value="">
        <input  type="hidden" id="sec" value="0">
    </div>
        
    <div class="row">
        <div>
            <?php
                if($_SESSION['cAdmin'] ==  1)
                {
                    /** Set Seller Tab **/ 
                    include '../setSeller.html';
                }
            ?>
        </div>
        <h3 style="color: #000"><center>Order Export</center></h3>
        
        <table>
            <tbody>
                <tr>
                    <td>
                        <label style="float:right">Select Status</label> 
                    </td>
                    <td>
                        <div id="exportStatus_div" style="width: 180px">
                            <select id='exportStatus' name='character' multiple='multiple'></select>
                        </div>
                    </td>
                    <td>
                        <label style="float:right">Features</label> 
                    </td>
                    <td>
                        <div id="exportFeatures_div" style="width: 180px">
                            <select id='exportFeatures' name='character' multiple='multiple'></select>
                        </div>
                    </td>
                    <td>
                        <label style="float:right">Date From</label> 
                    </td>
                    <td>
                        <input id="cFromDate" class="datepicker" name="cFromDate" type="text" />
                    </td>
                    <td>
                        <label style="float:right">Date To</label> 
                    </td>
                    <td>
                        <input id="cToDate" class="datepicker" name="cToDate" type="text" />
                    </td>
                    <td>
                        <div id="export" onclick="exportExcel()">
                            <p class="small button filter_btn"><img src="../img/excel_icon.png" height="20px" width="20px">Export</p>
                        </div>
                        <div id="export_loader" style="display: none">
                            <center>
                                <img id="img_export_loader" src="../img/loading_arrow.gif" alt="" height="20px" width="20px"/>
                                <label><b>Exporting</b></label>
                            </center>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
        <center>
            <img id="processing" src="../img/processing.gif" style="width:185px;height:45px;display: none;"/>
        </center>
        
        <div class="radius progress success large-8" id="progress_bar" style="width: 100%;height: 30px;display: none;">
            <span class="meter" style="width: 100%; background-color: #36c6d3;">
                <center id="progress"></center>
            </span>
        </div>
        <table>
            <tbody>
                <tr>
                    <td><center><label id="TimeTaken"></label></center></td>
                    <td><center><label id="RemainingTime"></label></center></td>
                    <td><center><label id="OrderCount"></label></center></td>
                </tr>
            </tbody>
        </table>
    <div>   
    <script src="../js/vendor/jquery.min.js"></script>
    <script src="../js/jquery-1.11.2.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/vendor/what-input.min.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script src="../js/jquery.reveal.js"></script>
    <script src="../js/jquery.timer.js"></script>
    <script src="../js/sol.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/alertify.min.js"></script>
    <script src="js/export.js"></script>
    <script src="../js/setSellers.js"></script> 

</body>
</html>    
        