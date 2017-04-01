<?
require_once("../../mainfile.php");

if ($curruser->haveperm($curruser->p_handler->getpermvalid()))
{
	if (!empty($_POST["doask"]))
	{
		$_POST["question"] = trim($_POST["question"]);
		if (!empty($_POST["question"]) && !empty($_POST["ref"]))
		{
			$ref = explode(",", $_POST["ref"]);

			$_POST["ref"] = getref($_POST["ref"]);

			if (!empty($_POST["ref"]))
			{
				$criteria = new CriteriaCompo(new Criteria("qno", ""));
				$criteria->add(new Criteria("poster_no", $curruser->uno));
				$criteria->add(new Criteria("question", $_POST["question"]));
				$criteria->add(new Criteria("posttime", mktime()));
				$criteria->add(new Criteria("ref", $_POST["ref"]));
				$criteria->add(new Criteria("ano", 0));
				$currdb->query("INSERT INTO `".$currdb->prefix("wiki_question")."` ".$criteria->insertsql());

				$qno = $currdb->insert_id();

				$currdb->query("INSERT INTO `".$currdb->prefix("wiki_subscribe")."` (user_no, type, no) VALUES ('".$curruser->uno."', 'question', '".$qno."')");
			}
		}
	}
	else if (!empty($_POST["doanswer"]) && !empty($_POST["qno"]))
	{
		$_POST["qno"] = intval($_POST["qno"]);

		$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_question")."` WHERE qno='".$_POST["qno"]."' and ano='0'");

		if ($tmp = $currdb->fetch_array($result))
		{
			if ($tmp["ano"] == 0)
			{
				$_POST["ref"] = getref($_POST["ref"]);

				$criteria = new CriteriaCompo(new Criteria("ano", ""));
				$criteria->add(new Criteria("poster_no", $curruser->uno));
				$criteria->add(new Criteria("answer", $_POST["answer"]));
				$criteria->add(new Criteria("posttime", mktime()));
				$criteria->add(new Criteria("ref", $_POST["ref"]));
				$criteria->add(new Criteria("qno", $_POST["qno"]));

				$currdb->query("INSERT INTO `".$currdb->prefix("wiki_answer")."` ".$criteria->insertsql());
			}
		}
	}
	else if (!empty($_GET["bestans"]) && !empty($_GET["qno"]) && !empty($_GET["ano"]))
	{

		$_GET["qno"] = intval($_GET["qno"]);

		$_GET["ano"] = intval($_GET["ano"]);

		$result = $currdb->query("SELECT a.ano, a.poster_no, q.ref as ref1, a.ref as ref2 FROM `".$currdb->prefix("wiki_question")."` q LEFT JOIN `".$currdb->prefix("wiki_answer")."` a ON a.qno=q.qno WHERE q.qno='".$_GET["qno"]."' and a.ano='".$_GET["ano"]."'");

		if ($currdb->num_rows($result) == 1)
		{
			$tmp = $currdb->fetch_array($result);

			if ($tmp["ano"] > 0 && ($currmodule->isadmin($curruser) || $curruser->uno == $tmp["poster_no"]))
			{
				$tmp = getref($tmp["ref1"].$tmp["ref2"]);

//				$currdb->query("DELETE FROM `".$currdb->prefix("wiki_answer")."` WHERE qno='".$_GET["qno"]."' and ano != '".$_GET["ano"]."'");

				$criteria = new CriteriaCompo(new Criteria("ref", $tmp));
				$criteria->add(new Criteria("ano", $_GET["ano"]));

				$currdb->query("UPDATE `".$currdb->prefix("wiki_question")."` ".$criteria->updatesql()." WHERE qno='".$_GET["qno"]."'");
			}
		}
	}
	else if (!empty($_GET["delques"]) && !empty($_GET["qno"]))
	{
		$_GET["qno"] = intval($_GET["qno"]);


		if ($currmodule->isadmin($curruser))
		{
			$currdb->query("DELETE FROM `".$currdb->prefix("wiki_question")."` WHERE qno='".$_GET["qno"]."'");
			$currdb->query("DELETE FROM `".$currdb->prefix("wiki_answer")."` WHERE qno='".$_GET["qno"]."'");
		}
	}
	else if (!empty($_GET["delans"]) && !empty($_GET["ano"]))
	{
		$_GET["ano"] = intval($_GET["ano"]);

		$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_answer")."` WHERE ano='".$_GET["ano"]."'");

		if ($tmp = $currdb->fetch_array($result))
		{
			if ($tmp["poster_no"] == $curruser->uno || $currmodule->isadmin($curruser))
			{
				$result = $currdb->query("SELECT ano FROM `".$currdb->prefix("wiki_question")."` WHERE qno='".$tmp["qno"]."'");

				if ($tmp = $currdb->fetch_array($result))
				{
					if ($tmp["ano"] != $_GET["ano"])
						$currdb->query("DELETE FROM `".$currdb->prefix("wiki_answer")."` WHERE ano='".$_GET["ano"]."'");
				}
			}
		}
	}

	_redirect();
}
else
	 _redirect();
?>
