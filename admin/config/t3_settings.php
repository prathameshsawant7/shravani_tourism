<?php
class settings
{
    public $con;
    public function connection()
    {
       $con =mysqli_connect("54.169.103.63","gdRj7tdff2","RfHhf654d","t2");
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