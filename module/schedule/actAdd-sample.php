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
	if(!$currmodule->isadmin($curruser) && !$curruser->g_handler->isGroupAdmin($no, $curruser->uno))
	{
		dies('You are not Admin!');
	}
}

if (!empty($_POST['start_date']) && !empty($_POST["title"]))
{
	$_POST['interval'] = intval($_POST['interval']);
	if ($_POST["interval"] <= 1)
		$_POST["interval"] = 1;

	$weekdays = '';
	if($_POST["interval"] == 1)
	{
		$_POST['type'] = 'N';
		$_POST['end_date'] = $_POST['start_date'];
	}
	else
	{
		$_POST['type'] = 'D';
	}

	$ano = actCreate($_POST['title'], $_POST['content'], $type, $no);

	list($year, $mon, $day) = explode("/", $_POST['start_date']);
	$start_mktime = mktime(0, 0, 0, $mon, $day, $year); 
	$end_mktime = mktime(0, 0, 0, $mon, $day+$_POST['interval']-1, $year);

	schCreate($ano, $start_mktime, $end_mktime, $_POST['type'], 1, $weekdays);
		
	//echo $_SERVER['REQUEST_URI'].'<br/>'.$_SESSION['ref'] .'<br/>'.$_SESSION['ref_o'];
	_redirect(2);
	//die('<script type="text/javascript">history.go(-2);</script>');
}
else
{
	$currtpl->assign("dnow", date("Y/m/d"));

	$currtpl->assign("itype_radio", $def_itype);
	$currtpl->assign("itype_def", "N");
	$currtpl->assign("wdays_chbox", $def_wday);

	$currtpl->display('actadd-sample.htm');
}
?>
