<?php
require_once('../../mainfile.php');

// Step1. Read the `page` and `class` of forum
$qa_page =	(intval($_GET['page']) > 0) ? intval($_GET['page']) : 1;
$qa_cls =	(intval($_GET['select']) > 0) ? intval($_GET['select']) : 0;

$qa_page_chg_num = 10;
$qa_page_list_arr_range = 4;

// Step2. Select all `qa_cls` of forum
$qa_cls_list_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("qa_cls"))."` ORDER BY `Cnum` ASC");
$qa_cls_list_arr = array();
while($qa_cls_list_single = $currdb -> fetch_array($qa_cls_list_src))
{
	array_push($qa_cls_list_arr, $qa_cls_list_single);
}

// Step3. Process the page navigator bar
$qa_total_counts = ($qa_cls == 0) ? $currdb -> fetch_array($currdb -> query("SELECT count(*) FROM `".($currdb -> prefix("qa_question"))."`")) : $currdb -> fetch_array($currdb -> query("SELECT count(*) FROM `".($currdb -> prefix("qa_question"))."` WHERE `Qcls` = '".$qa_cls."'"));

$qa_page_arr = array();
$qa_page_arr_init = false;	// Initialized?
$qa_page_arr_dest = false;	// Desctructed?

if($qa_page - $qa_page_list_arr_range > 1)
{
	array_push($qa_page_arr, ($qa_cls == 0) ? "<a href=\"index.php?page=1\">第一頁</a>" : "<a href=\"index.php?page=1&select=".$qa_cls."\">第一頁</a>");
}

for($i=($qa_page + ((-1) * ($qa_page_list_arr_range)) > 0) ? $qa_page + ((-1) * ($qa_page_list_arr_range)) : 1; ($i<=($qa_page + $qa_page_list_arr_range) && $i <= ((($qa_total_counts['count(*)'] - 1) / $qa_page_chg_num) + 1)); $i++)
{
	// Step3_1. Echo "..." if the first item is not '1'
	if(!$qa_page_arr_init && $i>1)
	{
		array_push($qa_page_arr, " ... ");
		$qa_page_arr_init = true;
	}
	else
	if(!$qa_page_arr_init && $i==1)
	{
		$qa_page_arr_init = true;
	}
	
	// Step3_2. Process normal page button
	if($qa_cls == 0)
	{
		array_push($qa_page_arr, ($i!=$qa_page) ? "<a href=\"index.php?page=".$i."\">".$i."</a>" : $i);
	}
	else
	{
		array_push($qa_page_arr, ($i!=$qa_page) ? "<a href=\"index.php?select=".$qa_cls."&page=".$i."\">".$i."</a>" : $i);
	}
	
	// Step3_3. Echo "..." if the last item is not ((($qa_total_counts['count(*)'] - 1) / $qa_page_chg_num) + 1)
	if($i==($qa_page + $qa_page_list_arr_range) && $i < ((($qa_total_counts['count(*)'] - 1) / $qa_page_chg_num) + 1))
	{
		array_push($qa_page_arr, " ... ");
		$qa_page_arr_dest = true;
	}
}

if($qa_page + $qa_page_list_arr_range < ((($qa_total_counts['count(*)'] - 1) / $qa_page_chg_num) + 1))
{
	array_push($qa_page_arr, ($qa_cls == 0) ? "<a href=\"index.php?page=".((($qa_total_counts['count(*)'] - 1) / $qa_page_chg_num) + 1)."\">最後頁</a>" : "<a href=\"index.php?page=".((($qa_total_counts['count(*)'] - 1) / $qa_page_chg_num) + 1)."&select=".$qa_cls."\">最後頁</a>");
}

// Step4. Select all `qa_question` corresponds to `$qa_cls`. If `$qa_cls` == 0, select all topics from `qa_question`
$qa_questions_list_arr_sql_cmd = "SELECT `Qno`, `Qtime`, `Quno`, `Qtitle`, `Qrenum`, `Qnewtime`, `Qcls`, `Qactive` FROM `".($currdb -> prefix("qa_question"))."` WHERE `Qactive` != 0";
if($qa_cls != 0)
{
	$qa_questions_list_arr_sql_cmd = $qa_questions_list_arr_sql_cmd." AND `Qcls` = ".$qa_cls;
}
$qa_questions_list_arr_sql_cmd = $qa_questions_list_arr_sql_cmd." ORDER BY `Qno` DESC LIMIT ".(($qa_page - 1) * $qa_page_chg_num)." , ".$qa_page_chg_num;
$qa_questions_list_src = $currdb -> query($qa_questions_list_arr_sql_cmd);

$qa_questions_list_arr = array();
while($qa_questions_single = $currdb -> fetch_array($qa_questions_list_src))
{
	// Step4_1. Select correspond user from `user` table
	$curr_topic_user = $currdb -> fetch_array($currdb -> query("SELECT `uno`, `uid`, `pic` FROM `".($currdb -> prefix("user"))."` WHERE `uno` = '".$qa_questions_single['Quno']."'"));
	$qa_questions_single['uid'] = $curr_topic_user['uid'];
	$qa_questions_single['pic'] = file_exists(ROOT_PATH."/module/shop/items_pic/".$curr_topic_user['pic'].".jpg") ? $curr_topic_user['pic'] : "file_doesnt_exist";
	
	// Step4_2. Check if there exist any new replies in the table
	$curr_newreply = $currdb -> fetch_array($currdb -> query("SELECT count(*) FROM `".($currdb -> prefix("qa_read"))."` WHERE `uno` = '".$curruser->uno."' AND `Qno` = '".$qa_questions_single['Qno']."' AND `Qtime` >= '".$qa_questions_single['Qnewtime']."'"));
	$qa_questions_single['new_reply'] = ($curr_newreply['count(*)'] == 0) ? true : false ;
	
	// Step4_3. Make the number of mktime() readable
	$qa_questions_single['Qtime'] = date("Y-m-d H:i:s", $qa_questions_single['Qtime']);
	
	// Step4_4. Encode the title
	$qa_questions_single['Qtitle'] = htmlencode($qa_questions_single['Qtitle']);
	
	// Step4_5. selected the corresponded class of current topic
	for($i=0; $i<count($qa_cls_list_arr); $i++)
	{
		if($qa_questions_single['Qcls'] == $qa_cls_list_arr[$i]['Cnum'])
		{
			$qa_questions_single['Qtitle'] = "[".$qa_cls_list_arr[$i]['Ccontent']."] ".$qa_questions_single['Qtitle'];
			break;
		}
	}
	
	// Step4_6. Minimize the title into 14 characters
	$qa_questions_single['Qtitle'] = _substrfix($qa_questions_single['Qtitle'], 32);
	
	// Step4_7. Array Push
	array_push($qa_questions_list_arr, $qa_questions_single);
}


// Step5. Select all `ten_quetion` from database.
require_once('tq_block.php');

// Step6. Assign all variables to template
$currtpl -> assign('qa_page', $qa_page);
$currtpl -> assign('qa_cls', $qa_cls);

$currtpl -> assign('qa_page_arr', (count($qa_page_arr) != 1) ? $qa_page_arr : NULL);

$currtpl -> assign('qa_cls_list_arr', $qa_cls_list_arr);
$currtpl -> assign('qa_questions_list_arr', $qa_questions_list_arr);
$currtpl -> assign('tq_list_arr', $tq_list_arr);

$currtpl -> display('index.tpl.htm');

// 中文字
?>
