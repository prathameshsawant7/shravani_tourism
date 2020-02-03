{config_load file="test.conf" section="setup"}
{include file="header.tpl"}


<div class="container-fluid padding-none">
	    <!--Indian Tour-->
<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 bann-slider">
<p class="slider-top-text">{$heading}</p>
<!--
<p class="text-head-grey">What could be more romantic than a little time away with each other? The warm colours and twinkling lights set up a perfect scenario for your romantic memories. The seclusion and peace is the perfect way to begin your married life

Our honeymoon special tours include the most exotic destinations where you “BOTH “can cherish your “WE TIME. India or abroad, just pick from a plethora of options. Indulge yourself into this romantic escape with India’s best travel agency. Treat your partner with those little surprises, spend some time alone together. Group tours or tailor made packages, we have it all ready for you.

No matter what “romance” means to you, Take a Break Tourism takes you on hideaways, and retreats with packages designed to suit your every wish and whim. Customised holiday packages or group tour packages, Take a Break Tourism has a variety of tour options to choose from. Join our Honeymoon special tours and give a beautiful and romantic beginning to your married life. Treasure your memories with Take a Break Tourism. </p>
-->
	{if $datacount neq 0}
		{foreach from=$data['packages'] key=k item=v}
			<a href="tour.php?id={$v['id_tour']}">
			    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-3 box-padd">
			        <div class=" padd-honey1">
						<div class="thumbnail thumbnail-honey">
					      <div class="item img-dom">
					      {if $data['listing_images'][$v['id_tour']] neq '' }
					      	<img src="images/tours/{$data['listing_images'][$v['id_tour']]}" class="img-responsive img-round img-dom" alt="{$v['tour_name']}">
					      {else}
					      	<img src="images/honey01.jpg" class="img-responsive img-round img-dom" alt="...">
					      {/if}
					      	<div class="caption caption-honey">
				          		<div class="col-xs-10 col-sm-4 col-md-8 col-lg-10 caption-text">{$v['tour_name']}</br>{$v['night_days']}
				          			<p class="yellow-text">Price from Rs.{$v['price']}/-</p>
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
		{/foreach}
	{else}
		<div class="col-xs-8 col-sm-4 col-md-8 col-lg-10 ">Coming Soon</div>
        <BR><BR><BR><BR><BR><BR><BR><BR><BR>
	{/if}
    

	
	</div>

{include file="footer.tpl"}