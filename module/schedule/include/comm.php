<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

//$act_type = array('N', 'D', 'W', 'M', 'MW', 'Y');
$act_type = array('N','D');

//$def_itype = array("N" => "不重複", "D" => "天", "W" => "週", "M" => "月", "MW" => "每月的第 X 週", "Y" => "年");
$def_itype = array("N" => "不重複" , "D" => "天");

$def_wday = array("0" => "日", "1" => "一", "2" => "二", "3" => "三", "4" => "四", "5" => "五", "6" => "六");

require_once("function.php");
require_once("getAction.php");
?>
