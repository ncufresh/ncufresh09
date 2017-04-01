<?
require_once("../../mainfile.php");

$_WikiCat = new WikiCat($_GET["cno"]);

showwhere($_WikiCat->cno);

$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='".$_WikiCat->cno."' ORDER BY ord");

$block_handler =& gethandler("block");
$c_block = $block_handler->getblockbyno(13)->fetch();

if ($currdb->num_rows($result) > 0)
{
	for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
	{
		$result2 = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_topic")."` WHERE cno='".$tmp["cno"]."'");

		while ($tmp2 = $currdb->fetch_array($result2))
			$tmp["child"][] = $tmp2;

		$category[$i] = $tmp;
	}
}
else
{
	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_topic")."` WHERE cno='".$_WikiCat->cno."'");

	for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
	{
		$topic[$i] = $tmp;
	}
}

$currtpl->assign("_WikiCat", $_WikiCat);
$currtpl->assign("c_block", $c_block);
$currtpl->assign("category", $category);
$currtpl->assign("topic", $topic);
$currtpl->display("showgroup.htm");
?>
