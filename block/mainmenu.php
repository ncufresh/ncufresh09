<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

function main_menu($dirname = null)
{
	$result = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("module")."` WHERE active='1' and showlink='".$GLOBALS["currmodule"]->m_handler->showlink."'");

	for ($i = 0;$tmp = $GLOBALS["currdb"]->fetch_array($result);$i++)
	{
		if (!file_exists(ROOT_PATH."/module/".$tmp["name"]))
		{
			$i--;
			continue;
		}

		$block["menu"][$i]["desc"] = $tmp["title"];
		$block["menu"][$i]["icon"] = $GLOBALS["currconfig"]->url."/module/".$tmp["name"]."/templates/images/".$tmp["icon"];
		$block["menu"][$i]["link"] = URL."/module/".$tmp["name"];
	}

	return $block;
}
?>
