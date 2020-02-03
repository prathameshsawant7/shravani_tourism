/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * JS for View Product Page
*/
$(document).ready(function() {
    
    getprodInformation();
    getprodImages();
    getprodFeatures();
    getprodCombinations();
   
});

function getprodInformation()
{
    var product_id = $('#product_id').val();
    $.post("ajax_calls.php",{request:'getprodInformation',product_id:product_id},function(data) 
    {
        var prod_info = JSON.parse(data);
        
        $('#cName').html(prod_info['name']);
        $('#cReference').html(prod_info['reference']);
        $('#cShortDesc').html(prod_info['description_short']);
        $('#cDesc').html(prod_info['description']);
        if(prod_info['active'] == 1)
            $('#cStatus').attr('src','../img/enabled.gif');
        else
            $('#cStatus').attr('src','../img/disabled.gif');
        
        if(prod_info['available_for_order'] == 1)
            $('#Opt1').attr('src','../img/enabled.gif');
        else
            $('#Opt1').attr('src','../img/disabled.gif');
        
        if(prod_info['show_price'] == 1)
            $('#Opt2').attr('src','../img/enabled.gif');
        else
            $('#Opt2').attr('src','../img/disabled.gif');
        
        $('#cCost').html(prod_info['price']);
        $('#cAssoc').html(prod_info['crumb']);
        $('#cQuantity').html(prod_info['quantity']);
        $('#cAvailableDate').html(prod_info['available_date']);
        
        
        $('#img_panel1v').hide();
        $('#table_panel1v').show();
        
        //alert(prod_info['crumb']);
            
    });
}


function getprodImages()
{
    var product_id = $('#product_id').val();
    $.post("ajax_calls.php",{request:'getprodImages',product_id:product_id},function(data) 
    {
        $('#images_div').html(data);
    });
}

function getprodFeatures()
{
    var product_id = $('#product_id').val();
    $.post("ajax_calls.php",{request:'getprodFeatures',product_id:product_id},function(data) 
    {
        $('#features_div').html(data);
    });
}

function getprodCombinations()
{
    $('#img_panel5v').show();
    var product_id = $('#product_id').val();
    $.post("ajax_calls.php",{request:'getprodCombinations',product_id:product_id},function(data) 
    {
        $('#combination_div').html(data);
        $('#img_panel5v').hide();
    });
}

function combinationFeatures(id)
{
    $('#combinationPopup').html($('#json_'+id).html());
}

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



function trim(str)
{
  return str.replace(/^\s+|\s+$/g,"");
}