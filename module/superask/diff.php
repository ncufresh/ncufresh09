<?
require_once("../../mainfile.php");

$_WikiPost = new WikiPost($_GET["pno"]);

if ($_WikiPost->pno > 0)
{
	$_WikiTopic = new WikiTopic();

	$_WikiTopic->getbyno($_WikiPost->tno);

	$tdf = new TableDiffFormatter();

	$tdf =  $tdf->format(new Diff(explode("\n", htmlencode($_WikiPost->content)), explode("\n", htmlencode($_WikiTopic->currpost->content))));

	$currtpl->assign("_WikiTopic", $_WikiTopic);
	$currtpl->assign("_WikiPost", $_WikiPost);
	$currtpl->assign("tdf", $tdf);
	$currtpl->display("diff.htm");
}
else
	_redirect();
?>
