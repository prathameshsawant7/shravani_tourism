<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Index page
--> 
<?php
session_start();
if(isset($_SESSION['cSellerID']))
    {header('Location:home.php'); }
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
       if( document.login.cEmail.value == "" )
       {
         error=error+"Please provide email id.\n";
       }
       else
       {
            var emailID = document.login.cEmail.value;
            atpos = emailID.indexOf("@");
            dotpos = emailID.lastIndexOf(".");
            if (atpos < 1 || ( dotpos - atpos < 2 )) 
            {
                error=error+"Incorrect Email-id";
            }
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
                <?php
                    if(isset($_GET['completed']))
                    {
                        if($_GET['completed'] == 'forgot')
                        {
                            ?>
                                <center>
                                    <h4 style="color: #22bb5b">Recovery link has been sent to your email address.</h4>
                                </center>

                            <?php
                        }

                    }
                    elseif (isset($_GET['error'])) 
                    {
                         ?>
                            <center>
                                <h4 style="color: #da3116">Error Message</h4>
                                <label style="color: #da3116"><?php echo $_GET['error'];?></label>
                            </center>
                            <BR>
                        <?php

                    }   
                ?>
                <div class="large-12 medium-12 columns">
                    <div class="text-center">
                      <img class="our_logo" src="img/logo.png" />
                    </div>
                    <form action="forgot_password.php" name="login" onsubmit="return(validate());" method="post">
                        <!-- <label>Email Id:</label> -->
                        <input type="text" placeholder="Email ID" id="cEmail" name="cEmail" />
                       <!--  <label>Password:</label> -->
                        <input type="submit" class="login_btn small button float-left" value="Submit"/>
                    </form>
                 
                </div>
           
        </div>
    
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
  </body>
</html>
