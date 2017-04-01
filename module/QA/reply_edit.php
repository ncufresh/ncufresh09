<?php
require_once('../../mainfile.php');

if(!$curruser -> isguest() )
{
	if($_GET['action']=="new_newpost")
	{
		if($_POST['isReply']!="1")
		{
			echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
			exit();
		}
		
		$Rno		= mysql_real_escape_string($_POST['Rno']);
		$Rcontent	= mysql_real_escape_string($_POST['Rcontent']);
		$user_IP	= ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
		
		if(trim($Rcontent) == "" || trim($Rno) == "")
		{
			$currtpl -> assign('Rno', $Rno);
			$currtpl -> assign('Rcontent', $Rcontent);
			
			$currtpl -> assign('err_msg', "請將內容欄位確實填寫！");
			
			$currtpl -> display('reply_edit.new.tpl.htm');
		}
		else
		{
			// Step1. Insert new reply
			$currdb -> query("INSERT INTO `".($currdb -> prefix("qa_re"))."` (`Rno`, `Rtime`, `Runo`, `Rcontent`, `RIP`) VALUES ('".$Rno."', '".mktime()."', '".$curruser -> uno."', '".$Rcontent."', '".$user_IP."')");
			
			// Step2. Add coins to user
			$coins_added = strlen($Rcontent);
			$coins_ori = $currdb -> fetch_array($currdb -> query("SELECT `coins` FROM `".($currdb -> prefix("user"))."` WHERE `uno` = '".$curruser -> uno."'"));
			$currdb -> query("UPDATE `".($currdb -> prefix("user"))."` SET `coins`='".(intval($coins_ori['coins']) + intval($coins_added))."' WHERE `uno` = '".$curruser -> uno."'");
			
			// Step3. Add reply num & final update time for the topic
			$curr_renum = $currdb -> fetch_array($currdb -> query("SELECT `Qrenum` FROM `".($currdb -> prefix("qa_question"))."` WHERE `Qno` = '".$Rno."'"));
			$currdb -> query("UPDATE `".($currdb -> prefix("qa_question"))."` SET `Qrenum` = '".($curr_renum['Qrenum'] + 1)."', `Qnewtime` = '".mktime()."' WHERE `Qno` = '".$Rno."'");
			
			// Step4. Set read
			$currdb -> query("DELETE FROM `".($currdb -> prefix("qa_read"))."` WHERE `uno` = '".$curruser -> uno."' AND `Qno` = '".$Rno."'");
			$currdb -> query("INSERT INTO `".($currdb -> prefix("qa_read"))."` (`uno`, `Qno`, `Qtime`) VALUES ('".$curruser->uno."', '".$Rno."', '".mktime()."')");
			
			// Step5. Redirect
			_redirect("view_topic.php?Qno=".$Rno);
		}
	}
}
else
{
	_savePage(URL.'/include/user.php?login_form=1');
}
?>