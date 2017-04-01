<?
require_once("../../../mainfile.php");

if ($currmodule->isadmin($curruser))
{
	$action_msg = "";
	$setedit = 0;

	$_POST["goal"] = intval($_POST["goal"]);
	$_POST["category"] = intval($_POST["category"]);

	if ($_POST['act'] == "add" && trim($_POST["name"]))
	{
		$_POST["name"] = trim($_POST["name"]);


		$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE cno='".$_POST["goal"]."'");

		if ($currdb->num_rows($result) != 1)
			$_POST["goal"] = 0;

		$criteria = new CriteriaCompo(new Criteria("parent", $_POST["goal"]));
		$criteria->add(new Criteria("name", $_POST["name"]));

		$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE ".$criteria->render());

		if ($currdb->num_rows($result) == 0)
		{
			$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='".$_POST["goal"]."'");
			$num = $currdb->num_rows($result) + 1;

			$_POST["manager"] = explode("/", $_POST["manager"]);
			$manager = array();

			for ($i = 0;$_POST["manager"][$i];$i++)
			{
				$user = $curruser->u_handler->getuserbyid($_POST["manager"][$i]);

				if ($user->uno > 0 && !in_array($user->uid, $manager))
					$manager[] = $user->uid;
			}

			$manager = implode("/", $manager);

			$criteria = new CriteriaCompo(new Criteria("cno", ""));
			$criteria->add(new Criteria("name", $_POST["name"]));
			$criteria->add(new Criteria("parent", $_POST["goal"]));
			$criteria->add(new Criteria("manager", $manager));
			$criteria->add(new Criteria("ord", $num));

			$currdb->query("INSERT INTO `".$currdb->prefix("wiki_category")."` ".$criteria->insertsql());

			$action_msg = ($currdb->insert_id() > 0) ? "新增成功" : "新增失敗";
		}
		else
			$action_msg = "目標類別下已有相同名稱之分類";
	}
	else if ($_POST["act"] == "move" && !empty($_POST["category"]))
	{
		$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE cno='".$_POST["category"]."'");

		if ($currdb->num_rows($result) == 1)
		{
			$target = $currdb->fetch_array($result);

			if ($_POST["action"] == 1)
			{
				$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE name='".$target["name"]."' and parent='0'");

				if ($currdb->num_rows($result) == 0)
				{
					$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE ord>".$target["ord"]." and parent='".$target["parent"]."'");

					for ($m = 0;$b=$currdb->fetch_array($result);$m++)
					{
						$b["ord"]--;
						$currdb->query("UPDATE `".$currdb->prefix("wiki_category")."` SET ord='".$b["ord"]."' WHERE cno='".$b["cno"]."'");
					}

					$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='0'");
					$num = $currdb->num_rows($result) + 1;
					$currdb->query("UPDATE `".$currdb->prefix("wiki_category")."` SET parent='0', ord='".$num."' WHERE cno='".$target["cno"]."'");
				}
				else
					$action_msg = "目標類別下已有相同名稱之分類";
			}
			else if ($_POST["action"] == 2)
			{
				$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='".$taret["cno"]."'");
				if ($currdb->num_rows($result) == 0)
				{
					$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='".$_POST["goal"]."' and name='".$target['name']."'");

					if ($currdb->num_rows($result) == 0)
					{
						$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='".$_POST["goal"]."'");
						$num = $currdb->num_rows($result) + 1;

						$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE ord>".$target["ord"]." and parent='".$target["parent"]."'");
						for ($m = 0;$a = $currdb->fetch_array($result);$m++)
						{
							$a["ord"]--;
							$currdb->query("UPDATE `" .$currdb->prefix("wiki_category")."` set ord='".$a["ord"]."' WHERE cno='".$a["cno"]."'");
						}

						$currdb->query("UPDATE `".$currdb->prefix("wiki_category")."` SET parent='".$_POST["goal"]."', ord='".$num."' WHERE cno='".$target["cno"]."'");
					}
					else
						$action_msg = "目標類別下已有相同名稱之分類";
				}
				else
					$action_msg = "此目錄下尚有其餘分類";
			}
			else if ($_POST["action"] == 3)
			{
				if ($target["ord"] > 1)
				{
					$currdb->query("UPDATE `".$currdb->prefix("wiki_category")."` SET ord='".$target["ord"]."' WHERE parent='".$target["parent"]."' and ord='".($target["ord"] - 1)."'");
					$currdb->query("UPDATE `".$currdb->prefix("wiki_category")."` SET ord='".($target["ord"] - 1)."' WHERE cno='".$target["cno"]."'");
				}
				else
					$action_msg = "此分類已為第一個分類";
			}
			else if ($_POST["action"] == 4)
			{
				$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='".$target["parent"]."'");

				if ($target["ord"] < $currdb->num_rows($result))
				{
					$currdb->query("UPDATE `".$currdb->prefix("wiki_category")."` SET ord='".$target["ord"]."' WHERE parent='".$target["parent"]."' and ord='".($target["ord"] + 1)."'");
					$currdb->query("UPDATE `".$currdb->prefix("wiki_category")."` SET ord='".($target["ord"] + 1)."' WHERE cno='".$target["cno"]."'");
				}
				else
					$action_msg = "此分類已為最後一個分類";
			}
			else if ($_POST["action"] == 5)
			{
				$setedit = 1;

				$currtpl->assign("target", $target);
			}
			else if ($_POST["action"] == 6)
			{
				$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='".$target["cno"]."'");
				$result2 = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_topic")."` WHERE cno='".$target["cno"]."'");

				if ($currdb->num_rows($result) == 0 && $currdb->num_rows($result2) == 0)
				{
					$currdb->query("DELETE FROM `".$currdb->prefix("wiki_category")."` WHERE cno='".$target["cno"]."'");

					$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='".$target["parent"]."' and ord>".$target["ord"]);

					while ($tmp = $currdb->fetch_array($result))
						$currdb->query("UPDATE `".$currdb->prefix("wiki_category")."` SET ord='".($tmp["ord"] - 1)."' WHERE cno='".$tmp["cno"]."'");
				}
				else
					$action_msg = "此類別下有子類別或尚有資料,無法刪除！";
			}
		}
	}
	else if ($_POST["act"] == "edit" && !empty($_POST["category"]))
	{		
		$_POST["manager"] = explode("/", $_POST["manager"]);
		$manager = array();

		for ($i = 0;$_POST["manager"][$i];$i++)
		{
			$user = $curruser->u_handler->getuserbyid($_POST["manager"][$i]);

			if ($user->uno > 0 && !in_array($user->uid, $manager))
				$manager[] = $user->uid;
		}

		$manager = implode("/", $manager);

		$criteria = new CriteriaCompo(new Criteria("name", $_POST["name"]));
		$criteria->add(new Criteria("manager", $manager));

		$currdb->query("UPDATE `".$currdb->prefix("wiki_category")."` ".$criteria->updatesql()." WHERE cno='".$_POST["category"]."'");

		$action_msg = "修改完成";
	}

	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` WHERE parent='0' ORDER BY ord");

	for ($m = 0;$tmp = $currdb->fetch_array($result);$m++)
	{
		$result2 = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_category")."` where parent='".$tmp["cno"]."' ORDER BY ord");

		for ($n = 0;$tmp2 = $currdb->fetch_array($result2);$n++)
			$tmp["child"][$n] = $tmp2;

		$cats[$m] = $tmp;
	}

	$currtpl->assign("action_msg", $action_msg);
	$currtpl->assign("setedit", $setedit);
	$currtpl->assign("cats", $cats);

	$currtpl->display("admin/category_manage.htm");
}
else
	_redirect();
?>
