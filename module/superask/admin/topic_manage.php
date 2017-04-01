<?
require_once("../../../mainfile.php");

if ($currmodule->isadmin($curruser))
{
	$_WikiTopic = new WikiTopic();

	$_WikiTopic->getbyno((isset($_GET["tno"])) ? $_GET["tno"] : $_POST["tno"]);

	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='0' ORDER BY ord ASC");

	for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
	{
		$cats[$tmp["cno"]] = $tmp["name"];

		$result2 = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='".$tmp["cno"]."' ORDER BY ord ASC");

		for ($j = 0;$tmp2 = $currdb->fetch_array($result2);$j++)
		{
			$cats[$tmp2["cno"]] = $tmp2["name"];
			$tmp["child"][$j] = $tmp2;
		}

		$category[$i] = $tmp;
	}

	$currtpl->assign("category", $category);

	if ($_WikiTopic->tno > 0)
	{
		if (isset($_GET["edit"]))
		{

			$currtpl->assign("_WikiTopic", $_WikiTopic);

			$currtpl->display("admin/topic_edit.htm");
		}
		else if (isset($_POST["edit"]))
		{
			$_POST["title"] = str_replace(",", "", $_POST["title"]);

			$_POST["title"] = str_replace("]", "", $_POST["title"]);

			$_POST["cno"] = intval($_POST["cno"]);

			$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE cno='".$_POST["cno"]."'");

			if ($currdb->num_rows($result) <= 0)
				$_POST["cno"] = $_WIkiTopic->cno;

			$locks = 0;

			for ($i = 0;$_POST["locks"][$i];$i++)
				$locks = ($locks | intval($_POST["locks"][$i]));

			$_POST["whylock"] = ($locks > 0) ? htmlencode($_POST["whylock"]) : "";

			$_POST["showlink"] = intval($_POST["showlink"]);



			$criteria = new CriteriaCompo(new Criteria("title", strtolower($_POST["title"])));
			$criteria->add(new Criteria("locks", $locks));
			$criteria->add(new Criteria("whylock", $_POST["whylock"]));
			$criteria->add(new Criteria("numread", intval($_POST["numread"])));
			$criteria->add(new Criteria("cno", $_POST["cno"]));
			$criteria->add(new Criteria("showlink",$_POST["showlink"]));

			$currdb->query("UPDATE `".$currdb->prefix("wiki_topic")."` ".$criteria->updatesql()." WHERE tno='".$_WikiTopic->tno."'");

			_redirect();
		}
		else if (isset($_GET["resave"]))
		{
			$result = $currdb->query("SELECT pno FROM `".$currdb->prefix("wiki_post")."` WHERE tno='".$_WikiTopic->tno."' ORDER BY pno DESC LIMIT 19, 1");

			if ($currdb->num_rows($result) == 1)
			{
				$tmp = $currdb->fetch_array($result);

				$currdb->query("DELETE FROM `".$currdb->prefix("wiki_post")."` WHERE tno='".$_WikiTopic->tno."' and pno < ".$tmp["pno"]);
			}

			_redirect();
		}
		else
			_redirect();
	}
	else
	{
	        $orderlist = array("title", "locks", "cno", "sum");

        	$_GET["order"] = (in_array($_GET["order"], $orderlist)) ? $_GET["order"] : $orderlist[1];

		if (!empty($_GET["column"]) && !empty($_GET["key"]))
		{
			$_GET["column"] = (in_array($_GET["column"], $orderlist)) ? $_GET["column"] : $orderlist[1];

			$criteria = new CriteriaCompo(new Criteria($_GET["column"], "%".$_GET["key"]."%", "like"));

			$result = $currdb->query("SELECT t.*, COUNT(*) as sum FROM `".$currdb->prefix("wiki_topic")."` t LEFT JOIN `".$currdb->prefix("wiki_post")."` p ON t.tno=p.tno WHERE ".$criteria->render()." GROUP BY p.tno ORDER BY ".$_GET["order"]." DESC");
		}
		else
			$result = $currdb->query("SELECT t.*, COUNT(*) as sum FROM `".$currdb->prefix("wiki_topic")."` t LEFT JOIN `".$currdb->prefix("wiki_post")."` p ON t.tno=p.tno GROUP BY p.tno ORDER BY ".$_GET["order"]." DESC");

		for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
		{
			$tmp["cat"] = $cats[$tmp["cno"]];
			$topics[$i] = $tmp;
		}

		$currtpl->assign("column", $_GET["column"]);
		$currtpl->assign("key", urlencode($_GET["key"]));
		$currtpl->assign("maxpage", $_GET["maxpage"]);
		$currtpl->assign("topics", $topics);
		$currtpl->display("admin/topiclist.htm");
	}
}
else
	_redirect();
?>
