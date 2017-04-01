<?
require_once('../mainfile.php');

if ($curruser->haveperm($curruser->p_handler->getpermadmin()))
{
	if (!empty($_POST['set_config']))
	{
		unset($_POST['set_config']);

		$config_handler =& gethandler("config");

		foreach($_POST as $config => $value)
			$config_handler->updateconfig($config, $value);

		_redirect($currconfig->phpself);
	}
	else
	{
		$currtpl->settpldir();

		$currtpl->display("admin/set_config.htm");
	}	
}
else
	_redirect();
?>
