<?
require_once("../../mainfile.php");

if (!empty($_REQUEST["gno"]))
{
	$gno = intval($_REQUEST["gno"]);

	$criteria = new CriteriaCompo(new Criteria("gno", $gno));

	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("group")."` WHERE ".$criteria->render());

	if ($currdb->num_rows($result) == 1)
		$group = $currdb->fetch_array($result);
}

if (!empty($group))
{
	if (!$curruser->isguest() && !empty($_GET["apply"]))
	{
		if($curruser->g_handler->memberAdd($_GET["gno"], $curruser->uno,1))
		{
			$currtpl->assign("msg", "已成功加入 ".$group["name"]);
		}
		else
		{
			$currtpl->assign("msg","不能加入喔，你已經加過了 或 此為隱藏 group");
		}
		$currtpl->display("sysmsg.htm");
	}
	else
	{
		if (!$curruser->isguest())
		{

			if ($currmodule->isadmin($curruser))
				$manager = 1;
			else
			{
				$result = $currdb->query("SELECT * FROM `".$currdb->prefix("gmember")."` WHERE gno='".$group["gno"]."' AND uno='".$curruser->uno."' AND level > 0");
				if ($currdb->num_rows($result) == 1)
				{
					$joined = 1;

					$gm = $currdb->fetch_array($result);
					if ($gm["level"] == 3)
						$manager = 1;
				}
			}
		}

		$joined = ($joined == 1) ? 1 : 0;
		$manager = ($manager == 1) ? 1 : 0;

		$currtpl->assign("joined", $joined);
		$currtpl->assign("manager", $manager);
		$currtpl->assign("group", $group);

		$currtpl->display("groupShow.htm");
	}
}
else
{
	$pagesize = 10;

	$_GET['page'] = (intval($_GET['page']) > 1) ? intval($_GET['page']) : 1;

	$dataFirst = ($_GET['page'] - 1) * $pagesize;

	$searchkey = trim($_REQUEST['searchkey']);

	$groupTotal = array();

	if ($currmodule->isadmin($curruser))
		$criteria = new CriteriaCompo(new Criteria("gno", "0", ">"));
	else
		$criteria = new CriteriaCompo(new Criteria("public", "1"));

	if (empty($searchkey))
	{
		$group = $currdb->query("SELECT SQL_CALC_FOUND_ROWS gno, name, introduce FROM `".$currdb->prefix("group")."` WHERE ".$criteria->render()." ORDER BY `name` ASC LIMIT ".$dataFirst.", ".$pagesize);

		if ($currdb->num_rows($group) > 0)
		{
			for ($m = 0;$groupFlag = $currdb->fetch_array($group);$m++)
				array_push($groupTotal, $groupFlag);
		}
	}
	else
	{
		$criteria->add(new Criteria("name", "%".$searchkey."%", "LIKE"));

		$group = $currdb->query("SELECT SQL_CALC_FOUND_ROWS gno, name, introduce FROM `".$currdb->prefix("group")."` WHERE ".$criteria->render()." ORDER BY `name` ASC LIMIT ".$dataFirst.", ".$pagesize);
		
		if ($currdb->num_rows($group) > 0)
		{
			for($m = 0;$groupFlag = $currdb->fetch_array($group);$m++)
				array_push($groupTotal, $groupFlag);
		}
	}

	$maxpage = $currdb->query("SELECT FOUND_ROWS()");

	$maxpage = $currdb->fetch_array($maxpage);

	$maxpage = ($maxpage[0] % $pagesize == 0) ? intval($maxpage[0] / $pagesize) : intval($maxpage[0] / $pagesize + 1);

	$_GET['page'] = ($_GET['page'] > $maxpage) ? $maxpage : $_GET['page'];

	$plink = _multipage($_GET['page'], $maxpage, $currconfig->phpself."?searchkey=".$searchkey);

	$currtpl->assign("searchkey", htmlencode($searchkey));
	$currtpl->assign("plink", $plink);
	$currtpl->assign("groupTotal", $groupTotal);
	$currtpl->display("groupList.htm");
}
?>
