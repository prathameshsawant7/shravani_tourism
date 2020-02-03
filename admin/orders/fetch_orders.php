<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Get orders list
*/ 
include("../config/start_session.php");
include("../config/settings.php");
$est =new settings();
$mysqli_conn=$est->connection();
$con=$est->connection();


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
    $cSellerQuery = "od.iSeller_id IN (".$_POST['cSellerID'].")";
else 
    $cSellerQuery = "od.iSeller_id > -1 ";

if(isset($_POST['cOrder_id']) && $_POST['cOrder_id'] != '')
    $filter  .= "AND o.id_order = ".$_POST['cOrder_id']." ";

if(isset($_POST['cReference']) && $_POST['cReference'] != '')
    $filter  .= "AND o.reference LIKE '%".$_POST['cReference']."%' ";

if(isset($_POST['cCustomer']) && $_POST['cCustomer'] != '')
    $filter  .= "AND CONCAT(c.firstname,' ',c.lastname) LIKE '%".$_POST['cCustomer']."%'";
//$filter  .= "AND (c.firstname LIKE '".$_POST['cCustomer']."' OR c.lastname LIKE '".$_POST['cCustomer']."')";

if(isset($_POST['cTotal']) && $_POST['cTotal'] != '')
    $filter  .= "AND o.total_products_wt = ".$_POST['cTotal']." ";

if(isset($_POST['cPayment']) && $_POST['cPayment'] != '')
    $filter  .= "AND o.payment LIKE '%".$_POST['cPayment']."%' ";

if(isset($_POST['cStatus']) && $_POST['cStatus'] != '')
    $filter  .= "AND osl.id_order_state = ".$_POST['cStatus']." ";

if(isset($_POST['cAddDate']) && $_POST['cAddDate'] != '')
    $filter  .= "AND DATE(o.date_add) = '".$_POST['cAddDate']."' ";

if(isset($_POST['cUpdDate']) && $_POST['cUpdDate'] != '')
    $filter  .= "AND DATE(o.date_upd) = '".$_POST['cUpdDate']."' ";


if(isset($_POST['arrangeOrder']))
{
    if($_POST['arrangeOrder'] == "" || $_POST['arrangeOrder'] == "order_up")
        $OrderBy = "o.id_order  ";
    elseif ($_POST['arrangeOrder'] == "order_down") 
        $OrderBy = "o.id_order DESC ";
    elseif($_POST['arrangeOrder'] == "orderdetail_up")
        $OrderBy = "od.id_order_detail  ";
    elseif ($_POST['arrangeOrder'] == "orderdetail_down") 
        $OrderBy = "od.id_order_detail DESC ";
    elseif ($_POST['arrangeOrder'] == "date_add_up") 
        $OrderBy = "o.date_add ";
    elseif ($_POST['arrangeOrder'] == "date_add_down") 
        $OrderBy = "o.date_add DESC ";
    elseif ($_POST['arrangeOrder'] == "date_upd_up") 
        $OrderBy = "o.date_upd ";
    elseif ($_POST['arrangeOrder'] == "date_upd_down") 
        $OrderBy = "o.date_upd DESC ";
}
else
    $OrderBy = "o.id_order DESC ";

$query = "SELECT COUNT(*) FROM js_orders AS o, js_order_state_lang AS osl, "
        . "js_customer AS c, js_order_detail AS od "
        . "WHERE osl.id_order_state = o.current_state AND c.id_customer = o.id_customer "
        . "AND od.id_order = o.id_order "
        . "AND ".$cSellerQuery." ".$filter;


//get total number of records from database
$results = $mysqli_conn->query($query);
$get_total_rows = $results->fetch_row(); //hold total records in variable
//$item_per_page = 10;
//break records into pages
$total_pages = ceil($get_total_rows[0]/$item_per_page);

//position of records
$page_position = (($page_number-1) * $item_per_page);



$fetch_data = $mysqli_conn->prepare("SELECT id_order_state,name FROM js_order_state_lang ORDER BY name");
$fetch_data->execute(); //Execute prepared Query
$fetch_data->bind_result($id_order_state,$name);
$cStatusOptions = '<option value="">Select Status</option>';
while($fetch_data->fetch())
{
    $cStatusOptions .= '<option value="'.$id_order_state.'">'.$name.'</option>';
}
  
if($_SESSION['cAdmin'] == 1)
    $cStatusUpdate = $cStatusOptions;
else 
    $cStatusUpdate = '<option value="4">Shipped</option>'
                    . '<option value="5">Delivered</option>';


$query = "SELECT o.id_order,od.id_order_detail, o.reference, c.firstname, "
        . "c.lastname,osl.id_order_state, od.total_price_tax_incl AS total, "
        . "o.payment, osl.name AS status, o.date_add, o.date_upd "
        . "FROM js_orders AS o, js_order_state_lang AS osl, "
        . "js_customer AS c, js_order_detail AS od "
        . "WHERE osl.id_order_state = o.current_state AND c.id_customer = o.id_customer "
        . "AND od.id_order = o.id_order "
        . "AND ".$cSellerQuery." ".$filter
        . " ORDER BY $OrderBy LIMIT $page_position, $item_per_page";


//Limit our results within a specified range.
$results = $mysqli_conn->prepare($query);
//echo $query;
$results->execute(); //Execute prepared Query
$results->bind_result($id_order,$id_order_detail,$reference,$firstname,$lastname, $id_order_state,$total,$payment,$status,$date_add,$date_upd); //bind variables to prepared statement


//Display records fetched from database.
echo '<table class="table_view">'
        . '<thead>'
        . '<tr>'
        . '<th><center><label><b>Order</b></label><span><img id="order_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span><span><img id="order_down" src="../img/down.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span></center></th>'
        . '<th><center><label><b>Order Detail</b></label><span><img id="orderdetail_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span><span><img id="orderdetail_down" src="../img/down.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span></center></th>'
        . '<th><center><label><b>Reference</b></label><span>&nbsp;</span></center></th>'
        . '<th><center><label><b>Customer</b></label><span>&nbsp;</span></center></th>'
        . '<th><center><label><b>Price</b></label><span>&nbsp;</span></center></th>'
        . '<th><center><label><b>Payment</b></label><span>&nbsp;</span></center></th>'
        . '<th><center><label><b>Status</b></label><span>&nbsp;</span></center></th>'
        . '<th><center><label><b>Date</b></label><span><img id="date_add_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span><span><img id="date_add_down" src="../img/down.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span></center></th>'
        . '<th><center><label><b>Updated Date</b></label><span><img id="date_upd_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span><span><img id="date_upd_down" src="../img/down.png"  onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span></center></th>'
        . '<th><center><label><b>Actions</b></label><span>&nbsp;</span></center></th>'
        . '<th><center><label><b>Invoice</b></label><span>&nbsp;</span></center></th>'
        . '</tr>'
//        . '<tr>'
//        . '<td>'
//        . '<center>'
//        . '<p><img id="product_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" />'
//        . '<img id="product_down" src="../img/down.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" />'
//        . '</p>'
//        . '</center>'
//        . '</td>'
//        . '<td colspan="5"></td>'
//        . '<td>'
//        . '<center>'
//        . '<p><img id="date_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" />'
//        . '<img id="date_down" src="../img/down.png"  onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" />'
//        . '</p>'
//        . '</center>'
//        . '</td>'
//        . '<td>'
//        . '<center>'
//        . '<p><img id="upd_date_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" />'
//        . '<img id="upd_date_down" src="../img/down.png"  onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" />'
//        . '</p>'
//        . '</center>'
//        . '</td>'
//        . '<td></td><td></td>'
//        . '</tr>'
        . '</thead>'
        . '<tbody>'
        . '<tr>'
        . '<td><input type="text" placeholder="Order" id="cOrder_id" class="filter" value=""/></td>'
        . '<td><input type="text" placeholder="Order Detail" id="cOrder_detail_id" class="filter" value=""/></td>'
        . '<td><input type="text" id="cReference" placeholder="Reference" class="filter" value=""/></td>'
        . '<td><input type="text" id="cCustomer" placeholder="Customer" class="filter" value=""/></td>'
        . '<td><input type="text" id="cTotal" placeholder="Total" class="filter" value=""/></td>'
        . '<td><input type="text" id="cPayment" placeholder="Payment" class="filter" value=""/></td>'
        . '<td><select id="cStatus" class="filter" style="width:100%">'.$cStatusOptions.'</select></td>'
        . '<td><input type="text" id="cAddDate" class="filter"  value=""/></td>'
        . '<td><input type="text" id="cUpdDate" class="filter"  value=""/></td>'
        . '<td><center><input type="button" class="small button filter_btn" value="Apply filter" onclick="applyFilter()"></center></td></tr>';
$count = 0;
while($results->fetch()){ //fetch values
    $count++;
    
    $query = "SELECT count(1) AS total "
        . "FROM js_order_history "
        . "WHERE id_order_state = '72' "
        . "AND id_order = '".$id_order."';" ;
    
    //echo $query;
    
    $data  = mysqli_query($con,$query);
    
    while($aData = $data->fetch_assoc())
        $invoice = $aData['total'];
    
    echo '<tr>'
            . '<td><center><label>'.$id_order.'</label></center></td>'
            . '<td><center><label>'.$id_order_detail.'</label></center></td>'
            . '<td><center><label>'.$reference.'</label></center></td>'
            . '<td><center><label>'.$firstname.' '.$lastname.'</label></center></td>'
            . '<td><center><label>'.number_format((float)$total, 2, '.', '').'</label></center></td>'
            . '<td><center><label>'.$payment.'</label></center></td>'
            . '<td><center><label id="cStatus_'.$id_order.'">'.$status.'</label></center>'
            . '<select id="cStatus_input_'.$id_order.'" class="filter" style="display:none;">'
            . $cStatusUpdate
            . '</select></td>'
            . '<td><center><label>'.$date_add.'</label></center></td>'
            . '<td><center><label>'.$date_upd.'</label></center></td>'
            . '<td><center>'
            . '<div id="StatusEdit_'.$id_order.'">';
        if($id_order_state == 5 || $id_order_state == 6)
            echo '<a href="#" >'
            . '<input type="button" class="small button filter_btn big-link" value="Edit Status" disabled>'
            . '</a>';
        else 
           echo '<a href="#" data-reveal-id="myModal">'
            . '<input type="button" class="small button filter_btn big-link" value="Edit Status"  onclick="editStatus('.$id_order.')">'
            . '</a>';
        
        echo '</div>'
            . '<div id="StatusUpdate_'.$id_order.'" style="display:none;">'
            . ''
            . ''
            . '</div>'
            . '</center></td>'
            . '<td>';
        
        if($invoice > 0)
            echo '<img id="product_up" src="../img/pdf_icon.png" onclick="InvoicePDF('.$id_order_detail.')" style="height:60px;width:50px;cursor:pointer;" />';
        else
            echo '<img id="product_up" src="../img/pdf_icon.png"  style="height:60px;width:50px;cursor:pointer;opacity: 0.3;"/>';
        
        echo '</td></tr>';
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

function checkInvoice($mysqli_conn,$id_order)
{
    
    return $total;
}

?>

