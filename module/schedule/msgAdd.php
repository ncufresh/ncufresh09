<?
require_once("../../mainfile.php");
	
if(!$curruser->isguest())
{
	if(empty($_POST['type']))
	{
		$currtpl->assign("wno",$_GET['ano']);

		$currtpl->display("msgAdd.htm");
	}
	else
	{
		$criteria = new CriteriaCompo(new Criteria("mno", intval($mno)));
		$criteria->add(new Criteria("wno", intval($_POST['wno'])));
		$criteria->add(new Criteria("poster_no", $curruser->uno));
		$criteria->add(new Criteria("content", htmlencode($_POST['content'])));
		$criteria->add(new Criteria("posttime", time()));
		
		$currdb->query("INSERT INTO `".$currdb->prefix("schedule_msg")."` ".$criteria->insertsql());
	}
}
else
	_redirect();
?>
