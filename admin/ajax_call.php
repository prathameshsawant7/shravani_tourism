<?php
/*
 * @author 	Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package     Jewelsouk Seller Hub
 * @version     1.0
 * @since 	2016-Mar
 * Used for all home ajax calls
*/ 
include("config/settings.php");
$est =new settings();
$con=$est->connection();

if($_POST['request']=='getBanksForSelectbox')
{
  $fetch_data = mysqli_query($con,"SELECT bank_id,bank_name FROM js_bank ORDER BY bank_name;");
  $result = '<option value="">Please Select</option>';
  while($aBank = $fetch_data->fetch_row())
    {
        $result .= '<option value="'.$aBank[0].'">'.$aBank[1].'</option>';
    }
     
   echo $result;
   exit;
}
if($_POST['request']=='getCountriesForSelectbox')
{
  $fetch_data = mysqli_query($con,"SELECT id_country,name FROM js_country_lang ORDER BY name;");
  $result = '<option value="">Please Select</option>';
  while($aCountry = $fetch_data->fetch_row())
    {
        $result .= '<option value="'.$aCountry[0].'">'.$aCountry[1].'</option>';
    }
     
   echo $result;
   exit;
}
else if($_POST['request']=='getStatesForSelectbox')
{
  $cCountry =   $_POST['cCountry'];
  $fetch_data = mysqli_query($con,"SELECT id_state,name FROM js_state WHERE id_country = ".$cCountry." ORDER BY name;");
  $result = '<option value="">Please Select</option>';
  while($aStates = $fetch_data->fetch_row())
    {
        $result .= '<option value="'.$aStates[0].'">'.$aStates[1].'</option>';
    }
     
   echo $result;
}
else if($_POST['request']=='validateEmail')
{
  $cEmail   = $_POST['cEmail'];
  $query    = "SELECT COUNT(*) FROM js_seller WHERE cEmail = '".$cEmail."';";
  $results  = $con->query($query);
  $get_total_rows = $results->fetch_row(); //hold total records in variable  
  echo $get_total_rows[0];
}
if($_POST['request']=='getSellerDetails')
{
    $iSeller_id   = $_POST['iSeller_id'];
  
    $query = "SELECT COUNT(*) FROM js_hybrid_product "
            . "WHERE iSeller_id IN (".$iSeller_id.");";
    $results = $con->query($query);
    
    $result['products'] = $results->fetch_row(); //hold total records in variable
    
    $query = "SELECT SUM(o.total_products_wt) AS total "
            . "FROM js_orders AS o "
            . "LEFT JOIN js_order_detail AS od ON o.id_order = od.id_order "
            . "LEFT JOIN js_order_state_lang AS osl ON o.current_state = osl.id_order_state "
            . "WHERE od.iSeller_id IN (".$iSeller_id.") "
            . "AND osl.id_order_state = 5;"; /* Query to get Sold Products */
    
    $fetch_data  = mysqli_query($con,$query);
    
    $result['sales'] = 0;
    while ($aData = $fetch_data->fetch_assoc()) 
    {
        setlocale(LC_MONETARY, 'en_IN');
        $result['sales'] = money_format('%!i', $aData['total']);
    }
    if($result['sales'] == NULL)
        $result['sales'] = 0;
  
    echo json_encode($result);
    exit;
}
if ($_POST['request']=='getOrderStatus') 
{
    $iSeller_id   = $_POST['iSeller_id'];
    $query        = "SELECT osl.name,count(o.id_order) AS count FROM js_orders AS o   "
                  . "LEFT JOIN js_order_detail AS od ON o.id_order = od.id_order  "
                  . "LEFT JOIN js_order_state_lang AS osl ON o.current_state = osl.id_order_state  "
                  . "WHERE od.iSeller_id IN (".$iSeller_id.") GROUP BY osl.name";

    $fetch_data = mysqli_query($con,$query);
    $count = 0;
    echo '<table width="30%">'
        . '<thead>'
        . '<tr>'
        . '<th width="30%"><center><b>Status</b></center></th>'
        . '<th width="30%"><center><b>Orders</b></center></th>'
        . '</tr></thead><tbody>';
    
    while($aStatus = $fetch_data->fetch_row())
    {
        echo '<tr>'
            . '<td><label>'.$aStatus[0].'</label></td>'
            . '<td><center><label>'.$aStatus[1].'</label></center></td>'
            . '</tr>';
        $count++;
    }
    if($count == 0)
    {
        echo '<tr><td colspan="2"><center><b>No record found</b></center></td></tr>';
    }
    echo '</tbody></table>';   
      
}
else if($_POST['request']=='setSellerStatus')
{
    $iSeller_id = $_POST['iSeller_id'];
    $iActive    = $_POST['iActive'];
    
    $query  = "UPDATE js_seller SET iActive='$iActive',tUpdated = now() "
            . "WHERE iSeller_id = ".$iSeller_id.";";
  
    mysqli_query($con,$query);
    
    echo "updated";
}
elseif ($_POST['request']=='todaySale') 
{
    $iSeller_id   = $_POST['iSeller_id'];
    
    $query  = "SELECT od.id_order_detail,od.id_order,od.product_name,od.product_quantity,od.product_price "
            . "FROM js_order_detail AS od "
            . "LEFT JOIN js_orders AS o ON o.id_order = od.id_order "
            . "WHERE iSeller_id IN (".$iSeller_id.") AND DATE(o.date_add) = '".date('Y-m-d')."';";
    
    $fetch_data = mysqli_query($con,$query);
    $count = 0;
    echo '<table  class="table_1" width="30%" style="size:12;">'
        . '<thead>'
        . '<tr>'
        . '<th width="10%"><center><b>Order ID</b></center></th>'
        . '<th width="10%"><center><b>Order Detail ID</b></center></th>'
        . '<th width="50%"><center><b>Product name</b></center></th>'
        . '<th width="20%"><center><b>Price</b></center></th>'
        . '</tr></thead><tbody>';
    
    while($aData = $fetch_data->fetch_assoc())
    {
        echo '<tr>'
            . '<td><label><center>'.$aData['id_order'].'</center></label></td>'
            . '<td><label><center>'.$aData['id_order_detail'].'</center></label></td>'
            . '<td><label> '.$aData['product_name'].'</label></td>'
            . '<td><label><center>'.number_format((float)$aData['product_price'], 2, '.', '').'</center></label></td>'
            . '</tr>';
        $count++;
    }
    if($count == 0)
    {
        echo '<tr><td colspan="5"><center><b>No record found</b></center></td></tr>';
    }
    echo '</tbody></table>';  
  
    exit;
}
?>