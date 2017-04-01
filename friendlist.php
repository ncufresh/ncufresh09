<?
require_once("./mainfile.php");

if (!$curruser->isguest())
{
	function cmp($a, $b)
	{
		return (strcmp($a->uid, $b->uid) > 0) ? 1 : -1;
	}


	$friend_handler =& gethandler("friend");

	$friend = $friend_handler->getallfriends();

	if (is_array($friend))
		usort($friend, "cmp");

	$currtpl->assign("friend_handler", $friend_handler);
	$currtpl->assign("friend", $friend);

	$currtpl->display("friendlist.htm");
}
else
	_redirect();
?>
