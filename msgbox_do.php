<?
require_once("./mainfile.php");

if (!$curruser->isguest())
{
	$read = 1;
	$unread = 2;

	if (isset($_GET["msgread"]) && isset($_GET["mno"]))
	{
		$criteria = new CriteriaCompo(new Criteria("m.owner_no", $curruser->uno));
		$criteria->add(new Criteria("mno", $_GET["mno"]));

		$result = $currdb->query("SELECT m.*, u.uid as sender_id ,u.name as sender_name FROM `".$currdb->prefix("msg")."` m LEFT JOIN `".$currdb->prefix("user")."` u ON m.sender_no=u.uno WHERE ".$criteria->render());
			
		if ($currdb->num_rows($result) < 1)
			dies("找不到此訊息");

		$msg = $currdb->fetch_array($result);

		//turn status
		if($msg["status"] == $unread)
		{
			$status = ($msg["status"] == $read) ? $unread : $read;
			$currdb->query("UPDATE `".$currdb->prefix("msg")."` m SET status='".$status."' WHERE ".$criteria->render());
		}

		$msg["content"] = _replace_code($msg["content"]);
		$msg["time"] = date("Y-m-d H:i:s", $msg["time"]);

		$currtpl->assign("msg",$msg);

		$currtpl->display("msg_read.htm");
	}
	else if (isset($_GET["msgdel"]) && isset($_GET["mno"]))
	{
	    /*foreach($_POST["chk"] as $v){
			$criteria = new CriteriaCompo(new Criteria("owner_no", $curruser->uno));
			$criteria->add(new Criteria("mno", $v));

			$currdb->query("DELETE FROM `".$currdb->prefix("msg")."` where ".$criteria->render());
		}*/

		$criteria = new CriteriaCompo(new Criteria("owner_no", $curruser->uno));
		$criteria->add(new Criteria("mno", $_GET["mno"]));

		$currdb->query("DELETE From `".$currdb->prefix("msg")."` where ".$criteria->render());

		_redirect(URL."/msgbox.php");
	}
	else if (isset($_GET["unread"]))
	{
		$currtpl->setndisplay();
	
		$result = $currdb->query("SELECT * FROM `".$currdb->prefix("msg")."` where owner_no='".$curruser->uno."' and status='".$unread."'");
		
		echo $currdb->num_rows($result);
	}
}
else
	_redirect();
?>
