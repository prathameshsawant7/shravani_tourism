<!--
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Index page
--> 
<?php 
session_start();
if(isset($_SESSION['cID']))
    {header('Location:home/index.php'); }
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Shravani Tourism</title>
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
       if( document.login.cPassword.value == "" )
       {
         error=error+"Please provide password";
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
            <h2>Shravani Tourism</h2>
        </div>
    </div>
    <div class="row">
        <div class="large-4 large-centered  columns">
            <div class="row login_area"  style="margin-top: 100px">
                <?php
                    if(isset($_GET['completed']))
                    {
                        if($_GET['completed'] == 'registration')
                        {
                            ?>
                                <center>
                                    <h4 style="color: #22bb5b">Registration completed</h4>
                                </center>

                            <?php
                        }
                        else if($_GET['completed'] == 'forgot')
                        {
                            ?>
                                <center>
                                    <h4 style="color: #22bb5b">Recovery link has been sent to your email address.</h4>
                                </center>

                            <?php
                        }
                        else if($_GET['completed'] == 'reset')
                        {
                            ?>
                                <center>
                                    <h4 style="color: #22bb5b">Reset password successfully .</h4>
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
                      <img class="our_logo" src="img/index1.jpeg" style="width: 150px" />
                    </div>
                    <form action="login.php" name="login" onsubmit="return(validate());" method="post">
                        <!-- <label>Email Id:</label> -->
                        <input type="text" placeholder="Email" id="cEmail" name="cEmail" />
                       <!--  <label>Password:</label> -->
                        <input type="password" placeholder="Password" id="cPassword" name="cPassword"/>
                       <!--  <div class="g-recaptcha" data-sitekey="6Leesx8TAAAAAP-9JPEGCyYlneWlzSt6spP_be2V"></div> -->
                        <BR>
                        <center>
                          <input type="submit" class="login_btn small button float-left" value="Sign In" style="margin-left: 24%;" />
                        </center>
                       <!--  <a href="register/index.php" class="login_btn small button float-right" >Sign Up</a> -->
                       <BR><BR><BR>
<!--                         <a style="float: left;" href="forgot.php">Forget Password</a>
 -->                    </form>
                 
                </div>
           
        </div>
    
    <script src="js/vendor/jquery.min.js"></script>
    <script src="js/vendor/what-input.min.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/app.js"></script>
    <script src='https://www.google.com/recaptcha/api.js'></script>
  </body>
</html>
