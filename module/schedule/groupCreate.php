<?
	require_once("../../mainfile.php");

	if(!$curruser->isguest())
	{
		if(isset($_POST['name']) && isset($_POST['public']))
		{
			$gno = groupAdd($_POST['name'],htmlencode($_POST['motd']),$_POST['introduce'],$_POST['public']);
			memberAdd($gno,$curruser->uno,3);
			
			_redirect("group.php?gno=".$gno);
		}
		else	
			$currtpl->display("groupCreate.htm");
	}
	else
		_redirect();
?>
