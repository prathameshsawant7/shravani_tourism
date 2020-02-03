<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Ajax calls of Setting Sellers
*/
include("config/start_session.php");
include("config/settings.php");
$est =new settings();
$con=$est->connection();

$request = $_POST['request'];

if($request == 'setTemplate')
{
    $query = "SELECT template_name FROM js_seller_template "
            . "WHERE employee_id = '".$_SESSION["cAdminID"]."' "
            . "AND seller_list = '".$_POST["iSeller_id"]."'";
    $fetch_data  = mysqli_query($con,$query);
    $template_name = '';
    while($aData = $fetch_data->fetch_assoc())
        $template_name = $aData['template_name'];
    
    $_SESSION['cSellerID']          = $_POST["iSeller_id"];
    $_SESSION['cSeller_Template']   = $template_name;
    echo $_SESSION['cSellerID']." - ".$_SESSION['cSeller_Template'];
}

if($request == 'saveTemplate')
{
    $cError = '';
    $query = "SELECT template_name FROM js_seller_template "
            . "WHERE employee_id = '".$_SESSION["cAdminID"]."' "
            . "AND seller_list = '".$_POST["iSeller_id"]."'";
   // echo $query;exit;
    $fetch_data     = mysqli_query($con,$query);
    $template_name  = '';
    while($aData = $fetch_data->fetch_assoc())
    {
        $template_name = $aData['template_name'];
    }
    
    if($template_name != '')
    {
        $cError .= 'Selected seller list already exist for template - '.$template_name."\n";
    }
    
    $query = "SELECT template_name FROM js_seller_template "
            . "WHERE employee_id = '".$_SESSION["cAdminID"]."' "
            . "AND template_name = '".$_POST["cTemplatename"]."'";
    //echo $query;exit;
    $fetch_data  = mysqli_query($con,$query);
    $get_total_rows1 = $fetch_data->fetch_row(); //hold total records in variable
    
    if($get_total_rows1 > 0)
    {
        $aData = $fetch_data->fetch_assoc();
        $cError .= "Template name already exist.\n";
    }
    
    if($cError == '')
    {
        $query = "INSERT INTO js_seller_template (employee_id,template_name,seller_list,tEntered) "
                . "VALUES ('".$_SESSION["cAdminID"]."','".$_POST["cTemplatename"]."'"
                . ",'".$_POST["iSeller_id"]."',now())";
        mysqli_query($con,$query);

        echo "Added Seller Template - ".$_POST["cTemplatename"];
    }
    else
        echo "Please fix below issues: \n".$cError;
    
}

if($request == 'updateTemplate')
{
    
    $cError = '';
    $query = "SELECT template_name FROM js_seller_template "
            . "WHERE employee_id = '".$_SESSION["cAdminID"]."' "
            . "AND seller_list = '".$_POST["iSeller_id"]."'";
   $fetch_data     = mysqli_query($con,$query);
    $template_name  = '';
    while($aData = $fetch_data->fetch_assoc())
    {
        $template_name = $aData['template_name'];
    }
    
    if($template_name != '')
    {
        $cError .= 'Selected seller list already exist for template - '.$template_name."\n";
    }
    
    
    if($cError == '')
    {
        $query = "UPDATE js_seller_template SET seller_list = '".$_POST["iSeller_id"]."', "
                . "tUpdated = now() "
                . "WHERE template_name = '".$_POST["cTemplatename"]."';";
        mysqli_query($con,$query);

        echo "Updated Seller Template - ".$_POST["cTemplatename"];
    }
    else
        echo "Please fix below issues: \n".$cError;
}

if($request == 'deleteTemplate')
{
    $query = "DELETE FROM js_seller_template "
            . "WHERE template_name = '".$_POST["cTemplatename"]."';";
    mysqli_query($con,$query);

    echo "Deleted Seller Template - ".$_POST["cTemplatename"];
;
}



if($request == 'getSetSeller')
{
    $query = "SELECT iSeller_id,cEst_name FROM js_seller ORDER BY cEst_name;";
    $seller_list  = mysqli_query($con,$query);
    
    $query = "SELECT seller_list,template_name FROM js_seller_template WHERE employee_id = ".$_SESSION['cAdminID']." ORDER BY template_name;";
    $seller_template_list  = mysqli_query($con,$query);
    
    $setTemplateHTML = "<select id='input_setSeller' name='character' multiple='multiple' >";
    $Options = '';
    while ($seller = $seller_template_list->fetch_assoc())
    {
        if($_SESSION['cSeller_Template'] == $seller['template_name'])
            $Options .= "<option value=".$seller['seller_list']." selected>".$seller['template_name']."</option>";
        else
            $Options .= "<option value=".$seller['seller_list'].">".$seller['template_name']."</option>";
    }
    if($Options != '')
        $setTemplateHTML .= "<optgroup label='Seller Templates'>$Options</optgroup>";
    
    $Options = '';
    $aSellers = explode(",",$_SESSION['cSellerID']);
    while ($seller = $seller_list->fetch_assoc())
    {
        if($_SESSION['cSeller_Template'] == '' && in_array($seller['iSeller_id'], $aSellers))
            $Options .= "<option value=".$seller['iSeller_id']." selected >".$seller['cEst_name']."</option>";
        else
            $Options .= "<option value=".$seller['iSeller_id'].">".$seller['cEst_name']."</option>";
    }
    if($Options != '')
        $setTemplateHTML .= "<optgroup label='Seller List'>$Options</optgroup></select>";
    
    
    $saveTemplateHTML = "<select id='input_saveSeller' name='character' multiple='multiple' >";
    $Options = '';
    mysqli_data_seek($seller_list,0);
    while ($seller = $seller_list->fetch_assoc())
        $Options .= "<option value=".$seller['iSeller_id'].">".$seller['cEst_name']."</option>";
    $saveTemplateHTML   .= "<optgroup label='Seller List'>$Options</optgroup></select>"
            . "<BR><input id='cTemplatename' type='text' placeholder='Enter Templatename' value='' style='float: left;'><BR>";
    
    
    $updateTemplateHTML = "<label>Select Template</label>"
            . "<select id='template_list'>"
            . "<option value=''>Please Select</option>";
    $Options = '';
    mysqli_data_seek($seller_template_list,0);
    while ($seller = $seller_template_list->fetch_assoc())
        $Options .= "<option value=".$seller['seller_list'].">".$seller['template_name']."</option>";
    $updateTemplateHTML .= $Options."</select>";
    
    $updateTemplateHTML .="<BR><BR><label>Update Template</label>"
            . "<select id='input_updateSeller' name='updateCheck' multiple='multiple' >";
    $Options = '';
    mysqli_data_seek($seller_list,0);
    while ($seller = $seller_list->fetch_assoc())
        $Options .= "<option value=".$seller['iSeller_id'].">".$seller['cEst_name']."</option>";
    $updateTemplateHTML .= "<optgroup label='Seller List'>$Options</optgroup></select>";
    
    
    $deleteTemplateHTML = "<label>Select Template</label>"
            . "<select id='delete_template_list'>"
            . "<option value=''>Please Select</option>";
    $Options = '';
    mysqli_data_seek($seller_template_list,0);
    while ($seller = $seller_template_list->fetch_assoc())
        $Options .= "<option value=".$seller['seller_list'].">".$seller['template_name']."</option>";
    $deleteTemplateHTML .= $Options."</select>";
    
    
    $return['setTemplateHTML']      = $setTemplateHTML;
    $return['saveTemplateHTML']     = $saveTemplateHTML;
    $return['updateTemplateHTML']   = $updateTemplateHTML;
    $return['deleteTemplateHTML']   = $deleteTemplateHTML;
    
    echo json_encode($return);
}


?>