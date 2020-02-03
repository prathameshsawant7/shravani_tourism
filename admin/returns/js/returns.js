/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * JS for Returns Page
*/ 
$(document).ready(function() {
    var iSeller_id  = $("#iSeller_id").val();
   
    var cRows       = trim($("#cRows").val());
    $("#table_returns" ).load( "fetch_returns.php",{"cRows":cRows,"cSellerID":iSeller_id,"page":1}, function()
    {
        $("#loading").hide();
        $("#cAddDate").datepicker();
        $("#cUpdDate").datepicker();
    });
//   //$("#loading").hide();
    //executes code below when user click on pagination links
    $("#table_returns").on( "click", ".pagination a", function (e){
        e.preventDefault();
        
        //$("#table_orders").html('');
        //alert(($(this).attr("data-page")));
        var iSeller_id          = trim($("#iSeller_id").val());
        var page                = $(this).attr("data-page");
        var cOrder_id           = trim($("#cOrder_id").val());
        var cOrder_detail_id    = trim($("#cOrder_detail_id").val());
        var cReference          = trim($("#cReference").val());
        var cCustomer           = trim($("#cCustomer").val());
        var cTotal              = trim($("#cTotal").val());
        var cPayment            = trim($("#cPayment").val());
        var cStatus             = trim($("#cStatus").val());
        var cAddDate            = trim($("#cAddDate").val());
        var cUpdDate            = trim($("#cUpdDate").val());
        var cRows               = trim($("#cRows").val());
        
        $("#loading").show(); //show loading element
        $("#table_returns").html('');
        
        $("#table_returns").load("fetch_returns.php",{"cRows":cRows,"cSellerID":iSeller_id,"page":page,"cOrder_id":cOrder_id,"cOrder_detail_id":cOrder_detail_id,"cReference":cReference,"cCustomer":cCustomer,"cTotal":cTotal,"cPayment":cPayment,"cStatus":cStatus,"cAddDate":cAddDate,"cUpdDate":cUpdDate}, function(){ //get content from PHP page
            $("#cOrder_id").val(cOrder_id);
            $("#cOrder_detail_id").val(cOrder_detail_id);
            $("#cReference").val(cReference);
            $("#cCustomer").val(cCustomer);
            $("#cTotal").val(cTotal);
            $("#cPayment").val(cPayment);
            $("#cAddDate").val(cAddDate);
            $("#cUpdDate").val(cUpdDate);
            $("#loading").hide(); //once done, hide loading element

            $("#cAddDate").datepicker();
            $("#cUpdDate").datepicker();
            alertify.success('Page '+page+' loaded successfully.');
        });
       
    });
    
    $("#cRows").change(function()
    {
        var iSeller_id          = $("#iSeller_id").val();
        var page                = $(this).attr("data-page");
        var cOrder_id           = trim($("#cOrder_id").val());
        var cOrder_detail_id    = trim($("#cOrder_detail_id").val());
        var cReference          = trim($("#cReference").val());
        var cCustomer           = trim($("#cCustomer").val());
        var cTotal              = trim($("#cTotal").val());
        var cPayment            = trim($("#cPayment").val());
        var cStatus             = trim($("#cStatus").val());
        var cAddDate            = trim($("#cAddDate").val());
        var cUpdDate            = trim($("#cUpdDate").val());
        var cRows               = trim($("#cRows").val());
        
        $("#loading").show(); //show loading element
        $("#table_returns").html('');
        
        $("#table_returns").load("fetch_returns.php",{"cRows":cRows,"cSellerID":iSeller_id,"page":page,"cOrder_id":cOrder_id,"cOrder_detail_id":cOrder_detail_id,"cReference":cReference,"cCustomer":cCustomer,"cTotal":cTotal,"cPayment":cPayment,"cStatus":cStatus,"cAddDate":cAddDate,"cUpdDate":cUpdDate}, function(){ //get content from PHP page
            $("#cOrder_id").val(cOrder_id);
            $("#cOrder_detail_id").val(cOrder_detail_id);
            $("#cReference").val(cReference);
            $("#cCustomer").val(cCustomer);
            $("#cTotal").val(cTotal);
            $("#cPayment").val(cPayment);
            $("#cAddDate").val(cAddDate);
            $("#cUpdDate").val(cUpdDate);
            $("#loading").hide(); //once done, hide loading element

            $("#cAddDate").datepicker();
            $("#cUpdDate").datepicker();
            alertify.success('Displayed '+cRows+' Rows');
        });
    });
    
//    $("#cSellerlist").change(function()
//    {
//        window.location.href="orders.php?iSeller_id="+$('#cSellerlist').val();
//    });
//
//    $('#cSellerlist option[value="'+trim($("#iSeller_id").val())+'"]').prop('selected', true);
    
   
});

function applyFilter(order)
{
    if (typeof order !== "undefined") 
        arrangeOrder = order.id;
    else
        arrangeOrder = "";
    
    var iSeller_id          = $("#iSeller_id").val();
    var page                = $(this).attr("data-page");
    var cOrder_id           = trim($("#cOrder_id").val());
    var cOrder_detail_id    = trim($("#cOrder_detail_id").val());
    var cReference          = trim($("#cReference").val());
    var cCustomer           = trim($("#cCustomer").val());
    var cTotal              = trim($("#cTotal").val());
    var cPayment            = trim($("#cPayment").val());
    var cStatus             = trim($("#cStatus").val());
    var cAddDate            = trim($("#cAddDate").val());
    var cUpdDate            = trim($("#cUpdDate").val());
    var cRows               = trim($("#cRows").val());
    
    $("#loading").show(); //show loading element
   // $("#table_returns").html('');
        
    
    $("#table_returns").load("fetch_returns.php",{"cRows":cRows,"cSellerID":iSeller_id,"page":page,"arrangeOrder":arrangeOrder,"cOrder_id":cOrder_id,"cOrder_detail_id":cOrder_detail_id,"cReference":cReference,"cCustomer":cCustomer,"cTotal":cTotal,"cPayment":cPayment,"cStatus":cStatus,"cAddDate":cAddDate,"cUpdDate":cUpdDate}, function(){ //get content from PHP page
        $("#cOrder_id").val(cOrder_id);
        $("#cOrder_detail_id").val(cOrder_detail_id);
        $("#cReference").val(cReference);
        $("#cCustomer").val(cCustomer);
        $("#cTotal").val(cTotal);
        $("#cPayment").val(cPayment);
        $("#cAddDate").val(cAddDate);
        $("#cUpdDate").val(cUpdDate);
        $("#loading").hide(); //once done, hide loading element

        $("#cAddDate").datepicker();
        $("#cUpdDate").datepicker();
        alertify.success('Applied Filter Successfully');
    });
}


function trim(str)
{
   return str.replace(/^\s+|\s+$/g,"");
}
