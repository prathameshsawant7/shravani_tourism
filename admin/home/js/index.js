$(document).ready(function() 
{
   
    iSeller_id = $('#iSeller_id').val();
    $.post("../ajax_call.php",{request:'getOrderStatus',iSeller_id:iSeller_id},function(data) 
    {
        $("#table_status_list").html(trim(data));
        $("#loading_status_list").hide();

    });


    var cRows       = trim($("#cRows").val());
    $("#table_seller_list" ).load( "fetch_seller_list.php",{"cRows":cRows,"page":1}, function()
    {
        $("#seller_list_loader").hide();
        $("#cAddDate").datepicker();
        $("#cUpdDate").datepicker();
    });



    $("#table_seller_list").on( "click", ".pagination a", function (e)
    {
        e.preventDefault();

        cSeller_id      = trim($('#cSeller_id').val());
        cSeller_Name    = trim($('#cSeller_Name').val());
        cSeller_Email   = trim($('#cSeller_Email').val());
        cSeller_Status  = trim($('#cSeller_Status').val());
        cAddDate        = trim($('#cAddDate').val());
        cUpdDate        = trim($('#cUpdDate').val());
        cRows           = trim($("#cRows").val());

        $("#loading").show(); //show loading element
        $("#table_seller_list").html('');

        $("#table_seller_list" ).load( "fetch_seller_list.php",{"cRows":cRows,"page":1,"cSeller_id":cSeller_id,"cSeller_Name":cSeller_Name,"cSeller_Email":cSeller_Email,"cSeller_Status":cSeller_Status,"cAddDate":cAddDate,"cUpdDate":cUpdDate}, function()
        {
            $("#seller_list_loader").hide();
            $("#loading").hide();
            $("#cAddDate").datepicker();
            $("#cUpdDate").datepicker();
        });

    });

    $("#cRows").change(function()
    {
        cSeller_id      = trim($('#cSeller_id').val());
        cSeller_Name    = trim($('#cSeller_Name').val());
        cSeller_Email   = trim($('#cSeller_Email').val());
        cSeller_Status  = trim($('#cSeller_Status').val());
        cAddDate        = trim($('#cAddDate').val());
        cUpdDate        = trim($('#cUpdDate').val());
        cRows           = trim($("#cRows").val());

        $("#loading").show(); //show loading element
        $("#table_seller_list").html('');

        $("#table_seller_list" ).load( "fetch_seller_list.php",{"cRows":cRows,"page":1,"cSeller_id":cSeller_id,"cSeller_Name":cSeller_Name,"cSeller_Email":cSeller_Email,"cSeller_Status":cSeller_Status,"cAddDate":cAddDate,"cUpdDate":cUpdDate}, function()
        {
            $("#seller_list_loader").hide();
            $("#loading").hide();
            $("#cAddDate").datepicker();
            $("#cUpdDate").datepicker();
            alertify.success('Displayed '+cRows+' Rows');
    
            
        });
    });

    $("#cSellerlist").change(function()
    {
        window.location.href="index.php?iSeller_id="+$('#cSellerlist').val();
    });

    $('#cSellerlist option[value="'+trim($("#iSeller_id").val())+'"]').prop('selected', true);
    

});  

function  applyFilter(seller)
{
    if (typeof seller !== "undefined") 
        arrangeOrder = seller.id;
    else
        arrangeOrder = "";

    cSeller_id      = trim($('#cSeller_id').val());
    cSeller_Name    = trim($('#cSeller_Name').val());
    cSeller_Email   = trim($('#cSeller_Email').val());
    cSeller_Status  = trim($('#cSeller_Status').val());
    cAddDate        = trim($('#cAddDate').val());
    cUpdDate        = trim($('#cUpdDate').val());
    cRows           = trim($("#cRows").val());

    $("#table_seller_list" ).load( "fetch_seller_list.php",{"cRows":cRows,"page":1,"arrangeOrder":arrangeOrder,"cSeller_id":cSeller_id,"cSeller_Name":cSeller_Name,"cSeller_Email":cSeller_Email,"cSeller_Status":cSeller_Status,"cAddDate":cAddDate,"cUpdDate":cUpdDate}, function()
    {
        $("#seller_list_loader").hide();
        $("#cAddDate").datepicker();
        $("#cUpdDate").datepicker();
        alertify.success('Applied Filter Successfully');
        
    });

}

function setSellerStatus(str)
{
    id          = str.id;
    idArray     = id.split('_');
    iActive     = idArray[0];
    iSeller_id  = idArray[1];

    $.post("../ajax_call.php",{request:'setSellerStatus',iSeller_id:iSeller_id,iActive:iActive},function(data) 
    {
        if(trim(data) == 'updated')
        {
            if(iActive == 1)
                msg = "Seller activated successfully.";
            else
                msg = "Seller deactivated successfully.";
            alertify.alert(msg, function()
            {
                alertify.success('Success');
            });
        }
        
    });

}

function trim(str)
{ 
    return str.replace(/^\s+|\s+$/g,"");
}
