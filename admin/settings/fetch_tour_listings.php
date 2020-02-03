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

if(isset($_POST['tour_code']) && $_POST['tour_code'] != '')
    $filter  .= "AND t.tour_code LIKE '%".$_POST['tour_code']."%' ";

if(isset($_POST['tour_name']) && $_POST['tour_name'] != '')
    $filter  .= "AND t.tour_name LIKE '%".$_POST['tour_name']."%' ";

if(isset($_POST['tour_region']) && $_POST['tour_region'] != '')
    $filter  .= "AND t.tour_region = ".$_POST['tour_region']." ";

if(isset($_POST['tour_state']) && $_POST['tour_state'] != '')
    $filter  .= "AND t.tour_state = ".$_POST['tour_state']." ";

if(isset($_POST['tour_duration']) && $_POST['tour_duration'] != '')
    $filter  .= "AND t.tour_duration LIKE '%".$_POST['tour_duration']."%' ";

if(isset($_POST['tour_places']) && $_POST['tour_places'] != '')
    $filter  .= "AND t.tour_places LIKE '%".$_POST['tour_places']."%' ";

if(isset($_POST['active']) && $_POST['active'] != '')
    $filter  .= "AND t.active = ".$_POST['active']." ";


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

$query = "SELECT t.id,t.tour_code,t.tour_name,t.display_image, r.name as tour_region, "
            . "s.state as tour_state,t.tour_duration, t.tour_places, t.active "
            . "FROM tours as t "
            . "LEFT JOIN regions AS r ON t.tour_region = r.id "
            . "LEFT JOIN states AS s ON t.tour_state = s.id_state "
            . "WHERE ".$filter." "
            . "ORDER BY $OrderBy LIMIT $page_position, $item_per_page";


//Limit our results within a specified range.
$fetch_data = mysqli_query($con,$query);
//$results->execute(); //Execute prepared Query
//$results->bind_result($id,$id_tour,$tour_name,$tour_location_category_name,$tour_type,$night_days,$price); //bind variables to prepared statement

$listingHtml = '';
$count = 1;

$query = "SELECT COUNT(*) FROM regions;";
$results = $con->query($query);


while($tour_data = $fetch_data->fetch_assoc()){ //fetch values
    $count++;
    $active = $tour_data['active'] ? 'Yes' : 'No';
    $listingHtml .= <<<HEREDOC
    <tr id="tr_{$tour_data['id']}" style="border:1px solid #000000;">
        <td><center><label>{$tour_data['id']}</label></center></td>
        <td><center><label>{$tour_data['tour_code']}</label></center></td>
        <td><center><label>{$tour_data['tour_name']}</label></center></td>
        <td style="width:150px;"><center><img id="display_image_preview" src="../../images/tours/{$tour_data['display_image']}" /></center></td>
        <td><center><label>{$tour_data['tour_region']}</label></center></td>
        <td><center><label>{$tour_data['tour_state']}</label></center></td>
        <td><center><label>{$tour_data['tour_duration']}</label></center></td>
        <td><center><label>{$tour_data['tour_places']}</label></center></td>
        <td><center><label>{$active}</label></center></td>
        <td>
            <center>
                <input type="button" class="small button" value="Edit" onclick="editTour({$tour_data['id']})" style="margin-bottom: -5px;" />
            </center>
        </td>
        <td>
            <center>
                <input type="button" class="small button" value="Delete" onclick="deleteTour({$tour_data['id']})" style="margin-bottom: -5px;"/>
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
           <th colspan="11">
                <h3 style="color: #000"><center>Tour Listings</center></h3>
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
                        <a href="add_tour.php" class="small button">Add New Tour</a>
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
                <center><label><b>Tour Code</b></label></center>
                <input type="text" id="tour_code" class="filter" placeholder="Tour Code" value="Tour Code"/>
            </td>
            <td>
                <center><label><b>Tour Name</b></label></center>
                <input type="text" id="tour_name" class="filter" placeholder="Tour Name" value="Tour Name"/>
            </td>
            <td>
                <center><label><b>Display Image</b></label></center>
            </td>
            <td>
                <center><label><b>Tour Region</b></label></center>
                <input type="text" id="tour_region" class="filter" placeholder="Tour Region" value="Tour Region"/>
            </td>
            <td>
                <center><label><b>Tour State</b></label></center>
                <input type="text" id="tour_state" class="filter" placeholder="Tour State" value="Tour State"/>
            </td>
            <td>
                <center><label><b>Tour Duration</b></label></center>
                <input type="text" id="tour_duration" class="filter" placeholder="Tour Duration" value="Tour Duration"/>
            </td>
            <td>
                <center><label><b>Tour Places</b></label></center>
                <input type="text" id="tour_places" class="filter" placeholder="Tour Places" value="Tour Places"/>
            </td>
            <td>
                <center><label><b>Active</b></label></center>
                <select id="active" class="filter" placeholder="Active/Inactive" value="Active/Inactive" >
                    <option value="" selected="selected">All</option>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
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
