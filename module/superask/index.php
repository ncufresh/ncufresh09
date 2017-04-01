<?
require_once("../../mainfile.php");

$title = explode("?", $_SERVER["REQUEST_URI"]);

if (!empty($title[1]))
{
	$title[1] = urldecode($title[1]);

	$_WikiTopic = new WikiTopic();

	$_WikiTopic->getbytitle($title[1]);

	if ($_WikiTopic->tno <= 0)
	{
		$title[1] = iconv("BIG-5", "UTF-8", $title[1]);

		$_WikiTopic->getbytitle($title[1]);
	}

	_redirect(URL."/module/".$currmodule->name."/view.php?title=".urlencode($title[1]));
}

$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='8' ORDER BY ord");
while($tmp = $currdb->fetch_array($result)){
    $result2 = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_topic")."` WHERE cno='".$tmp["cno"]."'");
    while($tmp2 = $currdb->fetch_array($result2))
      $tmp["child"][] = $tmp2;

    $cate[] = $tmp;
}
$currtpl->assign("club","0");
$currtpl->assign("cate",$cate);
$currtpl->display("department.htm");
?>
