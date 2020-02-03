<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Get Seller list
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

$filter = " 1 ";
$OrderBy= "";

if($_POST['cRows'] != 0)
    $item_per_page = $_POST['cRows'];
else 
    $item_per_page = 10;




if(isset($_POST['cSeller_id']) && $_POST['cSeller_id'] != '')
    $filter  .= "AND iSeller_id = ".$_POST['cSeller_id']." ";

if(isset($_POST['cSeller_Name']) && $_POST['cSeller_Name'] != '')
    $filter  .= "AND cReg_name LIKE '%".$_POST['cSeller_Name']."%' ";

if(isset($_POST['cSeller_Email']) && $_POST['cSeller_Email'] != '')
    $filter  .= "AND cEmail LIKE '%".$_POST['cSeller_Email']."%' ";

if(isset($_POST['cSeller_Status']) && $_POST['cSeller_Status'] != '')
    $filter  .= "AND iActive = ".$_POST['cSeller_Status']." ";

if(isset($_POST['cAddDate']) && $_POST['cAddDate'] != '')
    $filter  .= "AND DATE(tEntered) = '".$_POST['cAddDate']."' ";

if(isset($_POST['cUpdDate']) && $_POST['cUpdDate'] != '')
    $filter  .= "AND DATE(tUpdated) = '".$_POST['cUpdDate']."' ";


if(isset($_POST['arrangeOrder']))
{
    if($_POST['arrangeOrder'] == "" || $_POST['arrangeOrder'] == "seller_up")
        $OrderBy = "iSeller_id  ";
    elseif ($_POST['arrangeOrder'] == "seller_down") 
        $OrderBy = "iSeller_id DESC ";
    elseif ($_POST['arrangeOrder'] == "date_add_up") 
        $OrderBy = "tEntered ";
    elseif ($_POST['arrangeOrder'] == "date_add_down") 
        $OrderBy = "tEntered DESC ";
    elseif ($_POST['arrangeOrder'] == "date_upd_up") 
        $OrderBy = "tUpdated ";
    elseif ($_POST['arrangeOrder'] == "date_upd_down") 
        $OrderBy = "tUpdated DESC ";
}
else
    $OrderBy = "iSeller_id DESC ";


$query = "SELECT COUNT(*) FROM js_seller "
        . "WHERE ".$filter;

//echo $query;


//get total number of records from database
$results = $mysqli_conn->query($query);
$get_total_rows = $results->fetch_row(); //hold total records in variable
//$item_per_page = 2;
//break records into pages
$total_pages = ceil($get_total_rows[0]/$item_per_page);

//position of records
$page_position = (($page_number-1) * $item_per_page);



$query = "SELECT iSeller_id,cReg_name,cEmail,iActive,tEntered,tUpdated "
        . "FROM js_seller "
        . "WHERE ".$filter." "
        . "ORDER BY $OrderBy LIMIT $page_position, $item_per_page";

//echo $query;
//Limit our results within a specified range.
$results = $mysqli_conn->prepare($query);
//echo $query;
$results->execute(); //Execute prepared Query
$results->bind_result($iSeller_id,$cReg_name,$cEmail,$iActive,$tEntered, $tUpdated); //bind variables to prepared statement


//Display records fetched from database.
echo '<table class="table_view">'
        . '<thead>'
        . '<tr>'
        . '<th><center><label><b>Seller ID</b></label><span><img id="seller_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span><span><img id="seller_down" src="../img/down.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span></center></th>'
        . '<th><center><label><b>Name</b></label></center></th>'
        . '<th><center><label><b>Email</b></label></center></th>'
        . '<th colspan=2><center><label><b>Status</b></label><span>&nbsp;</span></center></th>'
        . '<th><center><label><b>Registered On</b></label><span><img id="date_add_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span><span><img id="date_add_down" src="../img/down.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span></center></th>'
        . '<th><center><label><b>Updated On</b></label><span><img id="date_upd_up" src="../img/up.png" onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span><span><img id="date_upd_down" src="../img/down.png"  onclick="applyFilter(this)" style="height:20px;width:20px;cursor:pointer;" /></span></center></th>'
        . '<th></th>'
        . '</tr>'
        . '</thead>'
        . '<tbody>'
        . '<tr>'
        . '<td><input type="text" placeholder="Seller ID" id="cSeller_id" class="filter" value=""/></td>'
        . '<td><input type="text" placeholder="Name" id="cSeller_Name" class="filter" value=""/></td>'
        . '<td><input type="text" placeholder="Email" id="cSeller_Email" class="filter" value=""/></td>'
        . '<td  colspan=2 width="240px"><select id="cSeller_Status">'
        . '<option value="">Please Select</option>'
        . '<option value="1">Active</option>'
        . '<option value="0">Non-Active</option>'
        . '<select></td>'
        . '<td><input type="text" id="cAddDate" class="filter"  value=""/></td>'
        . '<td><input type="text" id="cUpdDate" class="filter"  value=""/></td>'
        . '<td><center><input type="button" class="small button filter_btn" value="Apply filter" onclick="applyFilter()"></center></td></tr>';
$count = 0;
while($results->fetch())
{ //fetch values
    $count++;
    
    echo '<tr>'
        . '<td><center><label>'.$iSeller_id.'</label></center></td>'
        . '<td><center><label>'.$cReg_name.'</label></center></td>'
        . '<td><center><label>'.$cEmail.'</label></center></td>';
        if($iActive == 0)
        {
            echo '<td><center><input type="radio" id="1_'.$iSeller_id.'" name="cStatus_'.$iSeller_id.'" onclick="setSellerStatus(this)">&nbsp;&nbsp;<img src="../img/enabled.gif"></label></center>  '
                . '<td><center><input type="radio" id="0_'.$iSeller_id.'" name="cStatus_'.$iSeller_id.'" onclick="setSellerStatus(this)" checked="checked"> &nbsp;&nbsp;<img src="../img/disabled.gif"></label></center>';
        }
        else 
        {
            echo '<td><center><input type="radio" id="1_'.$iSeller_id.'" name="cStatus_'.$iSeller_id.'" onclick="setSellerStatus(this)" checked="checked"> &nbsp;&nbsp;<img src="../img/enabled.gif"></label></center>  '
                . '<td><center><input type="radio" id="0_'.$iSeller_id.'" name="cStatus_'.$iSeller_id.'" onclick="setSellerStatus(this)">&nbsp;&nbsp;<img src="../img/disabled.gif"></label></center>';
        }
        
    echo '<td><center><label>'.$tEntered.'</label></center></td>'
        . '<td><center><label>'.$tUpdated.'</label></center></td>'
        .'</td></tr>';
}
if($count == 0)
{
    echo '<tr><td colspan="8"><center><b>No record found</b></center></td></tr>';
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

