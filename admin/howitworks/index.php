<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * How it work guide page
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
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="../js/menu.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
  </head>
  <body>
    <?php
        include '../menu.php';
    ?>
  
    <BR>
    
   
    <div id="hiddenFields">
        <input  type="hidden" id="seller_id" value="<?php echo $_SESSION['cSellerID']; ?>">
        <input  type="hidden" id="product_id" value="<?php echo $_GET['product_id']; ?>">
    </div>
    
    <div class="large-12 columns no-pad">
        <div class="large-3 columns dark_bg no-pad">
            <div class="row dark_bg">
                <h4><i class="fa fa-home"></i>How it Work's</h4>
            </div>
            <div class="row dark_bg height_200vh">
                <ul class="tabs vertical" id="example-vert-tabs" data-tabs  >
                    <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true"><i class="fa fa-info"></i>Packaging Video</a></li>
                    <li class="tabs-title"><a href="#panel2v"><i class="fa fa-picture-o"></i>Operation's Procedure</a></li>
                    <li class="tabs-title"><a href="#panel3v"><i class="fa fa-star"></i>Return Policy</a></li>
                    <li class="tabs-title"><a href="#panel4v"><i class="fa fa-tag"></i>Exchange Policy</a></li>
                    <li class="tabs-title"><a href="#panel5v"><i class="fa fa-cogs"></i>Uploading Image Requirements</a></li>
                </ul>
            </div>
        </div>

        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
                <div class="tabs-panel is-active" id="panel1v">
                    <div class="row">
                        <div class="large-12 medium-12 columns">
                            <iframe width="500" height="350" src="https://www.youtube.com/embed/y9dPy1lvrUM" frameborder="0" allowfullscreen></iframe>
                            <BR><BR>
                            <label>
                                Please refer to the above video which explains the broken down process of packaging during dispatch. It is vital that you note and thereby follow this process in order to ensure standardization and minimize potential returns due to damage. Further it goes without saying it is of great importance that you QC your product and final package prior to shipment. 
                            </label>
                            <BR><BR>
                            <img src="../img/guide/packaging.jpg"/><BR><BR>
                            <input type="button" onclick="nextTab('2')" class="small button" value="Next"/>
                        </div>
                    </div>
                </div>
                <div class="tabs-panel" id="panel2v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                           <label>
                                <b>Operation's Procedure :</b><BR>
                                <img src="../img/guide/operations.png"/><BR><BR>
                                <p>
                                    1. Customer will place an order for your product via. Jewelsouk.com <BR>
                                    2. Our customer care support centre will immediately verify the order directly with the customer. <BR>
                                    3. Next, our customer care support personal will punch in the order, which will then reflect on our backend, thus simultaneously reflecting on your seller panel under the tab “orders” <BR>
                                    4. After which you will have to dispatch the product, which will be picked up by our logistic partners. Please note you will have to adhere to our packaging guidelines, which is demonstrated and explain in our video, which can be found on the following link; https://www.youtube.com/watch?v=y9dPy1lvrUM&feature=youtu.be  <BR>
                                    5. Jewelsouk will provide the necessary material to you that will be needed to package your product. For this Jewelsouk will charge a small token fee of Rs. 10. Please note the actual Jewellery box to pack the product will be arranged by your brand and not by Jewelsouk.com <BR>
                                    6. Next, a VAT bill will directly go from you to the customer for the selling price you have set. In other words, you will raise an invoice directly on the customer. This will be all auto-generated through your seller panel, from which you will be able to download and print the same invoice.  <BR>
                                    7. You will be paying VAT on the all inclusive selling price only.  <BR>
                                    8. Jewelsouk.com is an online aggregator, which in turn, will charge it’s service fee + service tax. This service fee + service tax will be levied on the selling price provided by you.  <BR>
                                    9. Jewelsouk.com will recover RS. 99 for shipping charges directly from the customer itself. However, the actual cost for shipping will be anywhere from Rs. 100 to Rs. 160. The balance shall be borne by you.  <BR>
                                    10. Finally Jewelsouk will execute a net payout on a fortnightly basis through raising a service charge invoice in the following way;  <BR>
                                    <BR>
                                    <b>Selling Price =</b>  <BR>
                                    <ul>
                                        <li>Commission + service tax</li>
                                        <li>Rs. 1 to Rs. 60 for shipping charges</li>
                                        <li>Rs. 10 per order for packaging</li>
                                    </ul>
                                </p>
                            </label>
                            <input type="button" onclick="backTab('1')" class="small button" value="Back"/>
                            <input type="button" onclick="nextTab('3')" class="small button" value="Next"/>
                        </div> 
                    </div>
                </div>
                <div class="tabs-panel" id="panel3v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                           <label>
                                <b>Return Policy :</b><BR>
                                <p>
                                    <ul>
                                        <li>In the unlikely event, if the customer receives one of your products with manufacturing defects, you will have to guarantee 100% product replacement at no additional costs.</li>
                                        <li>If the product is damaged in transit or is tampered with, the product has coverage of a transit liability of Rs. 5000 or the product value, whichever is lower; subject to the claim acceptance by our courier partner. The balance amount will absorbed by either the seller or Jewelsouk depending on a case to case matter.</li>
                                    </ul>
                                </p>
                            </label>
                            <input type="button" onclick="backTab('2')" class="small button" value="Back"/>
                            <input type="button" onclick="nextTab('4')" class="small button" value="Next"/>
                        </div> 
                    </div>
                </div>
                <div class="tabs-panel" id="panel4v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                           <label>
                                <b>Exchange Policy :</b><BR>
                                <p>
                                    <ul>
                                        <li>Jewelsouk will only exchange all products within 30 days from the date of delivery. </li>
                                        <li>Exchange on any product can only be done once.</li>
                                        <li>No Exchange will be done, if we do not receive the product with issued certification or in case the product is found damaged by the customer. </li>
                                        <li>Once a thorough quality check of the products is done, Jewelsouk will issue a credit voucher of the same value.</li>
                                        <li>There will be no exchange on gold jewellery/silver jewellery/coins/solitaires.</li>
                                        <li>Once we receive the product at our logistics centre, we will verify the product & its condition.</li>
                                        <li>On exchange of any Diamond Jewellery; you will receive only Diamond Jewellery as a replacement. The same is applicable on Fashion Jewellery/ Watches and Artifacts.</li>
                                        <li>Note: After 30 days from the date of delivery, if the customer wants to exchange the purchased product, they will only receive 80% of the total product value through a credit voucher. </li>
                                        <li>The customer will have the option to exchange your product for any other product listed on Jewelsouk.com. In particular, the customer will be able to purchase any other product of their choice of the same or higher value of the Credit Voucher that will be issued to them. In turn they will only be liable to pay the amount that is above the gift vouchers worth. </li>
                                    </ul>
                                </p>
                            </label>
                            <input type="button" onclick="backTab('3')" class="small button" value="Back"/>
                            <input type="button" onclick="nextTab('5')" class="small button" value="Next"/>
                        </div> 
                    </div>
                </div>
                <div class="tabs-panel" id="panel5v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                           <label>
                                <b>Exchange Policy :</b><BR>
                                <p>
                                    <label>Please note these are the Image requirements that you will need to adhere to before sharing your product images with us. </label><BR>
                                    <ul>
                                        <li>Preferably four images; two side angles, one front view, and one model view. We will be able to work with a minimum of three Images as well. However, the more Images given the better impressing it will bring about. </li>
                                        <li>The images needs to have a motionless standard white background</li>
                                        <li>Image Size should preferably be 1500 x 1500. However we will be able to work with a minimum size of 1000 x 1000 as well. At the same time the resolution should be of 300 DPI.</li>
                                        <li>The image should be cleaned properly.</li>
                                        <li>The image should be in a PNG format.</li>
                                        <li>The image name should not have a hyphen in it. </li>
                                        <li>
                                            Note: Name the images in the following way so the process of uploading can be carried out faster.
                                            <BR> 
                                            * Front angle: Style code <BR>
                                            * EXAMPLE: CD285087 <BR>
                                            * Model angle: style code <BR>
                                            * EXAMPLE: CD285087M <BR>
                                        </li>
                                    </ul>
                                    <BR> 
                                    <label>The images can either be shared with us through a given URL or a Zip File depending on the number of Images provided. </label>
                                    <BR> 
                                    <label>For any confusion on Image requirements please do not hesitate to get in touch with our concerning team. </label>
                                    <BR> 
                                </p>
                            </label>
                            <input type="button" onclick="backTab('4')" class="small button" value="Back"/>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    
    
    <script src="../js/vendor/jquery.min.js"></script>
    <script src="../js/jquery-1.11.2.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/vendor/what-input.min.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script src="../js/app.js"></script>
    <script type="text/javascript">
        function nextTab(id)
        {
            $('.is-active').removeClass('is-active').next().addClass('is-active');
            $('a[role="tab"]').attr('aria-selected','false');
            $('#panel'+id+'v-label').attr('aria-selected','true');
        }

        function backTab(id)
        {
            $('.is-active').removeClass('is-active').prev().addClass('is-active');
            $('a[role="tab"]').attr('aria-selected','false');
            $('#panel'+id+'v-label').attr('aria-selected','true');
        }



        function trim(str)
        {
          return str.replace(/^\s+|\s+$/g,"");
        }
    </script>
  </body>
</html>  