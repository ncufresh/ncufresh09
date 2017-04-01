<?
require_once('../mainfile.php');

if ($curruser->haveperm($curruser->p_handler->getpermadmin()))
{
	$module_handler =& gethandler("module");

	if ($_GET['do_module'] == "active" && isset($_GET["value"]))
	{
		$module = $module_handler->getmodulebyname($_GET["name"]);

		if ($module->mno > 0)
			$module_handler->setactive($module->mno, $_GET["value"]);

		_redirect($currconfig->phpself);
	}
	else
	{
		$module_list = array();

		$dir = opendir(ROOT_PATH."/module/");

		while ($file = readdir($dir))
		{
			if ($file[0] == ".")
				continue;

			if (is_dir(ROOT_PATH."/module/".$file))
			{
				$module = $module_handler->getmodulebyname($file);

				$tmp["name"] = urlencode($file);
				$tmp["installed"] = ($module->mno > 0) ? 1 : 0;
				$tmp["active"] = ($module->active == 1) ? 1 : 0;

				$module_list[] = $tmp;
			}
		}

		$currtpl->assign("module_list", $module_list);
		$currtpl->display("admin/module_manage.htm");
	}
}
else
	_redirect();
?>
