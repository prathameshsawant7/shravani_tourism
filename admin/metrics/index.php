<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Metrics Display Page
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
    <link rel="stylesheet" href="chartist/chartist.css">
    <link rel="stylesheet" href="chartist/chartist.css.map">
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
  </head>
  <body>
    
    <?php
        include'../menu.php';
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
        <div class="large-12 columns">
     
                <div>
                    <?php
                        if($_SESSION['cAdmin'] ==  1)
                        {
                            /** Set Seller Tab **/ 
                            include '../setSeller.html';
                        }
                    ?>
                </div>
            
            <table style="width: 90%;">
                <tr>
                    <td>
                        <div class="large-12 medium-12 columns callout">
                            <div>
                                <p class="medium secondary button"><b><?php echo $_SESSION['cSellerBusinessName']; ?> - Total Sale this year</b></p>
                                <center>    
                                    <img id="img_Loading_chart" src="../img/loading.gif" alt="" style="height: 200px;width: 540px"/>
                                </center>
                                <div class="ct-chart ct-golden-section" id="cSalesChart" style="height: 200px;width: 520px"></div>
                                <div id="totalYearSale"></div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="large-12 medium-12 columns callout">
                            <div>
                              <p class="medium secondary button"><b><?php echo $_SESSION['cSellerBusinessName']; ?> - Overall Sale Pie Diagram</b></p>
                              <center>    
                                    <img id="img_Loading_pie" src="../img/loading.gif" alt="" style="height: 200px;width: 550px"/>
                              </center>
                              <div class="ct-chart ct-golden-section" id="cSalesPie" style="height: 200px;width: 520px"></div>
                              <table style="font-size:12px;">
                                  <tbody>
                                    <tr>
                                        <td style="background-color: #d70206"></td>
                                        <td width="10%"><b><label id="pie1"></label></b></td>
                                        <td><b>Sold Products</b></td>
                                        <td><label id="pieWorth1"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #f05b4f"></td>
                                        <td><b><label id="pie2"></label></b></td>
                                        <td><b>Returned Products</b></td>
                                        <td><label id="pieWorth2"></label></td>
                                    </tr>
                                    <tr>
                                        <td style="background-color: #f4c63d"></td>
                                        <td><b><label id="pie3"></label></b></td>
                                        <td><b>Canceled Products</b></td>
                                        <td><label id="pieWorth3"></label></td>
                                    </tr>
                                  </thead>
                              </table>
                            </div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="large-12 medium-12 columns callout">
                            <div style="min-height: 550px">
                                <p class="medium secondary button"><b><?php echo $_SESSION['cSellerBusinessName']; ?> : Top 10 - Sold Products</b></p>
                                <div id="top10">
                                    <center>    
                                        <img id="img_Loading_top10" src="../img/loading.gif" alt="" style="height: 200px;width: 550px"/>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <div class="large-12 medium-12 columns callout">
                            <div style="min-height: 550px">
                                <p class="medium secondary button"><b><?php echo $_SESSION['cSellerBusinessName']; ?> : Top 3 - Sold Products this year</b></p>

                                <div>
                                    <canvas id="canvas"></canvas>
                                </div>
                                <div id="top3">
                                    <center>    
                                            <img id="img_Loading_top3" src="../img/loading.gif" alt="" style="height: 200px;width: 550px"/>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            </table>    
                
                
                
                
            </div>
                        
            
                          
<!--            <div class="row">
                <div class="large-6 medium-6 columns">
                    <div class="callout">
                      <p>Total Sale this year</p>
                    </div>
                </div>
                <div class="large-6 medium-6 columns">
                    <div class="callout">
                      <p>Total cancelled orders</p>
                    </div>
                </div>
            </div>-->
        </div>
    </div>
    <script src="../js/jquery-1.11.2.min.js"></script>
    <script src="../js/menu.js"></script>
    <script src="../js/vendor/what-input.min.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script src="../js/jquery.reveal.js"></script>
    <script src="../js/sol.js"></script>
    <script src="../js/app.js"></script>  
    <script src="../js/Chart.bundle.min.js"></script>
    <script src="../js/alertify.min.js"></script>
    <script src="chartist/chartist.min.js"></script>
    <script src="js/common.js"></script>   
    <script src="../js/setSellers.js"></script>
</body>
</html>