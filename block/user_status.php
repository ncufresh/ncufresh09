<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

function user_status($dirname = null)
{
	if (!$GLOBALS["curruser"]->isguest())
	{
		$block["uid"] = $GLOBALS["curruser"]->uid;
		$block["name"] = _substrfix($GLOBALS["curruser"]->name, 13);
		$block["picture"] = $GLOBALS["curruser"]->picture;
	
		$unread = 2;
		$msg_num = $GLOBALS["currdb"]->num_rows($GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("msg")."` where owner_no='".$GLOBALS["curruser"]->uno."' and status='".$unread."'"));
		$status = ($msg_num > 0) ? '<a href="'.URL.'/msgbox.php" title="訊息信箱">您有 '.$msg_num.' 封新訊息</a>' : '您沒有新訊息';
		$block["unreadmail"] = $status;

		return $block;
	}
}

function user_login($dirname = null)
{
	if ($GLOBALS["curruser"]->isguest())
	{
		return array();
	}
}
?>
