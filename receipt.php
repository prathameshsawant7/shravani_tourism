<?php
include_once("configs/defines.php");
include("configs/settings.php");
$est =new settings();
$con=$est->connection();
session_start(); 

if(isset($_GET['ticket'])){
  $ticket = $_GET['ticket'];
  $query = "SELECT t.tour_name, b.* FROM ashtavinayak_bookings as b LEFT JOIN tours as t ON t.id = b.tour_id WHERE ticket = '".$ticket."'";
  $fetch_data = mysqli_query($con,$query);
  $result = $fetch_data->fetch_assoc();    
  $tour_name = $result['tour_name'];
  $ticket = $result['ticket'];
  $seat_data = json_decode($result['seat_data'],true);
  $rooms  = count(json_decode($result['room_data'],true));
  $cost_data = json_decode($result['cost_data'],true);

  $query = "SELECT t.name FROM `tour_type` as t LEFT JOIN ashtavinayak_bookings as b ON b.tour_type = t.identifier WHERE b.ticket = '".$ticket."'";
  $fetch_data = mysqli_query($con,$query);
  $tour_type = $fetch_data->fetch_assoc(); 

}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml" lang="en">

<head><meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<script src="scripts/swfobject_modified.js" type="text/javascript"></script>
<title>Booking of Package Tours Organiser In All Over India | Online Booking Ashtavinayak Darshan | Online Booking Shirdi, Shani Shinganapur,Nashik | Online Booking Kashmir Vaishnodevi Tour | Online Booking Shimla, Kulu-Manali | Online Booking Konkan Darshan| Online Booking Package Tours Organiser in Mumbai | Online Booking Package Organiser Tours in india </title>
<style>
@charset "utf-8";
/* CSS Document */
*
{
outline:0px;
}

@font-face {
  font-family: SegoeUI;
  src: url('SegoeUI.ttf');
}

body{
  margin:0px;
  background-repeat:repeat-x;
  overflow: auto;
}
img{
  margin:0px;
  padding: 0px;
}
p{
margin-left: 0;
margin-right: 0;
margin-top: 0;
margin-bottom: 0;
font-weight: normal;
color:#000;
FONT-FAMILY: Trebuchet Ms;
FONT-SIZE: 12px; 
Line-Height: 1.6em;
}
h1{
margin-left: 0;
margin-right: 0;
margin-top: 0;
margin-bottom: 0;
font-weight: normal;
color:#000;
FONT-FAMILY: Trebuchet Ms;
FONT-SIZE: 10px; 
Line-Height: 1.6em;
}
hr{
color:#fff;
height: 1px;
margin: 0px;
}
.table1 {
border-radius: 5px; 
-moz-border-radius: 5px; 
-webkit-border-radius: 5px; 
border: 2px solid #000;
}
@media print  {
    .noPrint   {
        display:none;
    }
}

.style1 {color: #000000}
</style>

</head>

<body>

<script type="text/javascript">
function geetPrint() {

  $id = document.getElementById('ticket_id').value;
  if($id == '') {
    return false;
  }
  
  location.href='print.php?id=' + $id + '&task=email';

}
</script>
<table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td>
    <img src="images/printButton.gif" class="noPrint" width="85" height="24" onclick="javascript:window.print();" style="cursor:pointer " />
    &nbsp;&nbsp;&nbsp;
  <!--  <img src="images/email_icon.jpg" class="noPrint" width="85" height="24" onclick="javascript:geetPrint();" style="cursor:pointer " /> -->
  </td>
  </tr>
</table>
<table width="700" border="0" align="center" cellpadding="0" cellspacing="0" bordercolor="0">
  <tr>
    <td><table width="690" border="0" align="center" cellpadding="0" cellspacing="0" background="http://www.shravanitourism.co.in/images/top_banner.jpg">
        <tr> 
          <td width="225" height="120"><div align="center"><img src="http://shravanitourism.co.in/images/logo.jpg" alt="" width="158" height="120" /></div></td>
          <td width="757" valign="top"> <table width="480" height="80" border="0" align="center" cellpadding="0" cellspacing="0">
              <tr> 
                <td width="477" height="8" valign="top">&nbsp;</td>
              </tr>
            </table></td>
        </tr>
      </table>
      <table width="690" border="0" align="center" cellpadding="0" cellspacing="0"  bgcolor="#FFFFFF">
        <tr> 
          <td> <table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
             <tr> 
                <td height="10" valign="top"></td>
              </tr>
            </table>
            <table width="650" border="0" align="center" cellpadding="0" cellspacing="0" class="table1">
      <tr>
      <td>
      <table width="630" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td height="27" colspan="2"> <p style="margin-right:3px; "><strong>Route:</strong> 
              <?php echo $tour_name; ?> </p></td>
          <td width="225" height="27"> <p><strong>Ticket No: </strong><?php echo $ticket;?></p></td>
        </tr>
        <tr> 
          <td height="27" colspan="2"> <p style="margin-right:3px; "><strong>Tour type:</strong> 
              <?php echo $tour_type['name'];?></p></td>
          <td width="225" height="27"> <p><strong>Date: </strong><?php echo $result['tour_date'];?></p></td>
        </tr>
        <tr> 
          <td height="27" colspan="2"> <p style="margin-right:3px; "><strong>Pickup:</strong> 
              <?php echo $result['tour_pickup'];?></p></td>
          <td width="225" height="27"> <p><strong>Drop: </strong><?php echo $result['tour_drop'];?></p></td>
        </tr>
        <tr> 
          <td height="27" colspan="2"> <p style="margin-right:3px; "><strong>Seat:</strong> 
              <?php echo $result['seat_no'];?></p></td>
          <td width="225" height="27"> <p><strong>Rooms: </strong><?php echo $rooms;?></p></td>
        </tr>
        <tr> 
          <td height="27" colspan="2"> <p style="margin-right:3px; "><strong>Base Cost:</strong> 
              Rs. <?php echo $cost_data['cost'];?>/-</p></td>
          <td width="225" height="27" rowspan="4"> 
            <p style="margin-right:3px; ">
              <strong>Total Cost:</strong> 
              Rs. <?php echo $cost_data['total_cost'];?>/-
            </p>
          </td>
        </tr>
        <tr> 
          <td height="27" colspan="2"> <p style="margin-right:3px; "><strong>Service Cost:</strong> 
              Rs. <?php echo $cost_data['service_charge'];?>/-</p></td>
        </tr>
        <tr> 
          <td height="27" colspan="2"> <p style="margin-right:3px; "><strong>GST:</strong> 
              Rs. <?php echo $cost_data['gst'];?>/-</p></td>
        </tr>
        <tr> 
          <td height="27" colspan="2"> <p style="margin-right:3px; "><strong>Discount:</strong> 
              Rs. <?php echo $cost_data['discount'];?>/-</p></td>
        </tr>
       </table>
       </td>
      </tr>
      </table>
      <BR>
      <table width="650" border="1" align="center" cellpadding="0" cellspacing="0" class="table1">
        <tr>
          <th colspan="3" align="left">
            <p style="margin-right:3px; ">
              <strong>Passenger Details</strong>
            </p>
          </th>
        </tr>
        <tr>
          <th>
            <p style="margin-right:3px; ">
              <strong>Name</strong>
            </p>
          </th>
          <th>
            <p style="margin-right:3px; ">
              <strong>Age</strong>
            </p>
          </th>
          <th>
            <p style="margin-right:3px; ">
              <strong>Gender</strong>
            </p>
          </th>
        </tr>
        <?php foreach ($seat_data as $key => $value) { ?>
          <tr>
            <td><center><p><?php echo $value['name'];?></p></center></td>
            <td><center><p><?php echo $value['age'];?></p></center></td>
            <td><center><p><?php echo $value['gender'];?></p></center></td>
          </tr>
        <?php } ?>
        
      </table>
      
<!-- 
    <hr />  

            <p align="center">&nbsp; </p>

            <table width="640" border="0" align="center" cellpadding="0" cellspacing="0">

              <tr> 

                <td width="327"><p><strong>Passenger Name</strong></p></td>

                <td width="148"><p><strong>Seat No</strong></p></td>

                <td width="165"><p><strong>Age</strong></p></td>

              </tr>


        
        <tr>        

        <td height="25"> 

                  <p>Siddhesh Gaikwad</p></td>

                <td height="25"> 

                  <p>19</p></td>

                <td height="25"> 

                  <p>25</p></td>

        </tr>                       

      
        

      </table>-->
      
      <p style="margin:3px 0">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;*Drop Via Kalyan , Thane ,Sion , Virar & Vasai.</p>
     
      <table width="698" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr bgcolor="#333333"> 
          <td height="30" colspan="4"> <h1><strong><font color="#FFFFFF">&nbsp;&nbsp;Terms 
              &amp; Conditions</font></strong></h1></td>
        </tr>
        <tr> 
          <td colspan="4"> <img src="images/blank.png" width="6" height="10" /></td>
        </tr>
        <tr> 
          <td valign="top" style="padding: 3px;"> <div align="right"><img src="images/print-bullete.png" width="12" /></div></td>
          <td valign="top" style="padding: 3px;"> <h1>If there are less than participants 
              in a group, then the road journey will be done by Tata Winger / 
              Tempo Traveller. Due to this arrangement there is possibility of 
              change in seat numbers.</h1></td>
          <td valign="top" style="padding: 3px;"> <div align="right"><img src="images/print-bullete.png" width="12" /></div></td>
          <td valign="top" style="padding: 3px;"> <h1>All baggage and personal 
              belongings of the tour participant is his/her responsibility and 
              company shall not be liable for the loss or damage of the same.</h1></td>
        </tr>
        <tr> 
          <td colspan="4"> <img src="images/blank.png" width="6" height="10" /></td>
        </tr>
        <tr> 
          <td width="21" height="50" valign="top" style="padding: 3px;"> <div align="right"><img src="images/print-bullete.png" width="12" /></div></td>
          <td width="338" valign="top" style="padding: 3px;"> <h1 align="justify">The 
              Company Reserves the right to alter, amend, postpone, or cancel 
              any of the tour advertised in the brochure, without assigning any 
              reason, whatsoever. Under circumstances of cancellation of any tour 
              by the company, money paid by the tour participant will be fully 
              refunded, but no compensation is payable.</h1></td>
          <td valign="top" style="padding: 3px;"><div align="right"><img src="images/print-bullete.png" width="12" /></div></td>
          <td valign="top" style="padding: 3px;"> <h1>If the tour Participant 
              misbehaves in a manner causing inconvenience or annoyance to other 
              tour participants or causes damage to the property of the company, 
              he/she will be asked to leave the tour immediately and the tour 
              escorts have been authorized to do so. There will not be any compensation 
              whatsoever in such cases.</h1></td>
        </tr>
        <tr> 
          <td colspan="4"><img src="images/blank.png" width="6" height="10" /></td>
        </tr>
        <tr> 
          <td height="20" valign="top" style="padding: 3px;"><div align="right"><img src="images/print-bullete.png" width="12" /></div></td>
          <td width="338" valign="top" style="padding: 3px;"> <h1>We are travel 
              / tour organizers. We do not have any control over airline, railways, 
              Coach Company, shipping company, hotels, transport, or any other 
              facilities, which are being provided by the third party. We are 
              not responsible for the delay or deficiency in the service provided 
              by such other agencies. Also the company does not have any control 
              on schedule of opening and closing timings of tourist attractions.</h1></td>
          <td valign="top" style="padding: 3px;"><div align="right"><img src="images/print-bullete.png" width="12" /></div></td>
          <td valign="top" style="padding: 3px;"> <h1>It is understood that tour 
              participants traveling with Shravani Tourism have read and accepted 
              the above terms and conditions.</h1></td>
        </tr>
        <tr> 
          <td colspan="4"><img src="images/blank.png" width="6" height="10" /></td>
        </tr>
        <tr> 
          <td valign="top" style="padding: 3px;"><div align="right"><img src="images/print-bullete.png" width="12" /></div></td>
          <td valign="top" style="padding: 3px;"> <h1>Smoking and drinking alcohol 
              is strictly prohibited during the bus journey / in the dining halls.</h1></td>
          <td valign="top" style="padding: 3px;"><div align="right"><img src="images/print-bullete.png" width="12" /></div></td>
          <td valign="top" style="padding: 3px;"> <h1>Manual bookings are subject 
              to payment realization.</h1></td>
        </tr>
        <tr> 
          <td height="10" colspan="4"><img src="images/blank.png" width="6" height="10" /></td>
        </tr>
      </table>

            
      <table align="center" border="0" cellpadding="0" cellspacing="0" width="690">
        <tbody>

                <tr> 

                  
            <td height="30" bgcolor="#333333"> <h1 align="justify"><strong>&nbsp;&nbsp;<img src="images/bullete.gif" alt="" width="9" height="7" />&nbsp;<span class="style1"><u><font color="#FFFFFF">Cancellation 
                &amp; Refunds</font></u></span></strong></h1></td>
                </tr>

                <tr> 

                  
            <td height="22"> 
              <h1><strong>&#8226;</strong> 5% of value charge, 

                      if booking cancelled 90 days prior to departure</h1></td>
                </tr>

                <tr> 

                  
            <td height="22"> 
              <h1><strong>&#8226;</strong> 20% of value charge, 

                      if booking cancelled 60 days prior to departure. </h1></td>
                </tr>

                <tr> 

                  
            <td height="22"> 
              <h1><strong>&#8226;</strong> 50% of value charge, 

                      if booking cancelled 30 days before departure.</h1></td>
                </tr>

                <tr> 

                  
            <td height="22"> 
              <h1><strong>&#8226;</strong> 100% of value charge, 

                      if booking cancelled less than 15 days before departure</h1></td>
                </tr>
              </tbody>
            </table>
      

            <p align="center"><strong><font color="#000000">For Cancellation OR 

              enquiry OR changes with the existing ticket</font></strong></p>

            <p align="center"><strong>Call us at 9689507349 / 9271527667 / 0250-6480216</strong></p>

    </td>

  </tr>

</table>

      <table width="650" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr> 
          <td bgcolor="#FFFFFF"><div class="bottombar"> 
              <table width="690" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr> 
                  <td height="22"><div align="center"> 
                      <hr />
                      <table width="690" border="0" cellspacing="0" cellpadding="0">
                        <tr> 
                          <td> 
                            <h1 align="left"><font color="#323232">� Shravani Tourism. 
                              All Rights Reserved.</font></h1></td>
                        </tr>
                    </table>
                      
                    </div></td>
                </tr>
              </table>
            </div></td>
        </tr>
      </table></td>
  </tr>
</table>
<p>&nbsp;</p><table width="640" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr> 
    <td><div align="right"><img src="images/printButton.gif" class="noPrint" onclick="javascript:window.print();" style="cursor:pointer; " width="85" height="24" /></div></td>
  </tr>
</table>
<p>&nbsp;</p>


</body>

</html>

