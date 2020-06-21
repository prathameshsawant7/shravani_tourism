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
                if(!empty($_GET['msg'])){
                    echo $_GET['msg'];
                }


            ?>
            </h4>
        </center>
        <form action="insert_tour.php" name="register" method="post" enctype="multipart/form-data">
        <input type="hidden" id="data" name="data" value="import_group_tour_dates" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs" style="margin-left: 5%;width:125%;">
                <BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="2">
                                <h3 style="color: #000"><center>Import Group Tour Dates</center></h3>
                
                           </th> 
                        </tr>
                        
                        <tr>
                            <th style="border:1px solid #000000;">
                                <label>Select CSV File: </label>
                                <a href="../files/sample_group_tour_dates.csv" style="font-size: 10px;">Click here to download sample group dates CSV</a>
                            </th>
                            <td> 
                                <input type="file" name="file" id="file" class="input-large">
                                <input type="submit" class="small button" value="Submit" style="margin-bottom: -4px;"/>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <style>
                    .col-txt-1-cen{
                        padding:5px;
                        text-transform: uppercase;
                        color:434343;
                        font-size: 0.9rem;
                        line-height: 1.5rem;
                        height:2rem;
                        text-align: center;
                    }

                .table-head{
                        padding:5px;
                        text-transform: uppercase;
                        color:434343;
                        font-size: 0.9rem;
                        line-height: 1.5rem;
                        height:2rem;
                        text-align: center;
                        font-weight: 600;
                        background-color: #f1f1f1;
                    }
                    
                </style>
                <BR>
                <input type="button" onclick="delete_dates()" value="Delete selected dates" style="float: right;">
                <BR><BR>
                <table class="table table-bordered table-sm">
                <thead>
                  <tr>
                    <th class="table-head">ID</th>
                    <th class="table-head">Tour</th>
                    <th class="table-head">Date</th>
                    <th class="table-head">Added By</th>
                    <th class="table-head">Delete</th>
                  </tr>
                </thead>
                <tbody>
                    <?php 
                    $query = "SELECT t.id, CONCAT(t.tour_code,' - ',t.tour_name) AS tour, STR_TO_DATE(b.date, '%d/%m/%Y') as date_ord, b.date , b.added_by FROM group_tour_dates as b LEFT JOIN tours as t ON t.id = b.tour_id WHERE b.active=1  AND date_format(STR_TO_DATE(b.date, '%d/%m/%Y'), '%Y%m%d') > date_format(curdate(), '%Y%m%d') ORDER BY date_ord;";
                    $fetch_data  = mysqli_query($con,$query);
                    while ($data = $fetch_data->fetch_assoc()) {
                    ?>
                    <tr>
                        <td class="col-txt-1-cen"><?php echo $data['id']; ?></td>
                        <td class="col-txt-1-cen"><?php echo $data['tour']; ?></td>
                        <td class="col-txt-1-cen"><?php echo $data['date']; ?></td>
                        <td class="col-txt-1-cen"><?php echo $data['added_by']; ?></td> 
                        <td class="col-txt-1-cen">
                            <input type="checkbox" name="delete" value="<?php echo $data['id']; ?>">
                        </td> 
                      </tr>
                    <?php } ?>
                  
                </tbody>
                </table>
                <input type="button" onclick="delete_dates()" value="Delete selected dates" style="float: right;"><BR><BR>
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
        <script type="text/javascript">
            function delete_dates(){
                var ids = [];
                $(':checkbox:checked').each(function(i){
                    ids[i] = $(this).val();
                });
                console.log(ids);
                if (typeof ids !== 'undefined' && ids.length > 0) {
                    page_action = 'delete_group_tour_dates';
                    $.post("ajax_calls.php",{request:page_action,data:ids},function(data){
                        if($.trim(data) == 'success'){
                            alert("Deleted successfully");
                        }else{
                            alert("Something went wrong. Please try again.");
                        }
                        location.reload();
                    });
                }else{
                    alert("Please select checkboxes to delete dates.");
                }
            }
        </script>
    </body>
</html>

