<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

define("TOPIC_TYPE_ANN", 0x01);
define("TOPIC_TYPE_TOP", 0x02);
define("TOPIC_TYPE_REC", 0x04);

class ForumObject Extends Object
{
	function ForumObject($table, $no)
	{
		$criteria = new CriteriaCompo(new Criteria($table."_no", $no));

		$result = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("forum_".$table)."` WHERE ".$criteria->render());

		if ($GLOBALS["currdb"]->num_rows($result) == 1)
		{
			$this->setvars($GLOBALS["currdb"]->fetch_array($result));
			$this->order = "asc";
		}
	}
}

function title_type($title, $type)
{
	$tc = " ";

	if (intval($type) & intval(TOPIC_TYPE_ANN))
		$tc .= "[公告]";
	if (intval($type) & intval(TOPIC_TYPE_TOP))
		$tc .= "[置頂]";
	if (intval($type) & intval(TOPIC_TYPE_REC))
		$tc .= "[推薦]";

	return $tc." ".$title;
}

function gno_currsite($gno)
{
	global $currsite;
	
	static $dd = array();
	
	if(in_array($gno, $dd)) return;
	
	$dd[] = $gno;

	if($gno == 0) return;
	
	$forumgroup = new ForumObject("group", $gno);
	
	gno_currsite($forumgroup->parents);

	if($forumgroup->parents == 0)
		$currsite[] = array('name' => $forumgroup->title, 'url' => 'showGroup.php?gno='.$forumgroup->group_no);
}

function func_do_subscr($type, $no)
{
	global $currdb, $curruser;

	$forumobject = new ForumObject($type, $no);

	if ($forumobject->{$type."_no"} > 0)
	{
		$result = $currdb->query("SELECT no FROM `".$currdb->prefix("forum_subscribe")."` WHERE user_no='".$curruser->uno."' and type='".$type."' and no='".$forumobject->{$type."_no"}."'");

		if ($currdb->num_rows($result) <= 0)
			$currdb->query("INSERT INTO `".$currdb->prefix("forum_subscribe")."` (user_no, type, no) VALUES ('".$curruser->uno."', '".$type."', '".$forumobject->{$type."_no"}."')");
	}
	else 
		return false;

	return true;
}

function func_do_unsubscr($type, $no)
{
	global $currdb, $curruser;

	$forumobject = new ForumObject($type, $no);

	if ($forumobject->{$type."_no"} > 0)
		$currdb->query("DELETE FROM `".$currdb->prefix("forum_subscribe")."` WHERE user_no='".$curruser->uno."' and type='".$type."' and no='".$forumobject->{$type."_no"}."'");
	else
		return false;

	return true;
}

function bm($forumboard)
{
	global $curruser, $currmodule;
/*
	return (
			!$curruser->isguest() 
			&& (in_array($curruser->uid, explode("/", $forumboard->admin)) 
			|| $currmodule->isadmin($curruser))
			) ? 1 : 0;
 */
	

	return (
			!$curruser->isguest() 
			&& ($curruser->g_handler->isGroupAdmin($forumboard->admin, $curruser->uno) 
			|| $currmodule->isadmin($curruser))
			) ? 1 : 0;
}

function forum_substr($str, $len)
{
	//return _substr($str, 0, $len) . (mb_strwidth($str) > $len ? '...' : '');
	return htmlencode(mb_strimwidth($str, 0, $len, '...', 'utf-8'));
}

function forum_code($str)
{
	$str = preg_replace('/(http:\/\/[^ <>]*)/i', "<a href=\"\\0\">\\0</a>", $str);
	return $str;
}

require_once ROOT_PATH.'/dep.php';

if(strpos($_SERVER['SCRIPT_NAME'], 'viewboard')!==false)
{
	if($_SESSION['forum']['no'] == $_GET['no'] && empty($_GET['page']))
		$_GET['page'] = $_SESSION['forum']['page'];

	$_SESSION['forum']['no'] = $_GET['no'];
	$_SESSION['forum']['page'] = $_GET['page'];
}

?>
