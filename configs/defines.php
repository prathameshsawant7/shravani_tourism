
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
setlocale(LC_MONETARY, 'en_IN');


define('RAZOR_KEY_ID', 'rzp_test_byAejNzafEuX6g');
define('RAZOR_KEY_SECRET', 'MG78gkUks1F8kyedAyhMTDJo');


define('MAIL_HOST', 'mail.shravanitourism.com');
define('MAIL_USERNAME', 'support@shravanitourism.com');
define('MAIL_PASSWORD', 'iB61@#bF36fu');
define('MAIL_PORT', 465);
define('MAIL_ADDRESS', 'support@shravanitourism.com');


if(EXEC == 0){
	define("LIVEROOT", 'http://www.shravanitourism.com/');
	define("FULLROOT", ''); #Please set up this accordingly..
	define("WEBROOT", '/shravani_tourism/'); #Please set up this accordingly..
	define("ADMINROOT", 'shravani_tourism\admin');
	define("DBPATH", FULLROOT . "/configs/setting.php");
	define("SMARTY", FULLROOT . "/libs/Smarty.class.php");
	define("SESSIONPATH", WEBROOT . "\configs\start_session.php");
	define('_COOKIE_KEY_', 'Tnrz1a2GiemITuj3myqm4k1YcdtIJ4TtutUFaqru33e18nuHOtrW7193');
}else{
	define("LIVEROOT", 'http://www.shravanitourism.com/');
	define("FULLROOT", ''); #Please set up this accordingly..
	define("WEBROOT", ''); #Please set up this accordingly..
	define("ADMINROOT", 'admin');
	define("DBPATH", FULLROOT . "/configs/setting.php");
	define("SMARTY", FULLROOT . "/libs/Smarty.class.php");
	define("SESSIONPATH", WEBROOT . "\configs\start_session.php");
	define('_COOKIE_KEY_', 'Tnrz1a2GiemITuj3myqm4k1YcdtIJ4TtutUFaqru33e18nuHOtrW7193');
}


#GLOBALS
$rate_identifiers = [];
$rate_identifiers['adult_double'] = 'Rate Per Person with Double Occupancy';
$rate_identifiers['extra_adult'] = 'Extra Person with Same Room Sharing (Above+ 8yrs) with Extra Mattress';
$rate_identifiers['child'] = 'Per Child with Same Room Sharing (Above+ 4yrs) without Extra Mattress.';
$rate_identifiers['adult_single'] = 'Rate Per Person with Single Occupancy';

?>

