$(document).ready(function() {
    getListing(1);

    $("#table_tour_list").on( "click", ".pagination a", function (e){
        e.preventDefault();
        getListing($(this).attr("data-page"));
    });

//    $("#cSellerlist").change(function()
//    {
//        window.location.href="product_list.php?iSeller_id="+$('#cSellerlist').val();
//    });

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
    var tour_code                       = (typeof $("#tour_code").val() != 'undefined') ? trim($("#tour_code").val()) : '';
    var tour_name                       = (typeof $("#tour_name").val() != 'undefined') ? trim($("#tour_name").val()) : '';
    var display_image                   = (typeof $("#display_image").val() != 'undefined') ? trim($("#display_image").val()) : '';
    var tour_region                     = (typeof $("#tour_region").val() != 'undefined') ? trim($("#tour_region").val()) : '';
    var tour_state                      = (typeof $("#tour_state").val() != 'undefined') ? trim($("#tour_state").val()) : '';
    var tour_duration                   = (typeof $("#tour_duration").val() != 'undefined') ? trim($("#tour_duration").val()) : '';
    var tour_places                     = (typeof $("#tour_places").val() != 'undefined') ? trim($("#tour_places").val()) : '';
    var active                          = (typeof $("#active").val() != 'undefined') ? trim($("#active").val()) : '';
    var cRows                           = (typeof $("#cRows").val() != 'undefined') ? trim($("#cRows").val()) : '';
    var page                            = page;

    $("#loading").show(); //show loading element
    $("#table_tour_list").html('');
    $("#table_tour_list").load("fetch_tour_listings.php",{"arrangeOrder":arrangeOrder,"cRows":cRows,"page":page,"id":id,"tour_code":tour_code,"tour_name":tour_name,"display_image":display_image,"tour_region":tour_region,"tour_state":tour_state,"tour_duration":tour_duration,"tour_places":tour_places,"active":active}, function(){ //get content from PHP page
        $("#loading").hide(); //once done, hide loading element
        $("#id").val(id);
        $("#tour_code").val(tour_code);
        $("#tour_name").val(tour_name);
        $("#display_image").val(display_image);
        $("#tour_region").val(tour_region);
        $("#tour_state").val(tour_state);
        $("#tour_duration").val(tour_duration);
        $("#tour_places").val(tour_places);
        $("#active").val(active);
        //$("#cAddDate").datepicker();
        //$("#cUpdDate").datepicker();
        alertify.success('Page '+page+' loaded successfully.');
        $('select').find('option[selected="selected"]').each(function(){
            $(this).prop('selected', true);
        });
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
    if(id != ''){
        $.post("ajax_calls.php",{request:'deleteTour',id:id},function(data) {
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
