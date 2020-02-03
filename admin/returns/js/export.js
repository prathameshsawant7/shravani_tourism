/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * JS for Orders Export
*/ 


$(document).ready(function() 
{
    var iSeller_id  = $("#iSeller_id").val();
    $("#cFromDate").datepicker();
    $("#cToDate").datepicker();
    
    $( ".datepicker" ).datepicker({
        dateFormat: "yy-mm-dd"
      });
      
    // Getter
    var dateFormat = $( ".datepicker" ).datepicker( "option", "dateFormat" );

    // Setter
    $( ".datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
    
    $.post("ajax_calls.php",{request:'getStatus'},function(data) 
    {
        $("#exportStatus").html(data);
    });
    
});


function exportExcel()
{
    var iSeller_id  = $("#iSeller_id").val();
    var cFromDate   = $("#cFromDate").val();
    var cToDate     = $("#cToDate").val();
    var exportStatus= $("#exportStatus").val();
    var cError      = 0;

    if(cFromDate != '' && cToDate != '')
    {
        var diffDays = dateDiff(cFromDate,cToDate)

        if(diffDays > 90)
        {
            alert("Date range for export should not exceed more than 90 days(3 months)");
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
        window.location = "order_export.php?iSeller_id="+iSeller_id+"&exportStatus="+exportStatus+"&cFromDate="+cFromDate+"&cToDate="+cToDate;
    }
    
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

