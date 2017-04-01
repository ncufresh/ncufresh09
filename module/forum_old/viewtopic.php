<?
require_once("./module.php");
require_once("../../mainfile.php");

$criteria = new CriteriaCompo(new Criteria("topic_no", $_GET["no"]));

$result = $currdb->query("SELECT u.* , t.*, u.name as poster_name FROM `".$currdb->prefix("forum_topic")."` t LEFT JOIN `".$currdb->prefix("user")."` u ON t.poster_no=u.uno WHERE ".$criteria->render());

if ($currdb->num_rows($result) <= 0)
	dies("No such topic.");

$forumtopic = new Object();
$forumtopic->setvars($currdb->fetch_array($result));

if($forumtopic->die == 1) die('No such topic.');

$forumboard = new ForumObject("board", $forumtopic->board_no);

gno_currsite($forumboard->group_no);
$currsite[] = array('name'=>$forumboard->title, 'url'=>'viewboard.php?no='.$forumboard->board_no);
//$currsite[] = array('name'=>$forumtopic->title, 'url'=>'viewtopic.php?no='.$_GET['no']);

// redpoint !!
if(!$curruser->isguest())
{
	$currdb->query("INSERT `".$currdb->prefix("forum_redpoint")."`".
		"(`uno`, `topic_no`) VALUES('".$curruser->uno."', '".$forumtopic->topic_no."')");
}

$currtpl->addhdr("<link rel=\"alternate\" type=\"application/xml\" title=\"RSS\" href=\""."topicfeed.php?no=".$forumtopic->topic_no."\" />");

$forumtopic->dep = $dep[$forumtopic->department];
$forumtopic->title = htmlencode(_substr($forumtopic->title, 0, 50));
$forumtopic->uid = forum_substr($forumtopic->uid, 13);
$forumtopic->content = forum_code(str_replace("\n", "<br />", htmlencode($forumtopic->content)));
$forumtopic->poster_name = forum_substr( $forumtopic->poster_name, 13);
$forumtopic->posttime = date("Y-m-d H:i:s", $forumtopic->posttime);

$bm = bm($forumboard);
$currtpl->assign_by_ref("bm", $bm);

$criteria = new CriteriaCompo(new Criteria("topic_no", $forumtopic->topic_no));

$currdb->query("UPDATE `".$currdb->prefix("forum_topic")."` SET numread='".($forumtopic->numread + 1)."' WHERE ".$criteria->render());

$page = (intval($_GET["page"]) > 0) ? intval($_GET["page"]) : 1;

$pagesize = 10;

$result = $currdb->query("SELECT SQL_CALC_FOUND_ROWS u.* , r.* , u.name as poster_name FROM `".$currdb->prefix("forum_reply")."` r LEFT JOIN `".$currdb->prefix("user")."` u ON r.poster_no=u.uno WHERE ".$criteria->render()." ORDER BY reply_no ASC LIMIT ".(($page - 1) * $pagesize).", ".$pagesize);

$result2 = $currdb->query("SELECT FOUND_ROWS()");

$maxpage = $currdb->fetch_array($result2);
$maxpage = ceil($maxpage[0] / $pagesize);

$page = ($page > $maxpage) ? $maxpage : $page;

$plink = _multipage($page, $maxpage, $currconfig->phpself."?no=".$forumtopic->topic_no);

$fix_no = ($page-1)*$pagesize;
$pno = array();
for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
{
	$tmp['fix_no'] = ++$fix_no;
	$tmp['dep'] = $dep[$tmp['department']]; 
	$forumreply[$i] = new Object();
	$forumreply[$i]->setvars($tmp);
	$forumreply[$i]->uid = forum_substr( $forumreply[$i]->uid, 13);
	$forumreply[$i]->poster_name = forum_substr( $forumreply[$i]->poster_name, 13);
	$forumreply[$i]->content = forum_code(str_replace("\n", "<br />", htmlencode($forumreply[$i]->content)));
	$forumreply[$i]->posttime = date("Y-m-d H:i:s", $forumreply[$i]->posttime);
	$pno[] = $forumreply[$i]->reply_no;
}
/*
$result = $currdb->query("SELECT DISTINCT p.*, u.name as poster_name FROM `".$currdb->prefix("forum_push")."` p LEFT JOIN `".$currdb->prefix("user")."` u ON p.poster_no=u.uno WHERE p.reply_no IN (".implode(",", $pno).") ORDER BY p.reply_no ASC, push_no ASC");

$push = array();

for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
{
	$p = new Object();
	$p->setvars($tmp);
	$p->content = htmlencode(_substr($p->content, 0, 64));
	$p->posttime = date("Y-m-d H:i:s", $p->posttime);
	$push[$p->reply_no][] = $p;
}
*
for ($i = 0;$i < count($forumreply);$i++)			// modify data from each topic
	$forumreply[$i]->push = $push[$forumreply[$i]->reply_no];
 */
$currtpl->assign_by_ref("forumboard", $forumboard);
$currtpl->assign_by_ref("forumtopic", $forumtopic);
$currtpl->assign_by_ref("forumreply", $forumreply);
//$currtpl->assign_by_ref("forumpush", $forumpush);
$currtpl->assign_by_ref("plink", $plink);

$currtpl->display("viewtopic.htm");
?>

