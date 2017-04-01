<?
require_once("../../mainfile.php");

if ($curruser->isguest())
	_redirect();

$_GET["gno"] = intval($_GET["gno"]);

if (isset($_GET["del"]))
{
    foreach($_POST["chk"] as $v){
        if($v == $curruser->g_handler->getGroupByEngName($curruser->department)) echo "不能刪除自己的系所<br/>";
		else if($v == $curruser->g_handler->getGroupByEngName('ncuuser'))echo '不能刪除此預設行事曆喔～';
        else if($curruser->g_handler->isLastAdmin($v))
        {
             echo $curruser->g_handler->getGroupByNo($v)."沒有刪除，因為你是最後一個管理者<br/>";
        }
        else
        {
             $curruser->g_handler->memberDelete($v,$curruser->uno);
             echo "已經成功的刪除".$curruser->g_handler->getGroupByNo($v)."<br/>";
        }
    }
}


if (!$currmodule->isadmin($curruser) && !$curruser->g_handler->isGroupAdmin($_GET['gno'],$curruser->uno))
        _redirect();

//if(!in_array($_GET["gno"],groupGet(3)))
//	_redirect();

if (isset($_GET["memberAdd"]))
{
	if (isset($_POST["uid"]) && isset($_GET['gno']))
	{
		$curruser->g_handler->memberAdd($_GET["gno"], $curruser->u_handler->getuserbyid($_POST["uid"])->uno, 1);
		_redirect();
	}
}
else if (isset($_GET["change"]))
{
	$_POST["all_num"] = intval($_POST["all_num"]);
	$criteria1 = new CriteriaCompo();
	$criteria2 = new CriteriaCompo();
	$criteria3 = new CriteriaCompo();
	
	for ($i = 0;$i < $_POST["all_num"];$i++)
	{
		if ($_POST["change".$i] == true)
		{
			if ($_POST["level".$i] == 1)
				$criteria1->add(new Criteria("uno", $_POST["uno".$i]), "OR");
			else if($_POST["level".$i] == 2)
				$criteria2->add(new Criteria("uno", $_POST["uno".$i]), "OR");
			else if($_POST["level".$i] == 3)
				$criteria3->add(new Criteria("uno", $_POST["uno".$i]), "OR");
		}
	}

	if ($criteria1->render() != NULL)
		$currdb->query("UPDATE `".$currdb->prefix("gmember")."` SET level=1 WHERE ".$criteria1->render()." AND gno='".$_GET["gno"]."'");
	if ($criteria2->render() != NULL)
		$currdb->query("UPDATE `".$currdb->prefix("gmember")."` SET level=2 WHERE ".$criteria2->render()." AND gno='".$_GET["gno"]."'");
	if ($criteria3->render() != NULL)
		$currdb->query("UPDATE `".$currdb->prefix("gmember")."` SET level=3 WHERE ".$criteria3->render()." AND gno='".$_GET["gno"]."'");
	
	_redirect();
}
?>
