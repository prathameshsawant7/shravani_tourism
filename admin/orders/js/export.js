/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * JS for Orders Export
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
    $("#cFromDate").datepicker();
    $("#cToDate").datepicker();
    
    $(".datepicker").datepicker({
        dateFormat: "yy-mm-dd"
      });
      
    // Getter
    var dateFormat = $( ".datepicker" ).datepicker( "option", "dateFormat" );

    // Setter
    $( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
    
    $.post("ajax_calls.php",{request:'getStatus'},function(data) 
    {
        $("#exportStatus").html(data);
        $('#exportStatus').searchableOptionList();
    });
    
    $.post("ajax_calls.php",{request:'getFeatures'},function(data) 
    {
        $("#exportFeatures").html(data);
        $('#exportFeatures').searchableOptionList();
    });
    
});


function exportExcel()
{
    var iSeller_id      = $("#iSeller_id").val();
    var cFromDate       = $("#cFromDate").val();
    var cToDate         = $("#cToDate").val();
    var exportStatus    = $("#exportStatus").val();
    var exportFeatures  = $("#exportFeatures").val();
    var cError      = 0;

    if(exportStatus == null)
        exportStatus = '';
    
    if(exportFeatures == null)
        exportFeatures = '';

    if(cFromDate != '' && cToDate != '')
    {
        var diffDays = dateDiff(cFromDate,cToDate)

        if(diffDays > 92)
        {
            alertify.alert("Date range for export should not exceed more than 90 days(3 months)", function()
            {
                alertify.error('Error Occured');
            });
            $("#cToDate").val('');
            cError = 1;
        }
    }
    else if(cFromDate == '' && cToDate != '')
    {
        cFromDate = removeDays(cToDate,90);
        $("#cFromDate").val(cFromDate);
    }
    else if(cFromDate != '' && cToDate == '')
    {
        cToDate = addDays(cFromDate,90);
        $("#cToDate").val(cToDate);
    }
    else
    {
        $("#cToDate").val(getTodaysDate());
        $("#cFromDate").val(removeDays($("#cToDate").val(),90));
    }


    if(cError == 0)
    {
        var cFromDate   = $("#cFromDate").val();
        var cToDate     = $("#cToDate").val();
        //window.location = "order_export.php?iSeller_id="+iSeller_id+"&exportStatus="+exportStatus+"&exportFeatures="+exportFeatures+"&cFromDate="+cFromDate+"&cToDate="+cToDate;
    
        $('#processing').show();
        $('#export').hide();
        $.post("export_request.php?iSeller_id="+iSeller_id+"&exportStatus="+exportStatus+"&exportFeatures="+exportFeatures+"&cFromDate="+cFromDate+"&cToDate="+cToDate,{request:'getCount'},function(data) 
        {
            $('#processing').hide();
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
                $('#export').show();
            }
        });
    
    }
    
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




function addDays(date,days)
{ 
    
  var dmy = date.split("-");       
  var joindate = new Date(
      parseInt(dmy[0], 10),
      parseInt(dmy[1], 10) - 1,
      parseInt(dmy[2], 10)
  );
  joindate.setDate(joindate.getDate() + parseInt(days)); 
  var addDate = 
      (joindate.getFullYear()) + "-" +
      ("0" + (joindate.getMonth() + 1)).slice(-2) + "-" +
      ( "0" + joindate.getDate()).slice(-2) ;
  return addDate;
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
function removeDays(date,days)
{
  var dmy = date.split("-");       
  var joindate = new Date(
      parseInt(dmy[0], 10),
      parseInt(dmy[1], 10) - 1,
      parseInt(dmy[2], 10)
  );
  joindate.setDate(joindate.getDate() - parseInt(days)); 
  var addDate = 
      (joindate.getFullYear()) + "-" +
      ("0" + (joindate.getMonth() + 1)).slice(-2) + "-" +
      ( "0" + joindate.getDate()).slice(-2) ;
  return addDate;
}

function dateDiff(date1,date2)
{
    // First we split the values to arrays date1[0] is the year, [1] the month and [2] the day
    date1 = date1.split('-');
    date2 = date2.split('-');

    // Now we convert the array to a Date object, which has several helpful methods
    date1 = new Date(date1[0], date1[1], date1[2]);
    date2 = new Date(date2[0], date2[1], date2[2]);

    // We use the getTime() method and get the unixtime (in milliseconds, but we want seconds, therefore we divide it through 1000)
    date1_unixtime = parseInt(date1.getTime() / 1000);
    date2_unixtime = parseInt(date2.getTime() / 1000);

    // This is the calculated difference in seconds
    var timeDifference = date2_unixtime - date1_unixtime;

    // in Hours
    var timeDifferenceInHours = timeDifference / 60 / 60;

    // and finaly, in days :)
    var timeDifferenceInDays = timeDifferenceInHours  / 24;

    return timeDifferenceInDays;
  
}

function trim(str)
{
   return str.replace(/^\s+|\s+$/g,"");
}