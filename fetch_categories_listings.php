<?php

include_once("configs/defines.php");
include("configs/settings.php");
$est =new settings();
$con=$est->connection();

if(isset($_POST["page"]))
{
    $page_number = filter_var($_POST["page"], FILTER_SANITIZE_NUMBER_INT, FILTER_FLAG_STRIP_HIGH);
    if(!is_numeric($page_number))
        {die('Invalid page number!');}
}
else
{
    $page_number = 1; 
}



$filter = ' ';
$OrderBy= "";


if($_POST['cRows'] != 0)
    $item_per_page = $_POST['cRows'];
else 
    $item_per_page = 10;

$q = (isset($_POST['q']) && $_POST['q'] != '')?$_POST['q']:'';
$search = (isset($_POST['search']) && $_POST['search'] != '')?$_POST['search']:'';

if(isset($_POST['tour_category']) && $_POST['tour_category'] != ''){
    $tour_category = $_POST['tour_category'];
    $query = "SELECT id FROM tour_categories WHERE name = '".$tour_category."';";
    $fetch_data = mysqli_query($con,$query);
    $tour_category_data = $fetch_data->fetch_assoc();    
}
$tour_category_id = (isset($tour_category_data['id']) && $tour_category_data['id']!='')?$tour_category_data['id']:'';


if(isset($_POST['tour_subcategory']) && $_POST['tour_subcategory'] != ''){
    $tour_subcategory = $_POST['tour_subcategory'];
    $query = "SELECT id FROM tour_subcategories WHERE name = '".$tour_subcategory."' AND category_id = '".$tour_category_id."';";
    $fetch_data = mysqli_query($con,$query);
    $tour_subcategory_data = $fetch_data->fetch_assoc();    
}
$tour_subcategory_id = (isset($tour_subcategory_data['id']) && $tour_subcategory_data['id']!='')?$tour_subcategory_data['id']:'';


if($tour_category_id != '')
    $filter  .= "AND FIND_IN_SET(".$tour_category_id.", t.tour_categories) ";

if($tour_subcategory_id != '')
    $filter  .= "AND FIND_IN_SET(".$tour_subcategory_id.", t.tour_subcategories) ";

if(isset($_POST['tour_region']) && $_POST['tour_region'] != ''){
    $filter  .= "AND t.tour_region = ".$_POST['tour_region']." ";
}

if(isset($_POST['tour_state']) && $_POST['tour_state'] != '')
    $filter  .= "AND t.tour_state = ".$_POST['tour_state']." ";

if(isset($_POST['tour_duration']) && $_POST['tour_duration'] != '')
    $filter  .= "AND t.tour_duration = '".$_POST['tour_duration']."' ";


if(isset($_POST['tour_price']) && $_POST['tour_price'] != ''){
    $prices = split('-', $_POST['tour_price']);
    $min = $prices[0];
    $max = $prices[1];
    $filter  .= "AND t.tour_price BETWEEN ". $min ." AND ".$max." ";
}
// if(isset($_POST['active']) && $_POST['active'] != '')
//     $filter  .= "AND t.active = ".$_POST['active']." ";


if(isset($_POST['arrangeOrder'])){
    $OrderBy = "t.id ".$_POST['arrangeOrder'];
}
else{
    $OrderBy = "t.id DESC";
}



if($search != ''){
    $query = "SELECT COUNT(*) FROM `tours` as t  LEFT JOIN states as s ON s.id_state = t.tour_state LEFT JOIN regions as r ON r.id = t.tour_region  WHERE (t.tour_name LIKE '%$search%'  OR t.tour_code LIKE '%$search%' OR t.tour_places LIKE '%$search%' OR s.state  LIKE '%$search%'  OR r.name  LIKE '%$search%'  OR FIND_IN_SET((SELECT id FROM tour_categories WHERE name LIKE '%$search%' LIMIT 1), t.tour_categories) OR FIND_IN_SET((SELECT id FROM tour_subcategories WHERE name LIKE '%$search%' LIMIT 1), t.tour_subcategories)) AND t.active = 1 ".$filter;

    $results = $con->query($query);
    $get_total_rows = $results->fetch_row(); 
    $total_pages = ceil($get_total_rows[0]/$item_per_page);
    $page_position = (($page_number-1) * $item_per_page);

    $query = "SELECT t.*  FROM `tours` as t  LEFT JOIN states as s ON s.id_state = t.tour_state LEFT JOIN regions as r ON r.id = t.tour_region  WHERE (t.tour_name LIKE '%$search%'  OR t.tour_code LIKE '%$search%' OR t.tour_places LIKE '%$search%' OR s.state  LIKE '%$search%'  OR r.name  LIKE '%$search%'  OR FIND_IN_SET((SELECT id FROM tour_categories WHERE name LIKE '%$search%' LIMIT 1), t.tour_categories) OR FIND_IN_SET((SELECT id FROM tour_subcategories WHERE name LIKE '%$search%' LIMIT 1), t.tour_subcategories)) AND t.active = 1 ".$filter." ORDER BY $OrderBy LIMIT $page_position, $item_per_page;";
    
}else{
    $query = "SELECT COUNT(*) FROM tours as t WHERE t.active=1 ".$filter;

    $results = $con->query($query);
    $get_total_rows = $results->fetch_row(); 
    $total_pages = ceil($get_total_rows[0]/$item_per_page);
    $page_position = (($page_number-1) * $item_per_page);

    $query = "SELECT t.* FROM tours as t "
        . "WHERE t.active=1 ".$filter." "
        . "ORDER BY $OrderBy LIMIT $page_position, $item_per_page;";

}


$fetch_data = mysqli_query($con,$query);

$listingHtml = '';
$toursHtml = '';
$count = 1;


$region_filter = [];
$state_filter = [];
$duration_filter = [];
$min_price = 0;
$max_price = 0;
while($listing_data = $fetch_data->fetch_assoc()){ 
    $count++;
    $url = "package-details.php?q=".$q."&id=".$listing_data['id'];
    $toursHtml .= '<div class="col-6 col-sm-3 col-md-3 col-lg-3 mb-3">';
    $toursHtml .= '<div class="card card-bor">';
    $toursHtml .= '<a href="'.$url.'" >';
    $toursHtml .= '<img class="card-img-top card-img-bor-rad img-fluid" src="images/tours/'.$listing_data['display_image'].'" alt="Card image" style="width:100%">';
    $toursHtml .= '<div class="card-body text-center">';
    $toursHtml .= '<h6 class="card-title text-uppercase">'.$listing_data['tour_name'].'</h6>';
    $toursHtml .= '</a>';
    $toursHtml .= '</div>';
    $toursHtml .= '</div>';
    $toursHtml .= '</div>';
}

$region_html = '';

// if(!empty($region_filter)){
//     $regions = implode(',', $region_filter);
$query = "SELECT DISTINCT r.id,r.name FROM regions as r "  
        . "LEFT JOIN tours as t ON t.tour_region = r.id " 
        . "WHERE r.active=1 AND t.active=1";
$fetch_data = mysqli_query($con,$query);
$region_html .= '<div class="col-sm-2 col-md-2 col-lg-2 form-group bor-right">';
$region_html .= '<h6>Select Region</h6>';
$region_html .= '<div class="row">';
$region_html .= '<div class="col-sm-12 col-md-12 col-lg-12 pr-5">';
$region_html .= '<select class="custom-select tour-search" id="filter_region" onchange="filtered(this)">';
$region_html .= '<option value="">Please select</option>';
while($region_data = $fetch_data->fetch_assoc()){
    $selection = (isset($_POST['tour_region']) && $_POST['tour_region'] == $region_data['id'])?'selected="selected"':'';
    $region_html .= '<option value="'.$region_data['id'].'" '.$selection.'>'.$region_data['name'].'</option>';
}
$region_html .= '</select>';
$region_html .= '</div>';
$region_html .= '</div>';
$region_html .= '</div>';
//}

$state_html = '';
// $states = implode(',', $state_filter);
$query = "SELECT DISTINCT s.id_state,s.state FROM states as s "  
        . "LEFT JOIN tours as t ON t.tour_state = s.id_state " 
        . "WHERE s.active=1 AND t.active=1;";
$fetch_data = mysqli_query($con,$query);
$state_html .= '<div class="col-sm-2 col-md-2 col-lg-2 form-group bor-right">';
$state_html .= '<h6>Select State</h6>';
$state_html .= '<div class="row">';
$state_html .= '<div class="col-sm-12 col-md-12 col-lg-12 pr-5">';
$state_html .= '<select class="custom-select tour-search" id="filter_state" onchange="filtered(this)">';
$state_html .= '<option value="">Please select</option>';
while($state_data = $fetch_data->fetch_assoc()){
    $selection = (isset($_POST['tour_state']) && $_POST['tour_state'] == $state_data['id_state'])?'selected="selected"':'';
    $state_html .= '<option value="'.$state_data['id_state'].'" '.$selection.'>'.$state_data['state'].'</option>';
}
$state_html .= '</select>';
$state_html .= '</div>';
$state_html .= '</div>';
$state_html .= '</div>';


$query = "SELECT min(tour_price) as min, max(tour_price) as max FROM tours as t "  
        . "WHERE t.active=1;";
$fetch_data = mysqli_query($con,$query);
$price_data = $fetch_data->fetch_assoc();
$min_price  = $price_data['min'];
$max_price  = $price_data['max'];
$price_html .= '<div class="col-sm-4 col-md-4 col-lg-4 form-group bor-right">';
$price_html .= '<h6>Budget Per Person</h6>';
$price_html .= '<div class="row">';
$price_html .= '<div class="col-sm-6 col-md-6 col-lg-6">';
$price_html .= '<div class="col-sm-12 col-md-12 col-lg-12 nopadd-mar">';
$price_html .= '<select class="custom-select tour-search" id="filter_price" onchange="filtered(this)" style="width:200%;">';
$price_html .= '<option value="">Please select</option>';

$price_counter = ($max_price == $min_price)?1:5;
$price_diff = (int)(($max_price-$min_price)/$price_counter);
for($i=0;$i<$price_counter;$i++){
    if($i==0){
        $min = $min_price;
        $max = $min_price + $price_diff;
    }else if($i== 4){
        $min = $max + 1;
        $max = $max_price;
    }else{
        $min = $max + 1;
        $max = $min + $price_diff;
    }
    $val = $min.'-'.$max;
    $selection = (isset($_POST['tour_price']) && $_POST['tour_price'] == $val)?'selected="selected"':'';
    $price_html .= '<option value="'.$val.'" '.$selection.'>₹'.money_format('%!i', $min).'&nbsp; - &nbsp;₹'.money_format('%!i', $max).'</option>';
}
$price_html .= '</select>';
$price_html .= '</div>';
$price_html .= '</div>';
$price_html .= '</div>';
$price_html .= '</div>';


$query = "SELECT DISTINCT t.tour_duration FROM tours as t "  
        . "WHERE t.active=1;";
$fetch_data = mysqli_query($con,$query);
$duration_html .= '<div class="col-sm-4 col-md-4 col-lg-4 form-group bor-right">';
$duration_html .= '<h6>Duration</h6>';
$duration_html .= '<div class="row">';
$duration_html .= '<div class="col-sm-6 col-md-6 col-lg-6">';
$duration_html .= '<div class="col-sm-12 col-md-12 col-lg-12 nopadd-mar">';
$duration_html .= '<select class="custom-select tour-search" id="filter_duration" style="width:200%;" onchange="filtered(this)">';
$duration_html .= '<option value="">Please select</option>';

while($duration_data = $fetch_data->fetch_assoc()){
    $selection = (isset($_POST['tour_duration']) && $_POST['tour_duration'] == $duration_data['tour_duration'])?'selected="selected"':'';
    $duration_html .= '<option value="'.$duration_data['tour_duration'].'" '.$selection.'>'.$duration_data['tour_duration'].'</option>';
}

// $duration_diff = (int)(($max_duration-$min_duration)/5);
// for($i=0;$i<count($duration_filter);$i++){
//     $selection = (isset($_POST['tour_duration']) && $_POST['tour_duration'] == $duration_filter[$i])?'selected="selected"':'';
//     $duration_html .= '<option value="'.$duration_filter[$i].'" '.$selection.'>'.$duration_filter[$i].'</option>';
// }
$duration_html .= '</select>';
$duration_html .= '</div>';
$duration_html .= '</div>';
$duration_html .= '</div>';
$duration_html .= '</div>';

// $heading = ''
// if($tour_category != ''){
//     $heading = $tour_category
// }
$listingHtml .= '<div class="row m-4">';
$listingHtml .= $region_html;
$listingHtml .= $state_html;
$listingHtml .= $price_html;
$listingHtml .= $duration_html;
$listingHtml .= '<div class="container">';
$listingHtml .= '<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">';
$listingHtml .= '<h4 class="text-center text-uppercase pt-4 pb-4">'.$q.'</h4>';
$listingHtml .= '<div class="row">';
if($toursHtml != '')
    $listingHtml .= $toursHtml;
else{
    $listingHtml .=  "<BR><BR><BR><h5 class='text-center'>No records found for selected criteria. Please reach to us via phone ".$site_cms['site_phone']." or email us at ".$site_cms['site_email']." to know more about your search criteria.</h5>";
}
$listingHtml .= '</div></div>';
$listingHtml .= '<div class="col- col-sm-12 col-md-12 col-lg-12">';
$listingHtml .= paginate_function($item_per_page, $page_number, $get_total_rows[0], $total_pages);
$listingHtml .= '</div></div>';

echo $listingHtml;



// <div class="col- col-sm-12 col-md-12 col-lg-12">
//         <ul class="pagination pagination-sm">
//             <li class="page-item"><a class="page-link pg-link" href="#">Previous</a></li>
//             <li class="page-item"><a class="page-link pg-link" href="#">1</a></li>
//             <li class="page-item"><a class="page-link pg-link" href="#">2</a></li>
//             <li class="page-item"><a class="page-link pg-link" href="#">3</a></li>
//             <li class="page-item"><a class="page-link pg-link" href="#">Next</a></li>
//         </ul>
//     </div>

function paginate_function($item_per_page, $current_page, $total_records, $total_pages)
{
    $pagination = '';
    if($total_pages > 0 && $total_pages != 1 && $current_page <= $total_pages){ //verify total pages and current page number
        $pagination .= '<ul class="pagination pagination-sm">';
       
        $right_links    = $current_page + 3;
        $previous       = $current_page - 3; //previous link
        $next           = $current_page + 1; //next link
        $first_link     = true; //boolean var to decide our first link
       
        if($current_page > 1){
            $previous_link = ($previous==0)?1:$previous;
//            if($current_page == 2)
//                $previous_link = 1;
            $previous_link = $current_page - 1;
            
            $pagination .= '<li class="page-item first"><a class="page-link pg-link" href="#" data-page="1" title="First">&laquo;</a></li>'; //first link
            $pagination .= '<li class="page-item"><a class="page-link pg-link" href="#" data-page="'.$previous_link.'" title="Previous">&lt;</a></li>'; //previous link
                for($i = ($current_page-2); $i < $current_page; $i++){ //Create left-hand side links
                    if($i > 0){
                        $pagination .= '<li class="page-item"><a class="page-link pg-link" href="#" data-page="'.$i.'" title="Page'.$i.'">'.$i.'</a></li>';
                    }
                }  
            $first_link = false; //set first link to false
        }
       
        if($first_link){ //if current active page is first link
            $pagination .= '<li class="page-item first active"><label class="page-link">'.$current_page.'</label></li>';
        }elseif($current_page == $total_pages){ //if it's the last active link
            $pagination .= '<li class="page-item last active"><label class="page-link">'.$current_page.'</label></li>';
        }else{ //regular current link
            $pagination .= '<li class="page-item active"><label class="page-link">'.$current_page.'</label></li>';
        }
               
        for($i = $current_page+1; $i < $right_links ; $i++){ //create right-hand side links
            if($i<=$total_pages){
                $pagination .= '<li class="page-item"><a class="page-link pg-link" href="#" data-page="'.$i.'" title="Page '.$i.'">'.$i.'</a></li>';
            }
        }
        if($current_page < $total_pages){
                $next_link = ($i > $total_pages)? $total_pages : $i;
                $pagination .= '<li class="page-item"><a class="page-link pg-link" href="#" data-page="'.$next_link.'" title="Next">&gt;</a></li>'; //next link
                $pagination .= '<li class="page-item last"><a class="page-link pg-link" href="#" data-page="'.$total_pages.'" title="Last">&raquo;</a></li>'; //last link
        }
       
        $pagination .= '</ul>';
    }
    return $pagination; //return pagination links
}


?>
