
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
        <link rel="stylesheet" href="../css/jquery-ui.css">
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


                    $query = "SELECT * FROM tour_type;";
				    $fetch_data = mysqli_query($con,$query);
				    $data = [];$i=0;
				    $bus_html = '';
				    while($order_data = $fetch_data->fetch_assoc()){
				    	$selected = ($order_data['identifier'] == $reserved_data['tour_type'])?'selected=selected':'';
				        $bus_html .= "<option value=".$order_data['identifier']." ".$selected.">".$order_data['identifier']."</option>";
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
                            <th style="border:1px solid #000000;"><label>Tour: </label></th>
                            <td > 
                                <span style="margin-left: 21px;">
                                	<select id="tour_id" name="tour_id" onchange="getTourTypesByTourID()">
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
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Tour Type: </label></th>
                            <td > 
                                <span style="margin-left: 21px;">
                                	<select id="tour_type" name="tour_type">
                                		<?php echo $bus_html; ?>
    	                        	</select>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Date: </label></th>
                            <td > <input type="text" id="date" name="date" value="<?php echo $reserved_data['date'];?>" /></td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;"><label>Bus Number: </label></th>
                            <td>
                                <span style="margin-left: 21px;">
                                    <select id="bus_no" placeholder="Bus" value=""  name="bus_no">
                                        <?php 
                                        $buses = ['1','2'];
                                        for($i=0;$i<2;$i++){
                                            $selected = ($buses[$i] == $reserved_data['bus_no'])?'selected=selected':'';
                                        ?>
                                            <option value="<?php echo $buses[$i];?>"  <?php echo $selected;?>>
                                                <?php echo $buses[$i];?>
                                            </option>
                                        <?php
                                        }
                                        ?>
                                    </select>
                                </span>
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
    //   tinymce.init({ selector:'textarea' });
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

        	function getTourTypesByTourID(){
        		var tour_id = $('#tour_id').val();
        		if(tour_id != ''){
        			 $.get("ajax_calls.php",{request:'getTourTypesByTourID'},function(data) {
        			 	var tour_type = JSON.parse(data);
        			 	select_html = "";
        			 	Object.keys(tour_type).forEach(function (key) {
						   select_html += '<option value="'+tour_type[key]['identifier']+'">';
						   select_html += tour_type[key]['name'];
						   select_html += '</option>';
						});
						$('#tour_type').html(select_html);
        			 });
        		}
        	}



        </script>
    </body>
</html>

