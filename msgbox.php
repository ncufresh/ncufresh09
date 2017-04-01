<?
require_once("./mainfile.php");

if (!$curruser->isguest())
{
	$page = (intval($_GET["page"]) <= 0) ? 1 : intval($_GET["page"]);

	//get all msgs
	$page_first_msg = ($page - 1) * 10;

	$criteria = new CriteriaCompo(new Criteria("m.owner_no", $curruser->uno));
	$order = ($order) ? $order : "mno";

	$pri = ($pri == "asc") ? "asc" : "desc";

	$result = $currdb->query("SELECT SQL_CALC_FOUND_ROWS m.*, u.uid as sender_id FROM `".$currdb->prefix("msg")."` m LEFT JOIN `".$currdb->prefix("user")."` u ON m.sender_no=u.uno WHERE ".$criteria->render()." ORDER BY ".$order." ".$pri."");

	for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
	{
		$msgs[$i]["mno"] = $tmp["mno"];
		$msgs[$i]["sender_no"] = $tmp["sender_no"];
		$msgs[$i]["sender_id"] = $tmp["sender_id"];
		$msgs[$i]["title"] = $tmp["title"];
		$msgs[$i]["time"] = date("m/d", $tmp["time"]);
		$msgs[$i]["status"] = $tmp["status"];
	}

	$result = $currdb->query("SELECT FOUND_ROWS()");

	$how_many_msgs = $currdb->fetch_array($result);

	$how_many_msgs = $how_many_msgs[0];

	$maxpage = ($how_many_msgs % 10 == 0) ? intval($how_many_msgs / 10) : intval($how_many_msgs / 10 + 1);

	$page = ($page > $maxpage) ? $maxpage : $page;	

	$p = _multipage($page, $maxpage, URL."/msgbox.php");
	$currtpl->assign("num", $how_many_msgs);
	$currtpl->assign("p", $p);

	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("msg")."` where owner_no='".$curruser->uno."' and status='2'");
	$currtpl->assign("unreads",$currdb->num_rows($result));

	$currtpl->assign("msgs",$msgs);
	$currtpl->display("msg_box.htm");
}
else
	_redirect();
?>
