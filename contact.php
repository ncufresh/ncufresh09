<?
require_once("./mainfile.php");

if ($curruser->haveperm($curruser->p_handler->getpermadmin()))
{
	if (isset($_GET['changestate']) && isset($_POST['state']))
	{
		$c = new CriteriaCompo(new Criteria('state', $_POST['state']));

		$currdb->query("UPDATE `".$currdb->prefix('contact')."` ".$c->updatesql()." WHERE `mno`='".$_POST['mno']."'");

		_redirect(2);
	}
	else if (isset($_GET["read_contact"]) && isset($_GET["mno"]))
	{
		$_GET["mno"] = intval($_GET["mno"]);

		$result = $currdb->query("SELECT * FROM `".$currdb->prefix("contact")."` WHERE mno='".$_GET["mno"]."'");

		if ($currdb->num_rows($result) < 1)
			dies("沒有該訊息");

		$tmp = $currdb->fetch_array($result);

		$sender = ($tmp["isguest"]) ? $tmp["sender"] : $curruser->u_handler->getuserbyno($tmp["sender"])->uid;
		$email = ($tmp["isguest"]) ? "mailto:".$tmp["email"]."?subject=Re:".$tmp['title'] : $currconfig->url."/msgsend.php?fno=".$tmp["sender"]."&title=".$tmp['title'];

		$currtpl->assign("sender", $sender);
		$currtpl->assign("email", $email);
		$currtpl->assign("title", $tmp["title"]);
		$currtpl->assign("time", date("Y-m-d H:i:s", $tmp["time"]));
		$currtpl->assign("content", nl2br($tmp["content"]));
		$currtpl->assign("ip", $tmp["ip"]);
		$currtpl->assign("mno", $tmp["mno"]);
		$currtpl->assign('state', $tmp['state']);
		$currtpl->display("read_contact.htm");
	}
	else if (isset($_GET["del_contact"]) && isset($_GET["mno"]))
	{
		$_GET["mno"] = intval($_GET["mno"]);

		$currdb->query("DELETE FROM `".$currdb->prefix("contact")."` WHERE mno='".$_GET["mno"]."'");

		_redirect($currconfig->phpself);
	}
	else
	{
		$pagesize = 10;

		$page = (intval($_GET["page"]) > 0) ? intval($_GET["page"]) : 1;

		$result2 = $currdb->query("SELECT SQL_CALC_FOUND_ROWS * FROM `".$currdb->prefix("contact")."` ORDER BY mno DESC LIMIT ".(($page - 1) * $pagesize).", ".$pagesize);
		$result = $currdb->query("SELECT FOUND_ROWS()");

		$how_many_msgs = $currdb->fetch_array($result);

		$maxpage = ($how_many_msgs[0] % 10 == 0) ? intval($how_many_msgs[0] / $pagesize) : intval($how_many_msgs[0] / $pagesize + 1);

		$page = ($page > $maxpage) ? $maxpage : $page;
		$p = _multipage($page, $maxpage, $currconfig->phpself);
		$currtpl->assign("p", $p);

		for ($i = 0;$tmp = $currdb->fetch_array($result2);$i++)
		{
			$mno[$i] = $tmp["mno"];
			$email[$i] = ($tmp["isguest"]) ? "mailto:".$tmp["email"]."?subject=Re:".$tmp['title'] : $currconfig->url."/msgsend.php?fno=".$tmp["sender"]."&title=".$tmp["title"];
			$sender[$i] = ($tmp["isguest"]) ? $tmp["sender"] : $curruser->u_handler->getuserbyno($tmp["sender"])->realname;
			$title[$i] = $tmp["title"];
			$time[$i] = date("Y-m-d H:i", $tmp["time"]);
			$content[$i] = $tmp["content"];
			$ip[$i] = $tmp["ip"];
			$state[$i] = $tmp['state'];
		}

		$currtpl->assign("sender", $sender);
		$currtpl->assign("title", $title);
		$currtpl->assign("time", $time);
		$currtpl->assign("email", $email);
		$currtpl->assign("mno", $mno);
		$currtpl->assign('state', $state);
		$currtpl->display("contact_list.htm");
	}
}
else
{
	if (!empty($_POST["title"]) && !empty($_POST["content"]))
	{
		$sender = ($curruser->isguest()) ? htmlencode($_POST["sender"]) : $curruser->uno;
		$isguest = $curruser->isguest();
		$title = htmlencode($_POST["title"]);
		$content = htmlencode($_POST["content"]);
		$time = mktime();
		$ip = $_SERVER["REMOTE_ADDR"];
		$email = (!empty($_POST["email"])) ? $_POST["email"] : "";

		$currdb->query("INSERT INTO `".$currdb->prefix("contact")."` (mno, sender, email, title, content, time, isguest, ip, state) VALUES('', '".$sender."', '".$email."', '".$title."', '".$content."', '".$time."', '".$isguest."', '".$ip."', '未處理')");

		echo "訊息傳送成功";
	}
	else
		$currtpl->display("send_contact.htm");
}
?>
