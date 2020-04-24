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

if(isset($_POST['token']) && $_POST['token'] != '')
    $filter  .= "AND t.token LIKE '%".$_POST['token']."%' ";

if(isset($_POST['name']) && $_POST['name'] != '')
    $filter  .= "AND t.name LIKE '%".$_POST['name']."%' ";

if(isset($_POST['mobile']) && $_POST['mobile'] != '')
    $filter  .= "AND t.mobile LIKE '%".$_POST['mobile']."%' ";

if(isset($_POST['email']) && $_POST['email'] != '')
    $filter  .= "AND t.email LIKE '%".$_POST['email']."%' ";

if(isset($_POST['status']) && $_POST['status'] != '')
    $filter  .= "AND t.status LIKE '%".$_POST['status']."%' ";


if(isset($_POST['arrangeOrder'])){
    $OrderBy = "t.id ".$_POST['arrangeOrder'];
}
else{
    $OrderBy = "t.id DESC";
}

$query = "SELECT COUNT(*) FROM tour_enquiries AS t WHERE ".$filter;
$results = $con->query($query);


$get_total_rows = $results->fetch_row(); //hold total records in variable

$total_pages = ceil($get_total_rows[0]/$item_per_page);

//position of records
$page_position = (($page_number-1) * $item_per_page);

$query = "SELECT * FROM tour_enquiries AS t "
            . "WHERE ".$filter." "
            . "ORDER BY $OrderBy LIMIT $page_position, $item_per_page";


//Limit our results within a specified range.
$fetch_data = mysqli_query($con,$query);

$listingHtml = '';
$count = 1;

while($enquiry_data = $fetch_data->fetch_assoc()){ //fetch values
    $count++;
    #$active = $enquiry_data['active'] ? 'Yes' : 'No';

    $listingHtml .= <<<HEREDOC
    <tr id="tr_{$enquiry_data['id']}" style="border:1px solid #000000;">
        <td><center><label>{$enquiry_data['id']}</label></center></td>
        <td><center><label>{$enquiry_data['token']}</label></center></td>
        <td><center><label>{$enquiry_data['name']}</label></center></td>
        <td><center><label>{$enquiry_data['email']}</label></center></td>
        <td><center><label>{$enquiry_data['mobile']}</label></center></td>
        <td><center><label style="text-transform: capitalize;">{$enquiry_data['status']}</label></center></td>
        <td><center><input type="button" class="small button" value="View / Update" onclick="editEnquiry({$enquiry_data['id']})" style="margin-bottom: -5px;" /></center></td>
    </tr>
HEREDOC;
}
if(empty($listingHtml)){
    $listingHtml = '<tr><td colspan="9"><center><label><b>No Record Found</b></label></center></t>';
}

$status_options = '<option value="">Please Select</option>';

foreach ($enquiry_statuses as $key => $value) {
    $status_options .= '<option value="'.$value.'" style="text-transform: capitalize;">'.$value.'</option>';
}

$status_div = '<select id="status">'.$status_options.'</select>';

echo <<<HEREDOC
    <table border="4">
        <tr>
           <th colspan="13">
                <h3 style="color: #000"><center>Enquiries</center></h3>
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
                        <a href="add_enquiry.php" class="small button">Add New enquiry</a>
                    </span>

               </section>
           </th> 
        </tr>
        <tr style="border:1px solid #000000;">
            <td style="width: 10%;" >
                <center>
                    <label><b>Enquiry ID</b></label> 
                    <span><img id="product_up" src="../img/up.png" onclick="getListing(1,'ASC')" style="height:20px;width:20px;cursor:pointer;" />
                    </span>
                    <span><img id="product_down" src="../img/down.png" onclick="getListing(1,'DESC')" style="height:20px;width:20px;cursor:pointer;" /></span>
                </center>
                <input type="text" id="id" class="filter" placeholder="ID" value=""/>
            </td>
            <td>
                <center><label><b>Enquiry Token</b></label></center>
                <input type="text" id="token" class="filter" placeholder="Enquiry Token" value=""/>
            </td>
            <td>
                <center><label><b>Name</b></label></center>
                <input type="text" id="name" class="filter" placeholder="Name" value=""/>
            </td>
            <td>
                <center><label><b>Email</b></label></center>
                <input type="text" id="email" class="filter" placeholder="Email" value=""/>
            </td>
            <td>
                <center><label><b>Mobile</b></label></center>
                <input type="text" id="mobile" class="filter" placeholder="Mobile" value=""/>
            </td>
            <td>
                <center><label><b>Status</b></label></center>
                <center>{$status_div}</center>
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
