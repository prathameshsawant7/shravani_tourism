<?php
/* Smarty version 3.1.30, created on 2018-03-21 15:21:45
  from "E:\Inetpub\takeabreaktourism.com\www\demo\templates\listing.tpl" */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '3.1.30',
  'unifunc' => 'content_5ab22b3199d0e7_46809248',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '1cd24550a3937e14184f858d8f20e5a6f3075908' => 
    array (
      0 => 'E:\\Inetpub\\takeabreaktourism.com\\www\\demo\\templates\\listing.tpl',
      1 => 1521625890,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:header.tpl' => 1,
    'file:footer.tpl' => 1,
  ),
),false)) {
function content_5ab22b3199d0e7_46809248 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->configLoad->_loadConfigFile($_smarty_tpl, "test.conf", "setup", 0);
?>

<?php $_smarty_tpl->_subTemplateRender("file:header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>



<div class="container-fluid padding-none">
	    <!--Indian Tour-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bann-slider">
<p class="slider-top-text"><?php echo $_smarty_tpl->tpl_vars['heading']->value;?>
</p>
<!--
<p class="text-head-grey">What could be more romantic than a little time away with each other? The warm colours and twinkling lights set up a perfect scenario for your romantic memories. The seclusion and peace is the perfect way to begin your married life

Our honeymoon special tours include the most exotic destinations where you “BOTH “can cherish your “WE TIME. India or abroad, just pick from a plethora of options. Indulge yourself into this romantic escape with India’s best travel agency. Treat your partner with those little surprises, spend some time alone together. Group tours or tailor made packages, we have it all ready for you.

No matter what “romance” means to you, Take a Break Tourism takes you on hideaways, and retreats with packages designed to suit your every wish and whim. Customised holiday packages or group tour packages, Take a Break Tourism has a variety of tour options to choose from. Join our Honeymoon special tours and give a beautiful and romantic beginning to your married life. Treasure your memories with Take a Break Tourism. </p>
-->
	<?php if ($_smarty_tpl->tpl_vars['datacount']->value != 0) {?>
		<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['packages'], 'v', false, 'k');
if ($_from !== null) {
foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
?>
			<a href="tour.php?id=<?php echo $_smarty_tpl->tpl_vars['v']->value['id_tour'];?>
">
			    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 box-padd">
			        <div class=" padd-honey1">
						<div class="thumbnail thumbnail-honey">
					      <div class="item img-dom">
					      <?php if ($_smarty_tpl->tpl_vars['data']->value['listing_images'][$_smarty_tpl->tpl_vars['v']->value['id_tour']] != '') {?>
					      	<img src="images/tours/<?php echo $_smarty_tpl->tpl_vars['data']->value['listing_images'][$_smarty_tpl->tpl_vars['v']->value['id_tour']];?>
" class="img-responsive img-round img-dom" alt="<?php echo $_smarty_tpl->tpl_vars['v']->value['tour_name'];?>
">
					      <?php } else { ?>
					      	<img src="images/honey01.jpg" class="img-responsive img-round img-dom" alt="...">
					      <?php }?>
					      	<div class="caption caption-honey">
				          		<div class="col-xs-10 col-sm-4 col-md-8 col-lg-10 caption-text"><?php echo $_smarty_tpl->tpl_vars['v']->value['tour_name'];?>
</br><?php echo $_smarty_tpl->tpl_vars['v']->value['night_days'];?>

				          			<p class="yellow-text">Price from Rs.<?php echo $_smarty_tpl->tpl_vars['v']->value['price'];?>
/-</p>
				          		</div>
				          		<div class="col-xs-2 col-sm-4 col-md-4 col-lg-2 wish-icon"><i class="fa fa-heart" aria-hidden="true"></i></div>
				          		 <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="text-align: center;">
				          		 </div> 
			       			 </div>
					      </div>
					    </div>
			        </div>
				</div>
			</a>
		<?php
}
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl);
?>

	<?php } else { ?>
		<div class="col-xs-8 col-sm-4 col-md-8 col-lg-10 ">Coming Soon</div>
        <BR><BR><BR><BR><BR><BR><BR><BR><BR>
	<?php }?>
    

	
	</div>

<?php $_smarty_tpl->_subTemplateRender("file:footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
