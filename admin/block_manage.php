<?
require_once('../mainfile.php');

if ($curruser->haveperm($curruser->p_handler->getpermadmin()))
{
	$module_handler =& gethandler("module");

	if (!empty($_POST["block_manage"]))
	{
		if (is_array($_POST["side"]) && is_array($_POST["ord"]))
		{ 
			foreach ($_POST["ord"] as $key => $value)	
			{
				while ($value <= 0 || !empty($side[$_POST["side"][$key]][$value]))
					$value++;

				$side[$_POST["side"][$key]][$value] = $key;
			}

			foreach ($side as $key => $value)
			{
				for ($i = 1, $j = 2;$i <= count($value);$i++)
				{
					if (empty($value[$i]))
					{
						$j = ($j >= ($i + 1)) ? $j : ($i + 1);

						while (empty($value[$j]))
							$j++;

						$value[$i] = $value[$j];

						unset($value[$j]);
					}

					$result = $currdb->query("UPDATE `".$currdb->prefix("block")."` SET side='".$key."', ord='".$i."' WHERE bno='".$value[$i]."'"); 
				}
			}
		}
	}

	$result = $currdb->query("SELECT b.*, m.name as module_name, m.title as module_title FROM `".$currdb->prefix("block")."` b LEFT JOIN `".$currdb->prefix("module")."` m ON b.mno = m.mno ORDER BY b.bno ASC");

	while ($tmp = $currdb->fetch_array($result))
	{
		if ($tmp["module_name"] != "system" && !file_exists(ROOT_PATH."/module/".$tmp["module_name"]."/block/".$tmp["file"].".php"))
		{
			continue;
		}
		else if ($tmp["module_name"] == "system" && !file_exists(ROOT_PATH."/block/".$tmp["file"].".php"))
		{
			continue;
		}

		$block_list[] = $tmp;
	}

	$currtpl->assign("block_list", $block_list);
	$currtpl->display("admin/block_manage.htm");
}
else
	_redirect();
?>
