<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Registration Page
--> 
<?php

include("../config/settings.php");
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
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
  </head>
  <body>
    <center>
        <div class="row" style="background-color: #1583cc; color: #fefefe;">
            <div class="large-12 columns">
              <h2>Jewelsouk Seller Hub</h2>
          </div>
        </div>
    </center>
    <BR>
    
    <div id="hiddenFields">
        <input  type="hidden" id="cFullpath" value="<?php echo FULLROOT; ?>">
        <input  type="hidden" id="cWebpath" value="<?php echo WEBROOT; ?>">
    </div>

    <div class="row collapse">
        <div class="medium-3 columns">
            <ul class="tabs vertical" id="example-vert-tabs" data-tabs>
                <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true">Business Information</a></li>
                <li class="tabs-title"><a href="#panel2v">Business Details</a></li>
                <li class="tabs-title"><a href="#panel3v">Payment</a></li>
                <li class="tabs-title"><a href="#panel4v">Payment Settlements</a></li>
                <li class="tabs-title"><a href="#panel5v">Documents</a></li>
                <li class="tabs-title"><a href="#panel6v">Pickup Address</a></li>
            </ul>
        </div>
        <form action="store_reg.php" name="register" onsubmit="return(validate());" method="post"  enctype="multipart/form-data">
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
                <div class="tabs-panel is-active" id="panel1v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
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
                                            <input type="text" id="cEstName" name="cEstName" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Company Registered Name:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="cRegName" name="cRegName" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Company Web site:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="cWebsite" name="cWebsite" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Contact Person(s):</label>
                                        </td>
                                        <td>
                                            <input type="text" id="cContactPerson" name="cContactPerson" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Designation(s):</label>
                                        </td>
                                        <td>
                                            <input type="text" id="cDesignation" name="cDesignation" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Business Address:</label>
                                        </td>
                                        <td>
                                            <textarea id="cAddress" name="cAddress" ></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Business Address Pincode:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="cPincode" name="cPincode" />
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
                                            <input type="text" id="cCity" name="cCity" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Span of Business:</label>
                                        </td>
                                        <td>
                                            <textarea id="cBusinessSpan" name="cBusinessSpan" ></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Area of Business:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="cBusinessArea" name="cBusinessArea" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Registered Address:</label>
                                        </td>
                                        <td>
                                            <textarea id="cRegAddress" name="cRegAddress" ></textarea>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Registered Address Pincode:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="cRegPincode" name="cRegPincode" />
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
                                            <input type="text" id="cRegCity" name="cRegCity" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Telephone:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="cTelephone" name="cTelephone" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Mobile:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="cMobile" name="cTelephone" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Facsimile:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="cFacsimile" name="cFacsimile" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Email Id:</label>
                                        </td>
                                        <td>
                                            <input type="text" id="cEmail" name="cEmail" />
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Password:</label>
                                        </td>
                                        <td>
                                            <input type="password" id="cPassword" name="cPassword"/>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>Verify Password:</label>
                                        </td>
                                        <td>
                                            <input type="password" id="cVPassword" name="cVPassword"/>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <input type="button" onclick="nextTab('2')" class="small button" value="Next"/>
                        </div>
                    </div>
                </div>
                <div class="tabs-panel" id="panel2v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                           
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
                                                <input type="text" id="cOwnerName" name="cOwnerName" value=""/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Business Category:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cBusinessCategory" name="cBusinessCategory" value=""/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Services offered/Items Sold on the net:</label>
                                            </td>
                                            <td>
                                                <textarea id="cServices" name="cServices" ></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Turn over for last two years:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cTurnOver" name="cTurnOver" value="" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="button" onclick="backTab('1')" class="small button" value="Back"/>
                                <input type="button" onclick="nextTab('3')" class="small button" value="Next"/>
                           
                        </div> 
                    </div>
                </div>
                <div class="tabs-panel" id="panel3v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                           
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
                                                <input type="text" id="cAcc_name" name="cAcc_name" />
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Account number</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cAcc_number" name="cAcc_number" />
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
                                                <input type="text" id="cAcc_bankcity" name="cAcc_bankcity"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                 <label>Branch:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cAcc_bankbranch" name="cAcc_bankbranch"/>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                 <label>IFSC Code:</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cAcc_ifsc" name="cAcc_ifsc"/>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="button" onclick="backTab('2')" class="small button" value="Back"/>
                                <input type="button" onclick="nextTab('4')" class="small button" value="Next"/>
                           
                          </div> 
                    </div>
                </div>
                
                <div class="tabs-panel" id="panel4v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
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

                            <input type="button" onclick="backTab('3')" class="small button" value="Back"/>
                            <input type="button" onclick="nextTab('5')" class="small button" value="Next"/>
                            
                          </div> 
                    </div>
                </div>
                
                <div class="tabs-panel" id="panel5v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                           <div id="error_Loader">
                                <center>    
                                    <label style="color: red">Select Firm Type first in Business Details</label>
                                    <img id="img_Loading" src="../img/loading.gif" alt="" height="50%" width="50%"/>
                                </center>
                           </div>
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

                            <input type="button" onclick="backTab('4')" class="small button" value="Back"/>
                            <input type="button" onclick="nextTab('6')" class="small button" value="Next"/>
                           
                          </div> 
                    </div>
                </div>
                
                <div class="tabs-panel" id="panel6v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                           
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
                                            <td width="30%">
                                                <label>Address:</label>
                                            </td>
                                            <td>
                                                <textarea id="cPickup_address" name="cPickup_address" ></textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <label>Pincode</label>
                                            </td>
                                            <td>
                                                <input type="text" id="cPickup_pincode" name="cPickup_pincode" />
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
                                                <input type="text" id="cPickup_city" name="cPickup_city" />
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="button" onclick="backTab('5')" class="small button" value="Back"/>
                                <input type="submit" class="small button" value="Submit"/>
                            
                          </div> 
                    </div>
                </div>
                
            </div>
        </div>
        </form>
      </div>
    <script src="../js/jquery-1.11.2.min.js"></script>
    <script src="../js/vendor/jquery.min.js"></script>
    <script src="../js/vendor/what-input.min.js"></script>
    <script src="../js/foundation.min.js"></script>
     
    <script src="../js/app.js"></script>
    <script type="text/javascript">
       
    $(document).ready(function() 
    {
        $("#cFirm").change(function()
        {
            if($("#cFirm").val() == 'Proprietor')
            {
                $("#sole_Doc").show();
                $("#partnership_Doc").hide();
                $("#ltd_Doc").hide();
                $("#error_Loader").hide();
            }
            else if($("#cFirm").val() == 'Partnership')
            {
                $("#sole_Doc").hide();
                $("#partnership_Doc").show();
                $("#ltd_Doc").hide();
                $("#error_Loader").hide();
            }
            else if($("#cFirm").val() == 'Limited' || $("#cFirm").val() == 'Private Limited')
            {
                $("#sole_Doc").hide();
                $("#partnership_Doc").hide();
                $("#ltd_Doc").show();
                $("#error_Loader").hide();
            }
            else
            {
                $("#sole_Doc").hide();
                $("#partnership_Doc").hide();
                $("#ltd_Doc").hide();
                $("#error_Loader").show();
            }
        });
        
        
        $.post("../ajax_call.php",{request:'getCountriesForSelectbox'},function(data) 
            {
                $("#cCountry").html(trim(data));
                $("#cRegCountry").html(trim(data));
                $("#cPickup_country").html(trim(data));
            });

        $("#cCountry").change(function()
        {
            cCountry = trim($("#cCountry").val());
            if(cCountry != '')
            {
                $.post("../ajax_call.php",{request:'getStatesForSelectbox',cCountry:cCountry},function(data) 
                {
                    $("#cState").html(trim(data));
                });
            }
        });
        
        $("#cRegCountry").change(function()
        {
            cCountry = trim($("#cRegCountry").val());
            if(cCountry != '')
            {
                $.post("../ajax_call.php",{request:'getStatesForSelectbox',cCountry:cCountry},function(data) 
                {
                    $("#cRegState").html(trim(data));
                });
            }
        });
        
        $("#cPickup_country").change(function()
        {
            cCountry = trim($("#cPickup_country").val());
            if(cCountry != '')
            {
                $.post("../ajax_call.php",{request:'getStatesForSelectbox',cCountry:cCountry},function(data) 
                {
                    $("#cPickup_state").html(trim(data));
                });
            }
        });
        
        $("#cEmail").change(function()
        {
            cEmail = trim($("#cEmail").val());
            if(cEmail != '')
            {
                $.post("../ajax_call.php",{request:'validateEmail',cEmail:cEmail},function(data) 
                {
                    if(trim(data) > 0)
                    {
                        $("#cEmail").html('');
                        alert('Email id already exit');
                    }
                });
            }
        });
        
        $.post("../ajax_call.php",{request:'getBanksForSelectbox'},function(data) 
        {
            $("#cAcc_bankname").html(trim(data));
        });

    });

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
    
    function readURL(input) 
    {
        if (input.files && input.files[0]) 
        {
            var reader = new FileReader();

            reader.onload = function (e) 
            {
                $('#img_'+input.id)
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    function validate()
    {
     var error="";
       if( document.login.cEmail.value == "" )
       {
         error=error+"Please provide email id.\n";
       }
       else
       {
            var emailID = document.login.cEmail.value;
            atpos = emailID.indexOf("@");
            dotpos = emailID.lastIndexOf(".");
            if (atpos < 1 || ( dotpos - atpos < 2 )) 
            {
                error=error+"Incorrect Email-id";
            }
       }
       if( document.login.cPassword.value == "" )
       {
         error=error+"Please provide password";
       }

       if(error=="")
       {
       return( true );
       }
       else
       {
            alert("Fix Below issues: \n"+error);
            return( false );
       }
    }
    
    function trim(str)
    {
      return str.replace(/^\s+|\s+$/g,"");
    }
    </script>
  </body>
</html>
