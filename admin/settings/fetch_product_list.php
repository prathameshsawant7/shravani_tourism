<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Get product list
*/ 
include("../config/start_session.php");
include("../config/settings.php");
$est =new settings();
$mysqli_conn=$est->connection();

//Get page number from Ajax
if(isset($_POST["page"]))
{
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH); //filter number
    if(!is_numeric($page_number))
        {die('Invalid page number!');} //incase of invalid page number
}
else
{
    $page_number = 1; //if there's no page number, set it to 1
}

$filter = "";
$OrderBy= "";

if($_POST['cRows'] != 0)
    $item_per_page = $_POST['cRows'];
else 
    $item_per_page = 10;

if($_POST['cSellerID'] != 0)
    $cSellerQuery = "p.iSeller_id IN (".$_POST['cSellerID'].")";
else 
    $cSellerQuery = "p.iSeller_id > -1 ";

if(isset($_POST['cProduct_id']) && $_POST['cProduct_id'] != '')
    $filter  .= "AND p.id_product = ".$_POST['cProduct_id']." ";

if(isset($_POST['cReference']) && $_POST['cReference'] != '')
    $filter  .= "AND p.reference LIKE '%".$_POST['cReference']."%' ";

if(isset($_POST['cName']) && $_POST['cName'] != '')
    $filter  .= "AND (p.name LIKE '%".$_POST['cName']."%')";

if(isset($_POST['cPrice']) && $_POST['cPrice'] != '')
    $filter  .= "AND p.price = ".$_POST['cPrice']." ";

if(isset($_POST['cMRP']) && $_POST['cMRP'] != '')
    $filter  .= "AND p.wholesale_price = ".$_POST['cMRP']." ";

if(isset($_POST['cDiscount']) && $_POST['cDiscount'] != '')
    $filter  .= "AND p.quantity_discount = ".$_POST['cDiscount']." ";

if(isset($_POST['cQuantity']) && $_POST['cQuantity'] != '')
    $filter  .= "AND p.quantity = ".$_POST['cQuantity']." ";

if(isset($_POST['cActive']) && $_POST['cActive'] != '')
    $filter  .= "AND p.active = ".$_POST['cActive']." ";

if(isset($_POST['cAddDate']) && $_POST['cAddDate'] != '')
    $filter  .= "AND DATE(p.date_add) = '".$_POST['cAddDate']."' ";

if(isset($_POST['cUpdDate']) && $_POST['cUpdDate'] != '')
    $filter  .= "AND DATE(p.date_upd) = '".$_POST['cUpdDate']."' ";

if(isset($_POST['arrangeOrder']))
{
    if($_POST['arrangeOrder'] == "" || $_POST['arrangeOrder'] == "product_up")
        $OrderBy = "p.id_product ";
    elseif ($_POST['arrangeOrder'] == "product_down") 
        $OrderBy = "p.id_product DESC ";
    elseif ($_POST['arrangeOrder'] == "date_add_up") 
        $OrderBy = "p.date_add ";
    elseif ($_POST['arrangeOrder'] == "date_add_down") 
        $OrderBy = "p.date_add DESC ";
    elseif ($_POST['arrangeOrder'] == "date_upd_up") 
        $OrderBy = "p.date_upd ";
    elseif ($_POST['arrangeOrder'] == "date_upd_down") 
        $OrderBy = "p.date_upd DESC ";
}
else
    $OrderBy = "p.id_product DESC";

$query = "SELECT COUNT(*) FROM js_hybrid_product AS p "
            . "WHERE ".$cSellerQuery." ".$filter;
$results = $mysqli_conn->query($query);
//echo $query;exit;
$get_total_rows = $results->fetch_row(); //hold total records in variable
//$item_per_page = 10;
//break records into pages
$total_pages = ceil($get_total_rows[0]/$item_per_page);

//position of records
$page_position = (($page_number-1) * $item_per_page);

$Query = "SELECT DISTINCT p.id_product,p.name,p.reference,p.price,"
            . "p.wholesale_price,p.quantity_discount,p.date_add,"
            . "p.date_upd,p.quantity,p.active "
            . "FROM js_hybrid_product AS p "
            . "WHERE ".$cSellerQuery." ".$filter
            . "ORDER BY $OrderBy LIMIT $page_position, $item_per_page";
//echo $Query;

//Limit our results within a specified range.
$results = $mysqli_conn->prepare($Query);
$results->execute(); //Execute prepared Query
$results->bind_result($id_product,$name,$reference,$price,$mrp,$discount,$date_add,$date_upd,$quantity,$active); //bind variables to prepared statement


//Display records fetched from database.
echo '<table  class="table_1">'
        . '<thead>'
        . '<tr>'
        . '<th><center><label><b>Product ID.</b></label> <span><img id="product_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span><span><img id="product_down" src="../img/down.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span></center></th>'
        . '<th><center><label><b>Name</b></label><span>&nbsp;</span></center></th>'
        . '<th><center><label><b>Reference</b></label><span>&nbsp;</span></center></th>'
        . '<th><center><label><b>Selling Price</b></label><span>&nbsp;</span></center></th>'
        . '<th><center><label><b>MRP</b></label><span>&nbsp;</span></center></th>'
        . '<th><center><label><b>Discount</b></label><span>&nbsp;</span></center></th>'
        . '<th><center><label><b>Quantity</b></label><span>&nbsp;</span></center></th>'
        . '<th><center><label><b>Active</b></label><span>&nbsp;</span></center></th>'
        . '<th style="width: 11%;"><center><label><b>Date</b></label><span><img id="date_add_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span><span><img id="date_add_down" src="../img/down.png"  onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span></center></th>'
        . '<th style="width: 11%;"><center><label><b>Updated Date</b></label><span><img id="date_upd_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span><span><img id="date_upd_down" src="../img/down.png"  onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span></center></th>'
        . "<th><center><label><b>Action</b></label><span>&nbsp;</span></center></center></th>"
        . '</tr>'
        // . '<tr>'
        // . '<td>'
        // . '<center>'
        // . '<p style="padding:0; margin:0;"><img id="product_up" src="../img/up.png" onclick="applyFilter(this)" style="height:15px;width:15px;cursor:pointer;" />'
        // . '<img id="product_down" src="../img/down.png" onclick="applyFilter(this)" style="height:15px;width:15px;cursor:pointer;" />'
        // . '</p>'
        // . '</center>'
        // . '</td>'
        // . '<td colspan="5"></td>'
        // . '<td>'
        // . '<center>'
        // . '<p><img id="date_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" />'
        // . '<img id="date_down" src="../img/down.png"  onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" />'
        // . '</p>'
        // . '</center>'
        // . '</td>'
        // . '<td></td>'
        // . '</tr>'
        . '</thead>'
        . '<tbody>'
        . '<tr>'
        . '<td><input type="text" id="cProduct_id" class="filter" placeholder="Product No." value=""/></td>'
        . '<td><input type="text" id="cName" class="filter" value="" placeholder="Name" /></td>'
        . '<td><input type="text" id="cReference" class="filter" placeholder="Reference" value=""/></td>'
        . '<td><input type="text" id="cPrice" class="filter" placeholder="Price" value=""/></td>'
        . '<td><input type="text" id="cMRP" class="filter" placeholder="MRP" value=""/></td>'
        . '<td><input type="text" id="cDiscount" class="filter" placeholder="Discount" value=""/></td>'
        . '<td><input type="text" id="cQuantity" class="filter" placeholder="Quantity" value=""/></td>'
        . '<td style="width: 10%; text-align: center;"><select  id="cActive">'
        . '<option  value="">Please select</option>'
        . '<option value="1">Yes</option>'
        . '<option value="0">No</option>'
        . '</select></td>'
        . '<td><input type="text" id="cAddDate" class="filter" value=""/></td>'
        . '<td><input type="text" id="cUpdDate" class="filter" value=""/></td>'
        . '<td><center><input type="button" class="small button filter_btn" value="Apply filter" onclick="applyFilter()"></center></td></tr>';
$count = 0;
while($results->fetch()){ //fetch values
    $count++;
    echo '<tr>'
            . '<td><center><label>'.$id_product.'</label></center></td>'
            . '<td><center><label>'.$name.'</label></center></td>'
            . '<td><center><label>'.$reference.'</label></center></td>'
            . '<td><center><label>'.number_format((float)$price, 2, '.', '').'</label></center></td>'
            . '<td><center><label>'.number_format((float)$mrp, 2, '.', '').'</label></center></td>'
            . '<td><center><label>'.$discount.'</label></center></td>'
            . '<td><center>'
            . '<label id="cQuantity_'.$id_product.'">'.$quantity.'</label>'
            . '<input id="cQuantity_input_'.$id_product.'" type="text" value = "'.$quantity.'" style="display:none">'
            . '</center></td>'
            . '<td><center><label>';
    
            if($active == 0)
               echo '<img src="../img/disabled.gif">';
            else 
               echo '<img src="../img/enabled.gif">';
            
         echo '</label></center></td>'
            . '<td><center><label>'.$date_add.'</label></center></td>'
            . '<td><center><label>'.$date_upd.'</label></center></td>'
            . '<td><center>'
            . '<div id="display_'.$id_product.'" class="buttons">'
            . '<input type="button" class="small button view_btn" value="Edit" onclick="editProduct('.$id_product.')"/>'
            . '<input type="button" class="small button view_btn" value="View" onclick="viewProduct('.$id_product.')"/>'
            . '</div>'
            . '<div id="edit_'.$id_product.'" style="display:none">'
            . '<input type="button" class="small button view_btn" value="Update" onclick="updateProduct('.$id_product.')"/>'
            . '<input type="button" class="small button view_btn" value="Cancel" onclick="cancelProduct('.$id_product.')"/>'
            . '</div>'
            . '</center></td></tr>';
}
if($count == 0)
{
    echo '<tr><td colspan="9"><center><b>No record found</b></center></td></tr>';
}
echo '</tbody></table>';
echo '<div align="center">';
// To generate links, we call the pagination function here.
echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
echo '</div>';

function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination">';
       
        $right_links    = $current_page + 3;
        $previous       = $current_page - 3; //previous link
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
       
        if($current_page > 1){
            $previous_link = ($previous==0)?1:$previous;
//            if($current_page == 2)
//                $previous_link = 1;
            $previous_link = $current_page - 1;
            
            $pagination .= '<li class="first"><a href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li><a href="#" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }  
            $first_link = false; //set first link to false
        }
       
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="first active">'.$current_page.'</li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="last active">'.$current_page.'</li>';
        }else{ //regular current link
            $pagination .= '<li class="active">'.$current_page.'</li>';
        }
               
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li><a href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){
                $next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= '<li><a href="#" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="last"><a href="#" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
        }
       
        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
}

?>
