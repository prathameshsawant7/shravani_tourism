$(document).ready(function() {
    getSetSeller();    
});

function setSeller()
 {
    var iSellerArray    = $('#input_setSeller').val();
    var error ='';
    if(iSellerArray=== null || iSellerArray.length == 0)
        error += "Select sellers for template. <BR>";
    
    
    if(error == '')
    {
        iSeller_id = '';
        
        for(i=0;i<iSellerArray.length;i++)
        {  
            //alert(iSellerArray[i]);
            if(i != 0)
                iSeller_id += ",";

            iSeller_id += iSellerArray[i];
        }
        $.post("../setSellers.php",{request:'setTemplate',iSeller_id:iSeller_id},function(data) 
        {
            window.location.reload();
        });
    }
    else
    {
        alertify.alert("Please select sellers to set template.", function()
        {
            alertify.error('Error Occured');
        });
    }
 }
 
 function saveSeller()
 {
    var iSellerArray    = $('#input_saveSeller').val();
    var cTemplatename   = $('#cTemplatename').val();
    var error           = '';
    
    if(iSellerArray=== null || iSellerArray.length == 0)
        error += "Select sellers for template. <BR>";
    
     
    if(cTemplatename == '')
        error += "Enter template name. <BR>";
    
    if(error == '')
    {
        iSeller_id = '';
        for(i=0;i<iSellerArray.length;i++)
        {  
            //alert(iSellerArray[i]);
            if(i != 0)
                iSeller_id += ",";

            iSeller_id += iSellerArray[i];
        }
        $('#cTemplatename').val('');
        $.post("../setSellers.php",{request:'saveTemplate',iSeller_id:iSeller_id,cTemplatename:cTemplatename},function(data) 
        {
            alert(1);
            alertify.alert(trim(data), function()
            {
                alertify.success('Success');
            });
            getSetSeller();
            
        });
        
    }
    else
    {
        alertify.alert("Please fix below errors: <BR>"+error, function()
        {
            alertify.error('Error Occured');
        });
    }
    //$("#iSeller_id").val($('#input_setSeller').val());
 }
 
 function updateSeller()
 {
    var iSellerArray    = $('#input_updateSeller').val();
    var cTemplatename   = $('#template_list option:selected').text();
    var error           = '';
    
    if(cTemplatename == 'Please select')
        error += "Select template name. <BR>";
    
    if(iSellerArray=== null || iSellerArray.length == 0)
        error += "Select sellers to update template. <BR>";
    
    if(error == '')
    {
        iSeller_id = '';
        for(i=0;i<iSellerArray.length;i++)
        {  
            alert(iSellerArray[i]);
            if(i != 0)
                iSeller_id += ",";

            iSeller_id += iSellerArray[i];
        }
        
        $.post("../setSellers.php",{request:'updateTemplate',iSeller_id:iSeller_id,cTemplatename:cTemplatename},function(data) 
        {
            alertify.alert(trim(data), function()
            {
                alertify.success('Success');
            });
            getSetSeller();
        });
        
    }
    else
    {
        alertify.alert("Please fix below errors: <BR>"+error, function()
        {
            alertify.error('Error Occured');
        });
    }
    //$("#iSeller_id").val($('#input_setSeller').val());
 }
 
 function deleteSeller()
 {
    var cTemplatename   = $('#delete_template_list option:selected').text();
    var error           = '';
    
    if(cTemplatename == 'Please select')
        error += "Select template name. <BR>";
    
    
    if(error == '')
    {
        $.post("../setSellers.php",{request:'deleteTemplate',cTemplatename:cTemplatename},function(data) 
        {
            alertify.alert(trim(data), function()
            {
                alertify.success('Success');
            });
            getSetSeller();
        });
        
    }
    else
    {
        alertify.alert("Please fix below errors: <BR>"+error, function()
        {
            alertify.error('Error Occured');
        });
    }
    //$("#iSeller_id").val($('#input_setSeller').val());
 }
 
 function getSetSeller()
 {
    var iSeller_id          = $("#iSeller_id").val();
    var cSeller_template    = $("#cSeller_template").val();
    var cAdmin              = $("#cAdmin").val();
    $.post("../setSellers.php",{request:'getSetSeller',iSeller_id:iSeller_id,cSeller_template:cSeller_template},function(data) 
    {
       // alert(trim(data));
        var obj = $.parseJSON(data);
        $('#setTemplate_div').html(obj['setTemplateHTML']);
        $('#saveTemplate_div').html(obj['saveTemplateHTML']);
        $('#updateTemplate_div').html(obj['updateTemplateHTML']);
        $('#deleteTemplate_div').html(obj['deleteTemplateHTML']);
        $('#input_setSeller').searchableOptionList();
        $('#input_saveSeller').searchableOptionList();
        $('#input_updateSeller').searchableOptionList();
        //getSetSeller();
        if(cAdmin == 1)
            alertify.success('Sellers list updated.');
        $("#template_list").change(function()
        {
            $('#input_updateSeller option').removeAttr("selected");
            $('.sol-checkbox').removeAttr("checked");
            
            str = $(this).val();
            selectArray = str.split(',');
            for(i=0;i<selectArray.length;i++)
            {
                $('#input_updateSeller option[value="'+selectArray[i]+'"]').prop('selected',true);
                $('input[name="updateCheck"]').each(function() 
                {
                    if($(this).attr('value') == selectArray[i])
                        $(this).prop("checked", true);
                });
            }
            //alert($('#input_updateSeller').val());
        });
        
    });
 }
    
    