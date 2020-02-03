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

    var id_state                        = (typeof $("#id_state").val() != 'undefined') ? $("#id_state").val() : '';
    var state                           = (typeof $("#state").val() != 'undefined') ? trim($("#state").val()) : '';
    var active                          = (typeof $("#active").val() != 'undefined') ? trim($("#active").val()) : '';
    var cRows                           = (typeof $("#cRows").val() != 'undefined') ? trim($("#cRows").val()) : '';
    var page                            = page;

    $("#loading").show(); //show loading element
    $("#table_tour_list").html('');
    $("#table_tour_list").load("fetch_state_listings.php",{"arrangeOrder":arrangeOrder,"cRows":cRows,"page":page,"id_state":id_state,"state":state,"active":active}, function(){ //get content from PHP page
        $("#loading").hide(); //once done, hide loading element
        $("#id_state").val(id_state);
        $("#state").val(state);
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


function editState(id_state)
{
    window.location.href = "add_state.php?id_state="+id_state+"&action=edit";
}
function deleteState(id_state)
{
    if(id_state != ''){
        $.post("ajax_calls.php",{request:'deleteState',id_state:id_state},function(data) {
            alertify.alert("State ID: "+id_state+" - "+trim(data)+" has been deleted successfully.", function(){
                alertify.success('Success');
                $('#tr_'+id_state).remove();
            });
        });
    }
}

function trim(str){
    return str.replace(/^\s+|\s+$/g,"");
}
