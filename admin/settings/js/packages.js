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
    var name                            = (typeof $("#name").val() != 'undefined') ? trim($("#name").val()) : '';
    var active                          = (typeof $("#active").val() != 'undefined') ? trim($("#active").val()) : '';
    var cRows                           = (typeof $("#cRows").val() != 'undefined') ? trim($("#cRows").val()) : '';
    var page                            = page;

    $("#loading").show(); //show loading element
    $("#table_tour_list").html('');
    $("#table_tour_list").load("fetch_region_listings.php",{"arrangeOrder":arrangeOrder,"cRows":cRows,"page":page,"id":id,"name":name,"active":active}, function(){ //get content from PHP page
        $("#loading").hide(); //once done, hide loading element
        $("#id").val(id);
        $("#name").val(name);
        $("#active").val(active);
        $("#cRows").val(cRows);
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
function editRegion(id)
{
    window.location.href = "add_region.php?id="+id+"&action=edit";
}
function deleteRegion(id)
{
    if(id != ''){
        $.post("ajax_calls.php",{request:'deleteRegion',id:id},function(data) {
            alertify.alert("Region ID: "+id+" - "+trim(data)+" has been deleted successfully.", function(){
                alertify.success('Success');
                $('#tr_'+id).remove();
            });
        });
    }
}

function trim(str){
    return str.replace(/^\s+|\s+$/g,"");
}
