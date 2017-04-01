<?php
require_once("../../mainfile.php");


$searchNO = array();


$frame_width = 640;
$frame_height = 480;

if ($_GET['quality'] == "0")
{
	$sql = "SELECT * FROM `workv1_video` WHERE `no` = 1 ";
	$searchNO = $currdb -> query($sql);
	$searchNO = $currdb -> fetch_array($searchNO);
	$searchNO['video'] =  urlencode("./{$searchNO['video']}");
	
	header( "refresh:9 ; url=video_case.php?no=" . $_GET['no'] . "&quality=high" );
}
else
{
	$sql = "SELECT * FROM `workv1_video` WHERE `no` ={$_GET['no']}";
	$searchNO = $currdb -> query($sql);
	$searchNO = $currdb -> fetch_array($searchNO);
	$searchNO['video'] =  urlencode("./{$searchNO['video']}");
	
	if ($_GET['quality'] == "low")
	{
		$searchNO['video'] = $searchNO['low'];
	}
	
	if ($searchNO['name'] == '選課系統教學')
	{
		$frame_width = 720;
		$frame_height = 500;
	}
}
//

/* swf player setting */
$swf_url = URL."/module/video/templates/fpL.swf"; 
$swf_file_url = urlencode(URL_FULL.'/module/video/templates');


$is_auto_play = "true";

$currtpl->assign('frame_width', $frame_width);
$currtpl->assign('frame_height', $frame_height);

$currtpl->assign('quality', $_GET['quality']);
$currtpl->assign('play', $searchNO);
$currtpl->assign("v_url",$v_url); 
$currtpl->assign("swf_url",$swf_url);
$currtpl->assign("swf_file_url",$swf_file_url);
$currtpl->assign("is_auto_play",$is_auto_play);
$currtpl->assign('data', $data_array); 
$currtpl->setndisplay(); 
$currtpl->display("video_case.tpl.htm");
?>
