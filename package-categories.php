<?php
$tour_category = str_replace("-"," ",$url_params['tour']);
$tour_region = (isset($url_params['region']) && $url_params['region'] != '')?$url_params['region']:'';
$tour_state = (isset($url_params['state']) && $url_params['state'] != '')?$url_params['state']:'';
$tour_price = (isset($url_params['price']) && $url_params['price'] != '')?$url_params['price']:'';
$tour_duration = (isset($url_params['duration']) && $url_params['duration'] != '')?$url_params['duration']:'';
?>
<BR>
<div class="col- col-sm-12 col-md-12 col-lg-12">
	<ul class="breadcrumb br-crum">
	    <li class="breadcrumb-item"><a href="#">Home</a></li>
	    <li class="breadcrumb-item active"><?php echo $tour_category;?></li>
  	</ul>
</div>
<div class="large-12 columns no-pad" id="loading" style="display: none">
    <center>    
        <img id="img_Loading" src="../img/loading.gif" alt="" height="100%" width="100%"/>
    </center>
</div>
<form id="table_tour_list">
	<div class="row m-4">
		<!--Hotel Category-->	
		<div class="col-sm-2 col-md-2 col-lg-2 form-group bor-right">
			<h6>Hotel Category</h6>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 pr-5">
					 	 <select class="custom-select tour-search" id="sel1">
					    <option selected>2 Star *</option>
					    <option>3 Star *</option>
					    <option>4 Star *</option>
					    <option>5 Star *</option>
					  </select>
				</div>
			</div>
		</div>
		<!--Hotel Category-->
		<!--TourDestinations-->
		<div class="col-sm-2 col-md-2 col-lg-2 form-group bor-right">
			<h6>Select Your Tour</h6>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 pr-5">
					  <select class="custom-select tour-search" id="sel1">
					    <option selected>Ashtvinayak</option>
					    <option>Mahabaleshwar</option>
					    <option>Kokan Darshan</option>
					    <option>Sindhudurg</option>
					  </select>
				</div>
			</div>
		</div>
		<!--TourDestinations-->
		<!--Tour Budget-->
		<div class="col-sm-4 col-md-4 col-lg-4 form-group bor-right">
				<h6>Budget Per Person</h6>
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="col-sm-12 col-md-12 col-lg-12 nopadd-mar">
								  <select class="custom-select tour-search" id="sel1">
								    <option selected>1000</option>
								    <option>5000</option>
								    <option>10000</option>
								    <option>15000</option>
								  </select>
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="col-sm-12 col-md-12 col-lg-12 nopadd-mar">
								  <select class="custom-select tour-search" id="sel1">
								    <option selected>5000</option>
								    <option>10000</option>
								    <option>15000</option>
								    <option>20000</option>
								  </select>
							</div>
						</div>	
					</div>
		</div>
		<!--Tour Budget-->
		<!--Tour Duration-->
		<div class="col-sm-2 col-md-2 col-lg-2 form-group bor-right">
					<h6>Duration</h6>
					<div class="row">
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="col-sm-12 col-md-12 col-lg-12 nopadd-mar">
								  <select class="custom-select tour-search" id="sel1">
								    <option selected>1 N</option>
								    <option>2 N</option>
								    <option>3 N</option>
								    <option>4 N</option>
								  </select>
							</div>
						</div>
						<div class="col-sm-6 col-md-6 col-lg-6">
							<div class="col-sm-12 col-md-12 col-lg-12 nopadd-mar">
								  <select class="custom-select tour-search" id="sel1">
								    <option selected>2 N</option>
								    <option>3 N</option>
								    <option>4 N</option>
								    <option>5 N</option>
								  </select>
							</div>
						</div>
					</div>
				</div>
		<!--Tour Duration-->
		<!--TravelType-->
		<div class="col-sm-2 col-md-2 col-lg-2 form-group ">
			<h6>Travel Type</h6>
			<div class="row">
				<div class="col-sm-12 col-md-12 col-lg-12 pr-5">
					  <select class="custom-select tour-search" id="sel1">
					    <option selected>Bus</option>
					    <option>Car</option>
					  </select>
				</div>
			</div>
		</div>
		<!--TravelType-->
	</div>

	<!--Search-->
	<!--Package list-->
	<div class="container">
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h4 class="text-center text-uppercase pt-4 pb-4">Maharashtra Tours</h4>
			<div class="row">
				<div class="col-6 col-sm-3 col-md-3 col-lg-3 mb-3">
					<div class="card card-bor">
				   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/ashtvinayak01.jpg" alt="Card image" style="width:100%">
				   		 <div class="card-body text-center">
				      		<h6 class="card-title text-uppercase">Ashtvinayak</h6>
				      		<a href="#" class="btn btn-primary view-butt">See Profile</a>
				      	 </div>
		  			</div>
				</div>
			</div>
		</div>
		<!--Pagination-->
		<div class="col- col-sm-12 col-md-12 col-lg-12">
			<ul class="pagination pagination-sm">
			    <li class="page-item"><a class="page-link pg-link" href="#">Previous</a></li>
			    <li class="page-item"><a class="page-link pg-link" href="#">1</a></li>
			    <li class="page-item"><a class="page-link pg-link" href="#">2</a></li>
			    <li class="page-item"><a class="page-link pg-link" href="#">3</a></li>
			    <li class="page-item"><a class="page-link pg-link" href="#">Next</a></li>
			</ul>
		</div>
	<!--Pagination-->
	</div>
</form>
<script type="text/javascript">
	var tour_category = '<?php echo $tour_category;?>';
	var tour_region = '<?php echo $tour_region;?>';
	var tour_state = '<?php echo $tour_state;?>';
	var tour_price = '<?php echo $tour_price;?>';
	var tour_duration = '<?php echo $tour_duration;?>';
	$(document).ready(function() {
	    getListing(1);

	    $("#table_tour_list").on( "click", ".pagination a", function (e){
	        e.preventDefault();
	        getListing($(this).attr("data-page"));
	    });

	    $("#cRows").change(function()
	    {
	        getListing(1);
	    });
	});

	function filtered(filter){
		var id = filter.id;
		var filter_field = id.replace('filter_','');
		var filter_value = $("#"+id).val();
		var url_params = getUrlVars();
		var url = window.location.href.split('?')[0];
		var redirect_url = url+"?";

		$.each(url_params, function(key, value) {
		    console.log(redirect_url);
		    if(key != filter_field && key != 'p'){
		    	redirect_url += key+"="+value+"&";
		    }
		});
		if(filter_value != '')
			redirect_url += filter_field+"="+filter_value;
		else if(redirect_url.slice(-1) == '&'){
			redirect_url = redirect_url.substring(0, redirect_url.length - 1);
		}

		window.location.href = redirect_url;
	}

	function getUrlVars(){
	    var vars = {}, hash;
	    var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
	    for(var i = 0; i < hashes.length; i++)
	    {
	        hash = hashes[i].split('=');
	        //vars.push(hash[0]);
	        vars[hash[0]] = hash[1];
	    }
	    return vars;
	}

	function getListing(page,order){

	    if (typeof order !== "undefined")
	        arrangeOrder = order;
	    else
	        arrangeOrder = "";

	    //var id = (typeof $("#id").val() != 'undefined') ? $("#id").val() : '';
	    //var name = (typeof $("#name").val() != 'undefined') ? trim($("#name").val()) : '';
	    //var active = (typeof $("#active").val() != 'undefined') ? trim($("#active").val()) : '';
	    var cRows = (typeof $("#cRows").val() != 'undefined') ? trim($("#cRows").val()) : '';
	    var page = page;

	    $("#loading").show(); //show loading element
	    $("#table_tour_list").html('');
	    $("#table_tour_list").load("fetch_categories_listings.php",{"arrangeOrder":arrangeOrder,"cRows":cRows,"page":page,"tour_category":tour_category,"tour_region":tour_region,"tour_state":tour_state,"tour_price":tour_price,"tour_duration":tour_duration}, function(){ //get content from PHP page
	        $("#loading").hide(); //once done, hide loading element
	        // $("#id").val(id);
	        // $("#name").val(name);
	        // $("#active").val(active);
	        $("#cRows").val(cRows);
	        //$("#cAddDate").datepicker();
	        //$("#cUpdDate").datepicker();
	        //alertify.success('Page '+page+' loaded successfully.');
	        $('select').find('option[selected="selected"]').each(function(){
	            $(this).prop('selected', true);
	        });
	    });
	}
</script>