<?
	require_once("../../mainfile.php");
	
	if($curruser->isguest == 1)
		_redirect();
	
	$act = $currdb->query("SELECT a.subject AS subject FROM `".$currdb->prefix("schedule_act")."` AS a LEFT JOIN `".$currdb->prefix("schedule_sch")."` AS s ON a.ano = s.ano WHERE a.owner_no = ".$curruser->uno." ORDER BY s.start_date");
	if($currdb->num_rows($act) != 0)
	{
		$actTotal = array();
		for($m = 0 ; $actFlag = $currdb->fetch_array($act) ; $m ++)
			array_push($actTotal,$actFlag);
	}
	
	$currtpl->assign("actTotal",$actTotal);
	$currtpl->display("actList.htm");
?>