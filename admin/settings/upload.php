<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Upload product page
--> 
<?php
include_once("../config/defines.php");
include("../config/start_session.php");
include("../config/settings.php");
$est =new settings();
$con=$est->connection();

?>

<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seller Hub</title>
    <link rel="stylesheet" href="../css/foundation.css" />
    <link rel="stylesheet" href="../css/app.css" />
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/jquery-ui.css">
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="../js/menu.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    
  </head>
  <body>
    <?php
        include '../menu.php';
    ?>
  
    <BR>
    
    <?php
    
        $aCats = mysqli_query($con,"SELECT DISTINCT id,name FROM js_category_list WHERE type=0 and parent = 0 ORDER BY name;");
       // $aCats = mysqli_fetch_array($fetch_data);
        
        $aTreeData = mysqli_query($con,"SELECT DISTINCT cl.id_category as id, cl.name as name, c.id_parent as parent "
                . "FROM js_category_lang AS cl "
                . "INNER JOIN js_category AS c ON cl.id_category = c.id_category "
                . "WHERE c.level_depth > 1 AND c.active =1");
        
        
//        $query = "SELECT fvl.id_feature_value,fvl.value "
//                . "FROM js_feature_value_lang AS fvl,js_feature_lang AS fl,js_feature_value AS fv "
//                . "WHERE fv.id_feature = fl.id_feature AND fv.id_feature_value=fvl.id_feature_value AND fl.name = 'Width' "
//                . "ORDER BY fvl.value;";
//        $qWidth = mysqli_query($con,$query);
       
        //echo $query;exit;
        
       // $aSubCats = mysqli_fetch_array($fetch_data);
       //echo '<pre>';print_r($acc_details);
    ?>
    
    <div id="hiddenFields">
        <input  type="hidden" id="seller_id" value="<?php echo $_SESSION['cSellerID']; ?>">
    </div>
     <div class="large-12 columns no-pad">
        <div class="large-3 columns dark_bg no-pad">
            <div class="row dark_bg">
                <h4><i class="fa fa-upload"></i>Product Upload</h4>
            </div>
            <div class="row dark_bg height_200vh">
                <ul class="tabs vertical" id="example-vert-tabs" data-tabs  >
                    <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true"><i class="fa fa-info"></i>Information</a></li>
                    <li class="tabs-title"><a href="#panel2v"><i class="fa fa-inr"></i></i>Prices</a></li>
                    <li class="tabs-title"><a href="#panel3v"><i class="fa fa-sitemap"></i>Associations</a></li>
                    <li class="tabs-title"><a href="#panel4v"><i class="fa fa-list"></i>Quantities</a></li>
                    <li class="tabs-title"><a href="#panel5v"><i class="fa fa-picture-o"></i>Images</a></li>
                    <li class="tabs-title"><a href="#panel6v"><i class="fa fa-star"></i>Features</a></li>
                </ul>
            </div>
        </div>
       

            <!--  -->

                <div class="large-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
                <div class="tabs-panel is-active" id="panel1v">
                    <div class="row input_area">
                        <div class="large-12 medium-12 columns border">
                                <form>
                                  <div class="row">
                                    <div class="medium-6 columns">
                                      <label>Name
                                        <input id="cName" name="cName"  value="" type="text" placeholder="Enter your name here">
                                      </label>
                                    </div>
                                    <div class="medium-6 columns">
                                      <label>Reference
                                        <input id="cReference" name="cReference"  value="" type="text" placeholder="Enter reference here">
                                      </label>
                                    </div>
                                    <div class="medium-12 columns">
                                      <label>
                                          Short Description
                                          <textarea id="cShortDesc" name="cShortDesc" placeholder="Enter description here in short"></textarea>
                                      </label>
                                    </div>
                                    <div class="medium-12 columns">
                                      <label>
                                          Description
                                          <textarea class="desc" id="cDesc" name="cShortDesc" placeholder="Enter description here"></textarea>
                                      </label>
                                    </div>

                                    <div class="medium-12 columns">
                                      <label>
                                          Tags
                                          <textarea class="" id="cTags" name="cTags" placeholder="Enter tags here"></textarea>
                                      </label>
                                    </div>
                                    <div class="medium-4 columns">
                                        <legend>Status</legend>
                                        <input type="radio" id="cStatusEnable" name="cStatus"><label for="pokemonRed">Enable</label>
                                        <input type="radio" id="cStatusDisable" name="cStatus"><label for="pokemonBlue">Desable</label>
                                    </div>

                                     <div class="medium-8 columns">
                                         <legend>Check these out</legend>
                                         <input id="cOption1" name="cOption1" type="checkbox"><label for="checkbox1">Available for Order</label>
                                         <input id="cOption2" name="cOption2" type="checkbox"><label for="checkbox2">Show Price</label>
                                         <input id="cOption3" name="cOption3" type="checkbox"><label for="checkbox3">Online only (not sold in store)</label>
                                    </div>


                                  </div>
                                
                        <input type="button" onclick="nextTab('2')" class="small button input_area" value="Next"/>
                        </div>
                    </div>
                </div>
                <div class="tabs-panel" id="panel2v">
                    <div class="row">
                       <div class="large-12 medium-12 columns border">
                            

                                  <div class="row">
                                    <div class="medium-6 columns">
                                      <label>Product cost
                                        <input id="cName" name="cName"  value="" type="text" placeholder="Enter your name here">
                                      </label>
                                    </div>
                                    <div class="medium-6 columns">
                                      <label>Pre-tax retail price
                                        <input id="cReference" name="cReference"  value="" type="text" placeholder="Enter reference here">
                                      </label>
                                    </div>
                                   
                                     <div class="medium-6 columns">
                                      <label>Retail price with tax
                                        <input id="cReference" name="cReference"  value="" type="text" placeholder="Enter reference here">
                                      </label>
                                    </div>

                                     <div class="medium-6 columns">
                                      <label>Final retail price
                                        <input id="cReference" name="cReference" readonly  value="0.00" type="text" placeholder="Enter reference here">
                                      </label>
                                    </div>
                                 
                                  </div>
                           
                           <input type="button" onclick="backTab('1')" class="small button" value="Back"/>
                        <input type="button" onclick="nextTab('3')" class="small button" value="Next"/>

                        </div> 

                        
                    </div>
                </div>
                <div class="tabs-panel" id="panel3v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                           <ul style="list-style: none; background:#ccc; padding:10px 0;">
                           <?php
                           
                                while ($data = $aTreeData->fetch_assoc())
                                {
                                    $row[] = $data;
                                }
                                //$row = mysqli_fetch_all($aTreeData,MYSQLI_ASSOC);
                                //echo "<pre>";print_r($row);
                               echo(generatePageTree($row,'2'));
                           
//                            ?>
                           </ul>

<!--                            <ul>
                                <li><span class="Collapsable">item 1</span><ul>
                                    <li><span class="Collapsable">item 1</span></li>
                                    <li><span class="Collapsable">item 2</span><ul>
                                        <li><span class="Collapsable">item 1</span></li>
                                        <li><span class="Collapsable">item 2</span></li>
                                        <li><span class="Collapsable">item 3</span></li>
                                        <li><span class="Collapsable">item 4</span></li>
                                    </ul>
                                    </li>
                                    <li><span class="Collapsable">item 3</span></li>
                                    <li><span class="Collapsable">item 4</span><ul>
                                        <li><span class="Collapsable">item 1</span></li>
                                        <li><span class="Collapsable">item 2</span></li>
                                        <li><span class="Collapsable">item 3</span></li>
                                        <li><span class="Collapsable">item 4</span></li>
                                    </ul>
                                    </li>
                                </ul>
                                </li>
                                <li><span class="Collapsable">item 2</span><ul>
                                    <li><span class="Collapsable">item 1</span></li>
                                    <li><span class="Collapsable">item 2</span></li>
                                    <li><span class="Collapsable">item 3</span></li>
                                    <li><span class="Collapsable">item 4</span></li>
                                </ul>
                                </li>
                                <li><span class="Collapsable">item 3</span><ul>
                                    <li><span class="Collapsable">item 1</span></li>
                                    <li><span class="Collapsable">item 2</span></li>
                                    <li><span class="Collapsable">item 3</span></li>
                                    <li><span class="Collapsable">item 4</span></li>
                                </ul>
                                </li>
                                <li><span class="Collapsable">item 4</span></li>
                            </ul>-->
                            <input type="button" onclick="backTab('2')" class="small button" value="Back"/>
                            <input type="button" onclick="nextTab('4')" class="small button" value="Next"/>
                        </div> 
                    </div>
                </div>
                
                <div class="tabs-panel" id="panel4v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                            
                            <div class="row">
                                    <div class="medium-6 columns">
                                      <label>Minimum quantity
                                        <input id="cMinQuantity" name="cMinQuantity" type="text" placeholder="Enter your name here">
                                      </label>
                                    </div>
                                    <div class="medium-6 columns">
                                      <label>Available date
                                        <input id="cAvailableDate" name="cAvailableDate" type="text" />
                                      </label>
                                    </div>
                                   
                                 
                                  </div>

                            <input type="button" onclick="backTab('3')" class="small button" value="Back"/>
                            <input type="button" onclick="nextTab('5')" class="small button" value="Next"/>
                        </div> 
                    </div>
                </div>
                
                <div class="tabs-panel" id="panel5v">
                    <div class="row">
                       <div class="large-12 medium-12 columns border">
                            

                             <div class="row">
                                    <div class="medium-6 columns">
                                      <label>Legend
                                        <input id="cName" name="cName"  value="" type="text" placeholder="Enter your name here">
                                      </label>
                                    </div>
                                    <div class="medium-6 columns">
                                      <label>Position
                                        <input id="cReference" name="cReference"  value="" type="text" placeholder="Enter reference here">
                                      </label>
                                    </div>
                                   
                                     <div class="medium-6 columns">
                                         
                                         <input id="cIsCover" name="cIsCover" name="cOption1" type="checkbox"><label for="checkbox1">Is cover</label>
                                    </div>

                                     <div class="medium-6 columns">
                                        <label>Upload Image</label>
                                        <label for="exampleFileUpload" class="button">Upload File</label>
                                        <input type="file" id="cImage" name="file[]" onchange="readURL(this);" class="show-for-sr">
                                    </div>
                                 
                                  </div>

                            <input type="button" onclick="backTab('4')" class="small button" value="Back"/>
                            <input type="button" onclick="nextTab('6')" class="small button" value="Next"/>
                        </div> 
                    </div>
                </div>
                
                <div class="tabs-panel" id="panel6v">
                    <div class="row">
                        <div class="large-12 medium-12 columns" id="feature_table">
                            <table>
                                <thead>
                                    <tr>
                                        <th>
                                            <center><b>Feature</b></center>
                                        </th>
                                        <th >
                                            <center><b>Pre-defined value</b></center>
                                        </th>
                                        <th >
                                            <center><b>Cusmotized Value</b></center>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="3">
                                            <center>    
                                            <img id="img_Loading" src="../img/loading.gif" alt="" height="200px" width="500px"/>
                                            </center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>  
                    </div>
                </div>
                
            </div>
        </div>

            <!--  -->

        </form>
      </div>
    
    <script src="../js/vendor/jquery.min.js"></script>
    <script src="../js/jquery-1.11.2.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/vendor/what-input.min.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script src="../js/app.js"></script>
    <script src="js/upload.js"></script>
  </body>
</html>

<?php

function generatePageTree($datas, $parent = 0, $depth=0){
    if($depth > 1000) return ''; // Make sure not to have an endless recursion
    $tree = '<ul style="list-style: none;">';
    for($i=0, $ni=count($datas); $i < $ni; $i++){
        if($datas[$i]['parent'] == $parent)
        {
            $tree .= '<li style="list-style: none;"><span  class="Collapsable" style="cursor: pointer">';
            if($parent != 2)
                $tree .= '|----';
            $tree .= '<input type="radio" name="cCategory" value="'.$datas[$i]['name'].'" style="cursor: pointer"/>';
            $tree .= $datas[$i]['name'];
            $tree .= '</span>';
            $tree .= generatePageTree($datas, $datas[$i]['id'], $depth+1);
            $tree .= '</li>';
        }
    }
    $tree .= '</ul>';
    return $tree;
}

?>