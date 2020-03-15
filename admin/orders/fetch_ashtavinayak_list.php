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



$filter = ' ';
$OrderBy= "";



if($_POST['cRows'] != 0)
    $item_per_page = $_POST['cRows'];
else 
    $item_per_page = 10;

if(isset($_POST['id']) && $_POST['id'] != '')
    $filter  .= "AND o.id = ".$_POST['id']." ";

if(isset($_POST['ticket']) && $_POST['ticket'] != '')
    $filter  .= "AND o.ticket = ".$_POST['ticket']." ";

if(isset($_POST['tour_date']) && $_POST['tour_date'] != '')
    $filter  .= "AND o.tour_date LIKE '%".$_POST['tour_date']."%' ";

if(isset($_POST['tour_date']) && $_POST['tour_date'] != '')
    $filter  .= "AND o.tour_date LIKE '%".$_POST['tour_date']."%' ";

if(isset($_POST['tour_type']) && $_POST['tour_type'] != '')
    $filter  .= "AND o.tour_type LIKE '%".$_POST['tour_type']."%' ";

if(isset($_POST['seat_no']) && $_POST['seat_no'] != '')
    $filter  .= "AND o.seat_no LIKE '%".$_POST['seat_no']."%' ";

if(isset($_POST['tour_pickup']) && $_POST['tour_pickup'] != '')
    $filter  .= "AND o.tour_pickup LIKE '%".$_POST['tour_pickup']."%' ";

// if(isset($_POST['travellers']) && $_POST['travellers'] != '')
//     $filter  .= "AND t.travellers LIKE '%".$_POST['travellers']."%' ";

if(isset($_POST['status']) && $_POST['status'] != '')
    $filter  .= "AND o.status LIKE '%".$_POST['status']."%' ";

if(isset($_POST['updated_by']) && $_POST['updated_by'] != '')
    $filter  .= "AND o.updated_by LIKE '%".$_POST['updated_by']."%' ";

if(isset($_POST['added_by']) && $_POST['added_by'] != '')
    $filter  .= "AND o.added_by LIKE '%".$_POST['added_by']."%' ";

if(isset($_POST['updated_by']) && $_POST['updated_by'] != '')
    $filter  .= "AND o.updated_by LIKE '%".$_POST['updated_by']."%' ";

// if(isset($_POST['active']) && $_POST['active'] != '')
//     $filter  .= "AND t.active = ".$_POST['active']." ";


if(isset($_POST['arrangeOrder']) && $_POST['arrangeOrder']!=''){
    $OrderBy = "o.updated_by ".$_POST['arrangeOrder'];
}
else{
    $OrderBy = "o.updated_by DESC";
}

$query = "SELECT COUNT(*) FROM ashtavinayak_bookings AS t WHERE active=1 ".$filter;
$results = $con->query($query);


$get_total_rows = $results->fetch_row(); //hold total records in variable

$total_pages = ceil($get_total_rows[0]/$item_per_page);

//position of records
$page_position = (($page_number-1) * $item_per_page);

$query = "SELECT o.id,o.ticket,t.tour_code,o.tour_date,o.tour_type,o.seat_no,o.tour_pickup,o.tour_drop,o.seat_data,o.room_data,o.total_cost,o.added_by,o.status,o.updated_by,o.updated_on "
            . "FROM ashtavinayak_bookings AS o "
            . "LEFT JOIN tours as t ON t.id = o.tour_id "
            . "WHERE o.active=1 ".$filter." "
            . "ORDER BY $OrderBy LIMIT $page_position, $item_per_page";

//echo $query;exit;
//Limit our results within a specified range.
$fetch_data = mysqli_query($con,$query);
//$results->execute(); //Execute prepared Query
//$results->bind_result($id,$id_tour,$tour_name,$tour_location_category_name,$tour_type,$night_days,$price); //bind variables to prepared statement

$listingHtml = '';
$count = 1;

while($order_data = $fetch_data->fetch_assoc()){ //fetch values
    $count++;
   // $active = $order_data['active'] ? 'Yes' : 'No';
    $updated_by = $order_data['updated_by'] == 0 ? '-' : $order_data['updated_by'];
    $added_by = $order_data['added_by'] == 0 ? '-' : $order_data['added_by'];
    $updated_on = $order_data['updated_on'] == 0 ? '-' : $order_data['updated_on'];

    // $query = "SELECT GROUP_CONCAT(name) as name FROM customers where id IN (".$order_data['travellers'].")";
    // $travellers_data    = mysqli_query($con,$query);
    // $travellers         = $travellers_data->fetch_assoc();
    // $travellers         = str_replace(',', ',<br />', $travellers['name']);
    $seat_data = json_decode($order_data['seat_data'],true);
    $seat_text = '';
    foreach ($seat_data as $key => $value) {
        $seat_text = $seat_text.$value['name']." [".$value['age']." , ".$value['gender']."]<BR>";
    }

    $room_data = json_decode($order_data['room_data'],true);
    $room_text = '';
    $room_counter = 1;
    $total = 0;
    foreach ($room_data as $key => $value) {
        $room_text = $room_text."Room ".$room_counter .":<BR>[".$value['adult']." A | ".$value['child']." C]<BR>";
        $total += $value['adult']+$value['child'];
        $room_counter++;
    }
    $room_text = $room_text."Total: ".$total."<BR>";

    $listingHtml .= <<<HEREDOC
    <tr id="tr_{$order_data['id']}" style="border:1px solid #000000;">
        <td><center><label>{$order_data['id']}</label></center></td>
        <td><center><label>{$order_data['ticket']}</label></center></td>
        <td><center><label>{$order_data['tour_code']}</label></center></td>
        <td><center><label>{$order_data['tour_date']}</label></center></td>
        <td><center><label>{$order_data['tour_type']}</label></center></td>
        <td><center><label>{$order_data['seat_no']}</label></center></td>
        <td><center><label>{$order_data['tour_pickup']}</label></center></td>
        <td><center><label>{$order_data['tour_drop']}</label></center></td>
        <td><center><label>{$seat_text}</label></center></td>
        <td><center><label>{$room_text}</label></center></td>
        <td><center><label>{$order_data['total_cost']}</label></center></td>
        <td><center><label>{$added_by}</label></center></td>
        <td><center><label>{$order_data['status']}</label></center></td>
        <td><center><label>{$updated_by}</label></center></td>
        <td><center><label>{$updated_on}</label></center></td>
        <td><center><a href="../../receipt.php?ticket={$order_data['ticket']}"  target="_blank">Receipt</a></center></td>
         <td>
            <center>
                <a href="../settings/add_ashtavinayak_booking.php?ticket={$order_data['ticket']}" class="small button" style="margin-bottom: -5px;">Update Booking</a>
            </center>
        </td>
    </tr>
HEREDOC;
}
if(empty($listingHtml)){
    $listingHtml = '<tr><td colspan="9"><center><label><b>No Record Found</b></label></center></t>';
}

echo <<<HEREDOC
    <table border="4">
        <tr>
           <th colspan="17">
                <h3 style="color: #000"><center>Ashtavinayak Orders</center></h3>
                <section>
                    <label style="float: left">Number of rows to display: &nbsp;&nbsp;&nbsp;</label>
                    <select id="cRows" style="width: 50px;float: left" value="10">
                        <option value="10" selected="selected">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                        <option value="40">40</option>
                        <option value="50">50</option>
                        <option value="60">60</option>
                        <option value="70">70</option>
                        <option value="80">80</option>
                        <option value="90">90</option>
                        <option value="100">100</option>
                    </select>
                    

               </section>
           </th> 
        </tr>
        <tr style="border:1px solid #000000;">
            <td style="width: 10%;" >
                <center>
                    <label><b>ID</b></label> 
                    <span><img id="product_up" src="../img/up.png" onclick="getListing(1,'ASC')" style="height:20px;width:20px;cursor:pointer;" />
                    </span>
                    <span><img id="product_down" src="../img/down.png" onclick="getListing(1,'DESC')" style="height:20px;width:20px;cursor:pointer;" /></span>
                </center>
                <input type="text" id="id" class="filter" placeholder="ID" value=""/>
            </td>
            <td>
                <center><label><b>Ticket</b></label></center>
                <input type="text" id="ticket" class="filter" placeholder="Ticket" name="ticket"/>
            </td>
            <td>
                <center><label><b>Tour ID</b></label></center>
                <input type="text" id="tour_id" class="filter" placeholder="Tour ID"  name="tour_id"/>
            </td>
            <td>
                <center><label><b>Date</b></label></center>
                <input type="text" id="tour_date" class="filter" placeholder="Date" name="tour_date"/>
            </td>
            <td>
                <center><label><b>Tour Type</b></label></center>
                <input type="text" id="tour_type" class="filter" placeholder="Tour Type" name="tour_type"/>
            </td>
            <td>
                <center><label><b>Seats</b></label></center>
                <input type="text" id="seat_no" class="filter" placeholder="Seats" name="seat_no"/>
            </td>
            <td>
                <center><label><b>Pickup Points</b></label></center>
                <input type="text" id="tour_pickup" class="filter" placeholder="Pickup Points"  name="tour_pickup"/>
            </td>
            <td>
                <center><label><b>Drop Points</b></label></center>
                <input type="text" id="tour_drop" class="filter" placeholder="Drop Points"  name="tour_drop"/>
            </td>
            <td>
                <center><label><b>Travellers</b></label></center>
                <input type="text" id="seat_data" class="filter" placeholder="Travellers" name="seat_data"/>
            </td>
            <td>
                <center><label><b>Rooms</b></label></center>
                <input type="text" id="room_data" class="filter" placeholder="Travellers" name="room_data"/>
            </td>
            <td>
                <center><label><b>Total Cost</b></label></center>
                <input type="text" id="total_cost" class="filter" placeholder="Total Cost"  name="total_cost"/>
            </td>
            <td>
                <center><label><b>Added By</b></label></center>
                <input type="text" id="added_by" class="filter" placeholder="Added By" name="added_by"/>
            </td>
            <td>
                <center><label><b>Status</b></label></center>
                <input type="text" id="status" class="filter" placeholder="Status" name="status"/>
            </td>
            <td>
                <center><label><b>Processed By</b></label></center>
                <input type="text" id="updated_by" class="filter" placeholder="Processed By" name="updated_by"/>
            </td>
            <td>
                <center><label><b>Processed On</b></label></center>
                <input type="text" id="updated_on" class="filter" placeholder="Processed On" name="updated_on"/>
            </td>
            <td>
                <center><label><b>Download</b></label></center>
            </td>
            <td>
                <center>
                    <input type="button" class="small button" value="Apply Filter" onclick="getListing(1,'DESC')" style="margin-top: 20px;" />
                </center>
            </td>
        </tr>
        
        {$listingHtml}
    </table>
    <div align="center">
HEREDOC;
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
