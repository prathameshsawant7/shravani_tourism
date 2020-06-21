<?php
$q = (isset($url_params['q']) && $url_params['q'] != '')?str_replace("-"," ",$url_params['q']):'';
$search = (isset($url_params['search']) && $url_params['search'] != '')?str_replace("-"," ",$url_params['search']):'';
$tour_category = (isset($url_params['category']) && $url_params['category'] != '')?str_replace("-"," ",$url_params['category']):'';
$tour_subcategory = (isset($url_params['subcategory']) && $url_params['subcategory'] != '')?str_replace("-"," ",$url_params['subcategory']):'';
$tour_region = (isset($url_params['region']) && $url_params['region'] != '')?$url_params['region']:'';
$tour_state = (isset($url_params['state']) && $url_params['state'] != '')?$url_params['state']:'';
$tour_price = (isset($url_params['price']) && $url_params['price'] != '')?$url_params['price']:'';
$tour_duration = (isset($url_params['duration']) && $url_params['duration'] != '')?$url_params['duration']:'';
?>
<BR>
<div class="col- col-sm-12 col-md-12 col-lg-12">
	<ul class="breadcrumb br-crum">
	    <li class="breadcrumb-item"><a href="<?php echo LIVEROOT;?>">Home</a></li>
	    <?php if($tour_subcategory != ''){ 
	    	$category_url = LIVEROOT."packages.php?q=".$tour_category."&category=".$tour_category;
	    ?>
	    	<li class="breadcrumb-item"><a href="<?php echo $category_url;?>"><?php echo $tour_category;?></a></li>
	    	<li class="breadcrumb-item active"><?php echo $tour_subcategory;?></li>
	    <?php }else if($tour_category != ''){ ?>	    
	    	<li class="breadcrumb-item active"><?php echo $tour_category;?></li>
	    <?php }else if($tour_region != ''){ 
	    	$query = "SELECT name FROM regions WHERE id = ".$tour_region.";";
		    $fetch_data = mysqli_query($con,$query);
		    $data = $fetch_data->fetch_assoc();
	    ?>
	    	<li class="breadcrumb-item active"><?php echo $data['name'];?></li>
	     <?php }else if($tour_state != ''){ 
	     	$query = "SELECT state FROM states WHERE id_state = ".$tour_state.";";
		    $fetch_data = mysqli_query($con,$query);
		    $data = $fetch_data->fetch_assoc();
	     ?>
	    	<li class="breadcrumb-item active"><?php echo $data['state'];?></li>
	    <?php } ?>
  	</ul>
</div>
<div class="large-12 columns no-pad" id="loading" style="display: none">
    <center>    
        <img id="img_Loading" src="../img/loading.gif" alt="" height="100%" width="100%"/>
    </center>
</div>

<?php if($tour_category != '' && $tour_subcategory == ''){ 
	
	$query = "SELECT s.* FROM tour_subcategories as s LEFT JOIN tour_categories as c ON c.id = s.category_id WHERE c.name LIKE '".$tour_category."';";
    $fetch_data = mysqli_query($con,$query);
    $count=mysqli_num_rows($fetch_data);
    if($count > 0){
?>
	<div class="container">
	<h4 class="text-center text-uppercase pt-4 pb-4">Specialities of <?php echo $tour_category;?></h4>
	<div class="row">
	<?php if($tour_category == 'Maharashtra Tours'){ ?>
		<div class="col-sm-1 col-lg-1"><div class="card card-bor"></div></div>
		<div class="col-sm-4 col-lg-2">
		   <div class="card card-bor">
		   		<a href="<?php echo LIVEROOT;?>ashtavinayak-packages.php">
		   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/ashtvinayak01.jpg" alt="Card image" style="width:100%">
		   		 <div class="card-body">
		      		<h6 class="card-title text-al text-uppercase">Ashtvinayak Yatra</h6>
		      	 </div>
		      	</a>
	  		</div>
		</div>
	<?php
		}
    while($tour_subcategory_data = $fetch_data->fetch_assoc()){
    	$subcategory_url = LIVEROOT."packages.php?q=".$tour_category."&category=".$tour_category."&subcategory=".$tour_subcategory_data['name'];
    ?>
    	<div class="col-sm-4 col-lg-2">
		   <div class="card card-bor">
		   		<a href="<?php echo $subcategory_url;?>">
		   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/tours/<?php echo $tour_subcategory_data['display_image'];?>" alt="Card image" style="width:100%">
		   		 <div class="card-body">
		      		<h6 class="card-title text-al text-uppercase"><?php echo $tour_subcategory_data['name'];?></h6>
		      	 </div>
		      	</a>
	  		</div>
		</div>
	<?php } } ?>
	</div></div>
<?php } ?>

<!-- <div class="row">
		<div class="col-sm-6 col-lg-3">
		   <div class="card card-bor">
		   		<a href="ashtavinayak-packages.php">
		   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/ashtvinayak01.jpg" alt="Card image" style="width:100%">
		   		 <div class="card-body">
		      		<h6 class="card-title text-al text-uppercase">Ashtvinayak</h6>
		      	 </div>
		      	</a>
	  		</div>
		</div>	
		<div class="col-sm-6 col-lg-3">
		    <div class="card card-bor">
		   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/mahabaleshwar.jpg" alt="Card image" style="width:100%">
		   		 <div class="card-body">
		      		<h6 class="card-title text-al text-uppercase">Mahabaleshwar</h6>		      		
		   		 </div>
	  		</div>
		</div>	
		<div class="col-sm-6 col-lg-3">
		   <div class="card card-bor">
		   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/shirdi.jpg" alt="Card image" style="width:100%">
		   		 <div class="card-body">
		      		<h6 class="card-title text-al text-uppercase">Nashik-Shirdi</h6>
		      	 </div>
	  		</div>
		</div>	
		<div class="col-sm-6 col-lg-3">
		  <div class="card card-bor">
		   		 <img class="card-img-top card-img-bor-rad img-fluid" src="images/kokan01.jpg" alt="Card image" style="width:100%">
		   		 <div class="card-body">
		      		<h6 class="card-title text-al text-uppercase">Kokan Darshan</h6>
		      	 </div>
	  		</div>
		</div>	

	</div> -->
<form id="table_tour_list"></form>

<script type="text/javascript">
	var q = '<?php echo $q;?>';
	var search = '<?php echo $search;?>';
	var tour_category = '<?php echo $tour_category;?>';
	var tour_subcategory = '<?php echo $tour_subcategory;?>';
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
	    $("#table_tour_list").load("fetch_categories_listings.php",{"arrangeOrder":arrangeOrder,"cRows":cRows,"page":page,"q":q,"search":search,"tour_category":tour_category,"tour_subcategory":tour_subcategory,"tour_region":tour_region,"tour_state":tour_state,"tour_price":tour_price,"tour_duration":tour_duration}, function(){ //get content from PHP page
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