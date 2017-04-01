<?
require_once("./mainfile.php");

if (!$curruser->isguest())
{
	$currtpl->addjs(ROOT_PATH."/include/js/dragdrop.js");

	$block_handler =& gethandler("block");

	$result = $currdb->query("SELECT bno FROM `".$currdb->prefix("block")."` WHERE subscribe != '0' ORDER BY bno ASC");

	while ($tmp = $currdb->fetch_array($result))
	{
		$block = $block_handler->getblockbyno($tmp["bno"]);

		if ($block->bno > 0)
			$uf_blocks[] = $block;
	}

	$subscribe = unserialize($curruser->subscribe);

	for ($i = 0;$i < count($subscribe);$i++)
	{
		for ($j = 0;$j < count($subscribe[$i]);$j++)
		{
			$block = $block_handler->getblockbyno($subscribe[$i][$j]);

			if ($block->bno <= 0)
				continue;

			$user_blocks[$i][$j]["bno"] = $block->bno;

			$user_blocks[$i][$j]["content"] = $block->fetch();
		}
	}

	$currtpl->assign("uf_blocks", $uf_blocks);
	$currtpl->assign("user_blocks", $user_blocks);

	$currtpl->display("portal.htm");
}
else
	_redirect();
?>
