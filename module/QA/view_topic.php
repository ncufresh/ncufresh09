<?php
require_once('../../mainfile.php');
require_once('../../dep.php');

// Step1. Read the `page` and `Qno` of forum
$page =	(intval($_GET['page']) > 0) ? intval($_GET['page']) : 1;
$Qno = (intval($_GET['Qno']) > 0) ? intval($_GET['Qno']) : -1;

$page_chg_num = 10;
$page_list_arr_range = 4;

// ---
// Step2. Select the topic corresponds to the `Qno`
$qa_topic_arr = $currdb -> fetch_array($currdb -> query("SELECT * FROM `".($currdb -> prefix("qa_question"))."` WHERE `Qno`='".$Qno."' AND `Qactive` != 0"));

if(count($qa_topic_arr) == 0)
{
	$Qno = -1;
}

if($Qno == -1)
{
	echo "文章不存在！請重試！";
	exit();	
}
else
{
	$qa_topic_arr['Qtitle'] = htmlencode($qa_topic_arr['Qtitle']);
	$qa_topic_arr['Qcontent'] = nl2br(htmlencode($qa_topic_arr['Qcontent']));
	$qa_topic_arr['Qtime'] = date("Y-m-d H:i:s", $qa_topic_arr['Qtime']);
}

// Step2_1. Select the author of the topic corresponds to the `Qno`
$qa_topic_author_arr = $currdb -> fetch_array($currdb -> query("SELECT `uno`, `uid`, `name`, `department`, `pic` FROM `".($currdb -> prefix("user"))."` WHERE `uno` = '".$qa_topic_arr['Quno']."'"));

$qa_topic_arr['uno'] = $qa_topic_author_arr['uno'];
$qa_topic_arr['uid'] = $qa_topic_author_arr['uid'];
$qa_topic_arr['name'] = $qa_topic_author_arr['name'];
$qa_topic_arr['pic'] = file_exists(ROOT_PATH."/module/shop/items_pic/".$qa_topic_author_arr['pic'].".jpg") ? $qa_topic_author_arr['pic'] : "file_doesnt_exist";
$qa_topic_arr['department'] = $dep[$qa_topic_author_arr['department']];

$qa_topic_arr['uno_equal'] = ($qa_topic_arr['uno'] == $curruser -> uno || $curruser -> isadmin()) ? TRUE : FALSE;

// Step2_2. If user login, update the final read time to erase red points.
if(!$curruser -> isguest())
{
	$currdb -> query("DELETE FROM `".($currdb -> prefix("qa_read"))."` WHERE `uno` = '".$curruser -> uno."' AND `Qno` = '".$Qno."'");
	$currdb -> query("INSERT INTO `".($currdb -> prefix("qa_read"))."` (`uno`, `Qno`, `Qtime`) VALUES ('".$curruser -> uno."', '".$Qno."', '".mktime()."')");
}
// ---

// Step3. Process the page navigator bar
$qa_replies_count = $currdb -> fetch_array($currdb -> query("SELECT count(*) FROM `".($currdb -> prefix("qa_re"))."` WHERE `Rno`='".$Qno."'"));

$page_arr = array();
$page_arr_init = false;	// Initialized?
$page_arr_dest = false;	// Desctructed?

if($page - $page_list_arr_range > 1)
{
	array_push($page_arr, "<a href=\"view_topic.php?Qno=".$Qno."&page=1\">第一頁</a>");
}

for($i=($page + ((-1) * ($page_list_arr_range)) > 0) ? $page + ((-1) * ($page_list_arr_range)) : 1; ($i<=($page + $page_list_arr_range) && $i <= ((($qa_replies_count['count(*)'] - 1) / $page_chg_num) + 1)); $i++)
{
	// Step3_1. Echo "..." if the first item is not '1'
	if(!$page_arr_init && $i>1)
	{
		array_push($page_arr, " ... ");
		$page_arr_init = true;
	}
	else
	if(!$page_arr_init && $i==1)
	{
		$page_arr_init = true;
	}
	
	// Step3_2. Process normal page button
	array_push($page_arr, ($i!=$page) ? "<a href=\"view_topic.php?Qno=".$Qno."&page=".$i."\">".$i."</a>" : $i);
	
	// Step3_3. Echo "..." if the last item is not ((($qa_replies_count['count(*)'] - 1) / $page_chg_num) + 1)
	if($i==($page + $page_list_arr_range) && $i < ((($qa_replies_count['count(*)'] - 1) / $page_chg_num) + 1))
	{
		array_push($page_arr, " ... ");
		$page_arr_dest = true;
	}
}

if($page + $page_list_arr_range < ((($qa_replies_count['count(*)'] - 1) / $page_chg_num) + 1))
{
	array_push($page_arr, "<a href=\"view_topic.php?Qno=".$Qno."&page=".((($qa_replies_count['count(*)'] - 1) / $page_chg_num) + 1)."\">最後頁</a>");
}


// Step4. Select all replies correspond to the topic's `Qno`
$qa_replies_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("qa_re"))."` WHERE `Rno`='".$Qno."' ORDER BY `Rtime` ASC LIMIT ".(($page-1) * $page_chg_num).",".($page_chg_num)."");
$qa_replies_arr = array();

$currF = $page_chg_num * ($page - 1);
while($qa_replies_single = $currdb -> fetch_array($qa_replies_src))
{
	// Step4_1. Selected the author correspond to the `Runo`
	$qa_replies_single_author_arr = $currdb -> fetch_array($currdb -> query("SELECT `uno`, `uid`, `name`, `pic`, `department` FROM `".($currdb -> prefix("user"))."` WHERE `uno` = '".($qa_replies_single['Runo'])."'"));
	$qa_replies_single['uno'] = $qa_replies_single_author_arr['uno'];
	$qa_replies_single['uid'] = $qa_replies_single_author_arr['uid'];
	$qa_replies_single['name'] = $qa_replies_single_author_arr['name'];
	$qa_replies_single['pic'] = file_exists(ROOT_PATH."/module/shop/items_pic/".$qa_replies_single_author_arr['pic'].".jpg") ? $qa_replies_single_author_arr['pic'] : "file_doesnt_exist";
	$qa_replies_single['department'] = $dep[$qa_replies_single_author_arr['department']];
	
	$qa_replies_single['uno_equal'] = ($qa_replies_single['uno'] == $curruser -> uno || $curruser -> isadmin()) ? TRUE : FALSE;
	
	$qa_replies_single['Rf'] = ++$currF;
	
	// Step4_2. htmlencode
	$qa_replies_single['Rcontent'] = nl2br(htmlencode($qa_replies_single['Rcontent']));
	$qa_replies_single['Rtime'] = date("Y-m-d H:i:s", $qa_replies_single['Rtime']);
	
	array_push($qa_replies_arr, $qa_replies_single);
}




// Step5. Select all `ten_quetion` from database.
$tq_list_src = $currdb -> query("SELECT `TQno`, `TQtitle` FROM `".($currdb -> prefix("qa_tenquest"))."` ORDER BY `TQno` ASC");
$tq_list_arr = array();
while($tq_list_processing = $currdb -> fetch_array($tq_list_src))
{
	array_push($tq_list_arr, $tq_list_processing);
}


// Step6. Assign all variables to template
$currtpl -> assign('page', $page);
$currtpl -> assign('page_arr', (count($page_arr) != 1) ? $page_arr : NULL);

$currtpl -> assign('qa_topic_arr', $qa_topic_arr);
$currtpl -> assign('qa_replies_arr', $qa_replies_arr);

$currtpl -> assign('tq_list_arr', $tq_list_arr);

$currtpl -> display('view_topic.tpl.htm');
?>