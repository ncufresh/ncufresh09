<?
require_once("../mainfile.php");

if (isset($_POST["user_login"]))
{
	$curruser = $curruser->u_handler->loginuser($_POST["id"], _encrypt($_POST["pwd"]));
	
	if (!$curruser->isguest())
	{
		$_SESSION["user_uid"] = $curruser->uid;

		_redirect();
	}
	else
	{
		$currtpl->assign("msg", "帳號/密碼錯誤");
		$currtpl->display("login.htm");
	}
}
else if (isset($_GET["user_logout"]))
{
	if (!$curruser->isguest())
		$curruser->u_handler->logoutuser($curruser->uid);

	$_SESSION["user_uid"] = "";

	//session_destroy();

	_redirect($currconfig->url.'/index.php');
}
else if (isset($_GET["chk_uid"]))
{
	$currtpl->setndisplay();

	$user = new User();
	$user = $user->u_handler->getuserbyid($_GET["uid"]);
	if ($user->uno > 0)
		echo "exists";
}
else if (isset($_GET['login_form']))
{
	$currtpl->assign("msg","請先登入再使用此功能");
	$currtpl->display("login.htm");
}
else if ($_SESSION["ref"] == URL."/include/user.php")
	_redirect(URL);
else
	_redirect();
?>
