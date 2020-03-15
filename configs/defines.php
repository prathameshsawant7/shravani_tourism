
<?php
/*
 * @author  : Prathamesh Sawant
 * @package : Shravani Tourism
 * @version : 1.0
 * @since   : 2016-Mar
 * Defines
 */

$exec = 0; //0: local , 1:live
define("EXEC", $exec);
ini_set("display_errors",0);
error_reporting(E_ALL);


define('RAZOR_KEY_ID', 'rzp_test_byAejNzafEuX6g');
define('RAZOR_KEY_SECRET', 'MG78gkUks1F8kyedAyhMTDJo');
if(EXEC == 0){
	define("FULLROOT", ''); #Please set up this accordingly..
	define("WEBROOT", '/shravani_tourism/'); #Please set up this accordingly..
	define("ADMINROOT", 'shravani_tourism\admin');
	define("DBPATH", FULLROOT . "/configs/setting.php");
	define("SMARTY", FULLROOT . "/libs/Smarty.class.php");
	define("SESSIONPATH", WEBROOT . "\configs\start_session.php");
	define('_COOKIE_KEY_', 'Tnrz1a2GiemITuj3myqm4k1YcdtIJ4TtutUFaqru33e18nuHOtrW7193');
}else{
	define("FULLROOT", ''); #Please set up this accordingly..
	define("WEBROOT", ''); #Please set up this accordingly..
	define("ADMINROOT", 'admin');
	define("DBPATH", FULLROOT . "/configs/setting.php");
	define("SMARTY", FULLROOT . "/libs/Smarty.class.php");
	define("SESSIONPATH", WEBROOT . "\configs\start_session.php");
	define('_COOKIE_KEY_', 'Tnrz1a2GiemITuj3myqm4k1YcdtIJ4TtutUFaqru33e18nuHOtrW7193');
}

?>

