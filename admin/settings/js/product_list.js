/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * JS for Product Display Page
*/ 
$(document).ready(function() {
    var iSeller_id  = $("#iSeller_id").val();
    var cRows       = trim($("#cRows").val());
    $("#table_product_list" ).load("fetch_product_list.php",{"cRows":cRows,"cSellerID":iSeller_id,"page":1}, function()
    {
        $("#loading").hide();
        $("#cAddDate").datepicker();
        $("#cUpdDate").datepicker();
        
    });
   
    $("#table_product_list").on( "click", ".pagination a", function (e){
        e.preventDefault();
        
        var page        = $(this).attr("data-page"); //get page number from link
        var iSeller_id  = $("#iSeller_id").val();
        var cProduct_id = trim($("#cProduct_id").val());
        var cName       = trim($("#cName").val());
        var cReference  = trim($("#cReference").val());
        var cPrice      = trim($("#cPrice").val());
        var cMRP        = trim($("#cMRP").val());
        var cDiscount   = trim($("#cDiscount").val());
        var cQuantity   = trim($("#cQuantity").val());
        var cActive     = trim($("#cActive").val());
        var cAddDate    = trim($("#cAddDate").val());
        var cUpdDate    = trim($("#cUpdDate").val());
        var cRows       = trim($("#cRows").val());
        
        $("#loading").show(); //show loading element
        $("#table_product_list").html('');
        
        $("#table_product_list").load("fetch_product_list.php",{"cRows":cRows,"cSellerID":iSeller_id,"page":page,"cProduct_id":cProduct_id,"cName":cName,"cReference":cReference,"cPrice":cPrice,"cMRP":cMRP,"cDiscount":cDiscount,"cQuantity":cQuantity,"cActive":cActive,"cAddDate":cAddDate,"cUpdDate":cUpdDate}, function(){ //get content from PHP page
            $("#loading").hide(); //once done, hide loading element
            $("#cAddDate").datepicker();
            $("#cUpdDate").datepicker();
            alertify.success('Page '+page+' loaded successfully.');
        });
       
    });
    
    $("#cSellerlist").change(function()
    {
        window.location.href="product_list.php?iSeller_id="+$('#cSellerlist').val();
    });
    
    $("#cRows").change(function()
    {
        
        var iSeller_id  = $("#iSeller_id").val();
        var page        = $(this).attr("data-page");
        var cProduct_id = trim($("#cProduct_id").val());
        var cName       = trim($("#cName").val());
        var cReference  = trim($("#cReference").val());
        var cPrice      = trim($("#cPrice").val());
        var cMRP        = trim($("#cMRP").val());
        var cDiscount   = trim($("#cDiscount").val());
        var cQuantity   = trim($("#cQuantity").val());
        var cActive     = trim($("#cActive").val());
        var cAddDate    = trim($("#cAddDate").val());
        var cUpdDate    = trim($("#cUpdDate").val());
        var cRows       = trim($("#cRows").val());
        
        $("#table_product_list").html('');
        $("#loading").show(); 
        $("#table_product_list").load("fetch_product_list.php",{"cRows":cRows,"cSellerID":iSeller_id,"page":page,"cProduct_id":cProduct_id,"cName":cName,"cReference":cReference,"cPrice":cPrice,"cMRP":cMRP,"cDiscount":cDiscount,"cQuantity":cQuantity,"cActive":cActive,"cAddDate":cAddDate,"cUpdDate":cUpdDate}, function(){ //get content from PHP page
            $("#cProduct_id").val(cProduct_id);
            $("#cName").val(cName);
            $("#cReference").val(cReference);
            $("#cPrice").val(cPrice);
            $("#cMRP").val(cMRP);
            $("#cDiscount").val(cDiscount);
            $("#cQuantity").val(cQuantity);
            $("#cActive").val(cActive);
            $("#cAddDate").val(cAddDate);
            $("#cUpdDate").val(cUpdDate);
            $("#loading").hide(); //once done, hide loading element

            $("#cAddDate").datepicker();
            $("#cUpdDate").datepicker();
            alertify.success('Displayed '+cRows+' Rows');
        });
    });

    $('#cSellerlist option[value="'+trim($("#iSeller_id").val())+'"]').prop('selected', true);
    
   
});

function applyFilter(order)
{
    if (typeof order !== "undefined") 
        arrangeOrder = order.id;
    else
        arrangeOrder = "";
    
    var iSeller_id  = $("#iSeller_id").val();
    var page        = $(this).attr("data-page");
    var cProduct_id = trim($("#cProduct_id").val());
    var cName       = trim($("#cName").val());
    var cReference  = trim($("#cReference").val());
    var cPrice      = trim($("#cPrice").val());
    var cMRP        = trim($("#cMRP").val());
    var cDiscount   = trim($("#cDiscount").val());
    var cQuantity   = trim($("#cQuantity").val());
    var cActive     = trim($("#cActive").val());
    var cAddDate    = trim($("#cAddDate").val());
    var cUpdDate    = trim($("#cUpdDate").val());
    var cRows       = trim($("#cRows").val());
    
    $("#table_product_list").html('');
    $("#loading").show(); 
    $("#table_product_list").load("fetch_product_list.php",{"cRows":cRows,"cSellerID":iSeller_id,"page":page,"arrangeOrder":arrangeOrder,"cProduct_id":cProduct_id,"cName":cName,"cReference":cReference,"cPrice":cPrice,"cMRP":cMRP,"cDiscount":cDiscount,"cQuantity":cQuantity,"cActive":cActive,"cAddDate":cAddDate,"cUpdDate":cUpdDate}, function(){ //get content from PHP page
        $("#cProduct_id").val(cProduct_id);
        $("#cName").val(cName);
        $("#cReference").val(cReference);
        $("#cPrice").val(cPrice);
        $("#cMRP").val(cMRP);
        $("#cDiscount").val(cDiscount);
        $("#cQuantity").val(cQuantity);
        $("#cActive").val(cActive);
        $("#cAddDate").val(cAddDate);
        $("#cUpdDate").val(cUpdDate);
        $("#loading").hide(); //once done, hide loading element
        
        $("#cAddDate").datepicker();
        $("#cUpdDate").datepicker();
        alertify.success('Applied Filter Successfully');
        
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
function editProduct(id)
{
    $('#cQuantity_'+id).hide();
    $('#cQuantity_input_'+id).show();
    $('#display_'+id).hide();
    $('#edit_'+id).show();
}
function cancelProduct(id)
{
    $('#cQuantity_'+id).show();
    $('#cQuantity_input_'+id).hide();
    $('#display_'+id).show();
    $('#edit_'+id).hide();
}

function trim(str)
{
 return str.replace(/^\s+|\s+$/g,"");
}
