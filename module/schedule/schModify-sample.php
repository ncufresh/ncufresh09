<?php
require_once('../../mainfile.php');

if($curruser->isguest())
	_redirect();

$sno = intval($_REQUEST["sno"]);

$result = $currdb->query("SELECT * FROM `".$currdb->prefix("schedule_sch")."` s INNER JOIN `".$currdb->prefix("schedule_act")."` a ON s.ano=a.ano WHERE s.sno='".$sno."'");

if ($currdb->num_rows($result) != 1)
	_redirect();

$sch = $currdb->fetch_array($result);

$start = explode('-',$sch['start_date']);
$end = explode('-',$sch['end_date']);

$start_mktime = mktime(0,0,0,$start['1'],$start['2'],$start['0']);
$end_mktime = mktime(0,0,0,$end['1'],$end['2'],$end['0']);
$sch['contin'] = ($end_mktime - $start_mktime)/86400 +1;

if($sch['owner_type'] == 'U')
{
	if($sch['owner_no'] == $curruser->uno)
	{
		if(isset($_GET['modify']))
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

			actModify($_GET['ano'],$_POST['title'],$_POST['content']);

			list($year, $mon, $day) = explode("-", $_POST['start_date']);
			$start_mktime = mktime(0, 0, 0, $mon, $day, $year);
			$end_mktime = mktime(0, 0, 0, $mon, $day+$_POST['interval']-1, $year);

			schModify($_GET['sno'],$start_mktime,$end_mktime,$_POST['type'],1,$weekdays);
			//die('<script type="text/javascript">history.go(-2);</script>');
			_redirect(2);
		}
		else
		{
			$currtpl->assign('sch',$sch);
			$currtpl->display('schModify-sample.htm');
		}
	}
	else
		_redirect();
}
else
{
	if($curruser->g_handler->isGroupAdmin($sch['owner_no'],$curruser->uno) || $currmodule->isadmin($curruser))
	{
		if(isset($_GET['modify']))
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

			actModify($_GET['ano'],$_POST['title'],$_POST['content']);

			list($year, $mon, $day) = explode("-", $_POST['start_date']);
			$start_mktime = mktime(0, 0, 0, $mon, $day, $year);
			$end_mktime = mktime(0, 0, 0, $mon, $day+$_POST['interval']-1, $year);

			schModify($_GET['sno'],$start_mktime,$end_mktime,$_POST['type'],1,$weekdays);
			//die('<script type="text/javascript">history.go(-2);</script>');
			_redirect(2);
		}
		else
		{
			$currtpl->assign('sch',$sch);
			$currtpl->display('schModify-sample.htm');
		}
	}
	else
		_redirect();
}
?>
