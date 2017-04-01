<?
require_once("../../mainfile.php");

$_GET["qno"] = intval($_GET["qno"]);

$result = $currdb->query("SELECT q.*, u.uid as poster_id, u.name as poster_name FROM `".$currdb->prefix("wiki_question")."` q LEFT JOIN `".$currdb->prefix("user")."` u ON q.poster_no=u.uno WHERE q.qno='".$_GET["qno"]."'");

if ($currdb->num_rows($result) == 1)
{
	$question = $currdb->fetch_array($result);

	$question["posttime"] = date("m/d H:i", $question["posttime"]);

	$question["ref"] = explode(",", $question["ref"]);

	if ($question["ano"] > 0)
	{
		$result = $currdb->query("SELECT a.*, u.uid as poster_id, u.name as poster_name FROM `".$currdb->prefix("wiki_answer")."` a LEFT JOIN `".$currdb->prefix("user")."` u ON a.poster_no=u.uno WHERE a.ano='".$question["ano"]."'");

		if ($currdb->num_rows($result) == 1)
		{
			$bestans = $currdb->fetch_array($result);
			$bestans["posttime"] = date("m/d H:i", $bestans["posttime"]);

			$bestans["ref"] = explode(",", $bestans["ref"]);
		}
		else
		{
			$currdb->query("UPDATE `".$currdb->prefix("wiki_question")."` SET ano='0' WHERE qno='".$question["qno"]."'");
			$question["ano"] = 0;
		}
	}

	if (!isset($bestans))
	{
		$result = $currdb->query("SELECT a.*, u.uid as poster_id, u.name as poster_name FROM `".$currdb->prefix("wiki_answer")."` a LEFT JOIN `".$currdb->prefix("user")."` u ON a.poster_no=u.uno WHERE a.qno='".$question["qno"]."' ORDER BY a.ano ASC");

		for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
		{
			$tmp["posttime"] = date("m/d H:i", $tmp["posttime"]);
			$tmp["ref"] = explode(",", $tmp["ref"]);

			$answers[$i] = $tmp;
		}
	}

	$currtpl->assign("question", $question);
	$currtpl->assign("bestans", $bestans);
	$currtpl->assign("answers", $answers);

	$currtpl->display("question.htm");
}
else
{
	$page = (intval($_GET["page"]) > 0) ? intval($_GET["page"]) : 1;

	$pagesize = 10;

	$result = $currdb->query("SELECT SQL_CALC_FOUND_ROWS q.*, u.uid as poster_id, u.name as poster_name FROM `".$currdb->prefix("wiki_question")."` q LEFT JOIN `".$currdb->prefix("user")."` u ON q.poster_no=u.uno WHERE q.ano='0' ORDER BY q.qno DESC LIMIT ".(($page - 1) * $pagesize).", ".$pagesize);

	$result2 = $currdb->query("SELECT FOUND_ROWS()");

	$maxpage = $currdb->fetch_array($result2);
	$maxpage = ($maxpage[0] % $pagesize == 0) ? intval($maxpage[0] / $pagesize) : intval($maxpage[0] / $pagesize + 1);

	$page = ($_GET["page"] > 0) ? $_GET["page"] : 1;

	$page = ($page > $maxpage) ? $maxpage : $page;

	$plink = _multipage($page, $maxpage, $currconfig->phpself);

	for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
	{
		$result2 = $currdb->query("SELECT COUNT(*) FROM `".$currdb->prefix("wiki_answer")."` WHERE qno='".$tmp["qno"]."'");

		$tmp2 = $currdb->fetch_array($result2);

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

	$currtpl->assign("plink", $plink);

	$currtpl->assign("question", $question);

	$currtpl->display("question_list.htm");
}
?>
