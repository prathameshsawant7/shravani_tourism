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

if(isset($_POST['date']) && $_POST['date'] != '')
    $filter  .= "AND t.date LIKE '%".$_POST['date']."%' ";

if(isset($_POST['tour_id']) && $_POST['tour_id'] != '')
    $filter  .= "AND p.tour_code LIKE '%".$_POST['tour_id']."%' ";

if(isset($_POST['bus_id']) && $_POST['bus_id'] != '')
    $filter  .= "AND b.name LIKE '%".$_POST['bus_id']."%' ";

if(isset($_POST['seats']) && $_POST['seats'] != '')
    $filter  .= "AND t.seats LIKE '%".$_POST['seats']."%' ";

if(isset($_POST['added_by']) && $_POST['added_by'] != '')
    $filter  .= "AND a.name LIKE '%".$_POST['added_by']."%' ";

if(isset($_POST['updated_by']) && $_POST['updated_by'] != '')
    $filter  .= "AND u.name LIKE '%".$_POST['updated_by']."%' ";


if(isset($_POST['arrangeOrder'])){
    $OrderBy = "t.id ".$_POST['arrangeOrder'];
}
else{
    $OrderBy = "t.id DESC";
}

$query = "SELECT COUNT(*) FROM reserved_seats AS t "
        . "LEFT JOIN admin_users as a ON t.added_by = a.id "
        . "LEFT JOIN admin_users as u ON t.updated_by = u.id "
        . "LEFT JOIN tours as p ON p.id = t.tour_id "
        . "LEFT JOIN buses as b ON b.id = t.bus_id "
        . "WHERE ".$filter;
$results = $con->query($query);


$get_total_rows = $results->fetch_row(); //hold total records in variable

$total_pages = ceil($get_total_rows[0]/$item_per_page);

//position of records
$page_position = (($page_number-1) * $item_per_page);

$query = "SELECT t.id,t.date,p.tour_code,b.name,REPLACE(t.seats, '|', ' , ') as seats,a.name as added_by,u.name as updated_by "
            . "FROM reserved_seats AS t "
            . "LEFT JOIN admin_users as a ON t.added_by = a.id "
            . "LEFT JOIN admin_users as u ON t.updated_by = u.id "
            . "LEFT JOIN tours as p ON p.id = t.tour_id "
            . "LEFT JOIN buses as b ON b.id = t.bus_id "
            . "WHERE ".$filter." "
            . "ORDER BY $OrderBy LIMIT $page_position, $item_per_page";


//Limit our results within a specified range.
$fetch_data = mysqli_query($con,$query);
//$results->execute(); //Execute prepared Query
//$results->bind_result($id,$id_tour,$tour_name,$tour_location_category_name,$tour_type,$night_days,$price); //bind variables to prepared statement

$listingHtml = '';
$count = 1;

while($reserved_seats_data = $fetch_data->fetch_assoc()){ //fetch values
    $count++;
    $listingHtml .= <<<HEREDOC
    <tr id="tr_{$reserved_seats_data['id']}" style="border:1px solid #000000;">
        <td><center><label>{$reserved_seats_data['id']}</label></center></td>
        <td><center><label>{$reserved_seats_data['date']}</label></center></td>
        <td><center><label>{$reserved_seats_data['tour_code']}</label></center></td>
        <td><center><label>{$reserved_seats_data['name']}</label></center></td>
         <td><center><label>{$reserved_seats_data['seats']}</label></center></td>
        <td><center><label>{$reserved_seats_data['added_by']}</label></center></td>
        <td><center><label>{$reserved_seats_data['updated_by']}</label></center></td>
        <td>
            <center>
                <input type="button" class="small button" value="Edit" onclick="editReservedSeats({$reserved_seats_data['id']})" style="margin-bottom: -5px;" />
            </center>
        </td>
        <td>
            <center>
                <input type="button" class="small button" value="Delete" onclick="deleteReservedSeats({$reserved_seats_data['id']})" style="margin-bottom: -5px;"/>
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
           <th colspan="9">
                <h3 style="color: #000"><center>Reserved Seats</center></h3>
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
                    <span style="float: left;padding-left: 22px;margin-top: -5px;">
                        <a href="add_reserved_seats.php" class="small button">Add Reserved Seats</a>
                    </span>

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
                <center><label><b>Date</b></label></center>
                <input type="text" id="date" class="filter" placeholder="Date" value="Date"/>
            </td>
            <td>
                <center><label><b>Tour</b></label></center>
                <input type="text" id="tour_id" class="filter" placeholder="Tour" value="Tour"/>
            </td>
            <td>
                <center><label><b>Bus</b></label></center>
                <input type="text" id="bus_id" class="filter" placeholder="Bus" value="Bus"/>
            </td>
            <td>
                <center><label><b>Seats</b></label></center>
                <input type="text" id="seats" class="filter" placeholder="Seats" value="Seats"/>
            </td>
            <td>
                <center><label><b>Added By</b></label></center>
                <input type="text" id="added_by" class="filter" placeholder="Added By" name="added_by"/>
            </td>
            <td>
                <center><label><b>Updated By</b></label></center>
                <input type="text" id="updated_by" class="filter" placeholder="Updated By" name="updated_by"/>
            </td>
            <td colspan="2">
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
    