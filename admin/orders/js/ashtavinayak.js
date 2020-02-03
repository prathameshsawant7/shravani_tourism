$(document).ready(function() {
    getListing(1);

    $("#table_tour_list").on( "click", ".pagination a", function (e){
        e.preventDefault();
        getListing($(this).attr("data-page"));
    });


    $("#cRows").change(function()
    {
        getListing(1);
    });

});


function getListing(page,order){

    if (typeof order !== "undefined")
        arrangeOrder = order;
    else
        arrangeOrder = "";

    var id                              = (typeof $("#id").val() != 'undefined') ? $("#id").val() : '';
    var tour_id                         = (typeof $("#tour_id").val() != 'undefined') ? trim($("#tour_id").val()) : '';
    var date                            = (typeof $("#date").val() != 'undefined') ? trim($("#date").val()) : '';
    var bus                             = (typeof $("#bus").val() != 'undefined') ? trim($("#bus").val()) : '';
    var seats                           = (typeof $("#seats").val() != 'undefined') ? trim($("#seats").val()) : '';
    var pickup_point                    = (typeof $("#pickup_point").val() != 'undefined') ? trim($("#pickup_point").val()) : '';
    var travellers                      = (typeof $("#travellers").val() != 'undefined') ? trim($("#travellers").val()) : '';
    var status                          = (typeof $("#status").val() != 'undefined') ? trim($("#status").val()) : '';
    var processed_by                    = (typeof $("#processed_by").val() != 'undefined') ? trim($("#processed_by").val()) : '';
    var added_by                        = (typeof $("#added_by").val() != 'undefined') ? trim($("#added_by").val()) : '';
    var updated_by                      = (typeof $("#updated_by").val() != 'undefined') ? trim($("#updated_by").val()) : '';
    var active                          = (typeof $("#active").val() != 'undefined') ? trim($("#active").val()) : '';
    var cRows                           = (typeof $("#cRows").val() != 'undefined') ? trim($("#cRows").val()) : '';
    var page                            = page;

    $("#loading").show(); //show loading element
    $("#table_tour_list").html('');
    $("#table_tour_list").load("fetch_ashtavinayak_list.php",{"arrangeOrder":arrangeOrder,"cRows":cRows,"page":page,"id":id,"tour_id":tour_id,"date":date,"bus":bus,"seats":seats,"pickup_point":pickup_point,"travellers":travellers,"status":status,"processed_by":processed_by,"added_by":added_by,"updated_by":updated_by}, function(){ //get content from PHP page
        $("#loading").hide(); //once done, hide loading element
        $("#id").val(id);
        $("#tour_id").val(tour_id);
        $("#date").val(date);
        $("#bus").val(bus);
        $("#seats").val(seats);
        $("#pickup_point").val(pickup_point);
        $("#travellers").val(travellers);
        $("#status").val(status);
        $("#processed_by").val(processed_by);
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


function trim(str){
    return str.replace(/^\s+|\s+$/g,"");
}
