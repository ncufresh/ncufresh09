<?php
require_once ("../../mainfile.php");

$currtpl -> assign('isadmin', $curruser -> isadmin());

$request_month = (!empty($_GET['request_month'])) ? $_GET['request_month'] : date("n", mktime());
$islogin = ($curruser -> isguest()) ? 0 : 1;

// main - begin
$opt_list = $currdb -> query("SELECT * FROM `".($currdb -> prefix("regwizard_opt"))."` ORDER BY `rwo_date_begin` ASC");

$opt_list_dis = array();	// $opt_list_dis is a 2-D array.
$opt_nums_total = 0;		// Count the numbers of all non-hidden options.
$opt_nums_complete = 0;		// Count the numbers of options user completed.

if($islogin == 1)
{
	while($opt_list_dis_processing = $currdb -> fetch_array($opt_list))	// $opt_list_dis_processing is an 1-D array.
	{
		$opt_list_dis_processing['dis_type'] = check_display_type($opt_list_dis_processing);
		
		if($opt_list_dis_processing['dis_type'] == "complete")
		{
			$opt_nums_complete++;
		}
	
		if($opt_list_dis_processing['dis_type'] != "hidden")
		{
			$opt_nums_total++;
			
			$opt_list_dis_processing['rwo_date_display'] = avail_date_display($opt_list_dis_processing['rwo_datetype'], $opt_list_dis_processing['rwo_date_begin'], $opt_list_dis_processing['rwo_date_end']);
			
			switch($opt_list_dis_processing['dis_type'])
			{
				case "non-begin":
					$opt_list_dis_processing['rwo_img_alt'] = 1; //"時間未到不可執行工作";
					break;
				case "necessary":
					$opt_list_dis_processing['rwo_img_alt'] = 2; //"[必要] 尚為完成";
					break;
				case "non-necessary":
					$opt_list_dis_processing['rwo_img_alt'] = 3; //"[非必要] 尚未完成";
					break;
				case "complete":
					$opt_list_dis_processing['rwo_img_alt'] = 4; //"已完成";
					break;
				case "non-complete":
					$opt_list_dis_processing['rwo_img_alt'] = 5; //"未於時間內完成";
					break;
				default:
					echo "ERROR! <br />";
			}
			
			//array_push($opt_list_dis, $opt_list_dis_processing);
			if($opt_list_dis_processing['rwo_img_alt'] == 2 || $opt_list_dis_processing['rwo_img_alt'] == 3)
			{
				array_push($opt_list_dis, $opt_list_dis_processing);
			}
		}
	}
	
	if(count($opt_list_dis) == 0)
	{
		$currtpl -> assign('opt_list_null', "無");
	}
}
else
if($islogin == 0)
{
	while($opt_list_dis_processing = $currdb -> fetch_array($opt_list))
	{
		if(check_display_type_guest($opt_list_dis_processing))
		{
			array_push($opt_list_dis, $opt_list_dis_processing);
		}
	}
	
	if(count($opt_list_dis) == 0)
	{
		$currtpl -> assign('opt_list_null', "無");
	}
}

if($_GET['action']=="finished")
{
	$currtpl -> assign('chk_finished', 1);
}


$c_dis = array();
if($islogin == 1)
{
	switch(check_level($opt_nums_complete, $opt_nums_total))
	{
		case 1:
			$c_dis['id'] = 1;
			$c_dis['desc'] = "baby";
			break;
		case 2:
			$c_dis['id'] = 2;
			$c_dis['desc'] = "child";
			break;
		case 3:
			$c_dis['id'] = 3;
			$c_dis['desc'] = "student";
			break;
		case 4:
			$c_dis['id'] = 4;
			$c_dis['desc'] = "teenager";
			break;
		case 5:
			$c_dis['id'] = 5;
			$c_dis['desc'] = "adult";
			break;
		default:
			echo "ERROR<br />";
	}
}

$currtpl -> assign('rside_msg', (($_GET['action']!="finished") ? "請點選月曆條目，以檢視您必須完成的項目。" : "您已標記完成此一項目囉！"));

$currtpl -> assign('opt_list_dis', $opt_list_dis);
$currtpl -> assign('request_month', $request_month);
$currtpl -> assign('islogin', $islogin);

$currtpl -> assign('c_dis', $c_dis);

$currtpl -> assign("title", $title);
$currtpl -> display("index.tpl.htm");

?>
