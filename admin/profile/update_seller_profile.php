<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Update Seller Details
*/ 
include("../config/start_session.php");
include("../config/settings.php");
$est =new settings();
$con=$est->connection();

$iSeller_id = $_POST['iSeller_id'];

if(isset($_POST['tab']) && $_POST['tab'] == 'business_information')
{
    
    $cEstName               = $_POST['cEstName'];
    $cRegName               = $_POST['cRegName'];
    $cWebsite               = $_POST['cWebsite'];
    $cContactPerson         = $_POST['cContactPerson'];
    $cDesignation           = $_POST['cDesignation'];
    $cVAT                   = $_POST['cVAT'];
    $cCST                   = $_POST['cCST'];
    $cPAN                   = $_POST['cPAN'];
    $cCIN                   = $_POST['cCIN'];
    $cAddress               = $_POST['cAddress'];
    $cPincode               = $_POST['cPincode'];
    $cCountry               = $_POST['cCountry'];
    $cState                 = $_POST['cState'];
    $cCity                  = $_POST['cCity'];
    $cBusinessSpan          = $_POST['cBusinessSpan'];
    $cBusinessArea          = $_POST['cBusinessArea'];
    $cRegAddress            = $_POST['cRegAddress'];
    $cRegPincode            = $_POST['cRegPincode'];
    $cRegCountry            = $_POST['cRegCountry'];
    $cRegState              = $_POST['cRegState'];
    $cRegCity               = $_POST['cRegCity'];
    $cTelephone             = $_POST['cTelephone'];
    $cMobile                = $_POST['cTelephone'];
    $cFacsimile             = $_POST['cFacsimile'];
    $cEmail                 = $_POST['cEmail'];
    $cPassword              = $_POST['cPassword'];
    $cVPassword             = $_POST['cVPassword'];
    
    $query  = "UPDATE js_seller SET cEst_name='$cEstName',cReg_name='$cRegName',cWebsite='$cWebsite',"
            . "cContact_person='$cContactPerson',cDesignation='$cDesignation',"
            . "cVAT='$cVAT',cCST='$cCST',cPAN='$cPAN',cCIN='$cCIN',"
            . "cBusiness_address='$cAddress',iBusiness_address_pincode='$cPincode',"
            . "iBusiness_address_countryID=$cCountry,iBusiness_address_stateID=$cState,"
            . "cBusiness_address_city='$cCity',cSpan_of_business='$cBusinessSpan',"
            . "cArea_of_business='$cBusinessArea',cReg_address='$cRegAddress',"
            . "iReg_address_pincode='$cRegPincode',iReg_address_countryID=$cRegCountry,"
            . "iReg_address_stateID=$cRegState,cReg_address_city='$cRegCity',"
            . "iTelephone=$cTelephone,iMobile=$cMobile,cFacsimile='$cFacsimile',cEmail='$cEmail',";
            
    if($_POST['cPassword'] != '')
    {
        $cPassword    = md5($_POST['cPassword']);
        
        $query  .= "cPassword = '$cPassword',";
    }
    
    $query  .= "tUpdated = now()  WHERE iSeller_id = ".$iSeller_id.";";
    
    mysqli_query($con,$query);
    
    echo "updated";
}
else if(isset($_POST['tab']) && $_POST['tab'] == 'business_details')
{
    $cFirm                  = $_POST['cFirm'];
    $cOwnerName             = $_POST['cOwnerName'];
    $cBusinessCategory      = $_POST['cBusinessCategory'];
    $cServices              = $_POST['cServices'];
    $cTurnOver              = $_POST['cTurnOver'];
    
    $query  = "UPDATE js_seller SET cFirm='$cFirm',cDirectors='$cOwnerName',"
            . "cBusiness_category='$cBusinessCategory',cServices='$cServices',cTurn_over='$cTurnOver',"
            . "tUpdated = now()  WHERE iSeller_id = ".$iSeller_id.";";
  
    mysqli_query($con,$query);
    
    echo "updated";
}
else if(isset($_POST['tab']) && $_POST['tab'] == 'payment')
{
    $bank_id                = $_POST['cAcc_bankname'];
    $bank_acc_name          = $_POST['cAcc_name'];
    $bank_acc_number        = $_POST['cAcc_number'];
    $bank_city              = $_POST['cAcc_bankcity'];
    $bank_branch            = $_POST['cAcc_bankbranch'];
    $bank_ifsc              = $_POST['cAcc_ifsc'];
    
    $query  = "UPDATE js_seller SET cBank_nameID = $bank_id, cAcc_name = '$bank_acc_name',"
            . "cAcc_number = '$bank_acc_number', cBank_city = '$bank_city', cBank_branch= '$bank_branch',"
            . "cIFSC = '$bank_ifsc', tUpdated = now() WHERE iSeller_id = ".$iSeller_id.";";
  
    mysqli_query($con,$query);
    
    echo "updated";
}
else if(isset($_POST['tab']) && $_POST['tab'] == 'payment_settlement')
{
    $seller_business_name   = $_POST['cDisplay_name'];
    $seller_business_description = $_POST['cDescription'];
    
    $query  = "UPDATE js_seller SET seller_business_name = '$seller_business_name', "
            . "seller_business_description = '$seller_business_description', "
            . "tUpdated = now() "
            . "WHERE iSeller_id = ".$iSeller_id.";";
  
    mysqli_query($con,$query);
    echo "updated";
}
else if(isset($_POST['tab']) && $_POST['tab'] == 'documents')
{
    $cFirm      = $_POST['cFirm'];
    $seller_id  = $iSeller_id;
    $query      = "UPDATE js_seller_docs SET ";
    
    if($cFirm == 'Proprietor')
    {
        if(isset($_FILES["files"]["name"]["sdRationcard"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["sdRationcard"]);
            $link       = "Rationcard".$seller_id.time('His').".".end($ext);
            $query     .= " cRation_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["sdRationcard"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["sdAddressproof"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["sdAddressproof"]);
            $link       = "Addressproof".$seller_id.time('His').".".end($ext);
            $query     .= " cReg_office_address_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["sdAddressproof"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["sdPan"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["sdPan"]);
            $link       = "Pan".$seller_id.time('His').".".end($ext);
            $query     .= " cPAN_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["sdPan"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["sdReturnIncome"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["sdReturnIncome"]);
            $link       = "ReturnIncome".$seller_id.time('His').".".end($ext);
            $query     .= " cReturn_of_income_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["sdReturnIncome"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["sdBankSignature"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["sdBankSignature"]);
            $link       = "BankSignature".$seller_id.time('His').".".end($ext);
            $query     .= " cReturn_of_income_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["sdBankSignature"],"../img/seller_documents/".$link);
        }
    }
    elseif ($cFirm == 'Partnership') 
    {
        if(isset($_FILES["files"]["name"]["pdAddressproof"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["pdAddressproof"]);
            $link       = "Addressproof".$seller_id.time('His').".".end($ext);
            $query     .= " cReg_office_address_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["pdAddressproof"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["pdPan"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["pdPan"]);
            $link       = "Pan".$seller_id.time('His').".".end($ext);
            $query     .= " cPAN_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["pdPan"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["pdReturnIncome"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["pdReturnIncome"]);
            $link       = "ReturnIncome".$seller_id.time('His').".".end($ext);
            $query     .= " cReturn_of_income_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["pdReturnIncome"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["pdPartners"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["pdPartners"]);
            $link       = "Partners".$seller_id.time('His').".".end($ext);
            $query     .= " cList_of_partners_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["pdPartners"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["pdRegisteredCertificate"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["pdRegisteredCertificate"]);
            $link       = "RegisteredCertificate".$seller_id.time('His').".".end($ext);
            $query     .= " cReg_deed_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["pdRegisteredCertificate"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["pdBankSignature"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["pdBankSignature"]);
            $link       = "BankSignature".$seller_id.time('His').".".end($ext);
            $query     .= " cSignature_verification_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["pdBankSignature"],"../img/seller_documents/".$link);
        }
        
    }
    
    elseif ($cFirm == 'Limited' || $cFirm == 'Private Limited') 
    {
        if(isset($_FILES["files"]["name"]["ldRegAddressproof"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["ldRegAddressproof"]);
            $link       = "RegAddressproof".$seller_id.time('His').".".end($ext);
            $query     .= " cReg_office_address_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["ldRegAddressproof"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["ldPan"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["ldPan"]);
            $link       = "Pan".$seller_id.time('His').".".end($ext);
            $query     .= " cPAN_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["ldPan"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["ldPartners"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["ldPartners"]);
            $link       = "Partners".$seller_id.time('His').".".end($ext);
            $query     .= " cList_of_partners_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["ldPartners"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["ldBoardResolution"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["ldBoardResolution"]);
            $link       = "BoardResolution".$seller_id.time('His').".".end($ext);
            $query     .= " cBoard_resolution_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["ldBoardResolution"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["ldCommencementCertificate"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["ldCommencementCertificate"]);
            $link       = "CommencementCertificate".$seller_id.time('His').".".end($ext);
            $query     .= " cCertificate_of_commencement_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["ldCommencementCertificate"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["ldIncorporationCertificate"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["ldIncorporationCertificate"]);
            $link       = "IncorporationCertificate".$seller_id.time('His').".".end($ext);
            $query     .= " cCertificate_of_incorporation_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["ldIncorporationCertificate"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["ldDIN"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["ldDIN"]);
            $link       = "DIN".$seller_id.time('His').".".end($ext);
            $query     .= " cDIN_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["ldDIN"],"../img/seller_documents/".$link);
        }
        
        if(isset($_FILES["files"]["name"]["ldBankSignature"]))
        {
            $ext        = explode(".", $_FILES["files"]["name"]["ldBankSignature"]);
            $link       = "BankSignature".$seller_id.time('His').".".end($ext);
            $query     .= " cSignature_verification_link = '$link', ";
            move_uploaded_file($_FILES["files"]["tmp_name"]["ldBankSignature"],"../img/seller_documents/".$link);
        }
    }
        
    
    if(isset($_FILES["files"]["name"]["dCompanyProfile"]))
    {
        $ext        = explode(".", $_FILES["files"]["name"]["dCompanyProfile"]);
        $link       = "CompanyProfile".$seller_id.time('His').".".end($ext);
        $query     .= " cCompany_profile_link = '$link', ";
        move_uploaded_file($_FILES["files"]["tmp_name"]["dCompanyProfile"],"../img/seller_documents/".$link);
    }
    
    if(isset($_FILES["files"]["name"]["dVat"]))
    {
        $ext        = explode(".", $_FILES["files"]["name"]["dVat"]);
        $link       = "Vat".$seller_id.time('His').".".end($ext);
        $query     .= " cVAT_link = '$link', ";
        move_uploaded_file($_FILES["files"]["tmp_name"]["dVat"],"../img/seller_documents/".$link);
    }
    
    if(isset($_FILES["files"]["name"]["dServiceTax"]))
    {
        $ext        = explode(".", $_FILES["files"]["name"]["dServiceTax"]);
        $link       = "ServiceTax".$seller_id.time('His').".".end($ext);
        $query     .= " cVAT_link = '$link', ";
        move_uploaded_file($_FILES["files"]["tmp_name"]["dServiceTax"],"../img/seller_documents/".$link);
    }
    
    if(isset($_FILES["files"]["name"]["dCst"]))
    {
        $ext        = explode(".", $_FILES["files"]["name"]["dCst"]);
        $link       = "Cst".$seller_id.time('His').".".end($ext);
        $query     .= " cCST_link = '$link', ";
        move_uploaded_file($_FILES["files"]["tmp_name"]["dCst"],"../img/seller_documents/".$link);
    }
    
    if(isset($_FILES["files"]["name"]["dEstLicense"]))
    {
        $ext        = explode(".", $_FILES["files"]["name"]["dEstLicense"]);
        $link       = "EstLicense".$seller_id.time('His').".".end($ext);
        $query     .= " cEst_license_link = '$link', ";
        move_uploaded_file($_FILES["files"]["tmp_name"]["dEstLicense"],"../img/seller_documents/".$link);

    }
    
    $query  .= "tUpdated = now() WHERE iSeller_id = ".$_SESSION['cSellerID'].";";
    
    mysqli_query($con,$query);

    echo "updated";
}
else if(isset($_POST['tab']) && $_POST['tab'] == 'pickup')
{
    $seller_pickup_address      = $_POST['cPickup_address'];
    $seller_pickup_pincode      = $_POST['cPickup_pincode'];
    $seller_pickup_country_id   = $_POST['cPickup_country'];
    $seller_pickup_state_id     = $_POST['cPickup_state'];
    $seller_pickup_city         = $_POST['cPickup_city'];
    
    $query  = "UPDATE js_seller SET cPickup_address = '$seller_pickup_address', "
            . "iPickup_pincode = '$seller_pickup_pincode', "
            . "iPickup_countryID = $seller_pickup_country_id, "
            . "iPickup_stateID = $seller_pickup_state_id, "
            . "iPickup_city = '$seller_pickup_city', "
            . "tUpdated = now() "
            . "WHERE iSeller_id = ".$iSeller_id.";";
  
    mysqli_query($con,$query);
    
    echo "updated";
}


?>
