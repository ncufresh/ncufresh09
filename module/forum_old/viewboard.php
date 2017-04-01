<?
require_once("./module.php");
require_once("../../mainfile.php");

$forumboard = new ForumObject("board", $_GET["no"]);

$forumgroup = new ForumObject('group', $forumboard->group_no);
while($forumgroup->parents != 0)
	$forumgroup = new ForumObject('group', $forumgroup->parents);

$forumboard->group_no = $forumgroup->group_no;

gno_currsite($forumboard->group_no);
$currsite[] = array('name'=>$forumboard->title, 'url'=>'viewboard.php?no='.$_GET['no']);

$currtpl->assign_by_ref("forumboard", $forumboard);

if (!$forumboard->board_no)
        dies("No such board.");

$currtpl->addhdr("<link rel=\"alternate\" type=\"application/xml\" title=\"RSS\" href=\""."boardfeed.php?no=".$forumboard->board_no."\" />");

$bm = bm($forumboard);
$currtpl->assign_by_ref("bm", $bm);

$criteria = new CriteriaCompo(new Criteria("board_no", $forumboard->board_no));

$page = ($_GET["page"] > 0) ? $_GET["page"] : 1;

$pagesize = 10;

$result = $currdb->query("
	SELECT SQL_CALC_FOUND_ROWS 
		t.*, 
		u.name as poster_name,
		r.topic_no as red
	FROM `".$currdb->prefix("forum_topic")."` t 
	LEFT JOIN `".$currdb->prefix("user")."` u ON t.poster_no=u.uno 
	LEFT JOIN `".$currdb->prefix("forum_redpoint")."` r ON r.uno='".$curruser->uno."' AND t.topic_no=r.topic_no
	WHERE ".$criteria->render()." and t.type ^ '".TOPIC_TYPE_TOP."' 
	ORDER BY t.topic_no DESC LIMIT ".(($page - 1) * $pagesize).", ".$pagesize
);

$result2 = $currdb->query("SELECT FOUND_ROWS()");

$maxpage = $currdb->fetch_array($result2);
$fix_no = $maxpage[0];
$maxpage = ceil($maxpage[0] / $pagesize);

$page = ($page > $maxpage) ? $maxpage : $page;

$plink = _multipage($page, $maxpage, $currconfig->phpself."?no=".$forumboard->board_no, 10);

$i = 0;

if ($page <= 1)
{
	$result2 = $currdb->query("
		SELECT 
			t.*, 
			u.name as poster_name,
			r.uno as red
		FROM `".$currdb->prefix("forum_topic")."` t 
		LEFT JOIN `".$currdb->prefix("user")."` u ON t.poster_no=u.uno 
		LEFT JOIN `".$currdb->prefix("forum_redpoint")."` r ON r.uno='".$curruser->uno."' AND t.topic_no=r.topic_no
		WHERE ".$criteria->render()." and t.type & '".TOPIC_TYPE_TOP."' 
		ORDER BY t.topic_no DESC
	");

	for (;$tmp = $currdb->fetch_array($result2);$i++)
	{
		$tmp['fix_no'] = '*';
		$forumtopic[$i] = new Object();
		$forumtopic[$i]->setvars($tmp);
	}
}

$fix_no -= $pagesize * ($page - 1);
for (;$tmp = $currdb->fetch_array($result);$i++)
{
	$tmp['fix_no'] = $fix_no--;
	$forumtopic[$i] = new Object();
	$forumtopic[$i]->setvars($tmp);
}

for ($j = 0;$j < $i;$j++)
{
	$forumtopic[$j]->title = forum_substr($forumtopic[$j]->title, 20);
	$forumtopic[$j]->title = title_type($forumtopic[$j]->title, $forumtopic[$j]->type);
	$forumtopic[$j]->content = _substr($forumtopic[$j]->content, 0, 60);
	$forumtopic[$j]->content = str_replace("\n", "<br />", htmlencode($forumtopic[$j]->content));
	$forumtopic[$j]->poster_name = forum_substr($forumtopic[$j]->poster_name, 13);
	$forumtopic[$j]->posttime = date("Y-m-d H:i:s", $forumtopic[$j]->posttime);
	$forumtopic[$j]->lasttime = date("Y-m-d H:i:s", $forumtopic[$j]->lasttime);
}

$currtpl->assign_by_ref("forumboard", $forumboard);
$currtpl->assign_by_ref("forumtopic", $forumtopic);
$currtpl->assign_by_ref("plink", $plink);

//$currtpl->display("userlink.htm");
$currtpl->display("viewboard.htm");
?>
