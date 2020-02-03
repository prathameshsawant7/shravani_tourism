
<?php

include_once("../../configs/defines.php");
include("../../configs/settings.php");
$est =new settings();
$con=$est->connection();

?>
<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Shravani Tourism</title>
        <link rel="stylesheet" href="../css/foundation.css" />
        <link rel="stylesheet" href="../css/app.css" />
        <link rel="stylesheet" href="../css/sol.css" />
        <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
        <link rel="stylesheet" href="../css/multi-select.css" />
    </head>
    <body>
        <?php include '../menu.php'; ?>
        <div id="hiddenFields">
            <input  type="hidden" id="cFullpath" value="<?php echo FULLROOT; ?>">
            <input  type="hidden" id="cWebpath" value="<?php echo WEBROOT; ?>">
        </div>
        
        <center>
            <h4 style="color: green">
            <?php 
                $page_action = '';
                if(!empty($_GET['action']) && $_GET['action'] == 'edit'){
                    $id         = $_GET['id'];
                    $query      = "SELECT * FROM reserved_seats WHERE id=$id;";
                    $fetch_data = mysqli_query($con,$query);
                    $reserved_data  = $fetch_data->fetch_assoc();


                    $query = "SELECT * FROM buses WHERE tour_id = ".$reserved_data['tour_id'];
				    $fetch_data = mysqli_query($con,$query);
				    $data = [];$i=0;
				    $bus_html = '';
				    while($order_data = $fetch_data->fetch_assoc()){
				    	$selected = ($order_data['id'] == $reserved_data['bus_id'])?'selected=selected':'';
				        $bus_html .= "<option value=".$order_data['id']." ".$selected.">".$order_data['name']." - [Rs.".$order_data['price']."]</option>";
				    }

                    $page_action= $_GET['action'];

                    if(!empty($_GET['msg']) && $_GET['msg'] == 'update_success'){
                        echo "Reserved Seat ID - ".$_GET['id']. " has been updated successfully.";
                    }
                }else if(!empty($_GET['id'])){
                    echo "Reserved Seat ID - ".$_GET['id']. " has been added successfully.";
                } 

                

            ?>
            </h4>
        </center>
        <form action="insert_tour.php" name="register" method="post">
        <input type="hidden" id="data" name="data" value="reserved_seats" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs" style="margin-left: 30%;">
                <BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="2">
                                <h3 style="color: #000"><center>Add/Edit Reserved Seats</center></h3>
                
                           </th> 
                        </tr>
                        
                        <tr>
                            <th style="border:1px solid #000000;"><label>ID: </label></th>
                            <td> <input type="text" id="id" name="id" value="<?php echo $reserved_data['id'];?>" disabled /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Date: </label></th>
                            <td > <input type="text" id="date" name="date" value="<?php echo $reserved_data['date'];?>" /></td>
                        </tr>
                       	<tr>
                            <th style="border:1px solid #000000;"><label>Tour: </label></th>
                            <td > 
                            	<select id="tour_id" name="tour_id" onchange="getBusesByTourID()">
                            		<option value="">Please Select</option>
	                            <?php
	                            	$query = "SELECT id,tour_code,tour_name FROM tours WHERE tour_name LIKE '%ASHTAVINAYAK%';";
					                $fetch_data = mysqli_query($con,$query);
					                while($ashtavinayak_data  = $fetch_data->fetch_assoc()){ 
					                	$selected = ($ashtavinayak_data['id'] == $reserved_data['tour_id'])?'selected=selected':'';
					                	?>
					                	<option value="<?php echo $ashtavinayak_data['id']; ?>" <?php echo $selected; ?>>
					                		<?php echo $ashtavinayak_data['tour_code']; ?>
					                	</option>
					                	<?php
					                }
	                            ?>
	                        	</select>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Bus: </label></th>
                            <td > 
                            	<select id="bus" name="bus">
                            		<?php echo $bus_html; ?>
	                        	</select>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Reserved Seat: </label></th>
                            <td> 
                            	<select id="seats" name="seats[]" multiple="multiple">
                            		<?php
		                            	$query = "SELECT seat FROM ashtavinayak_seat_numbers;";
						                $fetch_data = mysqli_query($con,$query);
						                while($seat_data  = $fetch_data->fetch_assoc()){ 
						                	$selected = (in_array($seat_data['seat'], explode("|",$reserved_data['seats'])))?'selected=selected':'';
						                	?>
						                	<option value="<?php echo $seat_data['seat']; ?>" <?php echo $selected; ?>>
						                		<?php echo $seat_data['seat']; ?>
						                	</option>
						                	<?php
						                }
		                            ?>
                            	<!-- 	<option value="A">A</option>
									<option value="B">B</option>
									<option value="C">C</option>
									<option value="D">D</option>
									<option value="E">E</option>
									<option value="F">F</option>
									<option value="G">G</option>
									<option value="H">H</option>
									<option value="I">I</option>
									<option value="J">J</option>
									<option value="K">K</option>
									<option value="L">L</option>
									<option value="M">M</option>
									<option value="N">N</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
									<option value="6">6</option>
									<option value="7">7</option>
									<option value="8">8</option>
									<option value="9">9</option>
									<option value="10">10</option>
									<option value="11">11</option>
									<option value="12">12</option>
									<option value="13">13</option>
									<option value="14">14</option>
									<option value="15">15</option>
									<option value="16">16</option>
									<option value="17">17</option>
									<option value="18">18</option>
									<option value="19">19</option>
									<option value="20">20</option>
									<option value="21">21</option>
									<option value="22">22</option>
									<option value="23">23</option>
									<option value="24">24</option>
									<option value="25">25</option>
									<option value="26">26</option>
									<option value="27">27</option>
									<option value="28">28</option>
									<option value="29">29</option>
									<option value="30">30</option>
									<option value="31">31</option> -->
                            	</select>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <center>
                                    <input type="submit" class="small button" value="Submit" style="margin-bottom: -4px;"/>
                                </center>
                            </td>
                        </tr>
                    </tbody>
                </table>
               
                <input type="hidden" id="page_action" name="page_action" value="<?php echo $page_action;?>" />
                <input type="hidden" id="id" name="id" value="<?php echo $id;?>" />
                
            </div>
        </div>
        <script src="../js/jquery-1.11.2.min.js"></script>
        <script src="../js/menu.js"></script>
        <script src="../js/jquery-ui.min.js"></script>
        <script src="../js/vendor/what-input.min.js"></script>
        <script src="../js/foundation.min.js"></script>
        <script src="../js/jquery.reveal.js"></script>
        <script src="../js/app.js"></script>
        <script src="../js/sol.js"></script>
        <script src="../js/tinymce.min.js"></script>
        <script src="../js/jquery.multi-select.js"></script>
        <script>
            tinymce.init({ selector:'textarea' });
        	$('#seats').multiSelect();
        	$("#date").datepicker({ dateFormat: 'dd/mm/yy' });
      //   	<?php
      //   		if(isset($reserved_data[seats])){
      //   			//echo $seats = str_replace("|", ",",$reserved_data[seats]);
      //   			//$seats = explode('|', $reserved_data[seats]);
      //   			//print_r($seats);
      //   			?>
      //   				values = "<?php echo $reserved_data[seats]; ?>";
      //   				$.each(values.split("|"), function(i,e){
      //   					alert(e);
						//     $("#seats option[value='" + e + "']").prop("selected", "selected");
						// });
      //   		//	$('#seats').val(["A","B","C"]);
      //   				alert(1);
      //   			<?php
      //   		}
      //   	?>

        	function getBusesByTourID(){
        		var tour_id = $('#tour_id').val();
        		if(tour_id != ''){
        			 $.get("ajax_calls.php",{request:'getBusesByTourID',id:tour_id},function(data) {
        			 	var buses = JSON.parse(data);
        			 	select_html = "";
        			 	Object.keys(buses).forEach(function (key) {
        			 		console.log("dssd"+key);
						   select_html += '<option value="'+buses[key]['id']+'">';
						   select_html += buses[key]['name']+ ' - [Rs.'+buses[key]['price']+']';
						   select_html += '</option>';
						});
						$('#bus').html(select_html);
        			 });
        		}
        	}



        </script>
    </body>
</html>

