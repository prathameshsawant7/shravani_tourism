/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * JS for Orders Page
*/ 
$(document).ready(function() {
    var iSeller_id  = $("#iSeller_id").val();
    
    $.post("ajax_calls.php",{request:'getStatus'},function(data) 
    {
        $("#status_list").html(data);
    });
    
    $.post("ajax_calls.php",{request:'getCarriers'},function(data) 
    {
        $("#carrier_list").html(data);
    });
    
    var cRows       = trim($("#cRows").val());
    $("#table_orders" ).load( "fetch_orders.php",{"cRows":cRows,"cSellerID":iSeller_id,"page":1}, function()
    {
        $("#loading").hide();
        $("#cAddDate").datepicker();
        $("#cUpdDate").datepicker();
    });
   //$("#loading").hide();
    //executes code below when user click on pagination links
    $("#table_orders").on( "click", ".pagination a", function (e){
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
        $("#table_orders").html('');
        
        $("#table_orders").load("fetch_orders.php",{"cRows":cRows,"cSellerID":iSeller_id,"page":page,"cOrder_id":cOrder_id,"cOrder_detail_id":cOrder_detail_id,"cReference":cReference,"cCustomer":cCustomer,"cTotal":cTotal,"cPayment":cPayment,"cStatus":cStatus,"cAddDate":cAddDate,"cUpdDate":cUpdDate}, function(){ //get content from PHP page
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
        $("#table_orders").html('');
        
        $("#table_orders").load("fetch_orders.php",{"cRows":cRows,"cSellerID":iSeller_id,"page":page,"cOrder_id":cOrder_id,"cOrder_detail_id":cOrder_detail_id,"cReference":cReference,"cCustomer":cCustomer,"cTotal":cTotal,"cPayment":cPayment,"cStatus":cStatus,"cAddDate":cAddDate,"cUpdDate":cUpdDate}, function(){ //get content from PHP page
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
    
    $("#cSellerlist").change(function()
    {
        window.location.href="orders.php?iSeller_id="+$('#cSellerlist').val();
    });

    $('#cSellerlist option[value="'+trim($("#iSeller_id").val())+'"]').prop('selected', true);
    
   
});

function InvoicePDF(id)
{
    window.location = "order_invoice.php?id_order_detail="+id;
}


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
    $("#table_orders").html('');
        
    
    $("#table_orders").load("fetch_orders.php",{"cRows":cRows,"cSellerID":iSeller_id,"page":page,"arrangeOrder":arrangeOrder,"cOrder_id":cOrder_id,"cOrder_detail_id":cOrder_detail_id,"cReference":cReference,"cCustomer":cCustomer,"cTotal":cTotal,"cPayment":cPayment,"cStatus":cStatus,"cAddDate":cAddDate,"cUpdDate":cUpdDate}, function(){ //get content from PHP page
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

function updateStatus(request)
{
    id_order = $('#iUpdate_Status_id').val();
    if(request == 'Status')
    {
        current_state = $('#status_list').val();
        if(current_state != '')
        {
            var iSeller_id  = $("#iSeller_id").val(); 
            $.post("ajax_calls.php",{request:'updateStatus',id_order:id_order,current_state:current_state},function(data) 
            {
               if(trim(data) == "Updated")
               {
                   alertify.alert("Order Number: "+id_order+" Status Updated.", function()
                    {
                        alertify.success('Success');
                    });
                   
                    $('.close-reveal-modal').click();
                    //$('#cStatus_'+id_order).html("Shipped");
                    
                    $('#cStatus_'+id_order).html($('#status_list option[value="'+trim($("#status_list").val())+'"]').html());
    //                $('#cStatus_'+id).show();
    //                $('#cStatus_input_'+id).hide();
    //                $('#StatusEdit_'+id).show();
    //                $('#StatusUpdate_'+id).hide();
               }
            });
        }
        else
        {
            alertify.alert("Please select status to update.", function()
            {
                alertify.error('Error Occured');
            });
        }
    }
    else if(request == 'Shipping')
    {
        id_carrier = $('#carrier_list').val();
        tracking_number = $('#cTracking_number').val();

        errorMsg = '';
        if(trim(id_carrier) == '')
            errorMsg ='Select Carrier \n'; 
        if(trim($('#cTracking_number').val()) == '')
            errorMsg = errorMsg+'Enter tracking number \n'; 

        if(trim(errorMsg) =="")
        {
            var iSeller_id  = $("#iSeller_id").val(); 
            $.post("ajax_calls.php",{request:'updateShipping',id_order:id_order,id_carrier:id_carrier,tracking_number:tracking_number},function(data) 
            {
               if(trim(data) == "Updated")
               {
                    alertify.alert("Order Number: "+id_order+" Shipping details Updated.", function()
                    {
                        alertify.success('Success');
                    });
                    $('.close-reveal-modal').click();
                    $('#cStatus_'+id_order).html("Shipped");
                    //
    //                $('#cStatus_'+id).html($('#cStatus_input_'+id+' option[value="'+trim($("#cStatus_input_"+id).val())+'"]').html());
    //                $('#cStatus_'+id).show();
    //                $('#cStatus_input_'+id).hide();
    //                $('#StatusEdit_'+id).show();
    //                $('#StatusUpdate_'+id).hide();
               }
            });
        }
        else
        {
            alertify.alert("Please fix below issues: <BR>"+errorMsg, function()
            {
                alertify.error('Error Occured');
            });
        }
    }    
        
}
function editStatus(id)
{
    $('#carrier_list').val('');
    $('#cTracking_number').val('');
    $('#iUpdate_Status_id').val(id);
//    $('#cStatus_'+id).hide();
//    $('#cStatus_input_'+id).show();
//    $('#StatusEdit_'+id).hide();
//    $('#StatusUpdate_'+id).show();
}
function cancel(id)
{
    $('#cStatus_'+id).show();
    $('#cStatus_input_'+id).hide();
    $('#StatusEdit_'+id).show();
    $('#StatusUpdate_'+id).hide();
    
}



    
function trim(str)
{
   return str.replace(/^\s+|\s+$/g,"");
}
