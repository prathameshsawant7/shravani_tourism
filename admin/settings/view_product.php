<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * View Product page
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
    <link rel="stylesheet" href="../css/reveal.css" />
    <link rel="shortcut icon" type="image/png" href="../img/favicon.ico"/>
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
        $query ="SELECT id_category FROM js_category_product WHERE id_product = ".$_GET['product_id'].";";
        $fetch_data = mysqli_query($con,$query);
        
        while($Cats = mysqli_fetch_array($fetch_data))
        {
            $aCats[] = $Cats['id_category'];
        }
       // print_r($aCats);exit;
        $aTreeData = mysqli_query($con,"SELECT DISTINCT cl.id_category as id, cl.name as name, c.id_parent as parent "
                . "FROM js_category_lang AS cl "
                . "INNER JOIN js_category AS c ON cl.id_category = c.id_category "
                . "WHERE c.level_depth > 1 AND c.active =1");

    ?>
   
    <div id="hiddenFields">
        <input  type="hidden" id="seller_id" value="<?php echo $_SESSION['cSellerID']; ?>">
        <input  type="hidden" id="product_id" value="<?php echo $_GET['product_id']; ?>">
    </div>
    <div id="myModal" class="updates-modal reveal-modal"  style="z-index: 999999;">
        <h1>Features</h1>
        <div id="combinationPopup"></div>
        <a class="close-reveal-modal">&#215;</a>
    </div>
    <div class="large-12 columns no-pad">
        <div class="large-3 columns dark_bg no-pad">
            <div class="row dark_bg">
                <h4><a href="product_list.php"><i class="fa fa-backward"></i></a>View Product</h4>
            </div>
            <div class="row dark_bg height_200vh">
                <ul class="tabs vertical" id="example-vert-tabs" data-tabs  >
                    <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true"><i class="fa fa-info"></i>Information</a></li>
                    <li class="tabs-title"><a href="#panel2v"><i class="fa fa-picture-o"></i>Images</a></li>
                    <li class="tabs-title"><a href="#panel3v"><i class="fa fa-star"></i>Features</a></li>
                    <li class="tabs-title"><a href="#panel4v"><i class="fa fa-tag"></i>Association</a></li>
                    <li class="tabs-title"><a href="#panel5v"><i class="fa fa-cogs"></i>Customization</a></li>
                </ul>
            </div>
        </div>
    <!-- <div class="row collapse">
        <h5><a href="product_list.php">Product List</a> -> View Product</h5>
        <div class="medium-3 columns">
            <ul class="tabs vertical" id="example-vert-tabs" data-tabs  >
                <li class="tabs-title is-active"><a href="#panel1v" aria-selected="true">Information</a></li>
                <li class="tabs-title"><a href="#panel2v">Images</a></li>
                <li class="tabs-title"><a href="#panel3v">Features</a></li>
            </ul>
        </div> -->
        <div class="medium-9 columns">
            <div class="tabs-content vertical" data-tabs-content="example-vert-tabs">
                <div class="tabs-panel is-active" id="panel1v">
                    <div class="row">
                        <div class="large-12 medium-12 columns">
                            <img id="img_panel1v" src="../img/loading.gif" alt="" height="200px" width="500px"/>
                            <div  id="table_panel1v" style="display: none">
                            <table id="table_view" class="table_view">
                                <tbody>
                                    <tr>
                                        <td style="width: 25%">
                                            <label><B>Name:</B></label>
                                        </td>
                                        <td>
                                            <label id="cName"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label><B>Reference:</B></label>
                                        </td>
                                        <td>
                                            <label id="cReference"></label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label><B>Quantity: </B></label>
                                        </td>
                                        <td>
                                            <p><label id="cQuantity"></label></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label><B>Product cost: ₹</B></label>
                                        </td>
                                        <td>
                                            <p><label id="cCost"></label></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                <B>Status:</B><BR>
                                            </label>
                                        </td>
                                        <td>
					    <img id="cStatus" src="">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                <B>Options:</B><BR>
                                            </label>
                                        </td>
                                        <td>
					    <label><img id="Opt1" src=""> Available for order</label>
					    <label><img id="Opt2" src=""> Show price</label>
					</td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label><B>Association: </B></label>
                                        </td>
                                        <td>
                                            <p><label id="cAssoc"></label></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="25%">
                                            <label><B>Available Date: </B></label>
                                        </td>
                                        <td>
                                            <p><label id="cAvailableDate"></label></p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                <B>Short Description:</B><BR>
                                            </label>
                                        </td>
                                        <td>
                                            <label id="cShortDesc"></label>
                                            <h6>(Appears in the product list(s), and on the top of the product page.)</h6>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label>
                                                <B>Description:</B><BR>
                                                
                                            </label>
                                        </td>
                                        <td>
                                            <label id="cDesc"></label>
                                            <h6>(Appears in the body of the product page.)</h6>
                                        </td>
                                    </tr>
<!--                                    <tr>
                                        <td>
                                            <label>
                                                <B>Tags:</B><BR>
                                            </label>
                                        </td>
                                        <td>
                                            <label id="cTags"></label>
                                            <h6>(Tags separated by commas (e.g. dvd, dvd player, hifi))</h6>
                                        </td>
                                    </tr>-->
                                    
                                </tbody>
                            </table>
                            <input type="button" onclick="nextTab('2')" class="small button" value="Next"/>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tabs-panel" id="panel2v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                           <div id="images_div"></div>
                            <input type="button" onclick="backTab('1')" class="small button" value="Back"/>
                            <input type="button" onclick="nextTab('3')" class="small button" value="Next"/>
                        </div> 
                    </div>
                </div>
                <div class="tabs-panel" id="panel3v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                            <div id="features_div">
                                    <img src="../img/loading.gif" alt="" height="200px" width="500px"/>
                            </div> 
                            <input type="button" onclick="backTab('2')" class="small button" value="Back"/>
                            <input type="button" onclick="nextTab('4')" class="small button" value="Next"/>
                        </div> 
                    </div>
                </div>
                <div class="tabs-panel" id="panel4v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                           <ul style="list-style: none; padding:10px 0;">
                           <?php
                           
                                if(isset($aCats))
                                {
                                    while ($data = $aTreeData->fetch_assoc())
                                    {
                                        
                                        if(in_array($data['id'], $aCats))
                                            $row[] = $data;
                                    }
                                    
                                    echo(generatePageTree($row,'2'));
                                }
                                else
                                    echo "No Association found";
                           
                           ?>
                           </ul>

                            <input type="button" onclick="backTab('3')" class="small button" value="Back"/>
                            <input type="button" onclick="nextTab('5')" class="small button" value="Next"/>
                        </div> 
                    </div>
                </div>
                <div class="tabs-panel" id="panel5v">
                    <div class="row">
                       <div class="large-12 medium-12 columns">
                            <img id="img_panel5v" src="../img/loading.gif" alt="" height="200px" width="500px"/>
                            <div id="combination_div"></div>
                            <input type="button" onclick="backTab('4')" class="small button" value="Back"/>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
        </form>
      </div>
    
    <script src="../js/vendor/jquery.min.js"></script>
    <script src="../js/jquery-1.11.2.min.js"></script>
    <script src="../js/jquery-ui.min.js"></script>
    <script src="../js/vendor/what-input.min.js"></script>
    <script src="../js/foundation.min.js"></script>
    <script src="../js/jquery.reveal.js"></script>
    <script src="../js/app.js"></script>
    <script src="js/view_project.js"></script>
  </body>
</html>

<?php

function generatePageTree($datas, $parent = 0, $depth=0){
    if($depth > 1000) return ''; // Make sure not to have an endless recursion
    $tree = '<ul>';
    for($i=0, $ni=count($datas); $i < $ni; $i++){
        if($datas[$i]['parent'] == $parent)
        {
            $tree .= '<li><span  class="Collapsable" style="cursor: pointer">';
            if($parent != 2)
                $tree .= '|----';
            $tree .= '<input type="checkbox" name="cCategory" value="'.$datas[$i]['name'].'" style="cursor: pointer" checked="checked" disabled/>';
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