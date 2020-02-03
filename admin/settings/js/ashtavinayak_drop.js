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

    var id          = (typeof $("#id").val() != 'undefined') ? $("#id").val() : '';
    var point       = (typeof $("#point").val() != 'undefined') ? trim($("#point").val()) : '';
    var added_by    = (typeof $("#added_by").val() != 'undefined') ? trim($("#added_by").val()) : '';
    var updated_by  = (typeof $("#updated_by").val() != 'undefined') ? trim($("#updated_by").val()) : '';
    var cRows       = (typeof $("#cRows").val() != 'undefined') ? trim($("#cRows").val()) : '';
    var page        = page;

    $("#loading").show(); //show loading element
    $("#table_tour_list").html('');
    $("#table_tour_list").load("fetch_ashtavinayak_drop.php",{"arrangeOrder":arrangeOrder,"cRows":cRows,"page":page,"id":id,"point":point,"added_by":added_by,"updated_by":updated_by}, function(){ //get content from PHP page
        $("#loading").hide(); //once done, hide loading element 
        $("#id").val(id);
        $("#point").val(point);
        $("#added_by").val(added_by);
        $("#updated_by").val(updated_by);
        $("#cRows").val(cRows);
        //$("#cAddDate").datepicker();
        //$("#cUpdDate").datepicker();
        alertify.success('Page '+page+' loaded successfully.');
        $('select').find('option[selected="selected"]').each(function(){
            $(this).prop('selected', true);
        });
    });
}


function editDrop(id)
{
    window.location.href = "add_ashtavinayak_drop.php?id="+id+"&action=edit";
}
function deleteDrop(id)
{
    if(id != ''){
        $.post("ajax_calls.php",{request:'deleteAshtavinayakDrop',id:id},function(data) {
            alertify.alert("Drop ID: "+id+" - "+trim(data)+" has been deleted successfully.", function(){
                alertify.success('Success');
                $('#tr_'+id).remove();
            });
        });
    }
}

function trim(str){
    return str.replace(/^\s+|\s+$/g,"");
}
