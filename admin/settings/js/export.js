/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * JS for Product Export
*/ 


var sec = 0;
var minute = 0;
var countsec = 0;
var countminute = 0; 

timer = $.timer(
   function() 
   {
       sec=sec+1;$('#sec').val(sec);
       $('#TimeTaken').html("<b>Time Taken: </b>"+secToTimestamp(sec));
       //$('.minute').html(minute);					
   },
   1000,
   false
   );     


$(document).ready(function() 
{
    var iSeller_id  = $("#iSeller_id").val();
    
    $.post("ajax_calls.php",{request:'getCategory'},function(data) 
    {
        $("#exportCategory").html(data);
        $('#exportCategory').searchableOptionList();
    });
    
    
    $.post("ajax_calls.php",{request:'getSellers'},function(data) 
    {
        $("#exportSellers").html(data);
        $('#exportSellers').searchableOptionList();
    });
    
    $.post("ajax_calls.php",{request:'getFeatures'},function(data) 
    {
        $("#exportFeatures").html(data);
        $('#exportFeatures').searchableOptionList();
    });
    
});


function exportCSV()
{
    id_category = '';
    id_feature = '-1';
    
    var iSeller_id      = $("#iSeller_id").val();
    var cAdmin          = $("#cAdmin").val();
    var id_category     = $("#exportCategory").val();
    var id_feature      = $("#exportFeatures").val();
    var cError          = '';

    if(id_category == null)
        cError = 'Select atleast one category. <BR>';
    
    if(id_feature == null)
        id_feature = '-1';
    
    
    
    if(cError == '')
    {
        //window.location = "product_export.php?cAdmin="+cAdmin+"&iSeller_id="+iSeller_id+"&id_category="+id_category+"&id_brand="+id_brand+"&id_feature="+id_feature;
        $('#processing').show();
        $('#export').hide();
        $.post("export_request.php?cAdmin="+cAdmin+"&iSeller_id="+iSeller_id+"&id_category="+id_category+"&id_feature="+id_feature,{request:'getCount'},function(data) 
        {
            $('#processing').hide();
            if(trim(data) != 0)
            { 
                $('#data').html('');
                loop = parseInt(data/500)+1;
                start  = 0;
                end    = 500;
                total  = trim(data);
                $('#progress').html("0%"); 
                $('#progress_bar').css("width","100%");
                $('.meter').css("width","0%");
                $('#progress').show();
                $('#progress_bar').show();

                $('#RemainingTime').html("<b>Remaining Time: </b> Calculating...");
                $('#ProductCount').html("<b>Products Processed: </b> Calculating...");
                filter = "&cAdmin="+cAdmin+"&iSeller_id="+iSeller_id+"&id_category="+id_category+"&id_feature="+id_feature;

                sec = 0; //Reset Timer
                timer.play();
                getData(loop,start,end,0,total,filter);
            }
            else
            {
                alertify.alert("No Record Found", function()
                {
                    alertify.success('No Record Found');
                });
                timer.pause();
                $('#stopTimer').val('1');
                $('#progress').hide();
                $('#progress_bar').hide();
                $('#export').show();
            }
        });
    
    
    
    }
    else
    {
        alertify.alert("Please fix below issues: <BR>"+cError, function()
        {
            alertify.error('Error Occurred');
        });
    }
    
}
function startTimer()
{
    
}

function getData(loop,start,end,sec,total,filter)
{
    
    if(loop != 0)
    {
        startTime = $('#sec').val();
        $.post("export_request.php?loop="+loop+"&start="+start+"&end="+end+filter,{request:'getRecords'},function(data) 
        {
            if(end>total)
                end = total;
            
            progress = parseInt((end/total)*100);
            
            //Time taken
            $('#TimeTaken').html("<b>Time Taken: </b>"+secToTimestamp($('#sec').val()));
            
            //Calculate Remaining Time
            endTime         = $('#sec').val();
            calTime         = endTime - startTime;
            remainRecords   = total-end;
            finalCount      = parseInt(remainRecords/500) * calTime;
            if(finalCount > -1)
                $('#RemainingTime').html("<b>Remaining Time: </b>"+secToTimestamp(finalCount));
            else
                $('#RemainingTime').html("<b>Remaining Time: </b> Calculating...");
            
            //Product Count Display
            $('#ProductCount').html("<b>Products Processed: </b>"+end+"/"+total);
            $('#progress_bar').show();
            $('#progress').html(progress+" %");
            $('#progress_bar').css("width","100%");
            $('.meter').css("width",progress+"%");
            
            loop--;
            start = start+500;
            end = end+500;
            getData(loop,start,end,sec,total,filter);
        });
    }
    else
    {
        timer.pause();
        $('#stopTimer').val('1');
        $('#progress').hide();
        $('#progress_bar').hide();
        $('#export').show();
        alertify.success('Products list exported successfully.');
        window.location = "export_request.php";
    }
    
}
function secToTimestamp(seconds)
{
    var date = new Date(seconds * 1000);
    var hh = date.getUTCHours();
    var mm = date.getUTCMinutes();
    var ss = date.getSeconds();
    // If you were building a timestamp instead of a duration, you would uncomment the following line to get 12-hour (not 24) time
    // if (hh > 12) {hh = hh % 12;}
    // These lines ensure you have two-digits
    if (hh < 10) {hh = "0"+hh;}
    if (mm < 10) {mm = "0"+mm;}
    if (ss < 10) {ss = "0"+ss;}
    // This formats your string to HH:MM:SS
    var t = hh+":"+mm+":"+ss;
    return t;
}


function trim(str)
{
 return str.replace(/^\s+|\s+$/g,"");
}