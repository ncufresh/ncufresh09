<?
require_once("../../mainfile.php");

$_WikiTopic = new WikiTopic();
$_WikiTopic->getbyno($_GET["tno"]);

if ($_WikiTopic->tno > 0)
{
	$result = $currdb->query("SELECT p.pno, p.poster_no, p.posttime, u.uid as poster_id, u.name as poster_name FROM `".$currdb->prefix("wiki_post")."` p LEFT JOIN `".$currdb->prefix("user")."` u ON p.poster_no=u.uno WHERE p.tno='".$_WikiTopic->tno."' ORDER BY p.pno DESC");

	for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
	{
		$tmp["posttime"] = date("Y-m-d H:i:s", $tmp["posttime"]);
		$posts[$i] = $tmp;
	}

	$currtpl->assign("wikiav", 1);
	$currtpl->assign("_WikiTopic", $_WikiTopic);
	$currtpl->assign("_WikiPost", $_WikiTopic->currpost);
	$currtpl->assign("posts", $posts);
	$currtpl->display("allversion.htm");
}
else
	_redirect();
?>
