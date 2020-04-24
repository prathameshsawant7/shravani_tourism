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

    var id  = (typeof $("#id").val() != 'undefined') ? $("#id").val() : '';
    var token = (typeof $("#token").val() != 'undefined') ? trim($("#token").val()) : '';
    var name = (typeof $("#name").val() != 'undefined') ? trim($("#name").val()) : '';
    var mobile = (typeof $("#mobile").val() != 'undefined') ? trim($("#mobile").val()) : '';
    var email = (typeof $("#email").val() != 'undefined') ? trim($("#email").val()) : '';
    var status = (typeof $("#status").val() != 'undefined') ? trim($("#status").val()) : '';
    var cRows = (typeof $("#cRows").val() != 'undefined') ? trim($("#cRows").val()) : '';
    var page = page;

    $("#loading").show(); //show loading element
    $("#table_tour_list").html('');
    $("#table_tour_list").load("fetch_enquiries.php",{"arrangeOrder":arrangeOrder,"cRows":cRows,"page":page,"id":id,"token":token,"name":name,"mobile":mobile,"email":email,"status":status}, function(){ //get content from PHP page
        $("#loading").hide(); //once done, hide loading element
        $("#id").val(id);
        $("#token").val(token);
        $("#name").val(name);
        $("#mobile").val(mobile);
        $("#email").val(email);
        $("#status").val(status);
        $("#cRows").val(cRows);
        //$("#cAddDate").datepicker();
        //$("#cUpdDate").datepicker();
        alertify.success('Page '+page+' loaded successfully.');
        $('select').find('option[selected="selected"]').each(function(){
            $(this).prop('selected', true);
        });
    });
}


function editEnquiry(id)
{
    window.location.href = "view.php?id="+id;
}

function deleteenquiry(id)
{
    if(id != ''){
        $.post("ajax_calls.php",{request:'deleteEnquiry',id:id},function(data) {
            alertify.alert("Enquiry ID: "+id+" - "+trim(data)+" has been deleted successfully.", function(){
                alertify.success('Success');
                $('#tr_'+id).remove();
            });
        });
    }
}

function trim(str){
    return str.replace(/^\s+|\s+$/g,"");
}
