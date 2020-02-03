<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Used to display home page
--> 
<?php
include_once("../../configs/defines.php");
//include("../config/start_session.php");
include("../../configs/settings.php");
$est =new settings();
$con=$est->connection();
?>
<!DOCTYPE html public>
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
    <link rel="stylesheet" href="../css/v_bar.css">
    <link rel="stylesheet" href="../css/reveal.css" />
    <link rel="stylesheet" href="../css/sol.css" />
    <link rel="stylesheet" href="../css/shortcut.css" />
    <link rel="stylesheet" href="../css/alertify.core.css" />
    <link rel="stylesheet" href="../css/alertify.default.css" id="toggleCSS" />
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="../js/menu.js"></script>
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
    <div id="hiddenFields">
        <input  type="hidden" id="iSeller_id" value="<?php echo $iSeller_id; ?>">
        <input  type="hidden" id="cSeller_template" value="<?php echo $cSeller_template; ?>">
        <input  type="hidden" id="cAdmin" value="<?php echo $_SESSION['cAdmin']; ?>">
        
        <input  type="hidden" id="sec" value="0">
    </div>
      
    <div class="div">
        <div class="large-12 columns no-pad">           
            
        <div class="large-3 columns dark_bg no-pad">
            <div class="row dark_bg">
                <h4><i class="fa fa-home"></i>Home</h4>
            </div>
            <div class="row dark_bg height_200vh">
                <ul class="tabs vertical" id="example-vert-tabs" data-tabs  >
                    <li class="tabs-title is-active"><a href="#tab0v" aria-selected="true"><i class="fa fa-bookmark"></i>Overview</a></li>
                   <?php if($_SESSION['cAdmin'] ==  1) { ?>
                    <li class="tabs-title"><a href="#tab1v"><i class="fa fa-info"></i>Seller List</a></li>
                   <?php } ?>
<!--                     <li class="tabs-title"><a href="#panel2v"><i class="fa fa-briefcase"></i>Business Details</a></li>
                    <li class="tabs-title"><a href="#panel3v"><i class="fa fa-credit-card-alt"></i>Payment</a></li>
                    <li class="tabs-title"><a href="#panel4v"><i class="fa fa-money"></i>Payment Settlements</a></li>
                    <li class="tabs-title"><a href="#panel5v"><i class="fa fa-files-o"></i>Documents</a></li>
                    <li class="tabs-title"><a href="#panel6v"><i class="fa fa-map-marker"></i>Pickup Address</a></li>-->
                </ul>
            </div>
        </div>

            
        <div class="large-9 columns no-pad">
            
            <!--- Quick Menu -->
            <div id="quickExport" class="reveal-modal"  style="z-index: 999999;width: 48%">
                <h1>Quick Order Export</h1>
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
                <a class="close-reveal-modal">&#215;</a>
            </div>
            <div id="todaySale" class="reveal-modal"  style="z-index: 999999;width: 60%; left: 550px;">
                <h1>Today's Sale</h1>
                <center>
                    <img id="todaySale_processing" src="img/processing.gif" style="width:80px;height:30px;display: none;"/>
                </center>
                <div id="todaySalerecords"></div>
                <a class="close-reveal-modal">&#215;</a>
            </div>
            <div id='ss_menu'> 
                <div class='circless'  onclick=""> 
                    <a  style="font-size:70%;">Hide Shortcut</a> 
                </div>
                <div class='circless' onclick="todaySale()"> 
                    <a href="#" id="Today\'s Sale" data-reveal-id="todaySale" style='font-size:70%;'>Today's Sale</a> 
                </div>
                <div class='circless' onclick="quickExport()"> 
                    <a href="#" id="quickExport" data-reveal-id="quickExport" style='font-size:70%;'>Quick Export</a> 
                </div> 

                <div class='menu'> 
                    <div class='share' id='ss_toggle' data-rot='180'> 
                        <img src="../img/shortcut.png" />
<!--                        <i class="fa fa-refresh" aria-hidden="true"></i>-->
                    </div> 
                </div> 
            </div>
            <!-- -->
            <div class="row">
                <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
                    <div class="tabs-panel is-active" id="tab0v">
                        <div>
                            <?php
                                if($_SESSION['cAdmin'] ==  1)
                                {
                                    /** Set Seller Tab **/ 
                                    include '../setSeller.html';
                                }
                            ?>
                        </div>
                            <table  id="table_view" class="table_view">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            <h5 ><b>Sales Details</b></h5>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div id="graph_holder"></div>
                                            <div id= "table_status_list">
                                                <center>    
                                                    <img id="loading_status_list" src="../img/loading.gif" alt="" height="100%" width="100%"/>
                                                </center>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        
                   
                </div>
                <div class="tabs-panel" id="tab1v">
                    <div>
                        <h3 style="color: #000"><center>Seller List</center></h3>
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
                    <div class="large-12 columns" id="seller_list_loader">
                        <center>    
                            <img id="img_Loading" src="../img/loading.gif" alt="" height="100%" width="100%"/>
                        </center>
                    </div>
                    <div id="table_seller_list"></div>
                </div>
                    
        </form>
      </div>
    
    <script src="../js/vendor/jquery.min.js"></script>
    <script src="../js/jquery-1.11.2.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/vendor/what-input.min.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script src="../js/jquery.reveal.js"></script>
    <script src="../js/jquery.timer.js"></script>
    <script src="../js/sol.js"></script>
    <script src="../js/shortcut.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/v_bar.js"></script>
    <script src="../js/alertify.min.js"></script>
    <script src="js/index.js"></script>
    <script src="../js/setSellers.js"></script> 
    <script type="text/javascript">
         alertify.success('Under Development');
         alert("Under Development");
    </script>
  </body>
</html>