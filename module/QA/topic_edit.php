<?php
require_once('../../mainfile.php');

function genClassList($input = 0)
{
	global $currdb;
	
	$cls_list_str = "";
	$cls_list_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("qa_cls"))."` ORDER BY `Cnum` ASC");
	
	while($cls_list_single = $currdb -> fetch_array($cls_list_src))
	{
		if($input == $cls_list_single['Cnum'])
		{
			$cls_list_str = $cls_list_str."<option value=\"".$cls_list_single['Cnum']."\"  selected=\"selected\">".$cls_list_single['Ccontent']."</option>\n";
		}
		else
		{
			$cls_list_str = $cls_list_str."<option value=\"".$cls_list_single['Cnum']."\">".$cls_list_single['Ccontent']."</option>\n";
		}
	}
	
	return $cls_list_str;
}



if(!$curruser -> isguest() )
{
	if($_GET['action']=="edit")		// Edit_input_form
	{
		// Step1. check `uno`
		$counts = $currdb -> fetch_array($currdb -> query("SELECT count(*) FROM `".($currdb -> prefix("qa_question"))."` WHERE `Qno` = '".intval($_GET['Qno'])."' AND `Quno` = '".$curruser -> uno."'"));
		
		if(($counts['count(*)'] == 0 && !$curruser -> isadmin()) || empty($_GET['Qno']))
		{
			echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
			exit();
		}
		
		// Step2. Assign the original contents of the topics
		$curr_topic = $currdb -> fetch_array($currdb -> query("SELECT * FROM `".($currdb -> prefix("qa_question"))."` WHERE `Qno` = '".intval($_GET['Qno'])."'"));
		
		$currtpl -> assign('Qno', $curr_topic['Qno']);
		$currtpl -> assign('Qcls', genClassList($curr_topic['Qcls']));
		$currtpl -> assign('Qtitle', $curr_topic['Qtitle']);
		$currtpl -> assign('Qcontent', $curr_topic['Qcontent']);
		
		$currtpl -> assign('err_msg', NULL);
		
		$currtpl -> display('topic_edit.edit.tpl.htm');
	}
	else
	if($_GET['action']=="new_edit")	// Write_edit_data_into_DB
	{
		if($_POST['isEdit']!="1" || empty($_POST['Qno']))
		{
			echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
			exit();
		}
		
		// Step1. Check if `uno` is correspond to the current edit
		$counts = $currdb -> fetch_array($currdb -> query("SELECT count(*) FROM `".($currdb -> prefix("qa_question"))."` WHERE `Qno` = '".intval($_POST['Qno'])."' AND `Quno` = '".$curruser -> uno."'"));
		
		if($counts['count(*)'] == 0 && !$curruser -> isadmin())
		{
			echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
			exit();
		}
		
		// Step2. Write the edit into database
		$Qno		= mysql_real_escape_string($_POST['Qno']);
		$Qcls		= mysql_real_escape_string($_POST['Qcls']);
		$Qtitle		= mysql_real_escape_string($_POST['Qtitle']);
		$Qcontent	= mysql_real_escape_string($_POST['Qcontent']);
		$user_IP	= ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
		
		if(trim($Qtitle)=="" || trim($Qcls)=="" || trim($Qcontent)=="")
		{
			$currtpl -> assign('Qno', $Qno);
			$currtpl -> assign('Qcls', genClassList($Qcls));
			$currtpl -> assign('Qtitle', $Qtitle);
			$currtpl -> assign('Qcontent', $Qcontent);
			
			$currtpl -> assign('err_msg', "請將所有欄位 (類別、標題、內容) 確實填寫！");
			
			$currtpl -> display('topic_edit.edit.tpl.htm');
		}
		else
		{
			$currdb -> query("UPDATE `".($currdb -> prefix("qa_question"))."` SET `Qcls`='".$Qcls."', `Qtitle`='".$Qtitle."', `Qcontent`='".$Qcontent."', `QIP`='".$user_IP."' WHERE `Qno`='".$Qno."'");
			
			// Decrease Money? KerKer...
			
			_redirect("view_topic.php?Qno=".$Qno);
		}
	}
/*	else
	if($_GET['action']=="newpost")
	{
	
	}*/
	else
	if($_GET['action']=="new_newpost")
	{
		if($_POST['isPost']!="1")
		{
			echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
			exit();
		}
		
		$Qcls		= mysql_real_escape_string($_POST['Qcls']);
		$Qtitle		= mysql_real_escape_string($_POST['Qtitle']);
		$Qcontent	= mysql_real_escape_string($_POST['Qcontent']);
		$user_IP	= ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
		
		if(trim($Qcls) == "" || trim($Qtitle) == "" || trim($Qcontent) == "")
		{
			$currtpl -> assign('Qcls', genClassList($Qcls));
			$currtpl -> assign('Qtitle', $Qtitle);
			$currtpl -> assign('Qcontent', $Qcontent);
			
			$currtpl -> assign('err_msg', "請將所有欄位 (類別、標題、內容) 確實填寫！");
			
			$currtpl -> display('topic_edit.new.tpl.htm');
		}
		else
		{
			// Step1. Insert new topic
			$currdb -> query("INSERT INTO `".($currdb -> prefix("qa_question"))."` (`Qtime`, `Quno`, `Qtitle`, `Qcontent`, `Qrenum`, `Qnewtime`, `Qcls`, `QIP`, `Qactive`) VALUES ('".mktime()."', '".$curruser -> uno."', '".$Qtitle."', '".$Qcontent."', 0, '".mktime()."', '".$Qcls."', '".$user_IP."', '1')");
			
			// Step2. Add coins to user
			$coins_added = strlen($Qcontent);
			$coins_ori = $currdb -> fetch_array($currdb -> query("SELECT `coins` FROM `".($currdb -> prefix("user"))."` WHERE `uno` = '".$curruser -> uno."'"));
			$currdb -> query("UPDATE `".($currdb -> prefix("user"))."` SET `coins`='".(intval($coins_ori['coins']) + intval($coins_added))."' WHERE `uno` = '".$curruser -> uno."'");
			
			
			// Step3. Redirect
			_redirect("index.php");
		}
	}
	else
	if($_GET['action']=="delete")	// Delete_corresponded_data_from_DB
	{
		// Step1. Check `uno`
		$counts = $currdb -> fetch_array($currdb -> query("SELECT count(*) FROM `".($currdb -> prefix("qa_question"))."` WHERE `Qno` = '".intval($_GET['Qno'])."' AND `Quno`='".$curruser -> uno."'"));
		if(($counts['count(*)'] == 0 && !$curruser -> isadmin()) || empty($_GET['Qno']))
		{
			echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
			exit();
		}
		// Step2. Delete
		$currdb -> query("UPDATE `".($currdb -> prefix("qa_question"))."` SET `Qactive`= '0' WHERE `Qno`='".intval($_GET['Qno'])."'");
		
		// Step3. Decrease Money? KerKer...
		
		// Step4. Redirect
		_redirect("index.php");
	}
	else
	{
		$currtpl -> assign('Qcls', genClassList());
		$currtpl -> assign('Qtitle', NULL);
		$currtpl -> assign('Qcontent', NULL);
		
		$currtpl -> assign('err_msg', NULL);
		
		$currtpl -> display('topic_edit.new.tpl.htm');
	}
}
else
{
	_savePage(URL.'/include/user.php?login_form=1');
}
?>