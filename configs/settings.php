<?php
include_once("defines.php");
class settings
{
    public $con;
    public function connection()
    { 

      	//$con =mysqli_connect("localhost","root","root","shravani_travels");
        //$con =mysqli_connect("localhost","takeabreak","Break@#2016","takeabreak");
        //$con =mysqli_connect("37.59.55.185","7kwifbYZyp","HRWas0Mvyt","7kwifbYZyp");
        $con =mysqli_connect("sql12.freemysqlhosting.net","sql12324336","bp5MDVq65C","sql12324336");
        if (mysqli_connect_errno()) 
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        else
        {
            return $con;
        }
       
    }
}
?>
