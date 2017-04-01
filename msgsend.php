<?
require_once("./mainfile.php");

if (!$curruser->isguest())
{
	$read = 1;
	$unread = 2;

	if ($_POST["group"] != 0)
	{
		$_POST["group"] = (intval($_POST["group"]) > 0) ? intval($_POST["group"]) : 0;
		$result = $currdb->query("SELECT uno FROM `".$currdb->prefix("gmember")."` where gno='".$_POST["group"]."'");
		$_POST["title"] = htmlencode($_POST["title"]);
		$_POST["content"] = htmlencode($_POST["content"]);
		$own_no = array();
		while($res = $currdb->fetch_array($result)){
			$own_no[] =  "('','".$curruser->uno."','".$res["uno"]."','".$_POST["title"]."','".$_POST["content"]."','".mktime()."','".$unread."')";
		}
		//echo "INSERT INTO`".$currdb->prefix("msg")."`(mno,sender_no,owner_no,title,content,time,status) VALUES".implode(" ",$own_no); 
		$currdb->query("INSERT INTO`".$currdb->prefix("msg")."`(mno,sender_no,owner_no,title,content,time,status) VALUES".implode(",",$own_no));

	}
	else if (!empty($_POST["fid"]) && !empty($_POST["title"]) && !empty($_POST["content"]))
	{
/*		$owner_no = $curruser->u_handler->getuserbyid($_POST["fid"])->uno;
		
		if ($owner_no > 0)
		{
			$title = htmlencode($_POST["title"]);
			$content = htmlencode($_POST["content"]);

			if ($curruser->uno > 0 && $owner_no > 0)
			{
				$criteria = new CriteriaCompo(new Criteria("mno", ""));
				$criteria->add(new Criteria("sender_no", $curruser->uno));
				$criteria->add(new Criteria("owner_no", $owner_no));
				$criteria->add(new Criteria("title", $title));
				$criteria->add(new Criteria("content", $content));
				$criteria->add(new Criteria("time", mktime()));
				$criteria->add(new Criteria("status", $unread));


				$currdb->query("INSERT INTO `".$currdb->prefix("msg")."` ".$criteria->insertsql());
			}

			dies("訊息傳送成功", URL."/msgbox.php");
		}
		else
				echo "錯誤的使用者帳號";*/
		if(msgsend($_POST['fid'],$_POST['title'],$_POST['content']))
			dies("訊息傳送成功", URL."/msgbox.php");
		else
			echo "錯誤的使用者帳號";
	}
	else
	{
		if (isset($_GET["fno"]) || isset($_GET["msgreply"]))
		{
			$fid = "";
			$title = "";

			if (isset($_GET["fno"]))
				$fid = $curruser->u_handler->getuserbyno($_GET["fno"])->uid;

			if (isset($_GET["title"])){
				$title = $_GET["title"];
				if(strcasecmp('Re:',_substr($title,0,3))) $title = 'Re:'.$title;
			}

			$currtpl->assign("fid", $fid);
			$currtpl->assign("title", $title);
		}
		$result = $currdb->query("SELECT g.gno,g.name FROM `".$currdb->prefix("gmember")."`m LEFT JOIN `".$currdb->prefix("group")."`g ON g.gno=m.gno WHERE m.uno='".$curruser->uno."' ORDER BY m.gno ASC");
		$myGroup[] = "請選擇";
		while($tmp = $currdb->fetch_array($result)){
			$myGroup[$tmp["gno"]] = $tmp["name"];
		}
		$currtpl->assign("myGroup",$myGroup);
		$currtpl->display("msg_send_form.htm");
	}
}
else
	_redirect();
?>
