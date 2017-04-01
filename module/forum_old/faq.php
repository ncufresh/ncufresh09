<?php

require_once '../../mainfile.php';

$admin = array('b0690009', 'n0641098');

$currsite[] = array('name'=>'中大新生Q&amp;A', 'url'=>'faq.php');

if($curruser->isadmin() || in_array($curruser->uid, $admin) || $currmodule->isadmin($curruser))
{
	if(!empty($_POST['edit']))
	{
		$file = $currtpl->fetch('faq.htm');

		$currtpl->assign('content', htmlencode($file));

		$currtpl->display('edit_faq.htm');
	}
	else if(!empty($_POST['html']))
	{
		@fwrite(fopen($currtpl->template_dir.'faq.htm', "w+"), $_POST['html']);

		_redirect('faq.php');
	}
	else
	{
		echo '<form action="" method="post"><input type="submit" name="edit" value="Edit" /></form>';
		$currtpl->display('faq.htm');
	}
}
else
	$currtpl->display('faq.htm');

?>
