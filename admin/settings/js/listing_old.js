/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * JS for Product Display Page
*/ 
$(document).ready(function() {
    /*
    var iSeller_id  = $("#iSeller_id").val();
    var cRows       = trim($("#cRows").val());
    $("#table_product_list" ).load("fetch_tour_listings.php",{"cRows":cRows,"cSellerID":iSeller_id,"page":1}, function()
    {
        $("#loading").hide();
        //$("#cAddDate").datepicker();
        //$("#cUpdDate").datepicker();
        
    });
   */
    getListing(1);

    $("#table_tour_list").on( "click", ".pagination a", function (e){
        e.preventDefault();
        getListing($(this).attr("data-page"));
    });
    
    $("#cSellerlist").change(function()
    {
        window.location.href="product_list.php?iSeller_id="+$('#cSellerlist').val();
    });
    
    $("#cRows").change(function()
    {
        getListing(1);
    });

    //$('#cSellerlist option[value="'+trim($("#iSeller_id").val())+'"]').prop('selected', true);
    
   
});


function getListing(page,order){

    if (typeof order !== "undefined") 
        arrangeOrder = order;
    else
        arrangeOrder = "";

    var id                              = (typeof $("#id").val() != 'undefined') ? $("#id").val() : '';
    var id_tour                         = (typeof $("#id_tour").val() != 'undefined') ? trim($("#id_tour").val()) : '';
    var tour_name                       = (typeof $("#tour_name").val() != 'undefined') ? trim($("#tour_name").val()) : '';
    var tour_location_category_name     = (typeof $("#tour_location_category_name").val() != 'undefined') ? trim($("#tour_location_category_name").val()) : '';
    var tour_type                       = (typeof $("#tour_type").val() != 'undefined') ? trim($("#tour_type").val()) : '';
    var night_days                      = (typeof $("#night_days").val() != 'undefined') ? trim($("#night_days").val()) : '';
    var price                           = (typeof $("#price").val() != 'undefined') ? trim($("#price").val()) : '';
    var cRows                           = (typeof $("#cRows").val() != 'undefined') ? trim($("#cRows").val()) : '';
    var page                            = page;

    $("#loading").show(); //show loading element
    $("#table_tour_list").html('');
    $("#table_tour_list").load("fetch_tour_listings.php",{"arrangeOrder":arrangeOrder,"cRows":cRows,"page":page,"id":id,"id_tour":id_tour,"tour_name":tour_name,"tour_location_category_name":tour_location_category_name,"tour_type":tour_type,"night_days":night_days,"price":price}, function(){ //get content from PHP page
        $("#loading").hide(); //once done, hide loading element
        $("#id").val(id);
        $("#id_tour").val(id_tour);
        $("#tour_name").val(tour_name);
        $("#tour_location_category_name").val(tour_location_category_name);
        $("#tour_type").val(tour_type);
        $("#night_days").val(night_days);
        $("#price").val(price);
        $("#cRows").val(cRows);
        //$("#cAddDate").datepicker();
        //$("#cUpdDate").datepicker();
        alertify.success('Page '+page+' loaded successfully.');
    });
}



function viewProduct(product_id)
{
    window.location.href = "view_product.php?product_id="+product_id;
}

function updateProduct(id)
{
    cQuantity = $('#cQuantity_input_'+id).val();
    if(trim(cQuantity)!="" && !isNaN(cQuantity))
    {
        var iSeller_id  = $("#iSeller_id").val(); 
        $.post("ajax_calls.php",{request:'updateQuantity',id_product:id,cQuantity:cQuantity},function(data) 
        {
           if(trim(data) == "Updated")
           {
                alertify.alert("Product number: "+id+" quantity updated", function()
                {
                    alertify.success('Success');
                });
                $('#cQuantity_'+id).html($('#cQuantity_input_'+id).val());
                $('#cQuantity_'+id).show();
                $('#cQuantity_input_'+id).hide();
                $('#display_'+id).show();
                $('#edit_'+id).hide();
           }
        });
    }
    else
        alert("Please update proper Quantity for respective product.");
}
function editTour(id)
{
    window.location.href = "add_tour.php?id="+id+"&action=edit";
}
function deleteTour(id)
{
    if(id != ''){alert(id);
        $.post("ajax_calls.php",{request:'deleteTour',id:id},function(data) {alert('got');
            alertify.alert("Tour ID: "+id+" - "+trim(data)+" has been deleted successfully.", function(){
                alertify.success('Success');
                $('#tr_'+id).remove();
            });
        });
    }
}

function trim(str){
    return str.replace(/^\s+|\s+$/g,"");
}
