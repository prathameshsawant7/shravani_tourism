<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Export Excel
*/ 
include("../config/start_session.php");
include("../config/settings.php");
require_once '../class/PHPExcel.php';
require_once '../class/PHPExcel/Writer/Excel2007.php';
$est =new settings();
$con=$est->connection();


if($_GET['iSeller_id'] != 0)
{
    $iSeller_id   = $_GET['iSeller_id'];
    $cSellerQuery = "od.iSeller_id = ".$_GET['iSeller_id']." ";
}
else 
{    
    $iSeller_id   = "all";
    $cSellerQuery = "od.iSeller_id > -1 ";
}

$exportStatus   = $_GET['exportStatus'];
$cFromDate      = $_GET['cFromDate'];
$cToDate        = $_GET['cToDate'];

$cSellerQuery  .= 'AND DATE(o.date_add) >= "'.$cFromDate.'" AND DATE(o.date_add) <= "'.$cToDate.'" ';

if($exportStatus != '')
    $cSellerQuery .= 'AND o.current_state = '.$exportStatus.' ';

$filename = 'order_detail_'.$iSeller_id.'.xls';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$excel = new PHPExcel();
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="order_detail_'.$iSeller_id.'.xls"');
header('Cache-Control: max-age=0');

$xls_filename = 'export_'.date('Y-m-d').'.xls'; // Define Excel (.xls) file name

// Fetch Record from Database

$featureNameArray = array('product_id' => '');
$query = "SELECT DISTINCT `name` FROM `js_feature_lang`";
$fetch_data  = mysqli_query($con,$query);
while($row = $fetch_data->fetch_assoc()) 
{
    $featureNameArray[$row['name']] = "";
}
//print_r($featureNameArray);exit;
/*
$query = "SELECT od.`id_order`,o.reference,o.orderNumber,o.date_add,osl.name as orderstate,
    o.barcode, od.`product_id`, od.`id_order_invoice`, s.`name` as shop_name,o.id_customer,
    CONCAT(c.`firstname`,' ', c.`lastname`) as custmer_name,
    CONCAT(c.`firstname`,' ', c.`lastname`) as delivery_name,
    CONCAT(jds.`address1`,' ', jds.`address2`,' ',jds.city,' ',jds.postcode) as delivery_address,
    CONCAT(c.`firstname`,' ', c.`lastname`) as invoice_name,
    CONCAT(jdi.`address1`,' ', jdi.`address2`,' ',jdi.city,' ',jdi.postcode) as invoice_address, 
    s.`name` as brand_name, ccl.`name` as category, od.`prod_barcode`, 
    opi.`reference` as style_no, od.`product_quantity` as qty,od.product_supplier_reference ,
    o.gift,o.gift_message,o.shipping_number,o.order_message,o.delivered,o.total_discounts,
    o.total_paid,o.total_shipping,o.total_wrapping,o.total_paid_tax_excl,o.valid,
    jac.name as carrier,copi.`wholesale_price` as MRP, copi.`price` as sale_value, 
    od.`product_name`, o.`payment`,jfj.feature_json_name AS feature_product 
    FROM `js_order_detail` as od 
    LEFT JOIN `js_orders` o ON o.`id_order`=od.`id_order` 
    LEFT JOIN `js_customer` c ON c.`id_customer`=o.`id_customer` 
    LEFT JOIN `js_shop` s ON s.`id_shop`=od.`id_shop`
    LEFT JOIN `js_carrier` jac ON jac.`id_carrier`=o.`id_carrier`
    LEFT JOIN `js_order_state_lang` osl ON osl.`id_order_state`=o.`current_state`
    LEFT JOIN `js_address` jds ON jds.`id_address`=o.`id_address_delivery`
    LEFT JOIN `js_address` jdi ON jds.`id_address`=o.`id_address_invoice`
    LEFT JOIN `js_category_product` cp ON cp.`id_product`=od.`product_id` 
    LEFT JOIN `js_category_lang` cl ON cl.`id_category`=cp.`id_category` 
    LEFT JOIN `js_category` cat ON cat.`id_category`=cl.`id_category` 
    LEFT JOIN `js_order_product_info` opi ON opi.`id_order_detail`=od.`id_order_detail` 
    LEFT JOIN `js_order_product_info` copi ON copi.`id_product`=od.`product_id` 
    LEFT JOIN `js_category_lang` ccl ON ccl.`id_category`=od.`id_category_default`  
    LEFT JOIN js_feature_json jfj ON jfj.id_product = od.product_id 
    WHERE ".$cSellerQuery."   
    GROUP BY od.`id_order_detail` ORDER BY od.`id_order` DESC";
*/

$query = "SELECT od.id_order,o.reference,o.orderNumber, o.date_add, "
        . "osl.name as orderstate, o.barcode,  od.product_id,  od.id_order_invoice,  "
        . "s.name as shop_name, o.id_customer, "
        . "o.id_address_delivery, o.id_address_invoice,  s.name as brand_name,  "
        . "ccl.name as category, od.prod_barcode,  copi.reference as style_no,  "
        . "od.product_quantity as qty, od.product_supplier_reference , o.gift, "
        . "o.gift_message, o.shipping_number, o.order_message, o.delivered, "
        . "o.total_discounts, o.total_paid, o.total_shipping, o.total_wrapping, "
        . "o.total_paid_tax_excl, o.valid, jac.name as carrier, copi.wholesale_price as MRP,  "
        . "copi.price as sale_value,  od.product_name,  o.payment "
        . "FROM js_order_detail as od  "
        . "LEFT JOIN js_orders o ON o.id_order=od.id_order   "
        . "LEFT JOIN js_shop s ON s.id_shop=od.id_shop "
        . "LEFT JOIN js_order_state_lang osl ON osl.id_order_state=o.current_state "
        . "LEFT JOIN js_order_product_info copi ON copi.id_product=od.product_id  "
        . "LEFT JOIN js_carrier jac ON jac.id_carrier=o.id_carrier "
        . "LEFT JOIN js_category_lang ccl ON ccl.id_category=od.id_category_default "
        . "WHERE ".$cSellerQuery." "
        . "GROUP BY od.id_order_detail "
        . "ORDER BY od.id_order DESC; ";

echo $query;
$fetch_data = mysqli_query($con,$query);
//echo 1;
//print_r($fetch_data);exit;
$get_rows   = $fetch_data->fetch_row();

if($get_rows == 0)
{
    echo "No Record Found";exit;
}

$featureArray = array();
$titleArray = array();

while($row = $fetch_data->fetch_assoc()) 
{
    $jsonarray = json_decode(getFeatureProduct($con,$row['product_id']), true);
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
            } else {
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

//print_r($uniqueval);exit;
        $excel->getActiveSheet()->getColumnDimension('O')->setWidth(60);
        $excel->getActiveSheet()->getStyle('A1:O1')->getFont()->setBold(true);
        
	$excel->setActiveSheetIndex(0)
		->setCellValueByColumnAndRow(0,1,'Order ID')
                ->setCellValue('B1', 'Order Reference')
                ->setCellValue('C1', 'Partner Order Number')
                ->setCellValue('D1', 'Order State')
                ->setCellValue('E1', 'Partner Order Date')
                ->setCellValue('F1', 'Order Message')
                ->setCellValue('G1', 'Barcode')
                ->setCellValue('H1', 'ProductID')
		->setCellValue('I1', 'Order Invoice ID')
		->setCellValue('J1', 'Shop Name')
                ->setCellValue('K1', 'Customer ID')
		->setCellValue('L1', 'Customer Name')
                ->setCellValue('M1', 'Delivery Name')
                ->setCellValue('N1', 'Delivery Address')
                ->setCellValue('O1', 'Invoice Name')
                ->setCellValue('P1', 'Invoice Address')
		->setCellValue('Q1', 'Brand Name')
		->setCellValue('R1', 'Category')
		->setCellValue('S1', 'Sub Category')
		->setCellValue('T1', 'Product Barcode')
		->setCellValue('U1', 'Style No')
		->setCellValue('V1', 'Quantity')
                ->setCellValue('W1', 'Supplier Reference')
                ->setCellValue('X1', 'Gift')
                ->setCellValue('Y1', 'Gift Message')
                ->setCellValue('Z1', 'Shipping Number')
                ->setCellValue('AA1', 'Delivered')
                ->setCellValue('AB1', 'Total Discount')
                ->setCellValue('AC1', 'Total Paid')
                ->setCellValue('AD1', 'Shipping Cost')
                ->setCellValue('AE1', 'Total Wrapping')
                ->setCellValue('AF1', 'Total Paid Tax Excl.')
		->setCellValue('AG1', 'Valid')
                ->setCellValue('AH1', 'Carrier Name')
                ->setCellValue('AI1', 'MRP')
		->setCellValue('AJ1', 'Sale Value')
		->setCellValue('AK1', 'Product Name')
		->setCellValue('AL1', 'Payment Mode')
		->setCellValue('AM1', 'Product Image');
   
        
        
//print_r($uniquArraykey);  exit;   
$i=0;
foreach ($uniquArraykey as $key => $value) 
{  
    $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($i+39,1,$uniquArraykey[$key]);
    $i++;
}

$i=2;

//$fetch_data  = mysqli_query($con,$query);

mysqli_data_seek($fetch_data,0);
//print_r($fetch_data);exit;
while($row = $fetch_data->fetch_assoc()) 
{ 
    $CustomerName = getCustomerName($con,$row['id_customer']);
    $excel->getActiveSheet()->getRowDimension($i)->setRowHeight(55);
       
    	$excel->setActiveSheetIndex(0)
  	    ->setCellValue('A'.$i, $row['id_order'])
            ->setCellValue('B'.$i, $row['reference'])
            ->setCellValue('C'.$i, $row['orderNumber'])
            ->setCellValue('D'.$i, $row['orderstate'])
            ->setCellValue('E'.$i, $row['date_add'])
            ->setCellValue('F'.$i, $row['order_message'])
            ->setCellValue('G'.$i, $row['barcode'])
            ->setCellValue('H'.$i, $row['product_id'])
            ->setCellValue('I'.$i, $row['id_order_invoice'])
            ->setCellValue('J'.$i, $row['shop_name'])
            ->setCellValue('K'.$i, $row['id_customer'])
            ->setCellValue('L'.$i, $CustomerName)
            ->setCellValue('M'.$i, $CustomerName)
            ->setCellValue('N'.$i, getAddress($con,$row['id_address_delivery']))
            ->setCellValue('O'.$i, $CustomerName)
            ->setCellValue('P'.$i, getAddress($con,$row['id_address_invoice']))
            ->setCellValue('Q'.$i, $row['brand_name'])
            ->setCellValue('R'.$i, $row['category'])
            ->setCellValue('S'.$i, '')
            ->setCellValue('T'.$i, $row['prod_barcode'])
            ->setCellValue('U'.$i, $row['style_no'])
            ->setCellValue('V'.$i, $row['qty']) 
            ->setCellValue('W'.$i, $row['product_supplier_reference']) 
            ->setCellValue('X'.$i, $row['gift'])
            ->setCellValue('Y'.$i, $row['gift_message'])
            ->setCellValue('Z'.$i, $row['shipping_number'])
            ->setCellValue('AA'.$i, $row['delivered'])
            ->setCellValue('AB'.$i, $row['total_discounts'])
            ->setCellValue('AC'.$i, $row['total_paid'])
            ->setCellValue('AD'.$i, $row['total_shipping'])
            ->setCellValue('AE'.$i, $row['total_wrapping'])
            ->setCellValue('AF'.$i, $row['total_paid_tax_excl'])
            ->setCellValue('AG'.$i, $row['valid'])
            ->setCellValue('AH'.$i, $row['carrier'])
            ->setCellValue('AI'.$i, $row['MRP'])
            ->setCellValue('AJ'.$i, $row['sale_value'])
            ->setCellValue('AK'.$i, $row['product_name'])
            ->setCellValue('AL'.$i, $row['payment'])
            ->setCellValue('AL'.$i, imagePath($con,$row['product_id']));

    $j=0;

    if(isset($uniqueval[$row['product_id']]))
    {
        foreach ($uniqueval[$row['product_id']] as $key => $value) 
        {
            $excel->setActiveSheetIndex(0)->setCellValueByColumnAndRow($j+39,$i,$uniqueval[$row['product_id']][$key]);
            $j++;

        }
    }
    $i++;
}

//writer->PHPExcel_IOFactory::createWriter($excel, 'Excel5');
$objWriter = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
//readfile($filename);exit;
// This line will force the file to download
$objWriter->save("tmp/".$filename);
//$objWriter->save('php://output');
//$path = "tmp/".$iSeller_id."_excel.xls";
//$objWriter->save($path);
//echo "tmp/".$filename;


function imagePath($con,$product_id)
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

function getAddress($con,$id)
{
    $query =  "SELECT CONCAT(address1,' ',address2,' ',city,' ',postcode) as address "
            . "FROM js_address "
            . "WHERE id_address = ".$id.";";
    
    $data   = mysqli_query($con,$query);
    $aData = $data->fetch_assoc();
    return $aData['address'];
}

function getFeatureProduct($con,$id)
{
    $query =  "SELECT feature_json_name AS feature_product "
            . "FROM js_feature_json "
            . "WHERE id_product = ".$id.";";
    
    $data   = mysqli_query($con,$query);
    $aData = $data->fetch_assoc();
    return $aData['feature_product'];
}

function getCustomerName($con,$id)
{
    $query =  "SELECT CONCAT(firstname,' ', lastname) as customer_name "
            . "FROM js_customer "
            . "WHERE id_customer = ".$id.";";
    
    $data   = mysqli_query($con,$query);
    $aData = $data->fetch_assoc();
    return $aData['customer_name'];
}

exit;
	
?>