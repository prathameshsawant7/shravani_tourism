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
                $content_data = [];
                $query      = "SELECT * FROM site_content;";
                $fetch_data = mysqli_query($con,$query);

                while($fields  = $fetch_data->fetch_assoc()) {
                    $content_data[$fields['content_name']] = $fields['content_ids'];
                }
                
               //  $query = "SELECT id FROM tour_categories WHERE name LIKE '%Maharashtra Tours%';";
               //  $fetch_data = mysqli_query($con,$query);
               //  $maharashtra_data = $fetch_data->fetch_assoc();
               // /// print_r($maharashtra_data);exit;

               //  echo $query = "SELECT id,tour_code,tour_name FROM tour_categories WHERE FIND_IN_SET(".$maharashtra_data['id'].", tour_categories); ";exit;
            ?>
            </h4>
        </center>
        <form action="insert_tour.php" name="register" method="post" enctype="multipart/form-data">
        <input type="hidden" id="data" name="data" value="site_content" />
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs" style="margin-left: 2%;width: 130%;">
                <BR>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="2">
                                <h3 style="color: #000"><center>Homepage Content</center></h3>
                
                           </th> 
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;">
                                <label>Maharashtra Tours: </label>
                                <label>(Select 3 Tours)</label>
                            </th>
                            <td> 
                               <select id="home_maharashtra_tours" name="home_maharashtra_tours[]" multiple="multiple" style="width: 1000px;">
                                    <?php

                                        $query = "SELECT id FROM tour_categories WHERE name LIKE '%Maharashtra Tours%';";
                                        $fetch_data = mysqli_query($con,$query);
                                        $maharashtra_data = $fetch_data->fetch_assoc();
                                       /// print_r($maharashtra_data);exit;

                                        $query = "SELECT id,tour_code,tour_name FROM tours WHERE FIND_IN_SET(".$maharashtra_data['id'].", tour_categories) and active=1; ";
                                        #$query = "SELECT id,tour_code,tour_name FROM tours; ";
                                        $fetch_data = mysqli_query($con,$query);
                                        while($data  = $fetch_data->fetch_assoc()){ 
                                            $selected = (in_array($data['id'], explode(",",$content_data['home_maharashtra_tours'])))?'selected=selected':'';
                                            ?>
                                            <option value="<?php echo $data['id']; ?>" <?php echo $selected; ?>>
                                                <?php echo $data['tour_code']." - ".$data['tour_name']; ?>
                                            </option>
                                            <?php
                                        }
                                    ?> 
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;">
                                <label>India Tours: </label>
                                <label>(Select 3 Tours)</label>
                            </th>
                            <td> 
                               <select id="home_india_tours" name="home_india_tours[]" multiple="multiple" style="width: 1000px;">
                                    <?php

                                        $query = "SELECT id,tour_code,tour_name FROM tours WHERE  active=1;";
                                        #$query = "SELECT id,tour_code,tour_name FROM tours; ";
                                        $fetch_data = mysqli_query($con,$query);
                                        while($data  = $fetch_data->fetch_assoc()){ 
                                            $selected = (in_array($data['id'], explode(",",$content_data['home_india_tours'])))?'selected=selected':'';
                                            ?>
                                            <option value="<?php echo $data['id']; ?>" <?php echo $selected; ?>>
                                                <?php echo $data['tour_code']." - ".$data['tour_name']; ?>
                                            </option>
                                            <?php
                                        }
                                    ?> 
                                </select>
                            </td>
                        </tr>
                        
                    </tbody>
                </table>
                <table border="4">
                    <tbody>
                        <tr>
                           <th colspan="2">
                                <h3 style="color: #000"><center>Family Tours Content</center></h3>
                           </th> 
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;">
                                <label>States: </label>
                                <label>(Select 3 States)</label>
                            </th>
                            <td> 
                               <select id="family_tour_states" name="family_tour_states[]" multiple="multiple" style="width: 1000px;">
                                    <?php

                                        $query = "SELECT id_state,state FROM states WHERE  active=1;";
                                        #$query = "SELECT id,tour_code,tour_name FROM tours; ";
                                        $fetch_data = mysqli_query($con,$query);
                                        while($data  = $fetch_data->fetch_assoc()){ 
                                            $selected = (in_array($data['id_state'], explode(",",$content_data['family_tour_states'])))?'selected=selected':'';
                                            ?>
                                            <option value="<?php echo $data['id_state']; ?>" <?php echo $selected; ?>>
                                                <?php echo $data['state']; ?>
                                            </option>
                                            <?php
                                        }
                                    ?> 
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th style="border:1px solid #000000;">
                                <label>Special Holiday Package: </label>
                                <label>(Select 4 Tours)</label>
                            </th>
                            <td> 
                               <select id="family_tour_special_packages" name="family_tour_special_packages[]" multiple="multiple" style="width: 1000px;">
                                    <?php

                                        $query = "SELECT id,tour_code,tour_name FROM tours WHERE  active=1;";
                                        #$query = "SELECT id,tour_code,tour_name FROM tours; ";
                                        $fetch_data = mysqli_query($con,$query);
                                        while($data  = $fetch_data->fetch_assoc()){ 
                                            $selected = (in_array($data['id'], explode(",",$content_data['family_tour_special_packages'])))?'selected=selected':'';
                                            ?>
                                            <option value="<?php echo $data['id']; ?>" <?php echo $selected; ?>>
                                                <?php echo $data['tour_code']." - ".$data['tour_name']; ?>
                                            </option>
                                            <?php
                                        }
                                    ?> 
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <center>
                    <input type="submit" class="small button" value="Submit" style="margin-bottom: -4px;"/>
                </center>
                <BR>
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
        <script src="../js/jquery.quicksearch.js"></script>
        <script>
            //tinymce.init({ selector:'textarea' });
            $('#home_maharashtra_tours').multiSelect({
                selectableHeader: "<input type='text' class='search-input' autocomplete='on' placeholder='Search Box' style='width:100%;'>",
                selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search Box' style='width:100%;'>",
                afterInit: function(ms){
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                      if (e.which === 40){
                        that.$selectableUl.focus();
                        return false;
                      }
                    });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                      if (e.which == 40){
                        that.$selectionUl.focus();
                        return false;
                      }
                    });
                  },
                  beforeSelect: function(){
                    alert($('#home_maharashtra_tours').length());
                  },
                  afterSelect: function(){
                    var val = $('#home_maharashtra_tours').val();
                    //var val_arr = val.split(',');
                    console.log(val);
                    if(val.length > 3){
                        alert("Select only 3 packages.")
                        $('#home_maharashtra_tours').multiSelect('deselect', val[3]);
                    }
                    
                    this.qs1.cache();
                    this.qs2.cache();
                  },
                  afterDeselect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                  },
                multiple: true,
                header: "Type",
                noneSelectedText: "Type",
                selectedList: 1,
                beforeopen: function(){ 
                    $(this).multiselect('widget').width(1000);

                }
            }).css('width','200%');


            //Home India Tours

            $('#home_india_tours').multiSelect({
                selectableHeader: "<input type='text' class='search-input' autocomplete='on' placeholder='Search Box' style='width:100%;'>",
                selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search Box' style='width:100%;'>",
                afterInit: function(ms){
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                      if (e.which === 40){
                        that.$selectableUl.focus();
                        return false;
                      }
                    });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                      if (e.which == 40){
                        that.$selectionUl.focus();
                        return false;
                      }
                    });
                  },
                  beforeSelect: function(){
                    alert($('#home_india_tours').length());
                  },
                  afterSelect: function(){
                    var val = $('#home_india_tours').val();
                    //var val_arr = val.split(',');
                    console.log(val);
                    if(val.length > 3){
                        alert("Select only 3 packages.")
                        $('#home_india_tours').multiSelect('deselect', val[3]);
                    }
                    
                    this.qs1.cache();
                    this.qs2.cache();
                  },
                  afterDeselect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                  },
                multiple: true,
                header: "Type",
                noneSelectedText: "Type",
                selectedList: 1,
                beforeopen: function(){ 
                    $(this).multiselect('widget').width(1000);

                }
            }).css('width','200%');



            //Family Tours States

            $('#family_tour_states').multiSelect({
                selectableHeader: "<input type='text' class='search-input' autocomplete='on' placeholder='Search Box' style='width:100%;'>",
                selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search Box' style='width:100%;'>",
                afterInit: function(ms){
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                      if (e.which === 40){
                        that.$selectableUl.focus();
                        return false;
                      }
                    });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                      if (e.which == 40){
                        that.$selectionUl.focus();
                        return false;
                      }
                    });
                  },
                  afterSelect: function(){
                    var val = $('#family_tour_states').val();
                    //var val_arr = val.split(',');
                    console.log(val);
                    if(val.length > 3){
                        alert("Select only 3 packages.")
                        $('#family_tour_states').multiSelect('deselect', val[3]);
                    }
                    
                    this.qs1.cache();
                    this.qs2.cache();
                  },
                  afterDeselect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                  },
                multiple: true,
                header: "Type",
                noneSelectedText: "Type",
                selectedList: 1,
                beforeopen: function(){ 
                    $(this).multiselect('widget').width(1000);

                }
            }).css('width','200%');


            //Family Tours Special Holiday Packages

            $('#family_tour_special_packages').multiSelect({
                selectableHeader: "<input type='text' class='search-input' autocomplete='on' placeholder='Search Box' style='width:100%;'>",
                selectionHeader: "<input type='text' class='search-input' autocomplete='off' placeholder='Search Box' style='width:100%;'>",
                afterInit: function(ms){
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                    .on('keydown', function(e){
                      if (e.which === 40){
                        that.$selectableUl.focus();
                        return false;
                      }
                    });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                    .on('keydown', function(e){
                      if (e.which == 40){
                        that.$selectionUl.focus();
                        return false;
                      }
                    });
                  },
                  afterSelect: function(){
                    var val = $('#family_tour_special_packages').val();
                    //var val_arr = val.split(',');
                    console.log(val);
                    if(val.length > 4){
                        alert("Select only 4 packages.")
                        $('#family_tour_special_packages').multiSelect('deselect', val[4]);
                    }
                    
                    this.qs1.cache();
                    this.qs2.cache();
                  },
                  afterDeselect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                  },
                multiple: true,
                header: "Type",
                noneSelectedText: "Type",
                selectedList: 1,
                beforeopen: function(){ 
                    $(this).multiselect('widget').width(1000);

                }
            }).css('width','200%');


        </script>
    </body>
</html>

