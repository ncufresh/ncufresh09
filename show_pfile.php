<?
require_once("./mainfile.php");

require_once(ROOT_PATH."/dep.php");

if (isset($_GET["uno"]))
{
	$user = $curruser->u_handler->getuserbyno($_GET["uno"]);

	if ($user->uno > 0)
	{
		$user->department = $dep[$user->department];

		if($user->website)
			$user->website = "http://".$user->website;

		$currtpl->assign("user", $user);

		$currtpl->display("show_pfile.htm");
	}
	else
		echo "找不到使用者";
}
else
	echo "找不到使用者";
?>
