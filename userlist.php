<?
require_once("./mainfile.php");


if ($curruser->haveperm($curruser->p_handler->getpermvalid()))
{
	$orderlist = array("uid", "name", "sex", "sid");

	$_GET["order"] = (in_array($_GET["order"], $orderlist)) ? $_GET["order"] : $orderlist[1];

	if (!empty($_GET["column"]) && !empty($_GET["key"]))
	{
		$_GET["column"] = (in_array($_GET["column"], $orderlist)) ? $_GET["column"] : $orderlist[1];
		
		$criteria = new CriteriaCompo(new Criteria($_GET["column"], "%".$_GET["key"]."%", "like"));

		$result = $currdb->query("SELECT * FROM `".$currdb->prefix("user")."` WHERE ".$criteria->render()." ORDER BY ".$_GET["order"]." ASC");
	}
	else
		$result = $currdb->query("SELECT * FROM `".$currdb->prefix("user")."` ORDER BY ".$_GET["order"]." ASC");

	for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
		$users[$i] = $tmp;

	$currtpl->assign("column", $_GET["column"]);
	$currtpl->assign("key", urlencode($_GET["key"]));
	$currtpl->assign("users", $users);

	$currtpl->display("userlist.htm");
}
else
	_redirect();
?>
