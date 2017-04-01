<?
require_once("../../mainfile.php");

if ($curruser->haveperm($curruser->p_handler->getpermvalid()))
{
	if ($currmodule->isadmin($curruser) && (!empty($_POST["create"]) || !empty($_GET["create"])))
	{
		if (!empty($_POST["title"]) && !empty($_POST["content"]))
		{
			$_WikiTopic = new WikiTopic();

			$_WikiTopic->getbytitle($_POST["title"]);

			if ($_WikiTopic->tno <= 0)
			{
				$_POST["title"] = str_replace(",", "", $_POST["title"]);
				$_POST["title"] = str_replace("]", "", $_POST["title"]);

				$criteria = new CriteriaCompo(new Criteria("tno", ""));
				$criteria->add(new Criteria("title", strtolower($_POST["title"])));
				$criteria->add(new Criteria("locks", 0));
				$criteria->add(new Criteria("whylock", ""));
				$criteria->add(new Criteria("manager", ""));
				$criteria->add(new Criteria("cno", 0));

				$currdb->query("INSERT INTO `".$currdb->prefix("wiki_topic")."` ".$criteria->insertsql());

				if ($currdb->insert_id() > 0)
				{
					$tno = $currdb->insert_id();
					$_POST["content"] = wikifilter($_POST["content"]);
					$coins = wikidiff("", $_POST["content"]);

					$criteria = new CriteriaCompo(new Criteria("pno", ""));
					$criteria->add(new Criteria("poster_no", $curruser->uno));
					$criteria->add(new Criteria("posttime", mktime()));
					$criteria->add(new Criteria("tno", $tno));
					$criteria->add(new Criteria("content", $_POST["content"]));
					$criteria->add(new Criteria("cost", $coins));
					$criteria->add(new Criteria("impeach", 0));

					$currdb->query("INSERT INTO `".$currdb->prefix("wiki_post")."` ".$criteria->insertsql());

					$pno = $currdb->insert_id();

					if ($coins > 0)
					{
						$criteria = new CriteriaCompo(new Criteria("coins", $curruser->coins + $coins));

						$curruser->u_handler->modifyuser($curruser->uno, $criteria);
					}

					_redirect(URL."/module/".$currmodule->name."/view.php?pno=".$pno);
				}
			}
			else
				dies("此主題已經存在", URL."/module/".$currmodule->name);
		}
		else
		{
//			$ec = mb_detect_encoding($_GET["title"], "ASCII, BIG-5, UTF-8");
//			$_GET["title"] = iconv($ec, "UTF-8", $_GET["title"]);

			$currtpl->assign("tlb", wikitoolbar());
			$currtpl->assign("title", htmlencode($_GET["title"]));
			$currtpl->display("topic_create_form.htm");
		}
	}
	else if (!empty($_POST["newpost"]) || !empty($_GET["newpost"]))
	{
		$_WikiPost = new WikiPost(($_POST["pno"] > 0) ? $_POST["pno"] : $_GET["pno"]);

		$_WikiTopic = new WikiTopic();
		$_WikiTopic->getbyno($_WikiPost->tno);

		if ($_WikiTopic->tno > 0)
		{
			if ($_WikiTopic->unlock(LOCK_TOPIC))
			{
				if (!empty($_POST["content"]) && $_WikiTopic->currpost->content != $_POST["content"])
				{
					if (empty($_POST["chkorv"]) && $_WikiPost->pno != $_WikiTopic->currpost->pno)
					{
						$currtpl->assign("_WikiTopic", $_WikiTopic);
						$currtpl->assign("_WikiPost", $_WikiPost);
						$currtpl->assign("content", $_POST["content"]);
						$currtpl->display("topic_chkorv_form.htm");
					}
					else
					{
						$_POST["content"] = wikifilter($_POST["content"]);
						$coins = wikidiff($_WikiTopic->currpost->content, $_POST["content"]);

						$criteria = new CriteriaCompo(new Criteria("pno", ""));
						$criteria->add(new Criteria("poster_no", $curruser->uno));
						$criteria->add(new Criteria("posttime", mktime()));
						$criteria->add(new Criteria("tno", $_WikiTopic->tno));
						$criteria->add(new Criteria("content", $_POST["content"]));
						$criteria->add(new Criteria("cost", $coins));
						$criteria->add(new Criteria("impeach", 0));

						$currdb->query("INSERT INTO `".$currdb->prefix("wiki_post")."` ".$criteria->insertsql());

						$pno = $currdb->insert_id();

						if ($coins > 0)
						{
							$criteria = new CriteriaCompo(new Criteria("coins", $curruser->coins + $coins));

							$curruser->u_handler->modifyuser($curruser->uno, $criteria);
						}

						_redirect(URL."/module/".$currmodule->name."/view.php?pno=".$pno);
					}
				}
				else
				{
					$currtpl->assign("wikiedit", 1);
					$currtpl->assign("_WikiTopic", $_WikiTopic);
					$currtpl->assign("_WikiPost", $_WikiPost);
					$currtpl->assign("tlb", wikitoolbar());
					$currtpl->display("topic_newpost_form.htm");
				}
			}
			else
				dies("此主題已被鎖定".(($_WikiTopic->whylock) ? "<br />鎖定原因：".$_WikiTopic->whylock : ""), URL."/module/".$currmodule->name."/view.php?title=".urlencode($_WikiTopic->title));
		}
		else
			_redirect();
	}
	else if (!empty($_GET["delete"]) && !empty($_GET["tno"]))
	{
		if ($currmodule->isadmin($curruser))
		{
			$_WikiTopic = WikiTopic();

			$_WikiTopic->getbyno($_GET["tno"]);

			$currdb->query("DELETE FROM `".$currdb->prefix("wiki_post")."` WHERE tno='".$_WikiTopic->tno."'");
			$currdb->query("DELETE FROM `".$currdb->prefix("wiki_topic")."` WHERE tno='".$_WikiTopic->tno."'");
		}

		_redirect();
	}
	else if (!empty($_GET["impeach"]) && !empty($_GET["pno"]))
	{
		$_GET["pno"] = intval($_GET["pno"]);

		$currdb->query("UPDATE `".$currdb->prefix("wiki_post")."` SET impeach='".$curruser->uno."' WHERE pno='".$_GET["pno"]."'");

		_redirect(URL."/module/".$currmodule->name."/view.php?pno=".$_GET["pno"]);
	}
	else if (!empty($_GET["unimpeach"]) && !empty($_GET["pno"]))
	{
		if ($currmodule->isadmin($curruser))
		{
			$_GET["pno"] = intval($_GET["pno"]);

			$currdb->query("UPDATE `".$currdb->prefix("wiki_post")."` SET impeach='0' WHERE pno='".$_GET["pno"]."'");

			_redirect(URL."/module/".$currmodule->name."/view.php?pno=".$_GET["pno"]);
		}
	}
	else if (!empty($_POST["docomment"]) && !empty($_POST["tno"]) && !empty($_POST["comment"]))
	{
		$_WikiTopic = new WikiTopic();

		$_WikiTopic->getbyno($_POST["tno"]);

		if ($_WikiTopic->tno > 0)
		{
			if ($_WikiTopic->unlock(LOCK_COMM))
			{
				$criteria = new CriteriaCompo(new Criteria("mno", ""));
				$criteria->add(new Criteria("poster_no", $curruser->uno));
				$criteria->add(new Criteria("comment", $_POST["comment"]));
				$criteria->add(new Criteria("posttime", mktime()));
				$criteria->add(new Criteria("tno", $_WikiTopic->tno));

				$currdb->query("INSERT INTO `".$currdb->prefix("wiki_comment")."` ".$criteria->insertsql());

				_redirect(URL."/module/".$currmodule->name."/view.php?pno=".$_WikiTopic->currpost->pno);
			}
			else
				dies("此主題已被鎖定".(($_WikiTopic->whylock) ? "<br />鎖定原因：".$_WikiTopic->whylock : ""), URL."/module/".$currmodule->name."/view.php?title=".urlencode($_WikiTopic->title));
		}
		else
			_redirect();
	}
	else if (!empty($_GET["delcomment"]) && !empty($_GET["mno"]))
	{
		$_GET["mno"] = intval($_GET["mno"]);

		$result = $currdb->query("SELECT tno FROM `".$currdb->prefix("wiki_comment")."` WHERE mno='".$_GET["mno"]."'");

		if ($currdb->num_rows($result) == 1)
		{
			$tmp = $currdb->fetch_array($result);

			$_WikiTopic = new WikiTopic();
			$_WikiTopic->getbyno($tmp["tno"]);

			if ($_WikiTopic->ismanager())
				$currdb->query("DELETE FROM `".$currdb->prefix("wiki_comment")."` WHERE mno='".$_GET["mno"]."'");
		}

		_redirect();
	}
	else
		_redirect();
}
else
	 _redirect(URL."/module/".$currmodule->name);
?>
