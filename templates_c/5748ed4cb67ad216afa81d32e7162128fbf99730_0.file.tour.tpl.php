<?php
/* Smarty version 3.1.30, created on 2018-03-18 01:14:03
  from "E:\Inetpub\takeabreaktourism.com\www\demo\templates\tour.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5aad7003641474_02734824',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5748ed4cb67ad216afa81d32e7162128fbf99730' => 
    array (
      0 => 'E:\\Inetpub\\takeabreaktourism.com\\www\\demo\\templates\\tour.tpl',
      1 => 1521315231,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5aad7003641474_02734824 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "test.conf", "setup", 0);
?>

<?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>




<div class="container-fluid padding-none">
	  
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bann-slider">

        <p class="pink-text-head"><?php echo $_smarty_tpl->tpl_vars['data']->value['tour']['tour_name'];?>
 <i class="fa fa-heart" aria-hidden="true"></i></p>
       

      <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4 padding-none">
        <div class="pack-details01">
          <div class="price-left"><strong><i class="fa fa-inr" aria-hidden="true"></i>
            <?php echo $_smarty_tpl->tpl_vars['data']->value['tour']['price'];?>
/-</strong>
          
            <a href="#myModalEnquire" class="red-text" data-toggle="modal"><button type="button" class="btn btn-default but-right">Enquire Now</button></a> 

            <!--myModalEnquire-->
             <div class="modal fade" id="myModalEnquire" role="dialog">
               <div class="modal-dialog modal-md">
                 <div class="modal-content1">
                     <div class="modal-header1">
                      <button type="button" class="close but-close" data-dismiss="modal">&times;</button>
                       <h5 class="modal-title mod-til"><i class="fa fa-paper-plane" aria-hidden="true"></i>
                            <strong>Send Enquiry</strong></h5>
                     </div>
                  <form method="post" name="tourEnquiryForm" id="tourEnquiryForm">
                  <div class="modal-body mod-body-enquiry">
                      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <span class="enquiry-popup-text" style="color: ##4F8A10;display: none;" id="enquiry_msg"></span>
                     </div>
                      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                        <div class="form-group fogp">
                          <input type="hidden" name="action" id="action" value="tourEnquiry">
                          <span class="enquiry-popup-text">Tour ID</span><input type="email" class="form-control-enquiry" id="id_tour" name="id_tour" value="<?php echo $_smarty_tpl->tpl_vars['data']->value['tour']['id_tour'];?>
" readonly="readonly">
                          <span class="enquiry-popup-text">Email Id<label style="color: #cc0000;font-size: 10px;display: none;" id="eenquiry_email"></label>
                          </span>
                          <input type="email" class="form-control-enquiry" id="enquiry_email" name="enquiry_email" placeholder="Email">
                          
                       </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
                      <span class="enquiry-popup-text">Name<label style="color: #cc0000;font-size: 10px;display: none;" id="eenquiry_name"></label>
                      </span>
                      <input type="text" class="form-control-enquiry" id="enquiry_name"  name="enquiry_name" placeholder="Name">
                      <span class="enquiry-popup-text">Contact No<label style="color: #cc0000;font-size: 10px;display: none;" id="eenquiry_mobile"></label>
                      </span>
                      <input type="text" class="form-control-enquiry" id="enquiry_mobile" name="enquiry_mobile" placeholder="mobile">
                      
                    </div>
                     
                     <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                      <span class="enquiry-popup-text">
                        <label class="radio-inline"><input type="radio" value="email" name="enquiry_method">Email Me</label>
                      </span>
                       <span class="enquiry-popup-text">
                        <label class="radio-inline"><input type="radio" value="call" name="enquiry_method">Call Me</label>
                      </span>
                      <span class="enquiry-popup-text"><input type="button" class="btn btn-default submit" onclick="tourEnquiry()" value="Submit"></span>
                   </div>
                   </div> 
                </div>
               </div>
             </div>
         <!--myModalEnquire-->




             <hr class="pkg_sep">         
          </div>
          <div class="text-grp-detail">
            <ul style="list-style:none;">
              <!--
              <li><i class="fa fa-users icon-padd" aria-hidden="true"></i><span style="padding: 3px;"><strong>Group Tour</strong></span></li> -->
              <li><ul style="list-style:none; margin:0px" class="padding-none"><i class="fa fa-map-marker icon-padd" aria-hidden="true"></i><span CitiesCities="padding: 10px;">Tour Code - <?php echo $_smarty_tpl->tpl_vars['data']->value['tour']['id_tour'];?>
</ul></span></li>
              <li><i class="fa fa fa-calendar icon-padd" aria-hidden="true"></i><span  class="small-text-grp" style="padding: 5px;"><strong><?php echo $_smarty_tpl->tpl_vars['data']->value['tour']['night_days'];?>
</strong></span>
              </li>
              <!--
               <li><i class="fa fa-clock-o icon-padd" aria-hidden="true"></i><span style="padding: 10px;"><strong>Tour Date</strong></span></li> -->
            </ul>
            <hr class="pkg_sep">
          </div>
          <div class="text-grp-detail">
            <ul style="list-style:none;">
              <li class="small-text-grp">Holiday Type</li>
              <li class="link-text"><?php echo $_smarty_tpl->tpl_vars['data']->value['tour']['tour_type'];?>
</li>
              <li class="small-text-grp">States</li>
              <li class="link-text"><?php echo $_smarty_tpl->tpl_vars['data']->value['tour']['state'];?>
</li>
              <li class="small-text-grp">Cities</li>
              <li class="link-text"><?php echo $_smarty_tpl->tpl_vars['data']->value['tour']['cities'];?>
</li>
            </ul>
            <hr class="pkg_sep">
          </div>
        </div>   
      </div>

       <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
        <!--Images Slider-->
         <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>
      <?php $_smarty_tpl->_assignInScope('sliderImg', "active");
?>
      <!-- Wrapper for slides -->
      <div class="carousel-inner carou-bor-radius">
        <?php if (count($_smarty_tpl->tpl_vars['data']->value['tour_images']) != 0) {?>
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['tour_images'], 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
            <div class="item <?php echo $_smarty_tpl->tpl_vars['sliderImg']->value;?>
">
              <img src="images/tours/<?php echo $_smarty_tpl->tpl_vars['v']->value['image'];?>
">
            </div>
            <?php $_smarty_tpl->_assignInScope('sliderImg', '');
?>
          <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

        <?php } else { ?>
            <div class="item active">
              <img src="images/family1.jpg" alt="...">
            </div>
            <div class="item">
              <img src="images/rajasthan1.jpg" alt="...">
            </div>
            <div class="item">
              <img src="images/shimala1.jpg" alt="...">
            </div>
        <?php }?>
      </div>
            <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div>
        <!--Images Slider-->
  <!--Table-panel-->
  <p style="margin-top:20px"></p>
            <div id="tab" class="btn-group" data-toggle="buttons-radio">
              <a href="#overview" class="btn btn-large btn-info active but-tab-panel" data-toggle="tab">Overview</a>
              <a href="#hotels" class="btn btn-large btn-info but-tab-panel" data-toggle="tab">Hotels Details</a>
              <a href="#inclusions" class="btn btn-large btn-info but-tab-panel" data-toggle="tab">Inclusions</a>
              <a href="#exclusions" class="btn btn-large btn-info but-tab-panel"  data-toggle="tab">Exclusions</a>
              <a href="#rates" class="btn btn-large btn-info but-tab-panel"  data-toggle="tab">Rates</a>
            </div>
             
            <div class="tab-content">
              <div class="tab-pane active" id="overview">
                <br>
                  
                <p class="lead">Itinerary Highlights</p>
                <hr>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['tour_details'], 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                      <div class="itnry_inr_row">
                          <div class="itnry_head_wrap">
                              <span class="days_box"><strong>Day <?php echo $_smarty_tpl->tpl_vars['v']->value['day'];?>
</span> <span class="itnry_heading">: <?php echo $_smarty_tpl->tpl_vars['v']->value['activity'];?>
</span></strong>
                          </div>
                          <div class="touritnry-detail">
                            <p><?php echo $_smarty_tpl->tpl_vars['v']->value['sightseens'];?>
</p>                 
                          </div>
                      </div><BR>
                  <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                        
              </div>

              <!--Panel 2-->
              <div class="tab-pane" id="hotels">
                    <br>
                <p class="lead">Hotel Details</p>
                <div class="ow">
                    <table border="1" width="600px"  class="table table-bordered">
                      <thead>
                        <tr>
                          <th> Place </th>
                          <th> Hotel </th>
                          <th> Category </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['tour_hotels'], 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                          <tr>
                            <td> <?php echo $_smarty_tpl->tpl_vars['v']->value['place'];?>
 </td>
                            <td> <?php echo $_smarty_tpl->tpl_vars['v']->value['hotel_name'];?>
 </td>
                            <td> <?php echo $_smarty_tpl->tpl_vars['v']->value['hotel_category'];?>
 </td>
                          </tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                      </tbody>
                    </table>
                    <BR><BR><BR>
                </div>
              </div>
              <!--Panel 2-->

              <!--Panel 3-->
              <div class="tab-pane" id="inclusions">
                    <br>
                <div class="ow">
                   
                    <div class="span5">
                      <p><?php echo $_smarty_tpl->tpl_vars['data']->value['tour']['package_inclusion'];?>
</p> 
                    </div>
                    
                </div>
              </div>
              <!--Panel 3-->

              <!--Panel 4-->
              <div class="tab-pane" id="exclusions">
                    <br>
                <div class="ow">
                    <div class="span5">
                      <p><?php echo $_smarty_tpl->tpl_vars['data']->value['tour']['package_exclusion'];?>
</p> 
                    </div>
                </div>
              </div>
              <!--Panel 4-->

              <!--Panel 4-->
              <div class="tab-pane" id="rates">
                <br>
                <div class="ow">
                    <table border="1" width="850px" class="table table-bordered">
                      <thead>
                        <tr>
                          <th> Category </th>
                          <th> MAPAI </th>
                          <th> APAI </th>
                          <th> Pax 2 </th>
                          <th> Pax 4 </th>
                          <th> Pax 6 </th>
                          <th> Pax 8 </th>
                          <th> Supplement Meal </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['tour_rates'], 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
                          <tr>
                            <td> <?php echo $_smarty_tpl->tpl_vars['v']->value['hotel_category'];?>
 </td>
                            <td>
                            <?php if ($_smarty_tpl->tpl_vars['v']->value['mapai'] != 0) {?>
                             Rs. <?php echo $_smarty_tpl->tpl_vars['v']->value['mapai'];?>
/- 
                            <?php } else { ?>
                              -
                            <?php }?>
                            </td>
                            <td> 
                            <?php if ($_smarty_tpl->tpl_vars['v']->value['apai'] != 0) {?>
                             Rs. <?php echo $_smarty_tpl->tpl_vars['v']->value['apai'];?>
/- 
                            <?php } else { ?>
                              -
                            <?php }?>
                            </td>
                            <td>
                            <?php if ($_smarty_tpl->tpl_vars['v']->value['cost_with_pax_2'] != 0) {?>
                             Rs. <?php echo $_smarty_tpl->tpl_vars['v']->value['cost_with_pax_2'];?>
/- 
                            <?php } else { ?>
                              -
                            <?php }?>
                            </td>
                            <td>
                            <?php if ($_smarty_tpl->tpl_vars['v']->value['cost_with_pax_4'] != 0) {?>
                             Rs. <?php echo $_smarty_tpl->tpl_vars['v']->value['cost_with_pax_4'];?>
/- 
                            <?php } else { ?>
                              -
                            <?php }?>
                            </td>
                            <td>
                            <?php if ($_smarty_tpl->tpl_vars['v']->value['cost_with_pax_6'] != 0) {?>
                             Rs. <?php echo $_smarty_tpl->tpl_vars['v']->value['cost_with_pax_6'];?>
/- 
                            <?php } else { ?>
                              -
                            <?php }?>
                            </td>
                            <td>
                            <?php if ($_smarty_tpl->tpl_vars['v']->value['cost_with_pax_8'] != 0) {?>
                             Rs. <?php echo $_smarty_tpl->tpl_vars['v']->value['cost_with_pax_8'];?>
/- 
                            <?php } else { ?>
                              -
                            <?php }?>
                            </td>
                            <td>
                            <?php if ($_smarty_tpl->tpl_vars['v']->value['supplement_meal'] != 0) {?>
                             Rs. <?php echo $_smarty_tpl->tpl_vars['v']->value['supplement_meal'];?>
/- 
                            <?php } else { ?>
                              -
                            <?php }?>
                            </td>
                          </tr>
                        <?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

                      </tbody>
                    </table>
                    <BR><BR><BR>
                </div>
              </div>
              <!--Panel 4-->

            </div>
        </div>
        <!--Table-panel-->
  </div>
</div>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php echo '<script'; ?>
 type="text/javascript" src="js/enquiry.js"><?php echo '</script'; ?>
><?php }
}
