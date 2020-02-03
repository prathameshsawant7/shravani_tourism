<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Order Export CVS
*/ 
//include("../config/start_session.php");
include("../config/settings.php");

$est =new settings();
$con=$est->connection();

if(!isset($GET['request']))
{
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

    $filename = 'order_export.csv';

    header('Content-Encoding: UTF-8');
    header('Content-type: text/csv; charset=UTF-8');
    header('Content-Disposition: attachment; filename='.$filename);
    echo "\xEF\xBB\xBF"; // UTF-8 BOM

    $featureNameArray = array('product_id' => '');
    $query = "SELECT DISTINCT `name` FROM `js_feature_lang` ".$cFeatureFilter;
    $fetch_data  = mysqli_query($con,$query);
    while($row = $fetch_data->fetch_assoc()) 
    {
        $featureNameArray[$row['name']] = "";
    }

    $query = "SELECT od.id_order,od.id_order_detail,o.reference,DATE(o.date_add) AS date_add,o.orderNumber, "
	    . "osl.name as orderstate,o.id_customer, o.payment,od.id_shop,s.name as shop_name,"
	    . "copi.reference as style_no, copi.idcombination,copi.referencecombination AS combination_style,od.id_category_default,"
	    . "copi.id_sub_cat,od.product_quantity as quantity,copi.wholesale_price AS mrp, od.unit_price_tax_incl, "
	    . "copi.price AS selling_price,copi.additional_shipping_cost AS shipping_cost,od.total_price_tax_incl,od.total_price_tax_excl,"
	    . "o.total_shipping,o.total_discounts,o.total_paid,id_address_delivery,id_address_invoice,"
	    . "o.invoice_number,jac.name as carrier,o.shipping_number,o.gift,o.gift_message,copi.productfeature,"
	    . "copi.id_manufacturer,od.product_id,od.prod_barcode,o.shipping_number,od.product_name,"
	    . "o.order_message,o.delivered,total_wrapping,total_paid_tax_excl,valid,od.iSeller_id "
	    . "FROM js_order_detail as od  "
	    . "LEFT JOIN js_orders o ON o.id_order=od.id_order   "
	    . "LEFT JOIN js_shop s ON s.id_shop=od.id_shop "
	    . "LEFT JOIN js_order_state_lang osl ON osl.id_order_state=o.current_state "
	    . "LEFT JOIN js_order_product_info copi ON copi.id_product=od.product_id  "
	    . "LEFT JOIN js_carrier jac ON jac.id_carrier=o.id_carrier "
	    . "WHERE $cFilterQuery "
	    . "GROUP BY od.id_order_detail "
	    . "ORDER BY od.id_order; ";
  
    //echo $query;exit;
        $fetch_data = mysqli_query($con,$query);

        $get_rows   = $fetch_data->fetch_row();

        if($get_rows == 0)
        {
         
        }

        $featureArray = array();
        $titleArray = array();

        while($row = $fetch_data->fetch_assoc()) 
        {
            //$jsonarray = json_decode(getFeatureProduct($con,$row['product_id']), true);
            $jsonarray = json_decode($row['productfeature'], true);
            $jsonarray['product_id'] = $row['product_id'];

            foreach ($featureNameArray as $key22 => $value22) 
            {
               // $featureArray[$row['product_id']][$key22] = $row[$key22];
                if(isset($jsonarray[$key22]))
                    $featureArray[$row['product_id']][$key22] = $jsonarray[$key22];
            }
        }


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

            foreach ($uniquArraykey as $key44 => $val44) {
                            if(isset($value33[$key44]))
                                $uniqueval[$value33['product_id']][$key44] = $value33[$key44];
                            $titleArray = $key44;
            }
        }



        $aHeader = array('Order ID','Sub order id','Order Reference','Order Date','Partner Order Number','Partner Order Date','B2B/B2C','Order State','Customer Name','Email','Mobile No','Pincode','Delivery City','Payment Mode','Transaction ID','Brand Name','Style No','Combination ID','Combination Style','Category','Sub Category','Quantity','Unit MRP','Unit SP','Unit Shipping Cost','Total MRP','Total SP','Total Shipping Cost','Sub Total','Total Discount','Total Paid','Delivery Name','Delivery Address','Invoice Name','Invoice Address','Invoice No','Carrier Name','Shipping Number','Gift','Gift Message','Shop Name','Product Barcode','Product Name','Order Message','Seller ID');
	$i = count($aHeader);
        foreach ($uniquArraykey as $key => $value) 
        {  
            $aHeader[$i] = $uniquArraykey[$key];
            $i++;
        }

        $cOutput = "";
        for($i=0;$i<count($aHeader);$i++)
        {
                if($i != 0)
                   $cOutput .= ",";
                $cOutput .= $aHeader[$i];
        }

        $cOutput .= "\n";

        mysqli_data_seek($fetch_data,0);
        while($row = $fetch_data->fetch_assoc()) 
        {
            $Customer = getCustomer($con,$row['id_customer'],$row['id_address_invoice']);
            $CustomerName = '';
            $CustomerEmail = '';
            $CustomerMobile = '';
            $CustomerPincode = '';
            $CustomerCity = '';
            if($Customer != '')
                {	
                    $CustomerName = $Customer['name'];
                    $CustomerEmail = $Customer['email'];
                    $CustomerMobile = $Customer['mobile'];
                    $CustomerBussiness = $Customer['bussiness_type'];
                    $CustomerPincode = $Customer['postcode'];
                    $CustomerCity = $Customer['city'];
                }

           // $cOutput .=  $row['id_order'].", ".$row['id_order_detail'].", ".$row['reference'].", ".$row['date_add'].", ".$row['orderNumber'].", ".$row['date_add'].", ".''.", ".$row['orderstate'].", ".$CustomerName.", ".handleString($CustomerEmail).", ".$CustomerMobile.", ".$CustomerPincode.", ".$CustomerCity.", ".$row['payment'].", ".'' .", ".handleString($row['brand_name']).", ".handleString($row['style_no']).", ".$row['idcombination'].", ".handleString($row['combination_style']).", ".getCategoryName($con,$row['id_category_default']).", ".getCategoryName($con,$row['id_sub_cat']).", ".$row['quantity'].", ".$row['original_product_price'] .", ".$row['product_price'] .", ".$row['product_shipping'] .", ".$row['total_price_tax_incl'] .", ".$row['total_price_tax_excl'] .", ".$row['total_shipping'] .", ".$row['quantity']*$row['product_price'] .", ".$row['total_discounts'].", ".$row['total_paid'].", ".$CustomerName.", ".handleString(getAddress($con,$row['id_address_delivery'])).", ".$CustomerName.", ".handleString(getAddress($con,$row['id_address_invoice'])).", ".$row['invoice_number'].", ".$row['carrier'].", ".$row['shipping_number'].", ".handleString($row['gift']).", ".handleString($row['gift_message']).", ".handleString($row['shop_name']).", ".$row['product_id'].", ".$row['prod_barcode'].", ".handleString($row['product_name']).", ".handleString($row['order_message']).", ".$row['delivered'].", ".$row['total_wrapping'].", ".$row['total_paid_tax_excl'].", ".$row['valid'].", ".$row['iSeller_id']; 

        $subtotal = ($row['quantity']*$row['unit_price_tax_incl'])+($row['quantity']*$row['shipping_cost']);


	$cOutput .=  $row['id_order']."* "
		 . "".handleString($row['id_order_detail'])."* "
		 . "".handleString($row['reference'])."* "
		 . "".handleString($row['date_add'])."* "
		 . "".handleString($row['orderNumber'])."* "
		 . "".handleString($row['date_add'])."* "
		 . "".handleString($CustomerBussiness)."* "
		 . "".handleString($row['orderstate'])."* "
		 . "".handleString($CustomerName)."* "
		 . "".handleString($CustomerEmail)."* "
		 . "".$CustomerMobile."* "
		 . "".$CustomerPincode."* "
		 . "".handleString($CustomerCity)."* "
		 . "".handleString($row['payment'])."* "
		 . "".handleString(getTransactionID($con,$row['reference']))."* "
		 . "".handleString(getBrandName($con,$row['id_manufacturer']))."* "
		 . "".handleString($row['style_no'])."* "
		 . "".$row['idcombination']."* "
		 . "".handleString($row['combination_style'])."* "
		 . "".getCategoryName($con,$row['id_category_default'],$row['id_shop'])."* "
		 . "".getCategoryName($con,$row['id_sub_cat'],$row['id_shop'])."* "
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
		 . "".handleString($CustomerName)."* "
		 . "".handleString(getAddress($con,$row['id_address_delivery']))."* "
		 . "".handleString($CustomerName)."* "
		 . "".handleString(getAddress($con,$row['id_address_invoice']))."* "
		 . "".$row['invoice_number']."* "
		 . "".handleString($row['carrier'])."* "
		 . "".$row['shipping_number']."* "
		 . "".handleString($row['gift'])."* "
		 . "".handleString($row['gift_message'])."* "
		 . "".handleString($row['shop_name'])."* "
	/*	 . "".$row['product_id']."* " */
		 . "".handleString($row['prod_barcode'])."* "
		 . "".handleString($row['product_name'])."* "
		 . "".handleString($row['order_message'])."* "
	/*	 . "".$row['delivered']."* "
		 . "".handleString($row['total_wrapping'])."* "
		 . "".$row['total_paid_tax_excl']."* "
		 . "".$row['valid']."* " */
		 . "".$row['iSeller_id'];

	 for($i=45;$i<count($aHeader);$i++)
		{
			if(isset($uniqueval[$row['product_id']][$aHeader[$i]]))
				$cOutput .= "*".$uniqueval[$row['product_id']][$aHeader[$i]];
			else
				$cOutput .= "*-";
		}
	    $cOutput .= "\n";
	}
        
       
        echo trim($cOutput);
        exit;
}

function getAddress($con,$id)
{
    if($id != '')
    {
        $query =  "SELECT CONCAT(address1,' ',address2,' ',city,' ',postcode) as address "
                . "FROM js_address "
                . "WHERE id_address = ".$id.";";

        $data   = mysqli_query($con,$query);
        $aData = $data->fetch_assoc();
        return $aData['address'];
    }
    else
        return '';
}

function getFeatureProduct($con,$id)
{
    if($id != '')
    {
      
        $query =  "SELECT feature_json_name AS feature_product "
                . "FROM js_feature_json "
                . "WHERE id_product = ".$id.";";
        
        
        $data   = mysqli_query($con,$query);
        $aData = $data->fetch_assoc();
        return $aData['feature_product'];
    }
    else
        return '';
}

function getCustomer($con,$id,$idAddress)
{
    if($id != '')
    {
        $query =  "SELECT CONCAT(firstname,' ', lastname) as name,email,mobile,b2b_status "
                . "FROM js_customer "
                . "WHERE id_customer = ".$id.";";

        $data   = mysqli_query($con,$query);
        while($aData = $data->fetch_assoc())
            {
                    $return['name'] = $aData['name'];
                    $return['email'] = $aData['email'];
                    $return['mobile'] = $aData['mobile'];
                    if($aData['b2b_status'] == 1)
                            $return['bussiness_type'] = "B2B";
                    else
                            $return['bussiness_type'] = "B2C";
            }

        $query =  "SELECT postcode, city, phone, phone_mobile "
                . "FROM js_address "
                . "WHERE id_customer = ".$id.";";

        $data   = mysqli_query($con,$query);
        while($aData = $data->fetch_assoc())
            {
                    $return['postcode'] = $aData['postcode'];
                    $return['city'] = $aData['city'];
                    if($aData['phone'] != '')
                            $return['mobile'] = $aData['phone'];
                    if($aData['phone_mobile'] != '')
                            $return['mobile'] = $aData['phone_mobile'];
            }

        return $return;
    }
    else
        return '';
}

function getCategoryName($con,$id)
{
        if($id != '')
        {
            $query =  "SELECT name "
                    . "FROM js_category_lang "
                    . "WHERE id_category = ".$id.";";

            $data   = mysqli_query($con,$query);
            $aData = $data->fetch_assoc();
            return $aData['name'];
        }
        else
            return '';
}

function getBrandName($con,$id)
{
    if($id != '')
    {
        $query =  "SELECT name "
                . "FROM js_manufacturer "
                . "WHERE id_manufacturer = '".$id."';";

        $data   = mysqli_query($con,$query);
        $aData = $data->fetch_assoc();
        return $aData['name'];
    }
    else
        return '';
}

function getTransactionID($con,$reference)
{
    if($reference != '')
    {
        $query =  "SELECT transaction_id "
                . "FROM js_order_payment "
                . "WHERE order_reference = '".$reference."';";

        $data   = mysqli_query($con,$query);
        $aData = $data->fetch_assoc();
        return $aData['transaction_id'];
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
?>