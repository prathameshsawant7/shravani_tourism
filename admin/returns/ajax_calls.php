<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Ajax calls of Returns pages
*/
include("../config/start_session.php");
include("../config/settings.php");
$est =new settings();
$con=$est->connection();

$request = $_POST['request'];

if($request == 'updateStatus')
{
    $id_order           = $_POST['id_order'];
    $current_state      = $_POST['current_state'];
    
    $query =  "UPDATE js_orders "
            . "SET current_state = ".$current_state.","
            . "date_upd=now() "
            . "WHERE id_order = ".$id_order;
    
    mysqli_query($con,$query);
    
    $query =  "INSERT INTO js_order_history(id_order,id_order_state,date_add) "
            . "VALUES (".$id_order.",".$current_state.",now())";
    
    mysqli_query($con,$query);
    echo "Updated";
}
if($request == 'updateShipping')
{
    $id_order           = $_POST['id_order'];
    $id_carrier         = $_POST['id_carrier'];
    $tracking_number    = $_POST['tracking_number'];
    
    $query = "SELECT id_order_state FROM js_order_state_lang WHERE name = 'Shipped'";
    $fetch_data  = mysqli_query($con,$query);
    while($aData = $fetch_data->fetch_assoc())
    {
        $id_shipped = $aData['id_order_state'];
    }
    
    $query =  "INSERT INTO js_order_carrier(id_order,id_carrier,tracking_number,date_add) "
            . "VALUES (".$id_order.",".$id_carrier.",".$tracking_number.",now())";
    
    mysqli_query($con,$query);
    
    $query =  "UPDATE js_orders "
            . "SET current_state = ".$id_shipped.","
            . "id_carrier = ".$id_carrier.","
            . "shipping_number = ".$tracking_number.","
            . "date_upd=now() "
            . "WHERE id_order = ".$id_order;
    
    mysqli_query($con,$query);
    
    $query =  "INSERT INTO js_order_history(id_order,id_order_state,date_add) "
            . "VALUES (".$id_order.",".$id_shipped.",now())";
    
    mysqli_query($con,$query);
    
    echo "Updated";
}
if($request == 'getStatus')
{
    $query = "SELECT id_order_state,name FROM js_order_state_lang ORDER BY name";
    $fetch_data  = mysqli_query($con,$query);
    
    $cStatusOptions = '<option value="">Please Select</option>';
    while($aData = $fetch_data->fetch_assoc())
    {
        $cStatusOptions .= '<option value="'.$aData['id_order_state'].'">'.$aData['name'].'</option>';
    }
    //echo "<select id='exportStatus'>".$cStatusOptions."</select>";
    echo $cStatusOptions;
}
if($request == 'getCarriers')
{
    $query = "SELECT name, id_carrier "
            . "FROM js_carrier "
            . "WHERE active =1 AND deleted !=1 "
            . "GROUP BY id_carrier "
            . "ORDER BY `js_carrier`.`name` ASC; ";
    $fetch_data  = mysqli_query($con,$query);
    
    $cStatusOptions = '<option value="">Please Select</option>';
    while($aData = $fetch_data->fetch_assoc())
    {
        $cStatusOptions .= '<option value="'.$aData['id_carrier'].'">'.$aData['name'].'</option>';
    }
    echo $cStatusOptions;
}
?>