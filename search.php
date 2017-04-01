<?php
require_once('mainfile.php');

// Result of all search
$search_result = array();

// Result of one single data
$curr_result = array();

// Keyword of user input
$keyword_input = addslashes(trim(urldecode($_GET['keyword_input'])));

if(strlen($keyword_input) > 2 && $keyword_input != "全站搜尋")
{
	// News
	$query_news = $currdb -> query("SELECT `news_no`, `title`, `content` FROM `".($currdb -> prefix("news_post"))."` WHERE `title` LIKE '%".$keyword_input."%' OR `content` LIKE '%".$keyword_input."%' ORDER BY `news_no` DESC LIMIT 0, 500");
	
	while($processing = $currdb -> fetch_array($query_news))
	{
		$curr_result['title_href'] = "<a href=\"".$currconfig -> url."/module/news/index.php?news_no=".$processing['news_no']."\">[公告系統] ".$processing['title']."</a>";
		$curr_result['content'] = _substrfix(preg_replace('/<[^>]*>/i', '', $processing['content']), 100);
		array_push($search_result, $curr_result);
	}
	
	
	// MustRead
	$query_must =  $currdb -> query("SELECT `".($currdb -> prefix("must_category"))."`.`csn`, `".($currdb -> prefix("must_category"))."`.`title`, `".($currdb -> prefix("must_main"))."`.`main` FROM `".($currdb -> prefix("must_category"))."` LEFT JOIN `".($currdb -> prefix("must_main"))."` ON `".($currdb -> prefix("must_category"))."`.`csn` = `".($currdb -> prefix("must_main"))."`.`csn` WHERE `".($currdb -> prefix("must_category"))."`.`title` LIKE '%".$keyword_input."%' OR `".($currdb -> prefix("must_main"))."`.`main` LIKE '%".$keyword_input."%' ORDER BY `".($currdb -> prefix("must_category"))."`.`csn` ASC LIMIT  0, 500");
	
	while($processing = $currdb -> fetch_array($query_must))
	{
		$curr_result['title_href'] = "<a href=\"".$currconfig -> url."/module/mustknow/index.php?csn=".$processing['csn']."\">[大一必讀] ".$processing['title']."</a>";
		$curr_result['content'] = _substrfix(preg_replace('/<[^>]*>/i', '', $processing['main']), 100);
		array_push($search_result, $curr_result);
	}
	
	// Campus
	$query_campus = $currdb -> query("SELECT `CSMno`, `CSMtitle`, `Content` FROM `".($currdb -> prefix("campus_submenu"))."` WHERE `CSMtitle` LIKE '%".$keyword_input."%' OR `Content` LIKE '%".$keyword_input."%' ORDER BY `CSMno` ASC LIMIT  0, 500");
	
	while($processing = $currdb -> fetch_array($query_campus))
	{
		$curr_result['title_href'] = "<a href=\"".$currconfig -> url."/module/campus/index.php?content=".$processing['CSMno']."\">[中大校園] ".$processing['CSMtitle']."</a>";
		$curr_result['content'] = _substrfix(preg_replace('/<[^>]*>/i', '', $processing['Content']), 100);
		array_push($search_result, $curr_result);
	}
	
	
	// NCU Life
	$query_nculife = $currdb -> query("SELECT `t_ID`, `t_name`, `t_contents` FROM `".($currdb -> prefix("nculife_topic"))."` WHERE `t_name` LIKE '%".$keyword_input."%' OR `t_contents` LIKE '%".$keyword_input."%' ORDER BY `t_ID` ASC LIMIT  0, 500");
	
	while($processing = $currdb -> fetch_array($query_nculife))
	{
		$curr_result['title_href'] = "<a href=\"".$currconfig -> url."/module/nculife/index.php?t_ID=".$processing['t_ID']."\">[中大生活] ".$processing['t_name']."</a>";
		$curr_result['content'] = _substrfix(preg_replace('/<[^>]*>/i', '', $processing['t_contents']), 100);
		array_push($search_result, $curr_result);
	}
	
	// Departname (name)
	$query_dpm_name = $currdb -> query("SELECT `fno`, `board_sname`, `descripe` FROM `".($currdb -> prefix("forum_list"))."` WHERE `board_sname` LIKE '%".$keyword_input."%' OR `descripe` LIKE '%".$keyword_input."%' ORDER BY `fno` ASC LIMIT  0, 500");
	
	while($processing = $currdb -> fetch_array($query_dpm_name))
	{	
		$curr_result['title_href'] = "<a href=\"".$currconfig -> url."/module/forum/board.php?forum=".$processing['fno']."\">[系所社團] ".$processing['board_sname']."</a>";
		$curr_result['content'] = _substrfix(preg_replace('/<[^>]*>/i', '', $processing['descripe']), 100);
		array_push($search_result, $curr_result);
	}
	
	// Department (Topic)
	$query_dpm_topic = $currdb -> query("SELECT `ano`, `fno`, `title`, `content` FROM `".($currdb -> prefix("forum_articals"))."` WHERE `active` IS NOT '0' AND (`title` LIKE '%".$keyword_input."%' OR `content` LIKE '%".$keyword_input."%') ORDER BY `ano` DESC LIMIT  0, 500");
	
	while($processing = $currdb -> fetch_array($query_dpm_topic))
	{
		$dpm_name = $currdb -> fetch_array($currdb -> query("SELECT `board_sname` FROM `".($currdb -> prefix("forum_list"))."` WHERE `fno` = '".$processing['fno']."'"));
		
		$curr_result['title_href'] = "<a href=\"".$currconfig -> url."/module/forum/viewboard.php?ano=".$processing['ano']."\">[系所社團 - ".$dpm_name['board_sname']."] ".$processing['title']."</a>";
		$curr_result['content'] = _substrfix(preg_replace('/<[^>]*>/i', '', $processing['content']), 100);
		array_push($search_result, $curr_result);
	}
	
	// QA Ten Questions
	$query_qa_tq = $currdb -> query("SELECT `TQno`, `TQtitle`, `TQcontent` FROM `".($currdb -> prefix("qa_tenquest"))."` WHERE `TQtitle` LIKE '%".$keyword_input."%' OR `TQcontent` LIKE '%".$keyword_input."%' ORDER BY `TQno` ASC LIMIT  0, 500");
	
	while($processing = $currdb -> fetch_array($query_qa_tq))
	{	
		$curr_result['title_href'] = "<a href=\"".$currconfig -> url."/module/QA/view_tq.php?TQno=".$processing['TQno']."\">[精華十問] ".$processing['TQtitle']."</a>";
		$curr_result['content'] = _substrfix(preg_replace('/<[^>]*>/i', '', $processing['TQcontent']), 100);
		array_push($search_result, $curr_result);
	}
	
	
	// QA Topics
	$query_qa = $currdb -> query("SELECT `Qno`, `Qtitle`, `Qcontent` FROM `".($currdb -> prefix("qa_question"))."` WHERE `Qtitle` LIKE '%".$keyword_input."%' OR `Qcontent` LIKE '%".$keyword_input."%' ORDER BY `Qno` DESC LIMIT  0, 500");
	
	while($processing = $currdb -> fetch_array($query_qa))
	{	
		$curr_result['title_href'] = "<a href=\"".$currconfig -> url."/module/QA/view_topic.php?Qno=".$processing['Qno']."\">[新生論壇] ".$processing['Qtitle']."</a>";
		$curr_result['content'] = _substrfix(preg_replace('/<[^>]*>/i', '', $processing['Qcontent']), 100);
		array_push($search_result, $curr_result);
	}
	
	// Regwizard
	$query_regw = $currdb -> query("SELECT `rwoID`, `rwo_name`, `rwo_description` FROM `".($currdb -> prefix("regwizard_opt"))."` WHERE `rwo_name` LIKE '%".$keyword_input."%' OR `rwo_description` LIKE '%".$keyword_input."%' ORDER BY `rwoID` ASC LIMIT  0, 500");
	
	while($processing = $currdb -> fetch_array($query_regw))
	{	
		$curr_result['title_href'] = "<a href=\"".$currconfig -> url."/module/regwizard/opt_check.php?rwoID=".$processing['rwoID']."#reg_content\">[註冊精靈] ".$processing['rwo_name']."</a>";
		$curr_result['content'] = _substrfix(preg_replace('/<[^>]*>/i', '', $processing['rwo_description']), 100);
		array_push($search_result, $curr_result);
	}
	
	if(count($search_result) == 0)
	{
		$curr_result['title_href'] = "<span style=\"color: #0066FF;\">未找到相關的內容</span>";
		$curr_result['content'] = "請嘗試重新輸入關鍵字以進行搜尋。";
		array_push($search_result, $curr_result);
	}
	
}
else
{
	$curr_result['title_href'] = "<span style=\"color: #0066FF;\">輸入的關鍵字字數過少</span>";
	$curr_result['content'] = "請至少輸入3個以上的字元，才能判斷出您要的搜尋結果喔！";
	
	array_push($search_result, $curr_result);
}

$currtpl -> assign('search_result', $search_result);
$currtpl -> display('search.tpl.htm');
?>
