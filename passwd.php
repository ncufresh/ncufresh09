<?
require_once("./mainfile.php");

if (!$curruser->isguest())
{
	if (isset($_POST["o_pwd"]) && isset($_POST["n_pwd"]) && isset($_POST["i_pwd"]))
	{
		$currtpl->setndisplay();

		if ($curruser->pwd != _encrypt($_POST["o_pwd"]))
			echo "密碼錯誤";
		else if (strlen($_POST["n_pwd"]) < 6)
			echo "密碼長度需大於 6 個字元";
		else if ($_POST["n_pwd"] != $_POST["i_pwd"])
			echo "密碼不相符";
		else
		{
			$criteria = new CriteriaCompo(new Criteria("pwd", _encrypt($_POST["n_pwd"])));

			$curruser->u_handler->modifyuser($curruser->uno, $criteria);

			echo "密碼更改成功";
		}
	}
	else
		$currtpl->display("passwd.htm");
}
else
	_redirect();
?>
