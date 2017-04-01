<?
require_once("./module.php");
require_once("../../mainfile.php");

$currtpl->assign_by_ref("bm", $bm);

$page = ($_GET["page"] > 0) ? $_GET["page"] : 1;
$pagesize = 10;

$searchs = explode(' ', $_GET['s']);
$searchText = array();
$search = array();
foreach($searchs as $v)
{
	if($v == '' || in_array($v, $searchText)) continue;
	$searchText[] = $v;
	$search[] = "`t`.`title` LIKE '%$v%'";
	$search[] = "`t`.`content` LIKE '%$v%'";
}
$currtpl->assign('search', '"'.htmlencode(implode('", "', $searchText)).'"');

$result = $currdb->query("
	SELECT  SQL_CALC_FOUND_ROWS `t`.* , `b`.`title` AS `Btitle`
	FROM `".$currdb->prefix('forum_topic')."` t 
	LEFT JOIN `".$currdb->prefix('forum_board')."` b ON `t`.`board_no`=`b`.`board_no`
	WHERE ".implode(' OR ', $search)." 
	ORDER BY `lasttime` DESC 
	LIMIT ".(($page - 1) * $pagesize).", ".$pagesize
);

$result2 = $currdb->query("SELECT FOUND_ROWS()");

$maxpage = $currdb->fetch_array($result2);
$maxpage = ceil($maxpage[0] / $pagesize);

$page = ($page > $maxpage) ? $maxpage : $page;

$plink = _multipage($page, $maxpage, $currconfig->phpself."?s=".urlencode($_GET['s']));

$i = 0;

for (;$tmp = $currdb->fetch_array($result);$i++)
{
	$forumtopic[$i] = new Object();
	$forumtopic[$i]->setvars($tmp);
}

for ($j = 0;$j < $i;$j++)
{
	$forumtopic[$j]->title = htmlencode(_substr($forumtopic[$j]->title, 0, 50));
	$forumtopic[$j]->title = title_type($forumtopic[$j]->title, $forumtopic[$j]->type);
	$forumtopic[$j]->content = _substr($forumtopic[$j]->content, 0, 60);
	$forumtopic[$j]->content = str_replace("\n", "<br />", htmlencode($forumtopic[$j]->content));
	$forumtopic[$j]->posttime = date("Y-m-d H:i:s", $forumtopic[$j]->posttime);
	$forumtopic[$j]->lasttime = date("Y-m-d H:i:s", $forumtopic[$j]->lasttime);
}

$currtpl->assign_by_ref("forumtopic", $forumtopic);
$currtpl->assign_by_ref("plink", $plink);

$currtpl->display("search.htm");

?>
