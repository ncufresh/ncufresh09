<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

define("LOCK_TOPIC", 1);
define("LOCK_COMM", 2);
define("LOCK_QUES", 4);

$currtpl->assign("LOCK_TOPIC", LOCK_TOPIC);
$currtpl->assign("LOCK_COMM", LOCK_COMM);
$currtpl->assign("LOCK_QUES", LOCK_QUES);

require_once(ROOT_PATH."/module/".$currmodule->name."/include/wiki.php");
require_once(ROOT_PATH."/module/".$currmodule->name."/include/function.php");
?>
