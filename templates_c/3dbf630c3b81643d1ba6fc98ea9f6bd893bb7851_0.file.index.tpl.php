<?php
/* Smarty version 3.1.30, created on 2019-11-14 20:16:39
  from "/var/www/html/takeabreak/demo/templates/index.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5dcd68cf690b31_45622368',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '3dbf630c3b81643d1ba6fc98ea9f6bd893bb7851' => 
    array (
      0 => '/var/www/html/takeabreak/demo/templates/index.tpl',
      1 => 1573564415,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5dcd68cf690b31_45622368 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "test.conf", "setup", 0);
?>

<?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>



<div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
   
    </div>
    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
        <li data-target="#carousel-example-generic" data-slide-to="1"></li>
        <li data-target="#carousel-example-generic" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner carou-bor-radius">
        <div class="item active">
          <img src="images/family1.jpg" alt="...">
          
        </div>
        <div class="item">
          <img src="images/rajasthan1.jpg" alt="...">
          
        </div>
        <div class="item">
          <img src="images/shimala1.jpg" alt="...">
         
        </div>
      </div>
            <!-- Controls -->
      <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right"></span>
      </a>
    </div>
    <!--Social Media--
      <div class="social_doc">
    <ul>
      <li><a class="sprite icon_social_fb-small" target="_blank" href="#"> </a></li>
      <li><a class="sprite icon_social_insta-small" target="_blank" href="#"> </a></li>
      <li><a class="sprite icon_social_twitter-small" target="_blank" href="#"> </a></li>
      <li><a class="sprite icon_social_google-small" target="_blank" href="#"> </a></li>
      <li><a class="sprite icon_social_linkedin-small" target="_blank" href="#"> </a></li>
    </ul>
  </div>
      <!--Social Media-->
    <!--Indian Tour-->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bann-slider">
        <div class="slider-top-text">Indian Tour</div>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/raja2.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Rajasthan</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="location_listing.php?loc_cat=14" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
               <div class="item"><img src="images/anda2.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Andman</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="location_listing.php?loc_cat=1" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/Himachal2.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Himachal</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="location_listing.php?loc_cat=5" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/Kerala1.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Kerala</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="location_listing.php?loc_cat=8" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
    </div>
    <!--Indian Tour-->
    <!--International Tour-
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bann-slider">
        <div class="slider-top-text">International Tour</div>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/dubai.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Dubai</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="location_listing.php?loc_cat=17" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
               <div class="item"><img src="images/singapore.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Singapore</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="location_listing.php?loc_cat=16" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/malaysia.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Malaysia</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="location_listing.php?loc_cat=16" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-3 col-lg-3 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/srilanka.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6">
                  <p><strong>Sri Lanka</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 but-padd hidden-xs">
                <a href="location_listing.php?loc_cat=18" class="btn btn-primary but-grey" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
    </div>
    <!--International Tour-->
     <!--Speciality Tour-->
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bann-slider">
        <div class="slider-top-text">Speciality Tour</div>


        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/pilgrims.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height2">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-none">
                  <p><strong>Pilgrims Special</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 hidden-xs">
                <a href="listing.php?cat=4" class="btn btn-primary small-but" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/short-break.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height2">
              <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-none">
                  <p><strong>Short Break</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 hidden-xs">
                <a href="listing.php?cat=5" class="btn btn-primary small-but" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 padd">
            <div class="thumbnail padd-none">
               <div class="item"><img src="images/honey-moon.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height2">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-none">
                  <p><strong>Honeymoon Special</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 hidden-xs">
                <a href="listing.php?cat=6" class="btn btn-primary small-but" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/womens.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height2">
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-none">
                  <p><strong>Women's Special</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 hidden-xs">
                <a href="listing.php?cat=7" class="btn btn-primary small-but" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/senior.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height2">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-none">
                  <p><strong>Senior's Special</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 hidden-xs">
                <a href="listing.php?cat=8" class="btn btn-primary small-but" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-2 col-lg-2 padd">
            <div class="thumbnail padd-none">
              <div class="item img-dom"><img src="images/students.jpg" class="img-responsive img-round img-dom" alt="..."></div>
              <div class="caption thumb-height2">
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 padding-none">
                  <p><strong>Student's Special</strong></p>
               </div>
               <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 hidden-xs">
                <a href="listing.php?cat=9" class="btn btn-primary small-but" role="button">View More</a>
               </div>
              </div>
             </div>
        </div>
        
    </div>
<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>

<?php }
}
