<?
require_once("../../mainfile.php");

$_GET["sno"] = intval($_GET["sno"]);

$criteria = new CriteriaCompo(new Criteria("s.sno", $_GET["sno"]));

$result = $currdb->query("SELECT a.* FROM `".$currdb->prefix("schedule_sch")."` s INNER JOIN `".$currdb->prefix("schedule_act")."` a ON s.ano=a.ano WHERE ".$criteria->render());

if ($currdb->num_rows($result) == 1)
{
	$act = $currdb->fetch_array($result);

	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("schedule_sch")."` WHERE ano='".$act["ano"]."' ORDER BY start_date ASC");

	while ($tmp = $currdb->fetch_array($result))
		$sch[] = $tmp;

	$currtpl->assign("sno", $_GET["sno"]);
	$currtpl->assign("act", $act);
	$currtpl->assign("sch", $sch);

	$currtpl->display("showAct.htm");
}
else
	_redirect();
?>
