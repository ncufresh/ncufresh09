<?
require_once("./mainfile.php");

if (!$curruser->isguest())
{
	$currtpl->setndisplay();		// by ajax

	$friend_handler =& gethandler("friend");

	$keep = (isset($_POST["keep"])) ? $_POST["keep"] : $_GET["keep"];

	if (isset($_REQUEST["add_friend"]))
	{
		if (isset($_POST["fno"]))
			$fno = $_POST["fno"];
		else
		{
			$user = $curruser->u_handler->getuserbyid($_POST["fid"]);

			$fno = $user->uno;
		}

		$friend_handler->addfriend($fno, $friend_handler->goodfriend);
	}
	else if (isset($_GET["del_friend"]))
		$friend_handler->delfriend($_GET["fno"]);
	else if (isset($_GET["turn_friendship"]))
		$friend_handler->turnfriendship($_GET["fno"]);

	if (empty($keep))
		_redirect();
}
else
	_redirect();
?>
