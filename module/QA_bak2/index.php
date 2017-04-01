<?php
	require_once '../../mainfile.php';
	$QA_tenQuestions=tenQuest();
	
	if(!isset($_GET['page'])) $page=1;
	else                      $page=$_GET['page'];

	if(!isset($_GET['QAno']) && !isset($_GET['QTno']) && !isset($_GET['Qnew']) && !isset($_GET['Qchg'])){
		if(!isset($_GET['select']))
			$QA_MainBlock=mainpage($page,-1);
		else
			$QA_MainBlock=mainpage($page,$_GET['select']);
	}
	else if(isset($_GET['QAno']) && !isset($_GET['QTno']) && !isset($_GET['Qnew'])&& !isset($_GET['Qchg'])){
		$QA_MainBlock=Qpage($_GET['QAno'],$page);
	}
	else if(!isset($_GET['QAno']) && isset($_GET['QTno'])&& !isset($_GET['Qnew'])&& !isset($_GET['Qchg'])){
		$QA_MainBlock=TQpage($_GET['QTno']);
	}
	else if(!isset($_GET['QAno']) && !isset($_GET['QTno'])&& isset($_GET['Qnew'])&& !isset($_GET['Qchg'])){
		if($curruser->isguest()){
			_savePage(URL.'/include/user.php?login_form=1');
		}
		$QA_MainBlock=newpage();
	}
	else if(!isset($_GET['QAno']) && !isset($_GET['QTno'])&& !isset($_GET['Qnew'])&& isset($_GET['Qchg'])){
		if($curruser->isguest()){
			_savePage(URL.'/include/user.php?login_form=1');
		}
		$QA_MainBlock=chgpage($_GET['Qno']);
	}
	$currtpl->assign('QA_Ten_List',$QA_Ten_List);
	$currtpl->assign('QA_TenQuest',$QA_tenQuestions);
	$currtpl->assign('QA_MainBlock',$QA_MainBlock);
	$currtpl->display('index.tpl.php');

?>
