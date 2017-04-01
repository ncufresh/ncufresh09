<?
require_once("../../mainfile.php");

if (!$curruser->isguest())
{
	$_GET['gno'] = intval($_GET['gno']);

	$isAdmin = $currmodule->isadmin($curruser);

	$result = $currdb->query("SELECT g.* FROM `".$currdb->prefix("gmember")."`m INNER JOIN `".$currdb->prefix("group")."`g ON m.gno=g.gno WHERE m.gno='".$_GET['gno']."' AND ((m.uno='".$curruser->uno."' AND m.level='3') OR ".$isAdmin.")");

	if ($currdb->num_rows($result) == 0)
		_redirect();

	if (empty($_POST['gname']))
	{
		$group = $currdb->fetch_array($result);

		$currtpl->assign("group", $group);
		$currtpl->display("group_edit.htm");
	}
	else
	{
		$criteria = new CriteriaCompo(new Criteria("name", htmlencode($_POST['gname'])));
		$criteria->add(new Criteria("introduce", htmlencode($_POST['gintro'])));
		$criteria->add(new Criteria("motd", htmlencode($_POST['gmotd'])));
		$criteria->add(new Criteria("public", intval($_POST['gpublic'])));
	
		$currdb->query("UPDATE `".$currdb->prefix("group")."` ".$criteria->updatesql()." WHERE gno='".$_GET['gno']."'");

		_redirect("group.php?gno=".$_GET['gno']);
	}
}
else
	_redirect();
?>
