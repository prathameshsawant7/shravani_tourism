<?php 
    include("../configs/defines.php");
    include("../configs/settings.php");
    $est =new settings();
    $con=$est->connection();

    // $secretKey = "6Leesx8TAAAAADdIn0JNlvqJ5AARye0hYttT0BxG"; // ReCatcha Secret Key
    // $ip = $_SERVER['REMOTE_ADDR'];
    
    // if(isset($_POST['g-recaptcha-response']))
    // {
    //   $captcha=$_POST['g-recaptcha-response'];
    // }
    
    // if(!$captcha)
    // {
    //   header('Location: index.php?error=Please check the Captcha');
    //   exit;
    // }
    
    // Validate ReCaptcha Key
    // $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
    // $responseKeys = json_decode($response,true);
    // if(intval($responseKeys["success"]) !== 1) 
    // {
    //     header('Location: index.php?error="You are spammer ! Get the @$%K out"');exit;
    // }
    
    
    // Validate Login
    print_r($_POST);
    $query = "SELECT id,name,email,password,isAdmin FROM admin_users WHERE email = '".trim($_POST['cEmail'])."' ;";
    //echo $query;exit;
    $fetch_data=mysqli_query($con,$query);
   //print_r($fetch_data);exit;
    if(mysqli_num_rows($fetch_data)==1)
    {
        $db_pwd=mysqli_fetch_array($fetch_data);
        //echo $db_pwd['password']."----------".md5(_COOKIE_KEY_.$_POST['cPassword']);
        if($db_pwd['password']== md5(_COOKIE_KEY_.$_POST['cPassword']))
        {
            //session_destroy();
            session_start(); 
            $_SESSION['cID']=$db_pwd['id'];
            $_SESSION['cName']=$db_pwd['name'];
            $_SESSION['cEmail']=$db_pwd['email'];
            $_SESSION['cAdmin']=$db_pwd['isAdmin'];

            header('Location: settings/index.php');
        }
        else
        {
            header('Location: index.php?error=Email-id and Password doesn\'t match !');
        }
    }
    else
    {
       header('Location: index.php?error=Email-id doesn\'t exist or not activated yet !');
    }
?>
