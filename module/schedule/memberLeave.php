<?
	require_once("../../mainfile.php");
	
	if ($curruser->isguest())
		_redirect();
	
	if (isset($_GET['gno']))
		$currdb->query("DELETE FROM `".$currdb->prefix("gmember")."` WHERE gno='".intval($_GET['gno'])."' AND uno='".$curruser->uno."'");
	
	$group = $currdb->query("SELECT g.gno, g.name FROM `".$currdb->prefix("gmember")."` m INNER JOIN `".$currdb->prefix("group")."` g ON m.gno=g.gno WHERE m.uno='".$curruser->uno."' ORDER BY g.gno DESC");
	
	if ($currdb->num_rows($group) > 0)
	{
		$groupTotal = array();

		for($m = 0;$groupFlag = $currdb->fetch_array($group);$m++)
			array_push($groupTotal, $groupFlag);
	}
	
	$currtpl->assign("groupTotal", $groupTotal);
	$currtpl->display("memberLeave.htm");
?>
