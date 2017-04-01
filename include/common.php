<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

$st = microtime(true);

// #### Simple Security Check ####

require_once(ROOT_PATH.'/include/function.php');

do_security();

require_once(ROOT_PATH.'/kernel/object.php');
require_once(ROOT_PATH.'/kernel/criteria.php');

mb_internal_encoding('UTF-8');

// #### Connect to Database ####

require_once(ROOT_PATH."/kernel/database.php");

$currdb = new Database();

if (!$currdb->connect(DB_HOST, DB_USER, DB_PWD))
	die("Database connection error.");

$currdb->select_db(DB_NAME);

// #### Load Config ####

$config_handler =& gethandler("config");
$currconfig = $config_handler->loadconfig();

// #### Error handler ####

//set_error_handler('error_handler', E_ALL);

// #### Template and ob_* ####

require_once(ROOT_PATH."/kernel/template.php");

// #### Do more as system ####

$perm_handler =& gethandler("perm");
$currperm = $perm_handler->getpermlist(0);

// #### Login User ####

//if (isset($_COOKIE[$currconfig->session_name]))
//	session_id($_COOKIE[$currconfig->session_name]);

session_cache_expire($currconfig->session_expire);
session_name($currconfig->session_name);

session_start();

//setcookie($currconfig->session_name, session_id(), time() + (60 * $currconfig->session_expire));

if ($_SESSION["remote_adr"] != $_SERVER["REMOTE_ADDR"])
	$_SESSION["user_uid"] = "";

$_SESSION["remote_adr"] = $_SERVER["REMOTE_ADDR"];


$user_handler =& gethandler("user");
$curruser = $user_handler->getuserbyid($_SESSION["user_uid"]);
$curruser->u_handler->freshonlinetime($_SESSION["user_uid"]);

if ($_SESSION[$currconfig->session_name] != 1)
{
	$currdb->query("UPDATE `".$currdb->prefix("config")."` SET conf_value='".($currconfig->total_guests + 1)."' where conf_name='total_guests'");
	$_SESSION[$currconfig->session_name] = 1;
}

$currglevel = array(1=>"user", "superuser", "administrator");


// #### Load Module ####

$module_handler =& gethandler("module");
$currmodule = $module_handler->getmodulebyname();

if (!$currmodule->isactive())
	dies("Module is not exists.");

// #### Start to replace the template ####

$currtpl = new Template();

// #### Set Some Configs ####

$currtpl->settpldir($currmodule->name);

if (file_exists(ROOT_PATH."/module/".$currmodule->name."/".TEMPLATE_PATH."/style.css"))
	$currtpl->addcss(ROOT_PATH."/module/".$currmodule->name."/".TEMPLATE_PATH."/style.css");
	

if ($currmodule->name != "system")
{
	$currsite[0]["url"] = URL."/module/".$currmodule->name;
	$currsite[0]["name"] = $currmodule->title;
}

if (file_exists(ROOT_PATH."/module/".$currmodule->name."/include/comm.php"))
	require_once(ROOT_PATH."/module/".$currmodule->name."/include/comm.php");

define('REDIRECT', URL.'/redirect.php');

?>
