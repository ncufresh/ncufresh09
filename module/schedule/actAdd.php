<?php
require_once '../../mainfile.php';

if ($curruser->isguest())
	_redirect();

if(empty($_GET['t']) && intval($_GET['n']) > 0 || $_GET['t'] == 'G')
{
	$type = 'G';
	$no = intval($_GET['n']);
}
else
{
	$type = 'U';
	$no = empty($_GET['n']) ? $curruser->uno : intval($_GET['n']);
}
$_GET['t'] = $type;
$_GET['n'] = $no;

if($type == 'G')
{
	$group_handle =& gethandler('group');
	if(!$group_handle->isGroupAdmin($no, $curruser->uno))
	{
		dies('You are not Admin!');
	}
}

if (!empty($_POST['start_date']) && !empty($_POST["title"]))
{
	if(is_array($_POST['weekdays']))
		$weekdays = implode(",", $_POST["weekdays"]);

	if (!in_array($_POST["type"], $act_type))
		$_POST["type"] = $act_type[0];

	if ($_POST["type"] != "N")
	{
		if ($_POST["interval"] <= 1)
			$_POST["interval"] = 1;
	}

	$ano = actCreate($_POST['title'], $_POST['content'], $type, $no);

	list($year, $mon, $day) = explode("/", $_POST['start_date']);
	$start_mktime = mktime(0, 0, 0, $mon, $day, $year); 

	list($year, $mon, $day) = explode("/", $_POST['end_date']);
	$end_mktime = mktime(0, 0, 0, $mon, $day, $year);

	schCreate($ano, $start_mktime, $end_mktime, $_POST['type'], $_POST['interval'], $weekdays);

	_redirect();
}
else
{
	$currtpl->assign("dnow", date("Y/m/d"));

	$currtpl->assign("itype_radio", $def_itype);
	$currtpl->assign("itype_def", "N");
	$currtpl->assign("wdays_chbox", $def_wday);

	$currtpl->display('actadd.htm');
}
?>
