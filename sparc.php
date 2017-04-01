<?
require_once("./mainfile.php");
function do_valid($sid, $spwd)
{
	if (!empty($sid) && !empty($spwd))
	{
		$sid = trim($sid);
		$spwd = trim($spwd);

		if(preg_file(ROOT_PATH.'/etc/badsno', $sid))
		{
			return 0;
		}
		require_once(ROOT_PATH."/include/pop3.class.php");
		require_once(ROOT_PATH."/include/WebService.class.php");

		$ws = new WebService();

		/*if (!strcasecmp("98", substr($sid, 0, 2)))
		{
			$criteria = new CriteriaCompo(new Criteria("sid", $sid));
			$criteria->add(new Criteria("spwd", md5($spwd)));

			$result = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("freshman")."` WHERE ".$criteria->render());

			return ($GLOBALS["currdb"]->num_rows($result) == 1) ? 1 : 0;
		}
		else*/
		return ($ws->isPasswordValid($sid, $spwd)) ? 1 : 0;
	}
}

if (!$curruser->haveperm($curruser->p_handler->getpermvalid()) && !$curruser->haveperm($curruser->p_handler->getpermdeny()))
{
	if (!empty($_POST["sid"]) && !empty($_POST["spwd"]))
	{
		if (do_valid($_POST["sid"], $_POST["spwd"]))
		{
			$criteria = new CriteriaCompo(new Criteria("sid", $_POST["sid"]));
			$curruser->u_handler->modifyuser($curruser->uno, $criteria);

			$curruser->u_handler->activeuser($curruser->uno);

			echo "計中 e-mail 確認成功";
		}
		else
			echo "計中 e-mail 確認失敗";
	}
	else
		$currtpl->display("sparc.htm");
}
else
	_redirect();
?>
