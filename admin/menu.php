<?php
    session_start();
    if(!isset($_SESSION['cID'])){
        header('Location:../index.php'); 
    }
?>
<div class="large-12 columns header text-center">
    <div class="large-12 columns">
        <h2>Shravani Tourism Admin</h2>
    </div>
</div>
<div class="large-12  menu columns">

    <div class="title-bar off-canvas-wrapper" data-responsive-toggle="example-menu" data-hide-for="medium">
      <button class="menu-icon" type="button" data-toggle="offCanvas"></button>
      <div class="title-bar-title">Menu</div>
    </div>

    <div class="top-bar" id="example-menu">
      <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
          <!-- <li><a href='\<?php echo ADMINROOT;?>/home/index.php'><span>Home</span></a></li>  -->
            <li class='has-sub'><a href='#'><span>Tours</span></a>
                <ul class="menu vertical" style="z-index: 9999999;">
                    <li><a href='\<?php echo ADMINROOT;?>\settings\index.php'><span>Tour Packages</span></a></li>
                    <li><a href='\<?php echo ADMINROOT;?>\settings\configurations.php'><span>Tour Configurations</span></a></li>
                    <li>
                        <a href='#'><span>Tour Categories</span></a>
                        <ul class="menu vertical" style="z-index: 9999999;">
                            <li><a href='\<?php echo ADMINROOT;?>\settings\categories.php'><span>Categories</span></a></li>
                            <li><a href='\<?php echo ADMINROOT;?>\settings\sub_categories.php'><span>Sub Categories</span></a></li>
                        </ul>
                    </li>

                    <li><a href='\<?php echo ADMINROOT;?>\settings\import_group_tour_dates.php'><span>Group Tour Dates</span></a></li>
                    <li>
                        <a href='#'><span>Bus Settings</span></a>
                        <ul class="menu vertical" style="z-index: 9999999;">
                            <li><a href='\<?php echo ADMINROOT;?>\settings\import_bus_dates.php'><span>Import Bus Dates</span></a></li>
                            <li><a href='\<?php echo ADMINROOT;?>\settings\reserved_seats.php'><span>Reserve Seats</span></a></li>
                        </ul>
                        
                    </li>
                    <li>
                        <a href='#'><span>Pickup/Drop</span></a>
                        <ul class="menu vertical" style="z-index: 9999999;">
                            <li><a href='\<?php echo ADMINROOT;?>\settings\ashtavinayak_pickup.php'><span>Pickup Points</span></a></li>
                            <li><a href='\<?php echo ADMINROOT;?>\settings\ashtavinayak_drop.php'><span>Drop Points</span></a></li>
                        </ul>
                    </li>
                    
                    <li><a href='\<?php echo ADMINROOT;?>\settings\region_list.php'><span>Regions</span></a></li>
                    <li><a href='\<?php echo ADMINROOT;?>\settings\state_list.php'><span>States</span></a></li>
                    
<!--                         <li><a href='<?php echo WEBROOT;?>\listings\export.php'><span>Export Listing</span></a></li>
 --><!--                        <li><a href='<?php echo WEBROOT;?>/listings/upload.php'><span>Product Upload</span></a></li>
                        <li><a href='<?php echo WEBROOT;?>/listings/bulkupload.php'><span>Product Bulk Upload</span></a></li>-->
                    </ul>
                </li>
                <li class='has-sub'><a href='#'><span>Site</span></a>
                    <ul class="menu vertical" style="z-index: 9999999;">
                        <li><a href='\<?php echo ADMINROOT;?>\settings\site_images.php'><span>Site Images</span></a></li>
                        <li><a href='\<?php echo ADMINROOT;?>\settings\site_cms.php'><span>Site Pages CMS</span></a></li>
                        <li><a href='\<?php echo ADMINROOT;?>\settings\site_content.php'><span>Site Content</span></a></li>
                    </ul>
                </li>
                <li class='has-sub'><a href='#'><span>Bookings</span></a>
                    <ul class="menu vertical"  style="z-index: 9999999;">
                        <li><a href='\<?php echo ADMINROOT;?>\orders\ashtavinayak.php'><span>Ashtavinayak</span></a></li>
                        <!-- <li><a href='<?php echo WEBROOT;?>/orders/orders.php'><span>Order List</span></a></li>
                        <li><a href='<?php echo WEBROOT;?>/orders/export.php'><span>Order Export</span></a></li> -->
                    </ul>    
                        <!-- <ul class="menu vertical">
                        <li><a href='<?php //echo WEBROOT;?>/orders/orders.php'><span>Active Orders</span></a></li>
                        <li><a href='#'><span>Cancelled Orders</span></a></li>
                    </ul> -->
                </li>
                <li class='has-sub'><a href='\<?php echo ADMINROOT;?>\enquiry\index.php'><span>Enquires</span></a></li>
                <li class='has-sub'><a href='#'><span>Reports</span></a>
                    <ul class="menu vertical"  style="z-index: 9999999;">
                        <li><a href='\<?php echo ADMINROOT;?>\reports\bus_chart.php'><span>Generate Bus Chart</span></a></li>
                    </ul> 
                </li>
                <li class='has-sub'><a href='#'><span>Users</span></a>
                        <ul class="menu vertical" style="z-index: 9999999;">
                            <li><a href='\<?php echo ADMINROOT;?>\aUsers\register.php'><span>Add Users </span></a></li>
                            <li><a href='\<?php echo ADMINROOT;?>\aUsers\index.php'><span>Admin Users List</span></a></li>
                            <li><a href='\<?php echo ADMINROOT;?>\aUsers\site_index.php'><span>Site Users List</span></a></li>
                        </ul>
                    </li>
                    <li class='last'><a href='\<?php echo ADMINROOT;?>\logout.php'><span>Logout</span></a></li>
        </ul>
      </div>
    </div>
</div>

