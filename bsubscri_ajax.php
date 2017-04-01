<?
require_once("./mainfile.php");

if (!$curruser->isguest())
{
	$currtpl->setndisplay();

	if (isset($_POST["bno"]) || isset($_POST["chg"]))
	{
		if (!isset($_POST["chg"]))
			$subscribe = unserialize($curruser->subscribe);
		else
		{
			$subscribe[0] = $_POST["DropZone0"];
			$subscribe[1] = $_POST["DropZone1"];

			$_POST["bno"] = ($subscribe[0][0] > 0) ? $subscribe[0][0] : $subscribe[1][0];
			$_POST["add"] = 1;
		}

		$subscribe[0] = array_unique($subscribe[0]);
		$subscribe[1] = array_unique($subscribe[1]);

		$block_handler =& gethandler("block");

		$block = $block_handler->getblockbyno($_POST["bno"]);

		if ($block->bno > 0 && $block->subscribe > 0)
		{
			$exists = 0;

			$chk = 0;

			for ($i = 0;$i < count($subscribe);$i++)
			{
				for ($j = 0;$j < count($subscribe[$i]);$j++)
				{
					if ($subscribe[$i][$j] == $block->bno)
					{
						$exists = 1;

						$chk = 1 - $i;

						if (!isset($_POST["add"]))
							continue;
					}

					$n_subscribe[$i][] = $subscribe[$i][$j];
				}
			}

			if (isset($_POST["add"]) && !$exists)
				$n_subscribe[$chk][] = $block->bno;

			$criteria = new CriteriaCompo(new Criteria("subscribe", serialize($n_subscribe)));

			$curruser->u_handler->modifyuser($curruser->uno, $criteria);
		}
	}
}
else
	_redirect();
?>
