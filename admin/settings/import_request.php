<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Product Export CVS
*/ 
ini_set('memory_limit', '-1');
include("../config/start_session.php");
include("../config/settings.php");

$est =new settings();
$con=$est->connection();
$request='';

if(isset($_POST['request']))
{
    $request = $_POST['request'];

    if($_GET['iSeller_id'] != 0 && $_GET['cAdmin'] != 1)
    {
        $iSeller_id   = $_GET['iSeller_id'];
        $cFilterQuery = "pr.iSeller_id IN (".$_GET['iSeller_id'].") ";
    }
    else 
    {    
        $iSeller_id   = "all";
        $cFilterQuery = "pr.iSeller_id > -1 ";
    }

    $id_category    = $_GET['id_category'];
    $cFeatureFilter = 'WHERE id_feature IN ('.$_GET['id_feature'].') ';

    if($id_category != '')
        $cFilterQuery  .= 'AND pr.id_category_default IN ('.$id_category.') ';

    
}


if($request == 'getCount')
{
    $_SESSION['cListingCSVdata'] = '';
    $query = "SELECT pr.id_product "
        . "FROM js_hybrid_product pr, js_product_lang pl "
        . "WHERE pr.id_product>0 AND pl.id_product=pr.id_product AND $cFilterQuery "
        . "GROUP BY pr.id_product ;";
    
    $fetch_data = mysqli_query($con,$query);
    $id_products = "-1";
    $total = 0;
    $comma = '';
    while($row = $fetch_data->fetch_assoc()) 
    {
        if($total != 0)
            $comma = ",";
        
        $id_products .= $comma.$row['id_product'];
        $total++;
    }
    if($total > 0)
    {
        $featureArray       = getFeatureProduct($con,$id_products);

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
			            $uniqueval[$value33['id_product']][$key44] = $value33[$key44];
			        $titleArray = $key44;
		}
	    }
    
        $_SESSION['uniquArraykey'] 	= $uniquArraykey;
        $_SESSION['uniqueval'] 	= $uniqueval;
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

$query = "SELECT pr.active, pr.id_product,  pl.name,  pr.reference, "
        . "id_manufacturer, pl.link_rewrite,  pl.meta_description, "
        . "pl.meta_keywords,  pl.meta_title,  "
        . "pr.price,  pr.wholesale_price,  pr.available_for_order,  pr.show_price,  "
        . "pr.date_add,  pr.date_upd, pr.quantity, pr.id_category_default,pr.id_sub_cat, "
        . "pr.metalprice, pr.makingprice, pl.description,  pl.description_short, pr.favourites "
        . "FROM js_hybrid_product pr, js_product_lang pl "
        . "WHERE pr.id_product>0 AND pl.id_product=pr.id_product AND $cFilterQuery  "
        . "GROUP BY pr.id_product "
        . "ORDER BY pr.id_product LIMIT ".$start.",500;";


    $fetch_data = mysqli_query($con,$query);
//    $get_rows   = $fetch_data->fetch_row();
//
//    if($get_rows == 0)
//    {
//
//    }

    $featureArray = array();
    $titleArray = array();

    $id_products = "-1";
    $i = 0;
    while($row = $fetch_data->fetch_assoc()) 
    {
        $id_products .= ",".$row['id_product'];
        $array_id_product[$i] = $row['id_product'];
        $i++;
    }

    $CategoryNames          = getCategoryNames($con,$id_products);
    $SpecificationPrices    = getSpecificationPrices($con,$id_products);
    $BrandNames             = getBrandNames($con,$id_products);
    $ImagePaths             = getImagePaths($con,$id_products);

    

    $aHeader = array(
                'Active',
                'Id Product' ,
                'Name' ,
                'Reference' ,
                'Brand',
                'link_rewrite',
                'meta_description',
                'mtkeywordss',
                'meta_title' ,
                'price',
                'wholesale_price' ,
                'available_for_order',
                'show_price',        
                'date_add',
                'date_upd',
                'quantity',
                'Category',
                'Sub_Category',
                'Metal price',
                'Making price',
                'Reduction',
                'Reduction_type',
                'From',
                'To',
                'description' ,
                'description_short' ,
                'favourites',
                'Image Path',
                'Product Path'
                );    
    
    
    if(isset($_SESSION['uniquArraykey']))
    {
        $i = count($aHeader);
        foreach ($_SESSION['uniquArraykey'] as $key => $value) 
        {  
                $aHeader[$i] = $_SESSION['uniquArraykey'][$key];
                $i++;
        }
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

    //echo "<PRE>";print_r($cOutput);exit;

    
    mysqli_data_seek($fetch_data,0);
    while($row = $fetch_data->fetch_assoc()) 
    {

    $reduction = '';
    $reduction_type = '';
    $from = '';
    $to = '';
    $ImagePath = '';
    $BrandName = '';
        
    if(isset($SpecificationPrices[$row['id_product']]['reduction']) && $row['id_product'] != '')
        $reduction = $SpecificationPrices[$row['id_product']]['reduction']; 
        
    
    if(isset($SpecificationPrices[$row['id_product']]['reduction_type'])  && $row['id_product'] != '')
        $reduction_type = $SpecificationPrices[$row['id_product']]['reduction_type'];
    
    
    if(isset($SpecificationPrices[$row['id_product']]['from'])  && $row['id_product'] != '')
        $from = $SpecificationPrices[$row['id_product']]['from'];
    
    
    if(isset($SpecificationPrices[$row['id_product']]['to']) && $row['id_product'] != '')
        $to = $SpecificationPrices[$row['id_product']]['to'];
    
    
    if(isset($ImagePaths[$row['id_product']]) && $row['id_product'] != '')
        $ImagePath = $ImagePaths[$row['id_product']];
    
    
    if(isset($BrandNames[$row['id_product']]) && $row['id_product'] != '')
        $BrandName = $BrandNames[$row['id_product']];
        
    $cOutput .=  handleString($row['active']).", "
             . "".handleString($row['id_product']).", "
             . "".handleString($row['name']).", "
             . "".handleString($row['reference']).", "
             . "".handleString($BrandName).", "
             . "".handleString($row['link_rewrite']).", "
             . "".handleString($row['meta_description']).", "
             . "".handleString(str_replace(',', '-',$row['meta_keywords'])).", "
             . "".handleString($row['meta_title']).", "
             . "".handleString($row['price']).", "
             . "".handleString($row['wholesale_price']).", "
             . "".handleString($row['available_for_order']).", "
             . "".handleString($row['show_price']).", "
             . "".handleString($row['date_add']).", "
             . "".handleString($row['date_upd']).", "
             . "".handleString($row['quantity']).", "
             . "".handleString($CategoryNames[$row['id_product']]['cat']).", "
             . "".handleString($CategoryNames[$row['id_product']]['subcat']).", "
             . "".handleString($row['metalprice']).", "
             . "".handleString($row['makingprice']).", "
             . "".handleString($reduction).", "
             . "".handleString($reduction_type).", "
             . "".handleString($from).", "
             . "".handleString($to).", "
             . "".handleString($row['description']).", "
             . "".handleString($row['description_short']).", "
             . "".handleString($row['favourites']).", "
             . "".handleString($ImagePath).", "
             . "".handleString(getProductPath($row['id_product'],$id_category));
        if(isset($_SESSION['uniquArraykey']))
        {
            for($i=29;$i<count($aHeader);$i++)
            {
                if(isset($_SESSION['uniqueval'][$row['id_product']][$aHeader[$i]]))
                    $cOutput .= ",".$_SESSION['uniqueval'][$row['id_product']][$aHeader[$i]];
                else
                    $cOutput .= ",-";
            }
        }
        $cOutput .= "\n";
    }

    if(trim($_SESSION['cListingCSVdata']) != '')
        $_SESSION['cListingCSVdata'] .= "\n".trim($cOutput);
    else
        $_SESSION['cListingCSVdata'] = trim($cOutput);
    
    echo trim($cOutput);
    exit;
}


$filename = 'product_export.csv';
header('Content-Encoding: UTF-8');
header('Content-type: text/csv; charset=UTF-8');
header('Content-Disposition: attachment; filename='.$filename);
echo "\xEF\xBB\xBF"; // UTF-8 BOM
// clean the output buffer
ob_clean();
echo trim($_SESSION['cListingCSVdata']);
$_SESSION['cListingCSVdata'] = '';
exit;


//
//if($request == 'saveData')
//{
//    $filename = 'product_export.csv';
//
//    header('Content-Encoding: UTF-8');
//    header('Content-type: text/csv; charset=UTF-8');
//    header('Content-Disposition: attachment; filename='.$filename);
//    echo "\xEF\xBB\xBF"; // UTF-8 BOM
//    
//    echo $_POST['html'];exit;
//    
//}

function getSpecificPriceDetails($con,$id_product)
{
    if($id_product != '')
    {
        $query =  "SELECT jsp.reduction,jsp.reduction_type,jsp.from,jsp.to "
                . "FROM js_specific_price AS jsp "
                . "WHERE id_product = ".$id_product.";";
        $data   = mysqli_query($con,$query);
        $aData = $data->fetch_assoc();
        return $aData;
    }
    else
        return '';
}

function getSpecificationPrices($con,$id_product)
{
    if($id_product != '')
    {
        $query =  "SELECT id_product,jsp.reduction,jsp.reduction_type,jsp.from,jsp.to "
                . "FROM js_specific_price AS jsp "
                . "WHERE id_product IN (".$id_product.");";
        $data   = mysqli_query($con,$query);
        $aReturn = array();
        while($aData = $data->fetch_assoc())
        {
            $aReturn[$aData['id_product']]['reduction']         =  $aData['reduction'];
            $aReturn[$aData['id_product']]['reduction_type']    =  $aData['reduction_type'];
            $aReturn[$aData['id_product']]['from']              =  $aData['from'];
            $aReturn[$aData['id_product']]['to']                =  $aData['to'];
        }
        return $aReturn;
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
            $aReturn = '';
            $data   = mysqli_query($con,$query);
            while($aData = $data->fetch_assoc())
            {
                $aReturn[$aData['id_product']]['cat']       = $aData['cat'];
                $aReturn[$aData['id_product']]['subcat']    = $aData['subcat'];
            }
            return $aReturn;
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


function getImagePath($con,$id_product)
{
    if($id_product != '')
    {
        $query =  "SELECT i.id_image "
                . "FROM js_image AS i,js_image_lang AS il "
                . "WHERE i.id_image = il.id_image AND i.id_product = ".$id_product.";";

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

function getImagePaths($con,$id_product)
{
    if($id_product != '')
    {
        $query =  "SELECT i.id_product,i.id_image "
                . "FROM js_image AS i,js_image_lang AS il "
                . "WHERE i.id_image = il.id_image AND i.id_product IN (".$id_product.");";

        $image_data   = mysqli_query($con,$query);
        $path = '';
        $aResult = array();
	$tempProductID= ''; 
        while ($aData = $image_data->fetch_assoc())
        {
            
		if($tempProductID == '' || $tempProductID != $aData['id_product'])
			$path  = "";
		else
                	$path .= " | ";
                $path    .= "http://d3w0fztyp9j74f.cloudfront.net/img/p";
                $idArray = str_split($aData['id_image']);
                for($i=0;$i<count($idArray);$i++)
                    $path = $path."/".$idArray[$i];
                $path    .= "/".$aData['id_image']."-home_default.jpg";

                $aResult[$aData['id_product']] = $path;
		$tempProductID = $aData['id_product'];
               
        }
        return $aResult;
    }
    else
        return '';
}
        
function getProductPath($id_product, $catName) 
{
    $path = '';
    $catName = strtolower($catName);
    $path = 'http://www.jewelsouk.com/'.$catName .'/'. $id_product . '.html';
    return $path;
}


function getBrandNames($con,$id)
{
    $query = "SELECT p.id_product,m.name "
            . "FROM js_manufacturer AS m, js_hybrid_product AS p "
            . "WHERE p.id_manufacturer = m.id_manufacturer AND p.id_product IN (".$id.")";
    $fetch_data  = mysqli_query($con,$query);
    $aResult='';
    while($aData = $fetch_data->fetch_assoc())
        $aResult[$aData['id_product']] = $aData['name'];
    
    return $aResult;
}


function getFeatureProduct($con,$id)
{
    if($id != '')
    {
	$query =  "SELECT id_product,feature_json_name as productfeature "
                . "FROM js_feature_json "
                . "WHERE id_product IN (".$id.");";

        $data   = mysqli_query($con,$query);
        $aReturn = '';
        while($aData = $data->fetch_assoc())
        {

            $aReturn[$aData['id_product']] = json_decode($aData['productfeature'],true);
            $aReturn[$aData['id_product']]['id_product']=$aData['id_product'];
            
        }
        return $aReturn;
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





?>