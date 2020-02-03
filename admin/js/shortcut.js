var toggle = $('#ss_toggle');
var menu = $('#ss_menu');
var rot;
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
			    
$('#ss_toggle').on('click', function(ev) 
{
    rot = parseInt($(this).data('rot')) - 180;
    menu.css('transform', 'rotate(' + rot + 'deg)');
    menu.css('webkitTransform', 'rotate(' + rot + 'deg)');
    if (!$(toggle).parent().hasClass('ss_active')) 
    {
        //Moving in
        toggle.parent().addClass('ss_active');
        toggle.addClass('close');
    } 
    else 
    {
        //Moving Out
        toggle.parent().removeClass('ss_active');
        toggle.removeClass('close');
    }
    $(this).data('rot', rot);
});

menu.on('click', function() {
    if ($('#ss_menu div i').hasClass('icon-services')) 
    {
        $('#ss_menu div i').removeClass('icon-services')
        $('#ss_menu div i').addClass('icon-close1')
        $('#ss_menu div i').addClass('ss_animate'); 
    } 
    else 
    {
        $('#ss_menu div i').removeClass('icon-close1')
        $('#ss_menu div i').addClass('icon-services')
        $('#ss_menu div i').removeClass('ss_animate');
    }
});


function quickExport()
{
    var iSeller_id      = $("#iSeller_id").val();
    var cFromDate       = getTodaysDate();
    var cToDate         = getTodaysDate();
    var exportStatus    = '';
    var exportFeatures  = '';
    $('#ss_toggle').trigger('click');
    //window.location = "order_export.php?iSeller_id="+iSeller_id+"&exportStatus="+exportStatus+"&exportFeatures="+exportFeatures+"&cFromDate="+cFromDate+"&cToDate="+cToDate;

    $.post("../orders/export_request.php?iSeller_id="+iSeller_id+"&exportStatus="+exportStatus+"&exportFeatures="+exportFeatures+"&cFromDate="+cFromDate+"&cToDate="+cToDate,{request:'getCount'},function(data) 
    {
        if(trim(data) != 0)
        {
            $('#data').html('');
            loop = parseInt(data/100)+1;
            start  = 0;
            end    = 100;
            total  = trim(data);
            $('#progress').html("0%"); 
            $('#progress_bar').css("width","100%");
            $('.meter').css("width","0%");
            $('#progress').show();
            $('#progress_bar').show();

            $('#RemainingTime').html("<b>Remaining Time: </b> Calculating...");
            $('#OrderCount').html("<b>Orders Processed: </b> Calculating...");

            filter = "&iSeller_id="+iSeller_id+"&exportStatus="+exportStatus+"&exportFeatures="+exportFeatures+"&cFromDate="+cFromDate+"&cToDate="+cToDate;

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
        }
    });
}


function getData(loop,start,end,sec,total,filter)
{
    if(loop != 0)
    {
        startTime = $('#sec').val();
        $.post("../orders/export_request.php?loop="+loop+"&start="+start+"&end="+end+filter,{request:'getRecords'},function(data) 
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
            finalCount      = parseInt(remainRecords/100) * calTime;
            if(finalCount > -1)
                $('#RemainingTime').html("<b>Remaining Time: </b>"+secToTimestamp(finalCount));
            else
                $('#RemainingTime').html("<b>Remaining Time: </b> Calculating...");
            
            //Product Count Display
            $('#OrderCount').html("<b>Orders Processed: </b>"+end+"/"+total);
            
            
            $('#progress_bar').show();
            $('#progress').html(progress+" %");
            $('#progress_bar').css("width","100%");
            $('.meter').css("width",progress+"%");
            
            loop--;
            start = start+100;
            end = end+100;
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
        alertify.success('Orders list exported successfully.');
        window.location = "../orders/export_request.php"; //95217
    }
    
}

function todaySale()
{
    var iSeller_id      = $("#iSeller_id").val();
    var date            = getTodaysDate();
    $('#todaySale_processing').show();
    $('#ss_toggle').trigger('click');
    $.post("../ajax_call.php",{request:'todaySale',iSeller_id:iSeller_id,date:date},function(data) 
    {
        $('#todaySale_processing').hide();
        $('#todaySalerecords').html(trim(data));
    });
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


function getTodaysDate()
{
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();

    if(dd<10) {
        dd='0'+dd
    } 

    if(mm<10) {
        mm='0'+mm
    } 

    today = yyyy+'-'+mm+'-'+dd;
    return today;
}

