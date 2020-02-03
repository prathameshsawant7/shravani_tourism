/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * JS for Product Upload
*/
$(document).ready(function() 
{
   $("#cPT_RCost").change(function()
   {
       $("#cPT_RCost").val(trim($("#cPT_RCost").val()));
       $("#cT_RCost").val(trim($("#cPT_RCost").val()));
       $("#cF_RCost").html(trim($("#cPT_RCost").val()));
       
   });
   
   $("#cT_RCost").change(function()
   {
       $("#cPT_RCost").val(trim($("#cPT_RCost").val()));
       $("#cT_RCost").val(trim($("#cPT_RCost").val()));
       $("#cF_RCost").html(trim($("#cPT_RCost").val()));
       
   });
   
   $(".Collapsable").click(function () {

        $(this).parent().children().toggle();
        $(this).toggle();

    });
    //$(".Collapsable").children().toggle();
    $('.ulClass').click(function(){ $(this).children().toggle(); });
    $("#cAvailableDate").datepicker();

    $.post("ajax_calls.php",{request:'getFeatureUnits'},function(data) 
    {
        $("#feature_table").html(data);
//        $("#cHeight_unit").html(data);
//        $.post("upload_ajax_calls.php",{request:'getFeatureUnits',feature:'Width'},function(data) 
//        {
//            $("#cWidth_unit").html(data);
//            $.post("upload_ajax_calls.php",{request:'getFeatureUnits',feature:'Metal Type'},function(data) 
//            {
//                $("#cMetalType").html(data);
//
//
//            });
//           
//        });
    });




});

function nextTab(id)
{
    $('.is-active').removeClass('is-active').next().addClass('is-active');
    $('a[role="tab"]').attr('aria-selected','false');
    $('#panel'+id+'v-label').attr('aria-selected','true');
}

function backTab(id)
{
    $('.is-active').removeClass('is-active').prev().addClass('is-active');
    $('a[role="tab"]').attr('aria-selected','false');
    $('#panel'+id+'v-label').attr('aria-selected','true');
}

function readURL(input) 
{
    if (input.files && input.files[0]) 
    {
        var reader = new FileReader();

        reader.onload = function (e) 
        {
            $('#img_'+input.id)
                .attr('src', e.target.result)
                .width(150)
                .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

function trim(str)
{
  return str.replace(/^\s+|\s+$/g,"");
}

