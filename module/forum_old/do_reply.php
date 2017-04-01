<?
require_once("../../mainfile.php");

$_POST['content'] = addslashes($_POST['content']);

if (!$curruser->isguest())
{
	if (isset($_POST["doreply"]) || isset($_GET["doreply"]))			// reply topic (not ajax)
	{
		$tno = (!empty($_POST["tno"])) ? $_POST["tno"] : $_GET["tno"];

		$forumtopic = new ForumObject("topic", $tno);
		$forumboard = new ForumObject("board", $forumtopic->board_no);

		//$bm = bm($forumboard)) ;

		if ($forumtopic->topic_no <= 0 || !$curruser->haveperm($forumboard->perm)) 
			echo "找不到主題";
		else if (isset($_POST["doreply"]) && !empty($_POST["content"]))
		{
			$posttime = mktime();

			$currdb->query("INSERT INTO `".$currdb->prefix("forum_reply")."` (content, topic_no, poster_no, posttime, ip_addr) VALUES ('".$_POST["content"]."', '".$forumtopic->topic_no."', '".$curruser->uno."', '".$posttime."', '".$_SERVER["REMOTE_ADDR"]."')");

			$rno = $currdb->insert_id();

			if ($rno > 0)
			{
				$currdb->query("UPDATE `".$currdb->prefix("forum_topic")."` SET numreply='".($forumtopic->numreply + 1)."', lasttime='".mktime()."' WHERE topic_no='".$forumtopic->topic_no."'");

				$currdb->query("UPDATE `".$currdb->prefix("forum_board")."` SET lasttime='".mktime()."' WHERE board_no='".$forumboard->board_no."'");

				$currdb->query("DELETE FROM `".$currdb->prefix("forum_redpoint")."` WHERE `topic_no`='".$forumtopic->topic_no."'");
			}

			func_do_subscr('reply', $rno);
			
			_redirect(URL."/module/".$currmodule->name."/viewtopic.php?no=".$forumtopic->topic_no);
		}
		else
		{
			//$currtpl->assign_by_ref("forumboard", $forumboard);
			//$currtpl->assign_by_ref("forumtopic", $forumtopic);

			//$currtpl->display("userlink.htm");
			//$currtpl->display("reply_form.htm");
			
			_redirect();
		}
	}
	else if (isset($_POST["mdreply"]) || isset($_GET["mdreply"]))			//modify article (not ajax)
	{
		$rno = (!empty($_POST["rno"])) ? $_POST["rno"] : $_GET["rno"];

		$forumreply = new ForumObject("reply", $rno);
		$forumtopic = new ForumObject("topic", $forumreply->topic_no);
		$forumboard = new ForumObject("board", $forumtopic->board_no);

		$bm = bm($forumboard);

		if(($curruser->uno != $forumreply->poster_no) && !$bm)
			echo "找不到文章";
		else if (isset($_POST["mdreply"]) && !empty($_POST["content"]))
		{
			$_POST["content"] .= "\n\n\n\n\n\n由 ".$curruser->uid." 修改於 ".date("Y-m-d H:i:s");

			$currdb->query("UPDATE `".$currdb->prefix("forum_reply")."` SET content='".$_POST["content"]."' WHERE reply_no='".$forumreply->reply_no."'");

			_redirect(URL."/module/".$currmodule->name."/viewtopic.php?no=".$forumreply->topic_no);
		}
		else
		{
			$currtpl->assign_by_ref("forumboard", $forumboard);
			$currtpl->assign_by_ref("forumreply", $forumreply);

			$currtpl->display("mod_r_form.htm");
		}
	}
	else if (isset($_POST["rmreply"]))						// remove reply by post (ajax)
	{
		$currtpl->setndisplay();

		$forumreply = new ForumObject("reply", $_POST["rno"]);
		$forumtopic = new ForumObject("topic", $forumreply->topic_no);
		$forumboard = new ForumObject("board", $forumtopic->board_no);

		$bm = explode("/", $forumboard->admin);

		if ($forumreply->reply_no <= 0)
			echo "找不到文章";
		else if (!$bm && !($currmodule->isadmin($curruser)))
			echo "找不到文章";
		else
		{
			$currdb->query("UPDATE `".$currdb->prefix("forum_topic")."` SET numreply='".($forumtopic->numreply - 1)."' WHERE topic_no='".$forumtopic->topic_no."'");
			$currdb->query("UPDATE `".$currdb->prefix("forum_reply")."` SET `die`='1' WHERE `reply_no`='".$forumreply->reply_no."'");

			/*
			$currdb->query("DELETE FROM `".$currdb->prefix("forum_reply")."` WHERE reply_no='".$forumreply->reply_no."'");
			$currdb->query("DELETE FROM `".$currdb->prefix("forum_push")."` WHERE reply_no='".$forumreply->reply_no."'");
			 */
		}
	}
}
else
	_redirect();
?>
