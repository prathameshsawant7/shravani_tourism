<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * AJAX Calls for Metrics Pages
*/

include("../config/start_session.php");
include("../config/settings.php");
$est =new settings();
$con=$est->connection();

$request        = $_POST['request'];
//$iSeller_id     = $_POST['iSeller_id'];

if($_POST['iSeller_id'] != 0)
    $cSellerQuery = "od.iSeller_id IN (".$_POST['iSeller_id'].")";
else 
    $cSellerQuery = "od.iSeller_id > -1 ";

if($request == 'getSalesByMonth')
{
    
    $query = "SELECT DATE_FORMAT( o.date_add, '%b' ) AS month, SUM(o.total_products_wt) AS total "
            . "FROM js_orders AS o, js_order_detail AS od, js_order_state_lang AS osl "
            . "WHERE od.id_order = o.id_order AND ".$cSellerQuery." "
            . "AND YEAR(o.date_add) = YEAR(CURDATE()) "
            . "AND o.current_state = osl.id_order_state "
            . "AND osl.id_order_state = 5 "
            . "GROUP BY YEAR(o.date_add), MONTH(o.date_add)"; /* Query to get Sale as per months of current year */
    //echo $query;exit;
    $fetch_data  = mysqli_query($con,$query);
    
    $months['Jan'] = 0;
    $months['Feb'] = 0;  
    $months['Mar'] = 0;  
    $months['Apr'] = 0;  
    $months['May'] = 0;  
    $months['Jun'] = 0;  
    $months['Jul'] = 0;  
    $months['Aug'] = 0;  
    $months['Sep'] = 0;  
    $months['Oct'] = 0;  
    $months['Nov'] = 0;  
    $months['Dec'] = 0;

    while ($aData = $fetch_data->fetch_assoc()) 
    {
        foreach ($months as $key => $value)
        {   
            if($aData['month'] == $key)
                $months[$key] = $aData['total'];
        }
        
    }
   echo json_encode($months);
}
if($request == 'getTotalSalesTrack')
{
    
    $query = "SELECT SUM(o.total_products_wt) AS total "
            . "FROM js_orders AS o "
            . "LEFT JOIN js_order_detail AS od ON o.id_order = od.id_order "
            . "LEFT JOIN js_order_state_lang AS osl ON o.current_state = osl.id_order_state "
            . "WHERE ".$cSellerQuery." "
            . "AND osl.id_order_state = 5;"; /* Query to get Sold Products */
    
    $fetch_data  = mysqli_query($con,$query);
    
    while ($aData = $fetch_data->fetch_assoc()) 
    {
        $cSoldProducts = $aData['total'];
    }
    
    $query = "SELECT SUM(o.total_products_wt) AS total "
            . "FROM js_orders AS o "
            . "LEFT JOIN js_order_detail AS od ON o.id_order = od.id_order "
            . "LEFT JOIN js_order_state_lang AS osl ON o.current_state = osl.id_order_state "
            . "WHERE ".$cSellerQuery." "
            . "AND osl.id_order_state IN (25,32,63);"; /* Query to get Returned Products */
    
    $fetch_data  = mysqli_query($con,$query);
    
    while ($aData = $fetch_data->fetch_assoc()) 
    {
        $cReturnedProducts = $aData['total'];
    }
   
    $query = "SELECT DISTINCT o.id_order, SUM(o.total_products_wt) AS total "
            . "FROM js_orders AS o "
            . "LEFT JOIN js_order_detail AS od ON o.id_order = od.id_order "
            . "LEFT JOIN js_order_state_lang AS osl ON o.current_state = osl.id_order_state "
            . "WHERE ".$cSellerQuery." "
            . "AND osl.id_order_state = 6;"; /* Query to get Cancelled Products */
    
    $fetch_data  = mysqli_query($con,$query);
    
    while ($aData = $fetch_data->fetch_assoc()) 
    {
        $cCancelledProducts = $aData['total'];
    }
    
    echo $cSoldProducts."_".$cReturnedProducts."_".$cCancelledProducts;
    
}
if($request == 'getTop10')
{
    
    $query = "SELECT od.product_id,od.product_name, SUM(od.product_quantity) AS quantity  "
            ."FROM js_order_detail AS od  "
            ."WHERE ".$cSellerQuery." "
            ."GROUP BY od.product_id "
            ."ORDER BY SUM(od.product_quantity) DESC limit 10;  "; /* Query to get Top10 Sold Products */
    
    $fetch_data  = mysqli_query($con,$query);
    
    $content = "<table style='font-size:12px;'>"
            . "<tbody>"
            . "<tr>"
            . "<td><center><b>Product ID</b></center></td>"
            . "<td><center><b>Product Name</b></center></td>"
            . "<td><center><b>Total Sold</b></center></td>"
            . "<tr>";
    $data = '';
    while ($aData = $fetch_data->fetch_assoc()) 
    {
        $data   .= "<tr>"
                . "<td><center>".$aData['product_id']."</center></td>"
                . "<td><center>".$aData['product_name']."</center></td>"
                . "<td><center>".$aData['quantity']."</center></td>"
                . "</tr>";
        
    }
    
    if($data == '')
        $data = "<tr><td colspan='3'><center>No product sold yet.</center></td></tr>";
    
    $content .= $data."</tbody></table>";
    echo $content;
    
}

if($request == 'getTop3')
{
    
    $query = "SELECT od.product_id, od.product_name, SUM(od.product_quantity) AS quantity  "
            . "FROM js_order_detail AS od , js_orders AS o  "
            . "WHERE ".$cSellerQuery." "
            . "AND o.id_order = od.id_order AND YEAR(o.date_add) =  YEAR(CURDATE())  "
            . "GROUP BY od.product_id "
            . "ORDER BY SUM(od.product_quantity) DESC limit 3;  "; /* Query to get Top3 Sold Products */
    
    $fetch_data  = mysqli_query($con,$query);
    $i=0;
    while ($aData = $fetch_data->fetch_assoc()) 
    {
        $aResult[$i] = $aData;
        $i++;
    }
    $count = $i;
    
    $content = "<table style='font-size:12px;'>"
            . "<tbody>"
            . "<tr>"
            . "<td><center><b>Product ID</b></center></td>"
            . "<td><center><b>Product Name</b></center></td>"
            . "<td><center><b>Total Sold</b></center></td>"
            . "<tr>";
    $data = '';
    
    for($i=0;$i < $count;$i++) 
    {
        $data   .= "<tr>"
                . "<td><center>".$aResult[$i]['product_id']."</center></td>"
                . "<td><center>".$aResult[$i]['product_name']."</center></td>"
                . "<td><center>".$aResult[$i]['quantity']."</center></td>"
                . "</tr>";
        
        
        $querySales = "SELECT DATE_FORMAT( o.date_add, '%b' ) AS month, "
                . "SUM(od.product_quantity) AS total    "
                . "FROM js_orders AS o, js_order_detail AS od  "
                . "WHERE od.id_order = o.id_order   AND YEAR(o.date_add) = YEAR(CURDATE())  "
                . "AND od.product_id = ".$aResult[$i]['product_id']."  "
                . "GROUP BY YEAR(o.date_add), MONTH(o.date_add);";
       // echo $querySales;exit;
        $fetch_monthly_data  = mysqli_query($con,$querySales);
    
        $months['Jan'] = 0;
        $months['Feb'] = 0;  
        $months['Mar'] = 0;  
        $months['Apr'] = 0;  
        $months['May'] = 0;  
        $months['Jun'] = 0;  
        $months['Jul'] = 0;  
        $months['Aug'] = 0;  
        $months['Sep'] = 0;  
        $months['Oct'] = 0;  
        $months['Nov'] = 0;  
        $months['Dec'] = 0;

        while ($aDataMonthly = $fetch_monthly_data->fetch_assoc()) 
        {
            foreach ($months as $key => $value)
            {   
                if($aDataMonthly['month'] == $key)
                    $months[$key] = $aDataMonthly['total'];
            }

        }
        $return['productData'][$i] = $aResult[$i]['product_id'];
        $return['graphData'][$i] = $months;
        
    }
    
    if($count == 0)
    {
        $data = "<tr><td colspan='3'><center>No product sold yet.</center></td></tr>";
    }
    
    $content .= $data."</tbody></table>";
    
    $return['countData'] = $count;
    $return['tableData'] = $content;
    
    //echo "<pre>";print_r($return);exit;
    echo json_encode($return);
    
}






?>