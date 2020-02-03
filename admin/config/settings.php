<?php
/*
 * @author  : Prathamesh Sawant<prathamesh.sawant@jewelsouk.com>
 * @package : Jewelsouk Seller Hub
 * @version : 1.0
 * @since   : 2016-Mar
 * Live Settings
*/
class settings
{
    public $con;
    public function connection()
    {
      // $con =mysqli_connect("172.31.6.134","U52wBfSXWS","PM33y77zDQ","kuole65f44");
        $con =mysqli_connect("54.169.142.129","U52wBfSXWS","PM33y77zDQ","kuole65f44");
        if (mysqli_connect_errno()) 
                {
                         echo "Failed to connect to MySQL: " . mysqli_connect_error();
                }
        else
        {
        //echo "Connected to Db";

        return $con;
        }
       
    }
}
?>
