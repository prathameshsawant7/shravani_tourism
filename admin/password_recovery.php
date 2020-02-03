<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Password Recovery 
--> 
<?php

include("config/defines.php");
include("config/settings.php");
$est =new settings();
$con=$est->connection();

$key    = $_GET['key'];
//echo $key;
$aKey   = explode("_",$key);

$pass   = $aKey[1];
$query  = "SELECT iSeller_id,cPassword FROM js_seller WHERE cPassword = '".trim($pass)."';";
//echo $query;exit;
$fetch_data=mysqli_query($con,$query);

if(mysqli_num_rows($fetch_data) != 1)
{
    header('Location: index.php?error=Invalid recovery link.');
}
else 
{
    $db             = mysqli_fetch_array($fetch_data);
    $iSeller_id     = $db['iSeller_id'];
}

?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Seller Hub</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <link rel="stylesheet" href="css/app.css" />
    <link rel="shortcut icon" type="image/png" href="img/favicon.ico"/>
   <script type="text/javascript">
    function validate()
    {
        var error="";
       
       if( document.login.cPassword.value == "" )
       {
            error=error+"Please provide password";
       }
       if( document.login.cVPassword.value == "" )
       {
            error=error+"Please provide Verify password";
       }
       if(document.login.cPassword.value != document.login.cVPassword.value)
       {
            error=error+"Password and Verify Password doesn't match";
       }

       if(error=="")
       {
       return( true );
       }
       else
       {
            alert("Fix Below issues: \n"+error);
            return( false );
       }
    }

    </script>
  </head>
  <body>
   <div class="large-12 columns header text-center">
        <div class="large-12 columns">
            <h2>Jewelsouk Seller Hub</h2>
        </div>
    </div>
    <div class="row">
        <div class="large-4 large-centered  columns">
            <div class="row login_area">
                <div class="large-12 medium-12 columns">
                    <div class="text-center">
                      <img class="our_logo" src="img/logo.png" />
                    </div>
                    <form action="reset_password.php" name="login" onsubmit="return(validate());" method="post">
                        <input type="hidden" id="iSeller_id" name="iSeller_id" value="<?php echo $iSeller_id;?>" />
                        <input type="password" placeholder="Password" id="cPassword" name="cPassword" />
                        <input type="password" placeholder="Verify Password" id="cVPassword" name="cVPassword"/>
                        <input type="submit" class="login_btn small button float-left" value="Reset Password"/>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>