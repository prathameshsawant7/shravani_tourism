<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Order Export CVS
*/ 
include("../config/start_session.php");
include("../config/settings.php");

$est =new settings();
$con=$est->connection();
$request='';
if(isset($_POST['request']))
{
    $request = $_POST['request'];
    
    if($_GET['iSeller_id'] != 0)
    {
        $iSeller_id   = $_GET['iSeller_id'];
        $cFilterQuery = "od.iSeller_id IN (".$_GET['iSeller_id'].") ";
    }
    else 
    {    
        $iSeller_id   = "all";
        $cFilterQuery = "od.iSeller_id > -1 ";
    }

    $exportStatus   = $_GET['exportStatus'];
    $exportFeatures = $_GET['exportFeatures'];
    $cFromDate      = $_GET['cFromDate'];
    $cToDate        = $_GET['cToDate'];
    $cFeatureFilter = '';

    $cFilterQuery  .= 'AND DATE(o.date_add) >= "'.$cFromDate.'" AND DATE(o.date_add) <= "'.$cToDate.'" ';

    if($exportStatus != '')
        $cFilterQuery .= 'AND o.current_state IN ('.$exportStatus.') ';
    
    if($exportFeatures != '')
        $cFeatureFilter = 'WHERE id_feature IN ('.$exportFeatures.') ';
    else
        $cFeatureFilter = 'WHERE id_feature IN (-1) ';
}

if($request == 'getCount')
{
    $_SESSION['cOrderCSVdata'] = '';
    $query = "SELECT od.id_order_detail "
            . "FROM js_order_detail as od  "
	    . "LEFT JOIN js_orders o ON o.id_order=od.id_order "
	    . "LEFT JOIN js_order_state_lang osl ON osl.id_order_state=o.current_state "
	    . "LEFT JOIN js_order_product_info copi ON copi.id_product=od.product_id  "
	    . "WHERE $cFilterQuery "
	    . "GROUP BY od.id_order_detail "
	    . "ORDER BY od.id_order; ";
    //echo $query;
    $total = 0;
    $comma = '';
    $id_order_details = 0;
    $fetch_data = mysqli_query($con,$query);
    while($row = $fetch_data->fetch_assoc()) 
    {
        if($total != 0)
            $comma = ",";
        
        $id_order_details.= $comma.$row['id_order_detail'];
        $total++;
    }
    if($total > 0)
    {
        $featureArray = getFeatureProduct($con,$id_order_details);

	$uniquArraykey = array();
        foreach ($featureArray as $key => $value) {

            foreach ($value as $Fkey => $Fvalue) {

                if (isset($value[$Fkey]) && !empty($value[$Fkey])) {

                    if (isset($uniquArraykey[$Fkey]) && $uniquArraykey[$Fkey] == $Fkey) {
                        $uniquArraykey[$Fkey] = $Fkey;
                    } 
                    else {
                       $uniquArraykey[$Fkey] = $Fkey;
                    }
                }
            }
        }

        $uniqueval = array();
        foreach ($featureArray as $key33 => $value33) {

      //      echo "<PRE>";print_r($featureArray);
            foreach ($uniquArraykey as $key44 => $val44) {
                            if(isset($value33[$key44]))
                                $uniqueval[$value33['id_order_detail']][$key44] = $value33[$key44];
                            $titleArray = $key44;
            }
        }
    
        $_SESSION['uniquArraykey'] = $uniquArraykey;
        $_SESSION['uniqueval'] = $uniqueval;
    }
    echo $total;exit;
    
}

if($request == 'getRecords')
{
    $start = $_GET['start'];
    
    $featureNameArray = array('id_product' => '');
    $query = "SELECT DISTINCT `name` FROM `js_feature_lang` ".$cFeatureFilter;
    $fetch_data  = mysqli_query($con,$query);
    while($row = $fetch_data->fetch_assoc()) 
    {
        $featureNameArray[$row['name']] = "";
    }

    $query = "SELECT od.id_order,od.id_order_detail,o.reference,DATE(o.date_add) AS date_add,o.orderNumber, "
	    . "o.current_state,o.id_customer, o.payment,od.id_shop,od.status as sub_order_status,"
	    . "copi.reference as style_no, copi.idcombination,copi.referencecombination AS combination_style,od.id_category_default,"
	    . "copi.id_sub_cat,od.product_quantity as quantity,copi.wholesale_price AS mrp, od.unit_price_tax_incl, "
	    . "copi.price AS selling_price,copi.additional_shipping_cost AS shipping_cost,od.total_price_tax_incl,od.total_price_tax_excl,"
	    . "o.total_shipping,o.total_discounts,o.total_paid,id_address_delivery,id_address_invoice,"
	    . "o.invoice_number,od.invoice_number AS sub_invoice_number ,od.carrierid,od.trackingNumber AS shipping_number,o.gift,o.gift_message,copi.productfeature,"
	    . "copi.id_manufacturer,od.product_id,od.prod_barcode,o.shipping_number,od.product_name,"
	    . "o.order_message,o.delivered,total_wrapping,total_paid_tax_excl,valid,od.iSeller_id "
	    . "FROM js_order_detail as od  "
	    . "LEFT JOIN js_orders o ON o.id_order=od.id_order "
	    . "LEFT JOIN js_order_product_info copi ON copi.id_product=od.product_id  "
	    . "WHERE $cFilterQuery "
	    . "GROUP BY od.id_order_detail "
	    . "ORDER BY od.id_order LIMIT ".$start.",100;";

    $fetch_data = mysqli_query($con,$query);
//echo $query;exit;

    $featureArray = array();
    $titleArray = array();

    $comma          = "";
    $id_products    = "";
    $id_orders      = "";
    $id_order_details = "";
    $id_customers   = "";
    $references     = "";
    $current_states = "";
    $id_shops       = "";
    $id_carriers    = "";
    $id_address_delivery = "";
    $id_address_invoice = "";
    $id_address = "";
    
    $i = 0;
    while($row = $fetch_data->fetch_assoc()) 
    {
        if($i != 0)
            $comma = ",";
        
        $array_id_order_details[$i] = $row['id_order_detail'];
	if($row['id_order_detail'] != '')
        	$id_order_details       .= $comma.$row['id_order_detail'];
	if($row['id_order'] != '')
        	$id_orders              .= $comma.$row['id_order'];
	if($row['product_id'] != '')        
		$id_products            .= $comma.$row['product_id'];
        if($row['reference'] != '')
		$references             .= $comma."'".$row['reference']."'";
	if($row['id_customer'] != '')        
		$id_customers           .= $comma.$row['id_customer'];
        if($row['current_state'] != '')
        	$current_states         .= $comma.$row['current_state'];
        if($row['sub_order_status'] != '')
		$current_states         .= $comma.$row['sub_order_status'];
	if($row['id_shop'] != '')
        	$id_shops               .= $comma.$row['id_shop'];
    	if($row['carrierid'] != '')
    		$id_carriers            .= $comma.$row['carrierid'];
	if($row['id_address_delivery'] != '')
		$id_address 		.= $comma.$row['id_address_delivery'];
	if($row['id_address_invoice'] != '')
		$id_address 		.= $comma.$row['id_address_invoice'];
        
        $i++;
    }

    $CategoryNames      = getCategoryNames($con,$id_products);
    $TransactionID      = getTransactionID($con,$references);
    $Addresses          = getAddresses($con,$id_orders);
    $BrandNames         = getBrandNames($con,$id_products);
    $Customers          = getCustomers($con,$id_customers);
    $Shops              = getShops($con,$id_shops);
    $Carriers           = getCarriers($con,$id_carriers);
    $Current_states     = getCurrentStates($con,$current_states);
    $CustomerRecords    = getCustomerRecords($con,$id_address);
    $ShippingDates      = getShippingDates($con,$id_orders);
    $DeliveryDates      = getDeliveryDates($con,$id_orders);
    
    
    $aHeader = array('Order ID','Sub order id','Order Reference','Order Date','Partner Order Number','Partner Order Date','B2B/B2C','Order State','Sub Order State','Customer Name','Email','Mobile No','Pincode','Delivery City','Payment Mode','Transaction ID','Brand Name','Style No','Combination ID','Combination Style','Category','Sub Category','Quantity','Unit MRP','Unit SP','Unit Shipping Cost','Total MRP','Total SP','Total Shipping Cost','Sub Total','Total Discount','Total Paid','Delivery Name','Delivery Address','Invoice Name','Invoice Address','Order Invoice No','Sub Order Invoice No','Carrier Name','Shipping Number','Gift','Gift Message','Shop Name','Product Barcode','Product Name','Order Message','Seller ID','Shipping Date','Delivery Date');
    $i = count($aHeader);
    foreach ($_SESSION['uniquArraykey'] as $key => $value) 
    {  
        $aHeader[$i] = $_SESSION['uniquArraykey'][$key];
        $i++;
    }

    $cOutput = "";
    if($start == '0')
    {
        for($i=0;$i<count($aHeader);$i++)
        {
                if($i != 0)
                   $cOutput .= "*";
                $cOutput .= $aHeader[$i];
        }

        $cOutput .= "\n";
    }

    
    mysqli_data_seek($fetch_data,0);
    while($row = $fetch_data->fetch_assoc()) 
    {
        $BrandName = '';
        $cat = '';
        $subcat = '';
        $TransactionID = '';
        $delivery_address = '';
        $invoice_address = '';
        $CustomerName = '';
        $CustomerEmail = '';
        $CustomerMobile = '';
        $CustomerBusiness = '';
        $CustomerPincode = '';
        $CustomerCity = '';
        $Shop = '';
        $Carrier = '';
        $CurrentState = '';
        $SubOrderState='';
	$ShippingDate = '';
	$DeliveryDate = '';
        
        $subtotal = ($row['quantity']*$row['unit_price_tax_incl'])+($row['quantity']*$row['shipping_cost']);

        if(isset($BrandNames[$row['product_id']]) && $row['product_id'] != '')
            $BrandName = $BrandNames[$row['product_id']];

        if(isset($CategoryNames[$row['product_id']]['cat']) && $row['product_id'] != '')
            $cat = $CategoryNames[$row['product_id']]['cat'];

        if(isset($CategoryNames[$row['product_id']]['subcat']) && $row['product_id'] != '')
            $subcat = $CategoryNames[$row['product_id']]['subcat'];

        if(isset($TransactionID[$row['reference']]) && $row['reference'] != '')
            $TransactionID = $TransactionID[$row['reference']];

        if(isset($Addresses[$row['id_order']]['delivery_address'])  && $row['id_order'] != '')
            $delivery_address = $Addresses[$row['id_order']]['delivery_address'];

        if(isset($Addresses[$row['id_order']]['invoice_address'])  && $row['id_order'] != '')
            $invoice_address = $Addresses[$row['id_order']]['invoice_address'];
             
        if(isset($Customers[$row['id_customer']]['name']) && $row['id_customer'] != '')
           $CustomerName = $Customers[$row['id_customer']]['name'];

	if(isset($Addresses[$row['id_order']]['delivery_name']) && $row['id_order'] != '')
           $Deliveryname = $Addresses[$row['id_order']]['delivery_name'];

	if(isset($Addresses[$row['id_order']]['delivery_name'])  && $row['id_order'] != '')
           $Invoicename = $Addresses[$row['id_order']]['delivery_name'];

        if(isset($Customers[$row['id_customer']]['email']) && $row['id_customer'] != '')
           $CustomerEmail = $Customers[$row['id_customer']]['email'];

        if(isset($CustomerRecords[$row['id_address_delivery']]['mobile']) && $row['id_address_delivery'] != '')
           $CustomerMobile = $CustomerRecords[$row['id_address_delivery']]['mobile'];

        if(isset($Customers[$row['id_customer']]['business_type']) && $row['id_customer'] != '')
           $CustomerBusiness = $Customers[$row['id_customer']]['business_type'];

        if(isset($CustomerRecords[$row['id_address_delivery']]['postcode'])  && $row['id_address_delivery'] != '')
           $CustomerPincode = $CustomerRecords[$row['id_address_delivery']]['postcode'];

        if(isset($CustomerRecords[$row['id_address_delivery']]['city'])  && $row['id_address_delivery'] != '')
           $CustomerCity = $CustomerRecords[$row['id_address_delivery']]['city'];
        
        if(isset($Shops[$row['id_shop']]) && $row['id_shop'] != '')
           $Shop = $Shops[$row['id_shop']];
        
        if(isset($Carriers[$row['carrierid']])  && $row['carrierid'] != '')
           $Carrier = $Carriers[$row['carrierid']];
        
        if(isset($Current_states[$row['current_state']]) && $row['current_state'] != '')
           $CurrentState = $Current_states[$row['current_state']];
        
	if(isset($Current_states[$row['sub_order_status']]) && !empty($row['sub_order_status']))
           $SubOrderState = $Current_states[$row['sub_order_status']];

	if(isset($ShippingDates[$row['id_order']]) && !empty($row['id_order']))
           $ShippingDate = $ShippingDates[$row['id_order']];
       	
	if(isset($DeliveryDates[$row['id_order']]) && !empty($row['id_order']))
           $DeliveryDate = $DeliveryDates[$row['id_order']];

    $cOutput .=  $row['id_order']."* "
             . "".handleString($row['id_order_detail'])."* "
             . "".handleString($row['reference'])."* "
             . "".handleString($row['date_add'])."* "
             . "".handleString($row['orderNumber'])."* "
             . "".handleString($row['date_add'])."* "
             . "".handleString($CustomerBusiness)."* "
             . "".handleString($CurrentState)."* "
	     . "".handleString($SubOrderState)."* "
             . "".handleString($CustomerName)."* "
             . "".handleString($CustomerEmail)."* "
             . "".$CustomerMobile."* "
             . "".$CustomerPincode."* "
             . "".handleString($CustomerCity)."* "
             . "".handleString($row['payment'])."* "
             . "".handleString($TransactionID)."* "
             . "".handleString($BrandName)."* "
             . "".handleString($row['style_no'])."* "
             . "".$row['idcombination']."* "
             . "".handleString($row['combination_style'])."* "
             . "".handleString($cat)."* "
             . "".handleString($subcat)."* "
             . "".$row['quantity']."* "
             . "".$row['mrp'] ."* "
//		 . "".$row['selling_price'] ."* "
             . "".$row['unit_price_tax_incl'] ."* "
             . "".$row['shipping_cost'] ."* "
             . "".$row['quantity']*$row['mrp'] ."* "
             . "".$row['quantity']*$row['unit_price_tax_incl'] ."* "
             . "".$row['quantity']*$row['shipping_cost'] ."* "
             . "".$subtotal."* "
             . "".$row['total_discounts']."* "
             . "".$row['total_paid']."* "
             . "".handleString($Deliveryname)."* "
             . "".handleString($delivery_address)."* "
             . "".handleString($Invoicename)."* "
             . "".handleString($invoice_address)."* "
             . "".$row['invoice_number']."* "
	     . "".$row['sub_invoice_number']."* "
             . "".handleString($Carrier)."* "
             . "".$row['shipping_number']."* "
             . "".handleString($row['gift'])."* "
             . "".handleString($row['gift_message'])."* "
             . "".handleString($Shop)."* "
    /*	 . "".$row['product_id']."* " */
             . "".handleString($row['prod_barcode'])."* "
             . "".handleString($row['product_name'])."* "
             . "".handleString($row['order_message'])."* "
    /*	 . "".$row['delivered']."* "
             . "".handleString($row['total_wrapping'])."* "
             . "".$row['total_paid_tax_excl']."* "
             . "".$row['valid']."* " */
             . "".$row['iSeller_id']."* "
	     . "".handleString($ShippingDate)."* "
	     . "".handleString($DeliveryDate);

     for($i=49;$i<count($aHeader);$i++)
        {
            if(isset($_SESSION['uniqueval'][$row['id_order_detail']][$aHeader[$i]]))
                $cOutput .= "*".$_SESSION['uniqueval'][$row['id_order_detail']][$aHeader[$i]];
            else
                $cOutput .= "*-";
        }
        $cOutput .= "\n";
    }
       
     if(trim($_SESSION['cOrderCSVdata']) != '')
        $_SESSION['cOrderCSVdata'] .= "\n".trim($cOutput);
    else
        $_SESSION['cOrderCSVdata'] = trim($cOutput);
    
   // echo trim($cOutput);
    exit;
}


$filename = 'order_export.csv';
header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename='.$filename);
echo "\xEF\xBB\xBF"; // UTF-8 BOM
// clean the output buffer
ob_clean();
echo trim($_SESSION['cOrderCSVdata']);
$_SESSION['cOrderCSVdata'] = '';
exit;


function getFeatureProduct($con,$id)
{
    if($id != '')
    {
        $query =  "SELECT id_product,id_order_detail,productfeature "
                . "FROM js_order_product_info "
                . "WHERE id_order_detail IN (".$id.");";

        $data   = mysqli_query($con,$query);
        
        while($aData = $data->fetch_assoc())
        {
	    $lastChar = substr(trim($aData['productfeature']), -1);
	     if($lastChar == '}')
		$feature = $aData['productfeature'];
	     else
		$feature = getFeatureFromProductJSON($con,$aData['id_product']);

            $aReturn[$aData['id_order_detail']] = json_decode($feature,true);
            $aReturn[$aData['id_order_detail']]['id_order_detail']=$aData['id_order_detail'];
            
        }
        return $aReturn;
    }
    else
        return '';
}

function getFeatureFromProductJSON($con,$id)
{
    if($id != '')
    {
        $query =  "SELECT feature_json_name "
                . "FROM js_feature_json "
                . "WHERE id_product = ".$id.";";

        $data   = mysqli_query($con,$query);
        $cReturn = '';
        while($aData = $data->fetch_assoc())
        {
	    $cReturn = $aData['feature_json_name'];
        }
        return $cReturn;
    }
    else
        return '';
}

function getShippingDates($con,$id)
{
    if($id != '')
    {
        $query = "SELECT id_order,DATE(date_add) AS shipping_date "
                . "FROM js_order_history "
                . "WHERE id_order IN (".$id.") AND id_order_state = 4;";
        $fetch_data  = mysqli_query($con,$query);
        $name = '';    
        while($aData = $fetch_data->fetch_assoc())
            $aResult[$aData['id_order']] = $aData['shipping_date'];

        return $aResult;
    }
    else
        return '';
}

function getDeliveryDates($con,$id)
{
    if($id != '')
    {
        $query = "SELECT id_order,DATE(date_add) AS delivery_date "
                . "FROM js_order_history "
                . "WHERE id_order IN (".$id.") AND id_order_state = 5;";
        $fetch_data  = mysqli_query($con,$query);
        $name = '';    
        while($aData = $fetch_data->fetch_assoc())
            $aResult[$aData['id_order']] = $aData['delivery_date'];

        return $aResult;
    }
    else
        return '';
}


function getAddresses($con,$id)
{
    if($id != '')
    {
        
        $query =  "SELECT o.id_order,ad.firstname AS del_firstname,ad.lastname AS del_lastname, CONCAT(ad.address1,' ',ad.address2,' ',ad.city,' ',ad.postcode) as delivery_address ,"
                . "(SELECT CONCAT(ai.address1,' ',ai.address2,' ',ai.city,' ',ai.postcode) FROM js_address AS ai "
                . "WHERE ai.id_address=o.id_address_delivery LIMIT 1) as invoice_address "
                . "FROM js_orders o LEFT JOIN js_address AS ad "
                . "ON (ad.id_address=o.id_address_invoice) "
                . "WHERE  o.id_order IN ($id);";

         $data   = mysqli_query($con,$query);
        while($aData = $data->fetch_assoc())
        {
	    $aReturn[$aData['id_order']]['delivery_name']    	= $aData['del_firstname']." ".$aData['del_lastname'];
            $aReturn[$aData['id_order']]['delivery_address']    = $aData['delivery_address'];
            $aReturn[$aData['id_order']]['invoice_address']     = $aData['invoice_address'];
        }
        return $aReturn;
    }
    else
        return '';
}



function getCustomers($con,$id)
{
    if($id != '')
    {
        $query =  "SELECT id_customer,CONCAT(firstname,' ', lastname) as name,email,mobile,b2b_status "
                . "FROM js_customer "
                . "WHERE id_customer IN (".$id.");";

        $data   = mysqli_query($con,$query);
        while($aData = $data->fetch_assoc())
            {
                    $return[$aData['id_customer']]['name'] = $aData['name'];
                    $return[$aData['id_customer']]['email'] = $aData['email'];
                    $return[$aData['id_customer']]['mobile'] = $aData['mobile'];
                    if($aData['b2b_status'] == 1)
                            $return[$aData['id_customer']]['business_type'] = "B2B";
                    else
                            $return[$aData['id_customer']]['business_type'] = "B2C";
            }

        
        return $return;
    }
    else
        return '';
}

function getCustomerRecords($con,$id)
{
	$return = array();
	if($id != '')
    	{
		$query =  "SELECT id_address,firstname,lastname,postcode, city, phone, phone_mobile "
		        . "FROM js_address "
		        . "WHERE id_address IN (".$id.") ;";

		$data   = mysqli_query($con,$query);
		while($aData = $data->fetch_assoc())
		    {
                        $return[$aData['id_address']]['Deliveryname'] = $aData['firstname']." ".$aData['lastname'];


                        $return[$aData['id_address']]['postcode'] = $aData['postcode'];
                        $return[$aData['id_address']]['city'] = $aData['city'];
                        if($aData['phone'] != '')
                                $return[$aData['id_address']]['mobile'] = $aData['phone'];
                        if($aData['phone_mobile'] != '')
                                $return[$aData['id_address']]['mobile'] = $aData['phone_mobile'];
		    }
		
	}

	return $return;
}


function getCategoryNames($con,$id)
{
    if($id != '')
    {
        $query =  "SELECT DISTINCT p.id_product, c.link_rewrite AS cat,"
                . "(SELECT name FROM js_category_lang AS cl "
                . "WHERE cl.id_category=p.id_sub_cat LIMIT 1) AS subcat "
                . "FROM js_hybrid_product p LEFT JOIN js_category_lang c "
                . "ON (p.id_category_default=c.id_category) "
                . "WHERE  p.id_product IN ($id);";
//echo $query;exit;
        $data   = mysqli_query($con,$query);
        while($aData = $data->fetch_assoc())
        {
            $aReturn[$aData['id_product']]['cat']       = (!empty($aData['cat'])?$aData['cat']:'');
            $aReturn[$aData['id_product']]['subcat']    = (!empty($aData['subcat'])?$aData['subcat']:'');
        }
        return $aReturn;
    }
    else
        return '';
}


function getBrandNames($con,$id)
{
    if($id != '')
    {
        $query = "SELECT p.id_product,m.name "
                . "FROM js_manufacturer AS m, js_hybrid_product AS p "
                . "WHERE p.id_manufacturer = m.id_manufacturer AND p.id_product IN (".$id.")";
        $fetch_data  = mysqli_query($con,$query);
        $name = '';    
        while($aData = $fetch_data->fetch_assoc())
            $aResult[$aData['id_product']] = $aData['name'];

        return $aResult;
    }
    else
        return '';
}

function getShops($con,$id)
{
    if($id != '')
    {
        $query = "SELECT id_shop,name "
                . "FROM js_shop "
                . "WHERE id_shop IN (".$id.")";
        $fetch_data  = mysqli_query($con,$query);
        $name = '';    
        while($aData = $fetch_data->fetch_assoc())
            $aResult[$aData['id_shop']] = $aData['name'];

        return $aResult;
    }
    else
        return '';
}

function getCarriers($con,$id)
{
    if($id != '')
    {
        $query = "SELECT id_carrier,name "
                . "FROM js_carrier "
                . "WHERE id_carrier IN (".$id.")";
        $fetch_data  = mysqli_query($con,$query);
        $name = '';    
        while($aData = $fetch_data->fetch_assoc())
            $aResult[$aData['id_carrier']] = $aData['name'];

        return $aResult;
    }
    else
        return '';
}

function getCurrentStates($con,$id)
{
    if($id != '')
    {
        $query = "SELECT id_order_state,name "
                . "FROM js_order_state_lang "
                . "WHERE id_order_state IN (".$id.")";
        $fetch_data  = mysqli_query($con,$query);
        $name = '';    
        while($aData = $fetch_data->fetch_assoc())
            $aResult[$aData['id_order_state']] = $aData['name'];

        return $aResult;
    }
    else
        return '';
}

function getTransactionID($con,$references)
{
    if($references != '')
    {
        $query =  "SELECT order_reference,transaction_id "
                . "FROM js_order_payment "
                . "WHERE order_reference IN (".$references.");";

        $fetch_data = mysqli_query($con,$query);
        while($aData = $fetch_data->fetch_assoc())
        $aResult[$aData['order_reference']] = $aData['transaction_id'];
    
        return $aResult;
    }
    else
        return '';
}


function imagePath($con,$product_id)
{
    if($product_id != '')
    {
        $query =  "SELECT i.id_image,i.position,i.cover,il.legend "
                . "FROM js_image AS i,js_image_lang AS il "
                . "WHERE i.id_image = il.id_image AND i.id_product = ".$product_id.";";

        $image_data   = mysqli_query($con,$query);
        $path = '';
         while ($aData = $image_data->fetch_assoc())
        {
            $path    = "http://d3w0fztyp9j74f.cloudfront.net/img/p";
            $idArray = str_split($aData['id_image']);
            for($i=0;$i<count($idArray);$i++)
                $path = $path."/".$idArray[$i];
            $path    .= "/".$aData['id_image']."-home_default.jpg";
        }
        return $path;
    }
    else
        return '';
}

function handleString($str)
{
    $str = str_replace(',', ' ', $str);
    $str = str_replace('\n', ' ', $str);
    $str = '"' . str_replace('"', '""', $str) . '"';
    return $str;
}

exit;
/*
s.name as shop_name  
LEFT JOIN js_shop s ON s.id_shop=od.id_shop


osl.name
LEFT JOIN js_order_state_lang osl ON osl.id_order_state=o.current_state

jac.name as carrier
LEFT JOIN js_carrier jac ON jac.id_carrier=o.id_carrier 

*/
?>
