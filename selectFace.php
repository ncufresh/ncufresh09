<?
require_once('mainfile.php');
require_once('module/elf/include/comm.php');
if(!$curruser->isguest())
{
	if(!isset($_GET['selected']))
	{
		$arr = elf_get_full();
		$ys = array('A','B','C','D','E','F','G','H','I','J','R');

		$gno = $curruser->g_handler->getGroupByEngName('ncufresh');
		if(!$curruser->g_handler->inGroup($gno,$curruser->uno))
		{
			$arr = array_diff($arr, array('R', 'RN'));
		}

		$currtpl->assign("arr",$arr);
		$currtpl->assign("ys",$ys);
		$currtpl->display('selectFace.htm');
	}
	else
	{
		$_POST['piccho'] = htmlencode($_POST['piccho']);

		$arr = elf_get();
        $gno = $curruser->g_handler->getGroupByEngName('ncufresh');
        if(!$curruser->g_handler->inGroup($gno,$curruser->uno))
        {
            $arr = array_diff($arr,array('R'));
        }

		if(!in_array($_POST['piccho'],$arr)) $_POST['piccho'] = "A";
		$criteria = new CriteriaCompo(new Criteria("pic",$_POST['piccho']));
		$currdb->query("UPDATE `".$currdb->prefix("user")."` ".$criteria->updatesql()." WHERE uno='".$curruser->uno."'");
		_redirect('edit_pfile.php');
	}
}
else
	_redirect();
