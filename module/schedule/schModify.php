<?
require_once("../../mainfile.php");

if (!$curruser->isguest())
{
	$sno = intval($_REQUEST["sno"]);

	$curdate = intval($_REQUEST["curdate"]);

	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("schedule_sch")."` s INNER JOIN `".$currdb->prefix("schedule_act")."` a ON s.ano=a.ano WHERE s.sno='".$sno."'");

	if ($currdb->num_rows($result) != 1)
		_redirect();

	$sch = $currdb->fetch_array($result);

	if (!$currmodule->isadmin($curruser))
	{
		if ($sch["owner_type"] == "G")
		{
			$result = $currdb->query("SELECT g.gno FROM `".$currdb->prefix("gmember")."` m INNER JOIN `".$currdb->prefix("group")."` g ON g.gno=m.gno AND m.level >= 2 WHERE g.gno='".$sch["owner_no"]."' AND m.uno='".$curruser->uno."'");

			if ($currdb->num_rows($result) > 0)
				$rc = 1;
		}
		else
			$rc = ($sch["owner_no"] == $curruser->uno) ? 1 : 0;

		if (!$rc)
			_redirect();
	}

	if (!empty($_POST["schModify"]))
	{
		$_POST["interval"] = intval($_POST["interval"]);

		if (!in_array($_POST["itype"], $act_type))
			$_POST["itype"] = $act_type[0];

		if(!is_array($_POST['wdays'])) $_POST['wdays'] = array();
		$_POST["wdays"] = implode(",", $_POST["wdays"]);

		list($tYear, $tMonth, $tDay) = explode("-", $_POST["stDate"]);

		$start = mktime(0, 0, 0, $tMonth, $tDay, $tYear);

		list($tYear, $tMonth, $tDay) = explode("-", $_POST["edDate"]);

		$end = mktime(23, 59, 59, $tMonth, $tDay, $tYear);

		if ($_POST["ctype"] == "all")
		{
			actModify($sch["ano"], $_POST["subject"], $_POST["content"]);
			schModify($sno, $start, $end, $_POST["itype"], $_POST["interval"], $_POST["wdays"]);
		}
		else
		{
			if ($_POST["ctype"] != "independent")
				actModify($sch["ano"], $_POST["subject"], $_POST["content"]);

			list($tYear, $tMonth, $tDay) = explode("-", $sch["start_date"]);

			$old_start = mktime(0, 0, 0, $tMonth, $tDay, $tYear);

			list($tYear, $tMonth, $tDay) = explode("-", $sch["end_date"]);

			$old_end = mktime(23, 59, 59, $tSec, $tMonth, $tDay, $tYear);

			schModify($sno, $old_start, $start - 86400, $sch["type"], $sch["interval"], $sch["weekdays"]);

			if ($_POST["ctype"] == "independent")
				$sch["ano"] = actCreate($_POST["subject"], $_POST["content"], $sch["owner_type"], $sch["owner_no"]);

			schCreate($sch["ano"], $start, $end, $_POST["itype"], $_POST["interval"], $_POST["wdays"]);

			if ($_POST["ctype"] == "insert" && $old_end > $end)
				schCreate($sch["ano"], $end + 86400, $old_end, $sch["type"], $sch["interval"], $sch["weekdays"]);
		}

		//_redirect("showAct.php?sno=".$sch["sno"]);
		//_redirect();
		die('<script type="text/javascript">history.go(-2);</script>');
	}
	else
	{
		$currtpl->assign("itype_radio", $def_itype);

		$currtpl->assign("itype_def", $sch["type"]);

		$currtpl->assign("wdays_chbox", $def_wday);

		$currtpl->assign("wdays_def", explode(",", $sch["weekdays"]));

		//$currtpl->assign("ctype_radio", array("all" => "全部系列", "independent" => "獨立成新事件", "insert" => "插入新行程", "following" => "之後的行程"));
		$currtpl->assign("ctype_radio", array("all" => "全部系列", "independent" => "獨立成新事件"));

		$currtpl->assign("ctype_def", "all");

		$currtpl->assign("curdate", $curdate);

		$currtpl->assign("sch", $sch);

		$currtpl->display("schModify.htm");
	}
}
else
	_redirect();
?>
