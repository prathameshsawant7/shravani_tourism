<?php

include_once("../../configs/defines.php");
include("../../configs/settings.php");
$est =new settings();
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

$filter = '1 ';
$OrderBy= "";

if($_POST['cRows'] != 0)
    $item_per_page = $_POST['cRows'];
else 
    $item_per_page = 10;

if(isset($_POST['id']) && $_POST['id'] != '')
    $filter  .= "AND t.id = ".$_POST['id']." ";

if(isset($_POST['id_tour']) && $_POST['id_tour'] != '')
    $filter  .= "AND t.id_tour LIKE '%".$_POST['id_tour']."%' ";

if(isset($_POST['tour_name']) && $_POST['tour_name'] != '')
    $filter  .= "AND t.tour_name LIKE '%".$_POST['tour_name']."%' ";

if(isset($_POST['tour_location_category_name']) && $_POST['tour_location_category_name'] != '')
    $filter  .= 'AND tl.tour_location_category_name LIKE "%'.$_POST['tour_location_category_name'].'%" ';

if(isset($_POST['tour_type']) && $_POST['tour_type'] != '')
    $filter  .= "AND t.tour_type LIKE '%".$_POST['tour_type']."%' ";

if(isset($_POST['night_days']) && $_POST['night_days'] != '')
    $filter  .= "AND t.night_days LIKE '%".$_POST['night_days']."%' ";

if(isset($_POST['price']) && $_POST['price'] != '')
    $filter  .= "AND t.price = ".$_POST['price']." ";


if(isset($_POST['arrangeOrder'])){
    $OrderBy = "t.id ".$_POST['arrangeOrder'];
}
else{
    $OrderBy = "t.id DESC";
}

$query = "SELECT COUNT(*) FROM tours AS t WHERE ".$filter;
$results = $con->query($query);

$get_total_rows = $results->fetch_row(); //hold total records in variable

$total_pages = ceil($get_total_rows[0]/$item_per_page);

//position of records
$page_position = (($page_number-1) * $item_per_page);

$query = "SELECT t.id,t.id_tour,t.tour_name,tl.tour_location_category_name,"
            . "t.tour_type,t.night_days,t.price "
            . "FROM tours AS t "
            . "LEFT JOIN tour_location_category AS tl "
            . "ON tl.id_tour_location_category = t.id_tour_location_category "
            . "WHERE ".$filter." "
            . "ORDER BY $OrderBy LIMIT $page_position, $item_per_page";

//Limit our results within a specified range.
$fetch_data = mysqli_query($con,$query);
//$results->execute(); //Execute prepared Query
//$results->bind_result($id,$id_tour,$tour_name,$tour_location_category_name,$tour_type,$night_days,$price); //bind variables to prepared statement

$listingHtml = '';
$count = 1;
while($tour_data = $fetch_data->fetch_assoc()){ //fetch values
    $count++;
    $listingHtml .= <<<HEREDOC
    <tr id="tr_{$tour_data['id']}">
        <td><center><label>{$tour_data['id']}</label></center></td>
        <td><center><label>{$tour_data['id_tour']}</label></center></td>
        <td><center><label>{$tour_data['tour_name']}</label></center></td>
        <td><center><label>{$tour_data['tour_location_category_name']}</label></center></td>
        <td><center><label>{$tour_data['tour_type']}</label></center></td>
        <td><center><label>{$tour_data['night_days']}</label></center></td>
        <td><center><label>{$tour_data['price']}</label></center></td>
        <td>
            <center>
                <input type="button" class="small button" value="Edit" onclick="editTour({$tour_data['id']})"/>
            </center>
        </td>
        <td>
            <center>
                <input type="button" class="small button" value="Delete" onclick="deleteRegion({$tour_data['id']})"/>
            </center>
        </td>
    </tr>
HEREDOC;
}
if(empty($listingHtml)){
    $listingHtml = '<tr><td colspan="9"><center><label><b>No Record Found</b></label></center></t>';
}

echo <<<HEREDOC
    <table>
        <tr>
            <th>
                <center>
                    <label><b>ID</b></label> 
                    <span><img id="product_up" src="../img/up.png" onclick="getListing(1,'ASC')" style="height:20px;width:20px;cursor:pointer;" />
                    </span>
                    <span><img id="product_down" src="../img/down.png" onclick="getListing(1,'DESC')" style="height:20px;width:20px;cursor:pointer;" /></span>
                </center>
            </th>
            <th><center><label><b>Tour ID</b></label></center></th>
            <th><center><label><b>Tour Name</b></label></center></th>
            <th><center><label><b>Tour Location Category</b></label></center></th>
            <th><center><label><b>Tour type</b></label></center></th>
            <th><center><label><b>Days</b></label></center></th>
            <th><center><label><b>Price</b></label></center></th>
            <th colspan="2"><center><a href="add_tour.php" class="small button">Add New Tour</a></center></th>
        </tr>
        <tr>
            <td><input type="text" id="id" class="filter" placeholder="ID" value=""/></td>
            <td><input type="text" id="id_tour" class="filter" placeholder="Tour ID" value="Tour ID"/></td>
            <td><input type="text" id="tour_name" class="filter" placeholder="Tour Name" value="Name"/></td>
            <td><input type="text" id="tour_location_category_name" class="filter" placeholder="Package" value=""/></td>
            <td><input type="text" id="tour_type" class="filter" placeholder="Type" value=""/></td>
            <td><input type="text" id="night_days" class="filter" placeholder="Days" value=""/></td>
            <td><input type="text" id="price" class="filter" placeholder="Price" value=""/></td>
            <td colspan="2">
                <center>
                    <input type="button" class="small button" value="Apply Filter" onclick="getListing(1,'DESC')"/>
                </center>
            </td>
        </tr>
        
        {$listingHtml}
    </table>
    <div align="center">
HEREDOC;
echo paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
echo '</div>';
/*
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
*/
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
