<?
require_once("../../mainfile.php");

$_WikiTopic = new WikiTopic();

if (!empty($_GET["pno"]))
{
	$_WikiPost = new WikiPost($_GET["pno"]);

	if ($_WikiPost->pno > 0)
		$_WikiTopic->getbyno($_WikiPost->tno);
}
else
{
	if (!empty($_GET["title"]))
	{
//		$ec = mb_detect_encoding($_GET["title"], "ASCII, UTF-8, BIG-5");
//		$title = iconv($ec, "UTF-8", $_GET["title"]);

		$_WikiTopic->getbytitle($_GET["title"]);

		if ($_WikiTopic->tno <= 0)
		{
			$_GET["title"] = iconv("BIG-5", "UTF-8", $_GET["title"]);

			$_WikiTopic->getbytitle($_GET["title"]);
		}
	}
	else
		$_WikiTopic->getbyno($_GET["tno"]);

	$_WikiPost =& $_WikiTopic->currpost;
}

if ($_WikiTopic->tno > 0 && ($_WikiTopic->showlink != 0 || $curruser->g_handler->isGroupAdmin($_WikiTopic->gno,$curruser->uno)))
{
	if($_WikiTopic->tno != 217)
		showwhere($_WikiTopic->cno);

	$site["url"] = URL."/module/".$currmodule->name."/view.php?title=".urlencode($_WikiTopic->title);
	$site["name"] = $_WikiTopic->title;

	$currsite[] = $site;

	if ($_SESSION["superask_tno"] != $_WikiTopic->tno)
	{
		$currdb->query("UPDATE `".$currdb->prefix("wiki_topic")."` SET numread='".($_WikiTopic->numread + 1)."' WHERE tno='".$_WikiTopic->tno."'");

		$_SESSION["superask_tno"] = $_WikiTopic->tno;
	}

	$currtpl->addjs(ROOT_PATH."/include/js/effect.js");

	if ($_WikiPost->pno == $_WikiTopic->currpost->pno)
	{
		$result = $currdb->query("SELECT m.*, u.name as poster_name FROM `".$currdb->prefix("wiki_comment")."` m LEFT JOIN `".$currdb->prefix("user")."` u ON m.poster_no=u.uno WHERE m.tno='".$_WikiTopic->tno."' ORDER BY m.mno ASC");

		for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
		{
			$tmp["comment"] = _substr($tmp["comment"], 0, 30);
			$tmp["posttime"] = date("m/d", $tmp["posttime"]);
			$comment[$i] = $tmp;
		}

		$_WikiTopic->comment = $comment;

		$result = $currdb->query("SELECT q.*, u.uid as poster_id, u.name as poster_name FROM `".$currdb->prefix("wiki_question")."` q LEFT JOIN `".$currdb->prefix("user")."` u ON q.poster_no=u.uno WHERE q.ref like '%,".$_WikiTopic->title.",%' ORDER BY q.ano, q.qno DESC");

		for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
		{
			$result2 = $currdb->query("SELECT COUNT(*) FROM `".$currdb->prefix("wiki_answer")."` WHERE qno='".$tmp["qno"]."'");

			$tmp2 =  $currdb->fetch_array($result2);

			$tmp["posttime"] = date("Y/m/d H:i", $tmp["posttime"]);

			$tmp["ref"] = explode(",", $tmp["ref"]);

			$tmp["numans"] = $tmp2[0];

			$question[$i] = $tmp;

			if ($question[$i]["ano"] > 0)
			{
				$result2 = $currdb->query("SELECT a.*, u.uid as poster_id, u.name as poster_name FROM `".$currdb->prefix("wiki_answer")."` a LEFT JOIN `".$currdb->prefix("user")."` u ON a.poster_no=u.uno WHERE a.ano='".$question[$i]["ano"]."'");

				$tmp = $currdb->fetch_array($result2);

				$tmp["posttime"] = date("Y/m/d H:i", $tmp["posttime"]);

				$tmp["ref"] = explode(",", $tmp["ref"]);

				$question[$i]["answer"] = $tmp;
			}
		}

		$_WikiTopic->qanda = $question;
	}

	$currtpl->assign("wikiview", 1);
	$currtpl->assign("_WikiTopic", $_WikiTopic);
	$currtpl->assign("numcomment", count($_WikiTopic->comment));
	$currtpl->assign("numqanda", count($_WikiTopic->qanda));
	$currtpl->assign("_WikiPost", $_WikiPost);

	$_GET['userType'] = 'G';
	$_GET['no'] = $_WikiTopic->gno;
	$block_handler =& gethandler("block");
	$cal_block = $block_handler->getblockbyno(20)->fetch();
	$currtpl->assign("cal_block",$cal_block);

	$currtpl->display("topic_view.htm");
}
else if (!empty($_GET["title"]))
	_redirect(URL."/module/".$currmodule->name."/do_topic.php?create=1&title=".urlencode($_GET["title"]));
else if($_WikiTopic->showlink == 0 )
	dies('此主題沒有負責人，若有疑問請<a href="'.URL.'/contact.php" title="聯絡我們">[聯絡我們]</a>');
else
	_redirect();
?>
