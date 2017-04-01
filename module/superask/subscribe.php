<?
require_once("../../mainfile.php");

if (!$curruser->isguest())
{
	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_subscribe")."` WHERE user_no='".$curruser->uno."' and type='topic'");

	for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
	{
		$s_topics[$i] = new WikiTopic();
		$s_topics[$i]->getbyno($tmp["no"]);

		if ($s_topics[$i]->tno <= 0)
		{
			$currdb->query("DELETE FROM `".$currdb->prefix("wiki_subscribe")."` WHERE user_no='".$curruser->uno."' and type='topic' and no='".$tmp["no"]."'");

			unset($s_topics[$i]);

			$i--;
		}
		else
		{
			$s_topics[$i]->title = _substr($s_topics[$i]->title, 0, 13);

			$s_topics[$i]->currpost->posttime = date("m/d/Y", $s_topics[$i]->currpost->posttime);
		}
	}

	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_subscribe")."` WHERE user_no='".$curruser->uno."' and type='question'");

	for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
	{
		$result2 = $currdb->query("SELECT q.*, u.name as poster_name FROM `".$currdb->prefix("wiki_question")."` q LEFT JOIN `".$currdb->prefix("user")."` u ON q.poster_no=u.uno WHERE q.qno='".$tmp["no"]."'");

		if ($currdb->num_rows($result2) <= 0)
		{
			$currdb->query("DELETE FROM `".$currdb->prefix("wiki_subscribe")."` WHERE user_no='".$curruser->uno."' and type='question' and no='".$tmp["no"]."'");

			$i--;
		}
		else
		{
			$tmp = $currdb->fetch_array($result2);
			$tmp["question"] = _substr($tmp["question"], 0, 13);
			$tmp["posttime"] = date("m/d/Y", $tmp["posttime"]);

			if ($tmp["ano"] > 0)
			{
				$result2 = $currdb->query("SELECT a.*, u.name as poster_name FROM `".$currdb->prefix("wiki_answer")."` a LEFT JOIN `".$currdb->prefix("user")."` u ON a.poster_no=u.uno WHERE a.qno='".$tmp["qno"]."'");

                                $tmp["answer"] = $currdb->fetch_array($result2);

                                $tmp["posttime"] = date("m/d/Y", $tmp["answer"]["posttime"]);
			}

			$s_questions[$i] = $tmp;
		}
	}

	$currtpl->assign("s_topics", $s_topics);
	$currtpl->assign("s_questions", $s_questions);

	$currtpl->display("my_subscribe.htm");
}
else
	_redirect();
?>
