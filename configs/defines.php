
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
ini_set("display_errors",1);
error_reporting(E_ALL);

if(EXEC == 0){
	define("FULLROOT", ''); #Please set up this accordingly..
	define("WEBROOT", 'localhost\takeabreak\admin'); #Please set up this accordingly..
	define("ADMINROOT", 'shravani-tourism\admin');
	define("DBPATH", FULLROOT . "/configs/setting.php");
	define("SMARTY", FULLROOT . "/libs/Smarty.class.php");
	define("SESSIONPATH", WEBROOT . "\configs\start_session.php");
	define('_COOKIE_KEY_', 'Tnrz1a2GiemITuj3myqm4k1YcdtIJ4TtutUFaqru33e18nuHOtrW7193');
}else{
	define("FULLROOT", ''); #Please set up this accordingly..
	define("WEBROOT", 'localhost\takeabreak\admin'); #Please set up this accordingly..
	define("ADMINROOT", 'admin');
	define("DBPATH", FULLROOT . "/configs/setting.php");
	define("SMARTY", FULLROOT . "/libs/Smarty.class.php");
	define("SESSIONPATH", WEBROOT . "\configs\start_session.php");
	define('_COOKIE_KEY_', 'Tnrz1a2GiemITuj3myqm4k1YcdtIJ4TtutUFaqru33e18nuHOtrW7193');
}

?>

