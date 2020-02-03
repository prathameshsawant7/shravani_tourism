<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Used to display Profile
--> 
<?php
include_once("../config/defines.php");
include("../config/start_session.php");
include("../config/settings.php");
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
    <link rel="stylesheet" href="../css/v_bar.css">
    <link rel="stylesheet" href="../css/jquery.fs.boxer.css">
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
    ?>
    <BR>
    <?php
        if($_SESSION['cAdmin'] ==  1)
        {
            if(isset($_GET['iSeller_id']))
                $iSeller_id = $_GET['iSeller_id'];
            else 
                $iSeller_id = 1;
            
            $selller_list     = mysqli_query($con,"SELECT iSeller_id,cEst_name FROM js_seller ORDER BY cEst_name;");
        }
        else 
            $iSeller_id = $_SESSION['cSellerID'];

        $fetch_data     = mysqli_query($con,"SELECT * FROM js_seller WHERE iSeller_id = ".$iSeller_id.";");
        $acc_details    = mysqli_fetch_array($fetch_data);
                
        $fetch_data     = mysqli_query($con,"SELECT * FROM js_seller_docs WHERE iSeller_id = ".$iSeller_id.";");
        $acc_docs       = mysqli_fetch_array($fetch_data);
      
    ?>
    <div id="hiddenFields">
        <input  type="hidden" id="iSeller_id" value="<?php echo $iSeller_id; ?>">
        <input  type="hidden" id="cAdmin" value="<?php echo $_SESSION['cAdmin']; ?>">
        <input  type="hidden" id="cCountry_id" value="<?php echo $acc_details['iBusiness_address_countryID']; ?>">
        <input  type="hidden" id="cState_id" value="<?php echo $acc_details['iBusiness_address_stateID']; ?>">
        <input  type="hidden" id="cRegCountry_id" value="<?php echo $acc_details['iReg_address_countryID']; ?>">
        <input  type="hidden" id="cRegState_id" value="<?php echo $acc_details['iReg_address_stateID']; ?>">
        <input  type="hidden" id="cPickup_country_id" value="<?php echo $acc_details['iPickup_countryID']; ?>">
        <input  type="hidden" id="cPickup_state_id" value="<?php echo $acc_details['iPickup_stateID']; ?>">
        <input  type="hidden" id="cAcc_bank_id" value="<?php echo $acc_details['cBank_nameID']; ?>">
        <input  type="hidden" id="cFirm_val" value="<?php echo $acc_details['cFirm']; ?>">
    </div>
    
    <div class="div">
        <div class="large-12 columns no-pad">           
            
        <div class="large-3 columns dark_bg no-pad">
            <div class="row dark_bg">
                <h4><i class="fa fa-home"></i>Profile</h4>
            </div>
            <div class="row dark_bg height_200vh">
                <ul class="tabs vertical" id="example-vert-tabs" data-tabs  >
                    <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true"><i class="fa fa-info"></i>Business Information</a></li>
                    <li class="tabs-title"><a href="#panel2v"><i class="fa fa-briefcase"></i>Business Details</a></li>
                    <li class="tabs-title"><a href="#panel3v"><i class="fa fa-credit-card-alt"></i>Payment</a></li>
                    <li class="tabs-title"><a href="#panel4v"><i class="fa fa-money"></i>Payment Settlements</a></li>
                    <li class="tabs-title"><a href="#panel5v"><i class="fa fa-files-o"></i>Documents</a></li>
                    <li class="tabs-title"><a href="#panel6v"><i class="fa fa-map-marker"></i>Pickup Address</a></li>
                </ul>
            </div>
        </div>

        <div class="large-9 columns no-pad">
            <div class="row text-center">    
                     
                    <?php
                        if($_SESSION['cAdmin'] ==  1)
                        {
                            ?>

                             <span class="custom-dropdown custom-dropdown--white">
                                <select id="cSellerlist" class="custom-dropdown__select custom-dropdown__select--white">
                                    <?php
                                    while ($selller = $selller_list->fetch_assoc())
                                    {
                                        ?><option value="<?php echo $selller['iSeller_id'];?>"><?php echo $selller['cEst_name'];?></option><?php
                                    }
                                    ?>
                                </select>
                            </span>


                            <?php
                        }             
                    ?>
               
            </div>
            <div class="row">
                <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
<!--                <div class="tabs-panel is-active" id="panel0v">
                    
                      
                            <table  id="table_view" class="table_view">
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            <h5 ><b><?php echo $acc_details['cEst_name']; ?></b></h5>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div id="graph_holder"></div>
                                            <div id= "table_status_list">
                                                <center>    
                                                    <img id="loading_status_list" src="img/loading.gif" alt="" height="100%" width="100%"/>
                                                </center>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        
                   
                </div>-->
                <div class="tabs-panel is-active" id="panel1v">
                    <div class="row">
                        <div class="large-12 medium-12 columns">
                            <div id="display_business_information">
                                <table id="table_view"  class="table_view tabel_view_ids">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h5>Business Information:</h5>
                                            </th>
                                        </tr>



                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label><b>Establishment Name:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cEstName"><?php echo $acc_details['cEst_name']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Company Registered Name:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cRegName"><?php echo  $acc_details['cReg_name']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Company Web site:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cWebsite"><?php echo  $acc_details['cWebsite']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Contact Person(s):</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cContactPerson"><?php echo  $acc_details['cContact_person']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Designation(s):</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cDesignation"><?php echo  $acc_details['cDesignation']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>VAT TIN:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cVAT"><?php echo  $acc_details['cVAT']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>CST No:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cCST"><?php echo  $acc_details['cCST']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>PAN:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cPAN"><?php echo  $acc_details['cPAN']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>CIN:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cCIN"><?php echo  $acc_details['cCIN']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Business Address:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cAddress"><?php echo  $acc_details['cBusiness_address']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Business Address Pincode:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cPincode">
                                                    <?php 
                                                        if($acc_details['iBusiness_address_pincode'] != 0)
                                                            echo  $acc_details['iBusiness_address_pincode']; 
                                                    ?> 
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Business Address Country:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cCountry"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Business Address State:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cState"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Business Address City:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cCity"><?php echo  $acc_details['cBusiness_address_city']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Span of Business:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cBusinessSpan"><?php echo  $acc_details['cSpan_of_business']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Area of Business:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cBusinessArea"><?php echo  $acc_details['cArea_of_business']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Registered Address:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cRegAddress"><?php echo  $acc_details['cReg_address']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Registered Address Pincode:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cRegPincode">
                                                    <?php 
                                                        if($acc_details['iReg_address_pincode'] != 0)
                                                            echo  $acc_details['iReg_address_pincode']; 
                                                    ?> 
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Registered Address Country:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cRegCountry"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Registered Address State:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cRegState"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Registered Address City:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cRegCity"><?php echo  $acc_details['cReg_address_city']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Telephone:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cTelephone">
                                                    <?php 
                                                        if($acc_details['iTelephone'] != 0)
                                                            echo  $acc_details['iTelephone']; 
                                                    ?> 
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Mobile:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cMobile">
                                                    <?php 
                                                    if($acc_details['iMobile'] != 0)
                                                        echo  $acc_details['iMobile']; 
                                                    ?> 
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Facsimile:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cFacsimile"><?php echo  $acc_details['cFacsimile']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Email Id:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cEmail"><?php echo  $acc_details['cEmail']; ?> </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>



                                <?php
                                if($_SESSION['cAdmin'] ==  1)
                                {?>
                                    <input type="button" onclick="edit_seller('business_information')" class="small button" value="Edit"/>
                                <?php } ?>
                              </div>
                              <div id="edit_business_information"  style="display:none;">
                                    <table id="table_view" class="table_view tabel_view_ids">
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    <h3>Business Information:</h3>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="30%">
                                                    <label>Establishment Name:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cEstName" name="cEstName" value="<?php echo $acc_details['cEst_name']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Company Registered Name:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cRegName" name="cRegName" value="<?php echo  $acc_details['cReg_name']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Company Web site:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cWebsite" name="cWebsite" value="<?php echo  $acc_details['cWebsite']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Contact Person(s):</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cContactPerson" name="cContactPerson" value="<?php echo  $acc_details['cContact_person']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Designation(s):</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cDesignation" name="cDesignation" value="<?php echo  $acc_details['cDesignation']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>VAT TIN:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cVAT" name="cVAT" value="<?php echo  $acc_details['cVAT']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>CST No:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cCST" name="cCST" value="<?php echo  $acc_details['cCST']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>PAN:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cPAN" name="cPAN" value="<?php echo  $acc_details['cPAN']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>CIN:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cCIN" name="cCIN" value="<?php echo  $acc_details['cCIN']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Business Address:</label>
                                                </td>
                                                <td>
                                                    <textarea id="cAddress" name="cAddress" ><?php echo  $acc_details['cBusiness_address']; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Business Address Pincode:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cPincode" name="cPincode" value="<?php echo  $acc_details['iBusiness_address_pincode']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Business Address Country:</label>
                                                </td>
                                                <td>
                                                    <select id="cCountry" name="cCountry">
                                                        <option value="">Please Select</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Business Address State:</label>
                                                </td>
                                                <td>
                                                    <select id="cState" name="cState">
                                                        <option value="">First Select Country</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Business Address City:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cCity" name="cCity" value="<?php echo  $acc_details['cBusiness_address_city']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Span of Business:</label>
                                                </td>
                                                <td>
                                                    <textarea id="cBusinessSpan" name="cBusinessSpan" ><?php echo  $acc_details['cSpan_of_business']; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Area of Business:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cBusinessArea" name="cBusinessArea" value="<?php echo  $acc_details['cArea_of_business']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Registered Address:</label>
                                                </td>
                                                <td>
                                                    <textarea id="cRegAddress" name="cRegAddress" ><?php echo  $acc_details['cReg_address']; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Registered Address Pincode:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cRegPincode" name="cRegPincode" value="<?php echo  $acc_details['iReg_address_pincode']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Registered Address Country:</label>
                                                </td>
                                                <td>
                                                    <select id="cRegCountry" name="cRegCountry">
                                                        <option value="">Please Select</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Registered Address State:</label>
                                                </td>
                                                <td>
                                                    <select id="cRegState" name="cRegState">
                                                        <option value="">First Select Country</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Registered Address City:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cRegCity" name="cRegCity" value="<?php echo  $acc_details['cReg_address_city']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Telephone:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cTelephone" name="cTelephone" value="<?php echo  $acc_details['iTelephone']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Mobile:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cMobile" name="cMobile" value="<?php echo  $acc_details['iMobile']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Facsimile:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cFacsimile" name="cFacsimile" value="<?php echo  $acc_details['cFacsimile']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Email Id:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cEmail" name="cEmail" value="<?php echo  $acc_details['cEmail']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Password:</label>
                                                </td>
                                                <td>
                                                    <input type="password" id="cPassword" name="cPassword" value=""/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Verify Password:</label>
                                                </td>
                                                <td>
                                                    <input type="password" id="cVPassword" name="cVPassword" value=""/>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <input type="button" onclick="update_seller('business_information')" class="small button" value="Update"/>
                                    <input type="button" onclick="cancel('business_information')" class="small button" value="Cancel"/>
                              </div>
                        </div>
                      </div>
                            
                </div>
                <div class="tabs-panel" id="panel2v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                            <div id="display_business_details">
                                <table id="table_view"  class="table_view tabel_view_ids" >
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h5 >Business Details:</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="30%">
                                                <label><b>Your Firm is:</b></label>
                                            </td>
                                            <td>
                                                <lable id="disp_cFirm"> <?php echo  $acc_details['cFirm']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Name(s) of : Directors /Proprietors/Partners:</b></label>
                                            </td>
                                            <td>
                                                <lable id="disp_cOwnerName"> <?php echo  $acc_details['cDirectors']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Business Category:</b></label>
                                            </td>
                                            <td>
                                                <lable id="disp_cBusinessCategory"> <?php echo  $acc_details['cBusiness_category']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Services offered/Items Sold on the net:</b></label>
                                            </td>
                                            <td>
                                                <lable id="disp_cServices"> <?php echo  $acc_details['cServices']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Turn over for last two years:</b></label>
                                            </td>
                                            <td>
                                                <lable id="disp_cTurnOver"> <?php echo  $acc_details['cTurn_over']; ?> </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                if($_SESSION['cAdmin'] ==  1)
                                {?>
                                <input type="button" onclick="edit_seller('business_details')" class="small button" value="Edit"/>
                                <?php } ?>
                            </div>
                            <div id="edit_business_details" style="display:none;">
                                <form id="edit_business_form" method="post" enctype="multipart/form-data">
                                <table id="table_view"  class="table_view tabel_view_ids">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Business Details:</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="30%">
                                                <label>Your Firm is:</label>
                                            </td>
                                            <td>
                                                <select id="cFirm" name="cFirm">
                                                    <option value="">Please select</option>
                                                    <option value="Limited">Limited</option>
                                                    <option value="Private Limited">Private Limited</option>
                                                    <option value="Proprietor">Proprietor</option>
                                                    <option value="Partnership">Partnership</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Name(s) of : Directors /Proprietors/Partners:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cOwnerName" name="cOwnerName" value="<?php echo  $acc_details['cDirectors']; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Business Category:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cBusinessCategory" name="cBusinessCategory" value="<?php echo  $acc_details['cBusiness_category']; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Services offered/Items Sold on the net:</label>
                                            </td>
                                            <td>
                                                <textarea id="cServices" name="cService" ><?php echo  $acc_details['cServices']; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Turn over for last two years:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cTurnOver" name="cTurnOver" value="<?php echo  $acc_details['cTurn_over']; ?>" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="button" onclick="update_seller('business_details')" class="small button" value="Update"/>
                                <input type="button" onclick="cancel('business_details')" class="small button" value="Cancel"/>
                              </form>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="tabs-panel" id="panel3v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                            <div id="display_payment">
                                <table id="table_view"  class="table_view tabel_view_ids">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h5>Payment:</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="30%">
                                                <label><b>Payment Settlement in favour of:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cAcc_name"> <?php echo  $acc_details['cAcc_name']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Account number</label>
                                            </td>
                                            <td>
                                                <label id="disp_cAcc_number"> <?php echo  $acc_details['cAcc_number']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Bank name:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cAcc_bankname"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>City :</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cAcc_bankcity"> <?php echo  $acc_details['cBank_city']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                 <label><b>Branch:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cAcc_bankbranch"> <?php echo  $acc_details['cBank_branch']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                 <label><b>IFSC Code:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cAcc_ifsc"> <?php echo  $acc_details['cIFSC']; ?> </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                if($_SESSION['cAdmin'] ==  1)
                                {?>
                                <input type="button" onclick="edit_seller('payment')" class="small button" value="Edit"/>
                                <?php } ?>
                            </div>
                            <div id="edit_payment" style="display:none"> 
                                <table id="table_view"  class="table_view tabel_view_ids">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Payment:</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="30%">
                                                <label>Payment Settlement in favour of:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cAcc_name" name="cAcc_name" value="<?php echo  $acc_details['cAcc_name']; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Account number</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cAcc_number" name="cAcc_number" value="<?php echo  $acc_details['cAcc_number']; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Bank name:</label>
                                            </td>
                                            <td>
                                                <select id="cAcc_bankname" name="cAcc_bankname">
                                                    <option value="">Please Select</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>City :</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cAcc_bankcity" name="cAcc_bankcity" value="<?php echo  $acc_details['cBank_city']; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                 <label>Branch:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cAcc_bankbranch" name="cAcc_bankbranch" value="<?php echo  $acc_details['cBank_branch']; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                 <label>IFSC Code:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cAcc_ifsc" name="cAcc_ifsc" value="<?php echo  $acc_details['cIFSC']; ?>" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="button" onclick="update_seller('payment')" class="small button" value="Update"/>
                                <input type="button" onclick="cancel('payment')" class="small button" value="Cancel"/>
                              </div>
                        </div> 
                    </div>
                </div>
                
                <div class="tabs-panel" id="panel4v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                            <div id="display_payment_settlement">
                                <table id="table_view"  class="table_view tabel_view_ids">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h5 >Payment Settlement by Jewelsouk.com</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label><b>Payment settlement:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cPaynightmentSettlement"> <?php echo  $acc_details['cSettlement']; ?></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Mode of Payment Preferred:</b></label>
                                            </td>
                                            <td>
                        <label id="disp_cPaymentMode"> <?php echo  $acc_details['cMode']; ?></label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                if($_SESSION['cAdmin'] ==  1)
                                {?>
                                <input type="button" onclick="edit_seller('payment_settlement')" class="small button" value="Edit"/>
                                <?php } ?>
                            </div>
                            <div id="edit_payment_settlement" style="display:none"> 
                                <table id="table_view"  class="table_view tabel_view_ids">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Payment Settlement by Jewelsouk.com</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label>Payment settlement:</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="cPaynightmentSettlement_14" name="cPaymentSettlement" value="Fortnightly"/>Fortnightly
                                                <input type="radio" id="cPaynightmentSettlement_30" name="cPaymentSettlement" value="Monthly"/>Monthly
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Mode of Payment Preferred:</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="cPaymentMode_cheque" name="cPaymentMode" value="Cheque"/>Cheque
                                                <input type="radio" id="cPaymentMode_neft" name="cPaymentMode" value="NEFT"/>NEFT
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="button" onclick="update_seller('payment_settlement')" class="small button" value="Update"/>
                                <input type="button" onclick="cancel('payment_settlement')" class="small button" value="Cancel"/>
                            </div>
                        </div> 
                    </div>
                </div>
                
                <div class="tabs-panel" id="panel5v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                            <div id="display_documents">
                                <table id="disp_sole_Doc"  class="table_view table_view_id" style="display: none">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h5>Required Documents</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td  width="50%">
                                                <label><b>Ration card:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cRation_link']; ?>" class="boxer" title="Ration card">
                                                    <img  id="img_disp_sdRationcard" src="../img/seller_documents/<?php echo  $acc_docs['cRation_link']; ?>" alt="Thumbnail" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Address proof:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cReg_office_address_link']; ?>" class="boxer" title="Address proof">
                                                    <img id="img_disp_sdAddressproof" src="../img/seller_documents/<?php echo  $acc_docs['cReg_office_address_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>PAN Card:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cPAN_link']; ?>" class="boxer" title="PAN Card">
                                                    <img id="img_disp_sdPan" src="../img/seller_documents/<?php echo  $acc_docs['cPAN_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Return of Income for previous year:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cReturn_of_income_link']; ?>" class="boxer" title="Return of Income for previous year">
                                                    <img id="img_disp_sdReturnIncome" src="../img/seller_documents/<?php echo  $acc_docs['cReturn_of_income_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Signature Verification from Bank:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cSignature_verification_link']; ?>" class="boxer" title="Signature Verification from Bank">
                                                    <img id="img_disp_sdBankSignature" src="../img/seller_documents/<?php echo  $acc_docs['cSignature_verification_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="disp_partnership_Doc"  class="table_view table_view_id" style="display: none">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Required Documents</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="50%">
                                                <label><b>Address proof:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cReg_office_address_link']; ?>" class="boxer" title="Address proof">
                                                    <img id="img_disp_pdAddressproof" src="../img/seller_documents/<?php echo  $acc_docs['cReg_office_address_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>PAN Card:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cPAN_link']; ?>" class="boxer" title="PAN Card">
                                                    <img id="img_disp_pdPan" src="../img/seller_documents/<?php echo  $acc_docs['cPAN_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Return of Income for previous year:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cReturn_of_income_link']; ?>" class="boxer" title="Return of Income for previous year">
                                                    <img id="img_disp_pdReturnIncome" src="../img/seller_documents/<?php echo  $acc_docs['cReturn_of_income_link']; ?> " alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>List of Partners as on date (duly signed by Managing partner/ Partner):</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cList_of_partners_link']; ?>" class="boxer" title="List of Partners as on date">
                                                    <img id="img_disp_pdPartners" src="../img/seller_documents/<?php echo  $acc_docs['cList_of_partners_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Registered Deed / Registered certificate of Partnership Firm:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cReg_deed_link']; ?>" class="boxer" title="Registered Deed / Registered certificate of Partnership Firm">
                                                    <img id="img_disp_pdRegisteredCertificate" src="../img/seller_documents/<?php echo  $acc_docs['cReg_deed_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Signature Verification from Bank:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cSignature_verification_link']; ?>" class="boxer" title="Proof of Registered Office Address">
                                                    <img id="img_disp_pdBankSignature" src="../img/seller_documents/<?php echo  $acc_docs['cSignature_verification_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>    
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table id="disp_ltd_Doc"  class="table_view table_view_id" style="display: none">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Required Documents</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="50%">
                                                <label><b>Proof of Registered Office Address:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cReg_office_address_link']; ?>" class="boxer" title="Proof of Registered Office Address">
                                                    <img  id="img_disp_ldRegAddressproof" src="../img/seller_documents/<?php echo  $acc_docs['cReg_office_address_link']; ?>" alt="Thumbnail" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>PAN Card:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cPAN_link']; ?>" class="boxer" title="PAN Card">
                                                    <img id="img_disp_ldPan" src="../img/seller_documents/<?php echo  $acc_docs['cPAN_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>List of Partners as on date (duly signed by Managing partner/ Partner):</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cList_of_partners_link']; ?>" class="boxer" title="List of Partners as on date">
                                                    <img id="img_disp_ldPartners" src="../img/seller_documents/<?php echo  $acc_docs['cList_of_partners_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Board Resolution - (specimen Signature of authorizing Person should appear on Board resolution along with Company Secretary or other Director’s signature) on original letter head as per desired format:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cBoard_resolution_link']; ?>" class="boxer" title="Board Resolution">
                                                    <img id="img_disp_ldBoardResolution" src="../img/seller_documents/<?php echo  $acc_docs['cBoard_resolution_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Certificate of Commencement of Business (not applicable in case of Private Company):</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cCertificate_of_commencement_link']; ?>" class="boxer" title="Certificate of Commencement of Business">
                                                    <img id="img_disp_ldCommencementCertificate" src="../img/seller_documents/<?php echo  $acc_docs['cCertificate_of_commencement_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Certificate of Incorporation:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cCertificate_of_incorporation_link']; ?>" class="boxer" title="Certificate of Incorporation">
                                                    <img id="img_disp_ldIncorporationCertificate" src="../img/seller_documents/<?php echo  $acc_docs['cCertificate_of_incorporation_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>DIN Number of Directors:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cDIN_link']; ?>" class="boxer" title="DIN Number of Directors">
                                                    <img id="img_disp_ldDIN" src="../img/seller_documents/<?php echo  $acc_docs['cDIN_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>  
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Signature Verification from Bank:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cSignature_verification_link']; ?>" class="boxer" title="Signature Verification from Bank">
                                                    <img id="img_disp_ldBankSignature" src="../img/seller_documents/<?php echo  $acc_docs['cSignature_verification_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table  class="table_view table_view_id" >
                                    <tbody>
                                        <tr>
                                            <td  width="50%">
                                                <label><b>Company Profile:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cCompany_profile_link']; ?>" class="boxer" title="Company Profile">
                                                    <img id="img_disp_dCompanyProfile" src="../img/seller_documents/<?php echo  $acc_docs['cCompany_profile_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>VAT No.(If Applicable):</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cVAT_link']; ?>" class="boxer" title="VAT No.">
                                                    <img id="img_disp_dVat" src="../img/seller_documents/<?php echo  $acc_docs['cVAT_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Service Tax No.(If Applicable):</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cService_tax_link']; ?>" class="boxer" title="Service Tax No.">
                                                    <img id="img_disp_dServiceTax" src="../img/seller_documents/<?php echo  $acc_docs['cService_tax_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>C.S.T. No. (If Applicable):</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cCST_link']; ?>" class="boxer" title="C.S.T. No.">
                                                    <img id="img_disp_dCst" src="../img/seller_documents/<?php echo  $acc_docs['cCST_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Shops & Establishment License:</b></label>
                                            </td>
                                            <td>
                                                <a href="../img/seller_documents/<?php echo  $acc_docs['cEst_license_link']; ?>" class="boxer" title="Shops & Establishment License">
                                                    <img id="img_disp_dEstLicense" src="../img/seller_documents/<?php echo  $acc_docs['cEst_license_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                if($_SESSION['cAdmin'] ==  1)
                                {?>
                                <input type="button" onclick="edit_seller('documents')" class="small button" value="Edit"/>
                                <?php } ?>
                            </div>
                            <div id="edit_documents" style="display:none">
                                <table id="sole_Doc"  class="table_view table_view_id" style="display: none">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Required Documents</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td  width="50%">
                                                <label>Upload Ration card:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="sdRationcard" name="file[]" onchange="readURL(this);" />
                                                <img id="img_sdRationcard" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Address proof:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="sdAddressproof" name="file[]" onchange="readURL(this);" />
                                                <img id="img_sdAddressproof" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload PAN Card:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="sdPan" name="file[]" onchange="readURL(this);" />
                                                <img id="img_sdPan" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Return of Income for previous year:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="sdReturnIncome" name="file[]" onchange="readURL(this);" />
                                                <img id="img_sdReturnIncome" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Signature Verification from Bank:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="sdBankSignature" name="file[]" onchange="readURL(this);" />
                                                <img id="img_sdBankSignature" src="#" alt="" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="partnership_Doc"  class="table_view table_view_id" style="display: none">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Required Documents</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="50%">
                                                <label>Upload Address proof:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="pdAddressproof" name="file[]" onchange="readURL(this);" />
                                                <img id="img_pdAddressproof" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload PAN Card:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="pdPan" name="file[]" onchange="readURL(this);" />
                                                <img id="img_pdPan" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Return of Income for previous year:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="pdReturnIncome" name="file[]" onchange="readURL(this);" />
                                                <img id="img_pdReturnIncome" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload List of Partners as on date (duly signed by Managing partner/ Partner):</label>
                                            </td>
                                            <td>
                                                <input type='file' id="pdPartners" name="file[]" onchange="readURL(this);" />
                                                <img id="img_pdPartners" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Registered Deed / Registered certificate of Partnership Firm:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="pdRegisteredCertificate" name="file[]" onchange="readURL(this);" />
                                                <img id="img_pdRegisteredCertificate" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Signature Verification from Bank:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="pdBankSignature" name="file[]" onchange="readURL(this);" />
                                                <img id="img_pdBankSignature" src="#" alt="" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table id="ltd_Doc"  class="table_view table_view_id" style="display: none">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Required Documents</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="50%">
                                                <label>Upload Proof of Registered Office Address:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldRegAddressproof" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldRegAddressproof" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload PAN Card:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldPan" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldPan" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload List of Partners as on date (duly signed by Managing partner/ Partner):</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldPartners" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldPartners" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Board Resolution - (specimen Signature of authorizing Person should appear on Board resolution along with Company Secretary or other Director’s signature) on original letter head as per desired format:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldBoardResolution" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldBoardResolution" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Certificate of Commencement of Business (not applicable in case of Private Company):</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldCommencementCertificate" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldCommencementCertificate" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Certificate of Incorporation:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldIncorporationCertificate" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldIncorporationCertificate" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload DIN Number of Directors:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldDIN" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldDIN" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Signature Verification from Bank:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldBankSignature" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldBankSignature" src="#" alt="" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table  class="table_view table_view_id" >
                                    <tbody>
                                        <tr>
                                            <td  width="50%">
                                                <label>Upload Company Profile:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="dCompanyProfile" name="file[]" onchange="readURL(this);" />
                                                <img id="img_dCompanyProfile" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload VAT No.(If Applicable):</label>
                                            </td>
                                            <td>
                                                <input type='file' id="dVat" name="file[]" onchange="readURL(this);" />
                                                <img id="img_dVat" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Service Tax No.(If Applicable):</label>
                                            </td>
                                            <td>
                                                <input type='file' id="dServiceTax" name="file[]" onchange="readURL(this);" />
                                                <img id="img_dServiceTax" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload C.S.T. No. (If Applicable):</label>
                                            </td>
                                            <td>
                                                <input type='file' id="dCst" name="file[]" onchange="readURL(this);" />
                                                <img id="img_dCst" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Shops & Establishment License:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="dEstLicense" name="file[]" onchange="readURL(this);" />
                                                <img id="img_dEstLicense" src="#" alt="" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="button" onclick="update_seller('documents')" class="small button" value="Update"/>
                                <input type="button" onclick="cancel('documents')" class="small button" value="Cancel"/>
                            </div>
                        </div> 
                    </div>
                </div>
                
                <div class="tabs-panel" id="panel6v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                            <div id="display_pickup">
                                <table id="table_view "  class="table_view">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h5>Address</h5>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <tr>
                                            <th align="left" width="25%">
                                                <label>Address:</label>
                                            </th>
                                            <td>
                                                <label id="disp_cPickup_address"><?php echo  $acc_details['cPickup_address']; ?></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th align="left">
                                                <label>Pincode</label>
                                            </th>
                                            <td>
                                                <label id="disp_cPickup_pincode"><?php echo  $acc_details['iPickup_pincode']; ?></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th align="left">
                                                <label>Country</label>
                                            </th>
                                            <td>
                                                <label id="disp_cPickup_country"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th align="left">
                                                <label>State</label>
                                            </th>
                                            <td>
                                                <label id="disp_cPickup_state"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th align="left">
                                                <label>City</label>
                                            </th>
                                            <td>
                                                <label id="disp_cPickup_city"><?php echo  $acc_details['iPickup_city']; ?></label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                if($_SESSION['cAdmin'] ==  1)
                                {?>
                                <input type="button" onclick="edit_seller('pickup')" class="small button" value="Edit"/>
                                <?php } ?>
                            </div>
                            <div id="edit_pickup" style="display:none">
                                <table id="table_view"   class="table_view tabel_view_ids">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Pickup Address:</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label>Address:</label>
                                            </td>
                                            <td>
                                                <textarea id="cPickup_address" name="cPickup_address" ><?php echo  $acc_details['cPickup_address']; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Pincode</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cPickup_pincode" name="cPickup_pincode" value = "<?php echo  $acc_details['iPickup_pincode']; ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Country</label>
                                            </td>
                                            <td>
                                                <select id="cPickup_country" name="cPickup_country">
                                                    <option value="">Please Select</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>State</label>
                                            </td>
                                            <td>
                                                <select id="cPickup_state" name="cPickup_state">
                                                    <option value="">Select Country First</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>City</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cPickup_city" name="cPickup_city" value = "<?php echo  $acc_details['iPickup_city']; ?>"/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="button" onclick="update_seller('pickup')" class="small button" value="Update"/>
                                <input type="button" onclick="cancel('pickup')" class="small button" value="Cancel"/>
                              </div>
                        </div> 
                    </div>
                </div>
                
            </div>
                                
            </div>
            <div class="row">
                
            </div>
        </div>

        <!-- <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
                <div class="tabs-panel is-active" id="panel0v">
                    <div class="row">
                        <div class="large-12 medium-12 columns">
                            <table>
                                <thead>
                                    <tr>
                                        <th colspan="2">
                                            <h5 style="padding:0; margin:0;font-size:16px; font-weight:normal;"><b><?php //echo $acc_details['cEst_name']; ?></b></h5>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div id="graph_holder"></div>
                                            <div id= "table_status_list">
                                                <center>    
                                                    <img id="loading_status_list" src="img/loading.gif" alt="" height="100%" width="100%"/>
                                                </center>
                                            </div>
                                        </td>
                                    </tr>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="tabs-panel" id="panel1v">
                    <div class="row">
                        <div class="large-12 medium-12 columns">
                            <div id="display_business_information">
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h5 style="padding:0; margin:0;font-size:20px; font-weight:normal;">Business Information:</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label><b>Establishment Name:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cEstName"><?php //echo $acc_details['cEst_name']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Company Registered Name:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cRegName"><?php //echo  $acc_details['cReg_name']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Company Web site:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cWebsite"><?php //echo  $acc_details['cWebsite']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Contact Person(s):</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cContactPerson"><?php //echo  $acc_details['cContact_person']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Designation(s):</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cDesignation"><?php //echo  $acc_details['cDesignation']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Business Address:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cAddress"><?php //echo  $acc_details['cBusiness_address']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Business Address Pincode:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cPincode">
                                                    <?php 
                                                        //if($acc_details['iBusiness_address_pincode'] != 0)
                                                            //echo  $acc_details['iBusiness_address_pincode']; 
                                                    ?> 
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Business Address Country:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cCountry"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Business Address State:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cState"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Business Address City:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cCity"><?php //echo  $acc_details['cBusiness_address_city']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Span of Business:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cBusinessSpan"><?php //echo  $acc_details['cSpan_of_business']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Area of Business:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cBusinessArea"><?php //echo  $acc_details['cArea_of_business']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Registered Address:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cRegAddress"><?php //echo  $acc_details['cReg_address']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Registered Address Pincode:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cRegPincode">
                                                    <?php 
                                                       // if($acc_details['iReg_address_pincode'] != 0)
                                                            //echo  $acc_details['iReg_address_pincode']; 
                                                    ?> 
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Registered Address Country:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cRegCountry"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Registered Address State:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cRegState"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Registered Address City:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cRegCity"><?php //echo  $acc_details['cReg_address_city']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Telephone:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cTelephone">
                                                    <?php 
                                                       // if($acc_details['iTelephone'] != 0)
                                                            //echo  $acc_details['iTelephone']; 
                                                    ?> 
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Mobile:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cMobile">
                                                    <?php 
                                                    //if($acc_details['iMobile'] != 0)
                                                        //echo  $acc_details['iMobile']; 
                                                    ?> 
                                                </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Facsimile:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cFacsimile"><?php //echo  $acc_details['cFacsimile']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Email Id:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cEmail"><?php //echo  $acc_details['cEmail']; ?> </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                //if($_SESSION['cAdmin'] ==  1)
                                {?>
                                    <input type="button" onclick="edit_seller('business_information')" class="small button" value="Edit"/>
                                <?php } ?>
                              </div>
                              <div id="edit_business_information"  style="display:none;">
                                    <table>
                                        <thead>
                                            <tr>
                                                <th colspan="2">
                                                    <h3>Business Information:</h3>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td width="30%">
                                                    <label>Establishment Name:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cEstName" name="cEstName" value="<?php //echo $acc_details['cEst_name']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Company Registered Name:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cRegName" name="cRegName" value="<?php //echo  $acc_details['cReg_name']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Company Web site:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cWebsite" name="cWebsite" value="<?php //echo  $acc_details['cWebsite']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Contact Person(s):</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cContactPerson" name="cContactPerson" value="<?php //echo  $acc_details['cContact_person']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Designation(s):</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cDesignation" name="cDesignation" value="<?php //echo  $acc_details['cDesignation']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Business Address:</label>
                                                </td>
                                                <td>
                                                    <textarea id="cAddress" name="cAddress" ><?php //echo  $acc_details['cBusiness_address']; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Business Address Pincode:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cPincode" name="cPincode" value="<?php //echo  $acc_details['iBusiness_address_pincode']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Business Address Country:</label>
                                                </td>
                                                <td>
                                                    <select id="cCountry" name="cCountry">
                                                        <option value="">Please Select</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Business Address State:</label>
                                                </td>
                                                <td>
                                                    <select id="cState" name="cState">
                                                        <option value="">First Select Country</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Business Address City:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cCity" name="cCity" value="<?php //echo  $acc_details['cBusiness_address_city']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Span of Business:</label>
                                                </td>
                                                <td>
                                                    <textarea id="cBusinessSpan" name="cBusinessSpan" ><?php //echo  $acc_details['cSpan_of_business']; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Area of Business:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cBusinessArea" name="cBusinessArea" value="<?php //echo  $acc_details['cArea_of_business']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Registered Address:</label>
                                                </td>
                                                <td>
                                                    <textarea id="cRegAddress" name="cRegAddress" ><?php //echo  $acc_details['cReg_address']; ?></textarea>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Registered Address Pincode:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cRegPincode" name="cRegPincode" value="<?php //echo  $acc_details['iReg_address_pincode']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Registered Address Country:</label>
                                                </td>
                                                <td>
                                                    <select id="cRegCountry" name="cRegCountry">
                                                        <option value="">Please Select</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Registered Address State:</label>
                                                </td>
                                                <td>
                                                    <select id="cRegState" name="cRegState">
                                                        <option value="">First Select Country</option>
                                                    </select>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Registered Address City:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cRegCity" name="cRegCity" value="<?php //echo  $acc_details['cReg_address_city']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Telephone:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cTelephone" name="cTelephone" value="<?php //echo  $acc_details['iTelephone']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Mobile:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cMobile" name="cMobile" value="<?php //echo  $acc_details['iMobile']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Facsimile:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cFacsimile" name="cFacsimile" value="<?php //echo  $acc_details['cFacsimile']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Email Id:</label>
                                                </td>
                                                <td>
                                                    <input type="text" id="cEmail" name="cEmail" value="<?php ///echo  $acc_details['cEmail']; ?>" />
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Password:</label>
                                                </td>
                                                <td>
                                                    <input type="password" id="cPassword" name="cPassword" value=""/>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <label>Verify Password:</label>
                                                </td>
                                                <td>
                                                    <input type="password" id="cVPassword" name="cVPassword" value=""/>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>

                                    <input type="button" onclick="update_seller('business_information')" class="small button" value="Update"/>
                                    <input type="button" onclick="cancel('business_information')" class="small button" value="Cancel"/>
                              </div>
                        </div>
                      </div>
                            
                </div>
                <div class="tabs-panel" id="panel2v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                            <div id="display_business_details">
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h5 style="padding:0; margin:0;font-size:20px; font-weight:normal;">Business Details:</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="30%">
                                                <label><b>Your Firm is:</b></label>
                                            </td>
                                            <td>
                                                <lable id="disp_cFirm"> <?php //echo  $acc_details['cFirm']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Name(s) of : Directors /Proprietors/Partners:</b></label>
                                            </td>
                                            <td>
                                                <lable id="disp_cOwnerName"> <?php //echo  $acc_details['cDirectors']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Business Category:</b></label>
                                            </td>
                                            <td>
                                                <lable id="disp_cBusinessCategory"> <?php //echo  $acc_details['cBusiness_category']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Services offered/Items Sold on the net:</b></label>
                                            </td>
                                            <td>
                                                <lable id="disp_cServices"> <?php //echo  $acc_details['cServices']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Turn over for last two years:</b></label>
                                            </td>
                                            <td>
                                                <lable id="disp_cTurnOver"> <?php //echo  $acc_details['cTurn_over']; ?> </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                //if($_SESSION['cAdmin'] ==  1)
                                {?>
                                <input type="button" onclick="edit_seller('business_details')" class="small button" value="Edit"/>
                                <?php } ?>
                            </div>
                            <div id="edit_business_details" style="display:none;">
                                <form id="edit_business_form" method="post" enctype="multipart/form-data">
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Business Details:</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="30%">
                                                <label>Your Firm is:</label>
                                            </td>
                                            <td>
                                                <select id="cFirm" name="cFirm">
                                                    <option value="">Please select</option>
                                                    <option value="Limited">Limited</option>
                                                    <option value="Private Limited">Private Limited</option>
                                                    <option value="Proprietor">Proprietor</option>
                                                    <option value="Partnership">Partnership</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Name(s) of : Directors /Proprietors/Partners:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cOwnerName" name="cOwnerName" value="<?php //echo  $acc_details['cDirectors']; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Business Category:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cBusinessCategory" name="cBusinessCategory" value="<?php //echo  $acc_details['cBusiness_category']; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Services offered/Items Sold on the net:</label>
                                            </td>
                                            <td>
                                                <textarea id="cServices" name="cService" ><?php //echo  $acc_details['cServices']; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Turn over for last two years:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cTurnOver" name="cTurnOver" value="<?php //echo  $acc_details['cTurn_over']; ?>" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="button" onclick="update_seller('business_details')" class="small button" value="Update"/>
                                <input type="button" onclick="cancel('business_details')" class="small button" value="Cancel"/>
                              </form>
                            </div>
                        </div> 
                    </div>
                </div>
                <div class="tabs-panel" id="panel3v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                            <div id="display_payment">
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h5 style="padding:0; margin:0;font-size:20px; font-weight:normal;">Payment:</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="30%">
                                                <label><b>Payment Settlement in favour of:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cAcc_name"> <?php //echo  $acc_details['cAcc_name']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Account number</label>
                                            </td>
                                            <td>
                                                <label id="disp_cAcc_number"> <?php //echo  $acc_details['cAcc_number']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Bank name:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cAcc_bankname"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>City :</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cAcc_bankcity"> <?php //echo  $acc_details['cBank_city']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                 <label><b>Branch:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cAcc_bankbranch"> <?php //echo  $acc_details['cBank_branch']; ?> </label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                 <label><b>IFSC Code:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cAcc_ifsc"> <?php //echo  $acc_details['cIFSC']; ?> </label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                //if($_SESSION['cAdmin'] ==  1)
                                {?>
                                <input type="button" onclick="edit_seller('payment')" class="small button" value="Edit"/>
                                <?php } ?>
                            </div>
                            <div id="edit_payment" style="display:none"> 
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Payment:</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="30%">
                                                <label>Payment Settlement in favour of:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cAcc_name" name="cAcc_name" value="<?php// echo  $acc_details['cAcc_name']; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Account number</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cAcc_number" name="cAcc_number" value="<?php //echo  $acc_details['cAcc_number']; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Bank name:</label>
                                            </td>
                                            <td>
                                                <select id="cAcc_bankname" name="cAcc_bankname">
                                                    <option value="">Please Select</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>City :</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cAcc_bankcity" name="cAcc_bankcity" value="<?php //echo  $acc_details['cBank_city']; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                 <label>Branch:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cAcc_bankbranch" name="cAcc_bankbranch" value="<?php //echo  $acc_details['cBank_branch']; ?>" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                 <label>IFSC Code:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cAcc_ifsc" name="cAcc_ifsc" value="<?php //echo  $acc_details['cIFSC']; ?>" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="button" onclick="update_seller('payment')" class="small button" value="Update"/>
                                <input type="button" onclick="cancel('payment')" class="small button" value="Cancel"/>
                              </div>
                        </div> 
                    </div>
                </div>
                
                <div class="tabs-panel" id="panel4v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                            <div id="display_payment_settlement">
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h5 style="padding:0; margin:0;font-size:20px; font-weight:normal;">Payment Settlement by Jewelsouk.com</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label><b>Payment settlement:</b></label>
                                            </td>
                                            <td>
                                                <label id="disp_cPaynightmentSettlement"> <?php //echo  $acc_details['cSettlement']; ?></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Mode of Payment Preferred:</b></label>
                                            </td>
                                            <td>
						<label id="disp_cPaymentMode"> <?php //echo  $acc_details['cMode']; ?></label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                //if($_SESSION['cAdmin'] ==  1)
                                {?>
                                <input type="button" onclick="edit_seller('payment_settlement')" class="small button" value="Edit"/>
                                <?php } ?>
                            </div>
                            <div id="edit_payment_settlement" style="display:none"> 
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Payment Settlement by Jewelsouk.com</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label>Payment settlement:</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="cPaynightmentSettlement_14" name="cPaymentSettlement" value="Fortnightly"/>Fortnightly
                                                <input type="radio" id="cPaynightmentSettlement_30" name="cPaymentSettlement" value="Monthly"/>Monthly
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Mode of Payment Preferred:</label>
                                            </td>
                                            <td>
                                                <input type="radio" id="cPaymentMode_cheque" name="cPaymentMode" value="Cheque"/>Cheque
                                                <input type="radio" id="cPaymentMode_neft" name="cPaymentMode" value="NEFT"/>NEFT
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="button" onclick="update_seller('payment_settlement')" class="small button" value="Update"/>
                                <input type="button" onclick="cancel('payment_settlement')" class="small button" value="Cancel"/>
                            </div>
                        </div> 
                    </div>
                </div>
                
                <div class="tabs-panel" id="panel5v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                            <div id="display_documents">
                                <table id="disp_sole_Doc" style="display: none">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h5 style="padding:0; margin:0;font-size:20px; font-weight:normal;">Required Documents</h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td  width="50%">
                                                <label><b>Upload Ration card:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_sdRationcard" src="../img/seller_documents/<?php echo  $acc_docs['cRation_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload Address proof:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_sdAddressproof" src="../img/seller_documents/<?php echo  $acc_docs['cReg_office_address_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload PAN Card:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_sdPan" src="../img/seller_documents/<?php echo  $acc_docs['cPAN_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload Return of Income for previous year:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_sdReturnIncome" src="../img/seller_documents/<?php echo  $acc_docs['cReturn_of_income_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload Signature Verification from Bank:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_sdBankSignature" src="../img/seller_documents/<?php echo  $acc_docs['cSignature_verification_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="disp_partnership_Doc" style="display: none">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Required Documents</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="50%">
                                                <label><b>Upload Address proof:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_pdAddressproof" src="../img/seller_documents/<?php echo  $acc_docs['cReg_office_address_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload PAN Card:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_pdPan" src="../img/seller_documents/<?php echo  $acc_docs['cPAN_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload Return of Income for previous year:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_pdReturnIncome" src="../img/seller_documents/<?php echo  $acc_docs['cReturn_of_income_link']; ?> " alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload List of Partners as on date (duly signed by Managing partner/ Partner):</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_pdPartners" src="../img/seller_documents/<?php echo  $acc_docs['cList_of_partners_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload Registered Deed / Registered certificate of Partnership Firm:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_pdRegisteredCertificate" src="../img/seller_documents/<?php echo  $acc_docs['cReg_deed_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload Signature Verification from Bank:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_pdBankSignature" src="../img/seller_documents/<?php echo  $acc_docs['cSignature_verification_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table id="disp_ltd_Doc" style="display: none">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Required Documents</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="50%">
                                                <label><b>Upload Proof of Registered Office Address:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_ldRegAddressproof" src="../img/seller_documents/<?php echo  $acc_docs['cReg_office_address_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload PAN Card:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_ldPan" src="../img/seller_documents/<?php echo  $acc_docs['cPAN_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload List of Partners as on date (duly signed by Managing partner/ Partner):</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_ldPartners" src="../img/seller_documents/<?php echo  $acc_docs['cList_of_partners_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload Board Resolution - (specimen Signature of authorizing Person should appear on Board resolution along with Company Secretary or other Director’s signature) on original letter head as per desired format:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_ldBoardResolution" src="../img/seller_documents/<?php echo  $acc_docs['cBoard_resolution_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload Certificate of Commencement of Business (not applicable in case of Private Company):</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_ldCommencementCertificate" src="../img/seller_documents/<?php echo  $acc_docs['cCertificate_of_commencement_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload Certificate of Incorporation:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_ldIncorporationCertificate" src="../img/seller_documents/<?php echo  $acc_docs['cCertificate_of_incorporation_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload DIN Number of Directors:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_ldDIN" src="../img/seller_documents/<?php echo  $acc_docs['cDIN_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload Signature Verification from Bank:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_ldBankSignature" src="../img/seller_documents/<?php echo  $acc_docs['cSignature_verification_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td  width="50%">
                                                <label><b>Upload Company Profile:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_dCompanyProfile" src="../img/seller_documents/<?php echo  $acc_docs['cCompany_profile_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload VAT No.(If Applicable):</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_dVat" src="../img/seller_documents/<?php echo  $acc_docs['cVAT_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload Service Tax No.(If Applicable):</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_dServiceTax" src="../img/seller_documents/<?php echo  $acc_docs['cService_tax_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload C.S.T. No. (If Applicable):</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_dCst" src="../img/seller_documents/<?php echo  $acc_docs['cCST_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label><b>Upload Shops & Establishment License:</b></label>
                                            </td>
                                            <td>
                                                <img id="img_disp_dEstLicense" src="../img/seller_documents/<?php echo  $acc_docs['cEst_license_link']; ?>" alt=""  style="width: 200px; height: 250px;" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                                if($_SESSION['cAdmin'] ==  1)
                                {?>
                                <input type="button" onclick="edit_seller('documents')" class="small button" value="Edit"/>
                                <?php } ?>
                            </div>
                            <div id="edit_documents" style="display:none">
                                <table id="sole_Doc" style="display: none">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Required Documents</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td  width="50%">
                                                <label>Upload Ration card:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="sdRationcard" name="file[]" onchange="readURL(this);" />
                                                <img id="img_sdRationcard" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Address proof:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="sdAddressproof" name="file[]" onchange="readURL(this);" />
                                                <img id="img_sdAddressproof" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload PAN Card:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="sdPan" name="file[]" onchange="readURL(this);" />
                                                <img id="img_sdPan" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Return of Income for previous year:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="sdReturnIncome" name="file[]" onchange="readURL(this);" />
                                                <img id="img_sdReturnIncome" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Signature Verification from Bank:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="sdBankSignature" name="file[]" onchange="readURL(this);" />
                                                <img id="img_sdBankSignature" src="#" alt="" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table id="partnership_Doc" style="display: none">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Required Documents</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="50%">
                                                <label>Upload Address proof:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="pdAddressproof" name="file[]" onchange="readURL(this);" />
                                                <img id="img_pdAddressproof" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload PAN Card:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="pdPan" name="file[]" onchange="readURL(this);" />
                                                <img id="img_pdPan" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Return of Income for previous year:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="pdReturnIncome" name="file[]" onchange="readURL(this);" />
                                                <img id="img_pdReturnIncome" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload List of Partners as on date (duly signed by Managing partner/ Partner):</label>
                                            </td>
                                            <td>
                                                <input type='file' id="pdPartners" name="file[]" onchange="readURL(this);" />
                                                <img id="img_pdPartners" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Registered Deed / Registered certificate of Partnership Firm:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="pdRegisteredCertificate" name="file[]" onchange="readURL(this);" />
                                                <img id="img_pdRegisteredCertificate" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Signature Verification from Bank:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="pdBankSignature" name="file[]" onchange="readURL(this);" />
                                                <img id="img_pdBankSignature" src="#" alt="" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>

                                <table id="ltd_Doc" style="display: none">
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Required Documents</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="50%">
                                                <label>Upload Proof of Registered Office Address:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldRegAddressproof" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldRegAddressproof" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload PAN Card:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldPan" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldPan" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload List of Partners as on date (duly signed by Managing partner/ Partner):</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldPartners" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldPartners" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Board Resolution - (specimen Signature of authorizing Person should appear on Board resolution along with Company Secretary or other Director’s signature) on original letter head as per desired format:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldBoardResolution" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldBoardResolution" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Certificate of Commencement of Business (not applicable in case of Private Company):</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldCommencementCertificate" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldCommencementCertificate" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Certificate of Incorporation:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldIncorporationCertificate" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldIncorporationCertificate" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload DIN Number of Directors:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldDIN" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldDIN" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Signature Verification from Bank:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="ldBankSignature" name="file[]" onchange="readURL(this);" />
                                                <img id="img_ldBankSignature" src="#" alt="" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td  width="50%">
                                                <label>Upload Company Profile:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="dCompanyProfile" name="file[]" onchange="readURL(this);" />
                                                <img id="img_dCompanyProfile" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload VAT No.(If Applicable):</label>
                                            </td>
                                            <td>
                                                <input type='file' id="dVat" name="file[]" onchange="readURL(this);" />
                                                <img id="img_dVat" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Service Tax No.(If Applicable):</label>
                                            </td>
                                            <td>
                                                <input type='file' id="dServiceTax" name="file[]" onchange="readURL(this);" />
                                                <img id="img_dServiceTax" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload C.S.T. No. (If Applicable):</label>
                                            </td>
                                            <td>
                                                <input type='file' id="dCst" name="file[]" onchange="readURL(this);" />
                                                <img id="img_dCst" src="#" alt="" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Upload Shops & Establishment License:</label>
                                            </td>
                                            <td>
                                                <input type='file' id="dEstLicense" name="file[]" onchange="readURL(this);" />
                                                <img id="img_dEstLicense" src="#" alt="" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="button" onclick="update_seller('documents')" class="small button" value="Update"/>
                                <input type="button" onclick="cancel('documents')" class="small button" value="Cancel"/>
                            </div>
                        </div> 
                    </div>
                </div>
                
                <div class="tabs-panel" id="panel6v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                            <div id="display_pickup">
                                <table>
                                    <tbody>
                                        <tr>
                                            <th align="left" width="25%">
                                                <label>Address:</label>
                                            </th>
                                            <td>
                                                <label id="disp_cPickup_address"><?php //echo  $acc_details['cPickup_address']; ?></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th align="left">
                                                <label>Pincode</label>
                                            </th>
                                            <td>
                                                <label id="disp_cPickup_pincode"><?php //echo  $acc_details['iPickup_pincode']; ?></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th align="left">
                                                <label>Country</label>
                                            </th>
                                            <td>
                                                <label id="disp_cPickup_country"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th align="left">
                                                <label>State</label>
                                            </th>
                                            <td>
                                                <label id="disp_cPickup_state"></label>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th align="left">
                                                <label>City</label>
                                            </th>
                                            <td>
                                                <label id="disp_cPickup_city"><?php //echo  $acc_details['iPickup_city']; ?></label>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <?php
                               // if($_SESSION['cAdmin'] ==  1)
                                {?>
                                <input type="button" onclick="edit_seller('pickup')" class="small button" value="Edit"/>
                                <?php } ?>
                            </div>
                            <div id="edit_pickup" style="display:none">
                                <table>
                                    <thead>
                                        <tr>
                                            <th colspan="2">
                                                <h3>Pickup Address:</h3>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                <label>Address:</label>
                                            </td>
                                            <td>
                                                <textarea id="cPickup_address" name="cPickup_address" ><?php //echo  $acc_details['cPickup_address']; ?></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Pincode</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cPickup_pincode" name="cPickup_pincode" value = "<?php //echo  $acc_details['iPickup_pincode']; ?>"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Country</label>
                                            </td>
                                            <td>
                                                <select id="cPickup_country" name="cPickup_country">
                                                    <option value="">Please Select</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>State</label>
                                            </td>
                                            <td>
                                                <select id="cPickup_state" name="cPickup_state">
                                                    <option value="">Select Country First</option>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>City</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cPickup_city" name="cPickup_city" value = "<?php// echo  $acc_details['iPickup_city']; ?>"/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="button" onclick="update_seller('pickup')" class="small button" value="Update"/>
                                <input type="button" onclick="cancel('pickup')" class="small button" value="Cancel"/>
                              </div>
                        </div> 
                    </div>
                </div>
                
            </div>
        </div> -->
        </form>
      </div>
    
    <script src="../js/vendor/jquery.min.js"></script>
    <script src="../js/jquery-1.11.2.min.js"></script>
    <script src="../js/vendor/what-input.min.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script src="../js/app.js"></script>
    <script src="../js/alertify.min.js"></script>
    <script src="../js/jquery.fs.boxer.js"></script>
    <script src="js/index.js"></script>
    </body>
</html>