<?php
if (!defined("MAINFILE_INCLUDED"))
	exit();

function navigator($dirname = NULL)
{
	$block = array();
	
	global $currconfig;
	global $currsite;
	global $currmodule;
	
	// Pre-process: Requested url/path information for block templates
	$block['currconfig_url'] = $currconfig -> url;
	$block['btn_addcss'] = array();
	$block['bar_lnk'] = array();
	
	$block['currsite'] = array();
	for($i=0; $i<count($currsite); $i++)
	{
		$block['currsite'][$i]['name'] = $currsite[$i]['name'];
		$block['currsite'][$i]['url'] = $currsite[$i]['url'];
	}
	
	// Step1. Process button bar & content_top's background/height
	$block['content_top'] = array();
	
	switch($currmodule -> name)
	{
		case "mustknow":
			$block['btn_addcss']['mustknow'] = "style=\"background-image:url(".$currconfig -> url."/templates/images/i01h.png);\"";
			$block['content_top']['bg'] = "bar01.gif";
			$block['content_top']['height'] = 24;
			$block['content_top']['type'] = "nws";
			
			array_push($block['bar_lnk'], "<a href=\"index.php?csn=3\">相關須知</a>");
			array_push($block['bar_lnk'], "<a href=\"index.php?csn=1\">大一新生重要須知</a>");
			array_push($block['bar_lnk'], "<a href=\"index.php?csn=2\">大一休學後復學生</a>");
			
			break;
		case "campus":
			$block['btn_addcss']['campus'] = "style=\"background-image:url(".$currconfig -> url."/templates/images/i02h.png);\"";
			$block['content_top']['bg'] = "bar02.gif";
			$block['content_top']['height'] = 24;
			$block['content_top']['type'] = "nws";
			/*$block['bar_lnk'][]="<span onclick=\"sub_menu(1)\">行政區</span>";*/
			array_push($block['bar_lnk'], "<a href=\"index.php?menu=1\" onclick=\"sub_menu(1);return false;\">行政區</a>");
			array_push($block['bar_lnk'], "<a href=\"index.php?menu=2\" onclick=\"sub_menu(2);return false;\">中大景點</a>");
			array_push($block['bar_lnk'], "<a href=\"index.php?menu=3\" onclick=\"sub_menu(3);return false;\">系館位置</a>");
			array_push($block['bar_lnk'], "<a href=\"index.php?menu=4\" onclick=\"sub_menu(4);return false;\">自學資源</a>");
			array_push($block['bar_lnk'], "<a href=\"index.php?menu=5\" onclick=\"sub_menu(5);return false;\">運動場所</a>");
			array_push($block['bar_lnk'], "<a href=\"index.php?menu=6\" onclick=\"sub_menu(6);return false;\">全校地圖</a>");
			break;
		case "nculife":
			$block['btn_addcss']['nculife'] = "style=\"background-image:url(".$currconfig -> url."/templates/images/i03h.png);\"";
			$block['content_top']['bg'] = "bar03.gif";
			$block['content_top']['height'] = 24;
			$block['content_top']['type'] = "nws";
			
			array_push($block['bar_lnk'], "<a href=\"index.php?cat_ID=1\">交通方式</a>");
			array_push($block['bar_lnk'], "<a href=\"index.php?cat_ID=2\">學校飲食</a>");
			array_push($block['bar_lnk'], "<a href=\"index.php?cat_ID=4\">住宿相關</a>");
			array_push($block['bar_lnk'], "<a href=\"index.php?cat_ID=3\">生活相關</a>");
			break;
		case "forum":
			$block['btn_addcss']['forum'] = "style=\"background-image:url(".$currconfig -> url."/templates/images/i04h.png);\"";
			$block['content_top']['bg'] = "bar04.gif";
			$block['content_top']['height'] = 6;
			$block['content_top']['type'] = "nws";
			break;
		case "QA":
			$block['btn_addcss']['QA'] = "style=\"background-image:url(".$currconfig -> url."/templates/images/i05h.png);\"";
			$block['content_top']['bg'] = "bar05.gif";
			$block['content_top']['height'] = 6;
			$block['content_top']['type'] = "nws";
			break;
		case "regwizard":
			$block['btn_addcss']['regwizard'] = "style=\"background-image:url(".$currconfig -> url."/templates/images/i06h.png);\"";
			$block['content_top']['bg'] = "bar06.gif";
			$block['content_top']['height'] = 6;
			$block['content_top']['type'] = "nws";
			break;
		case "aboutus":
			$block['btn_addcss']['aboutus'] = "style=\"background-image:url(".$currconfig -> url."/templates/images/i07h.png);\"";
			$block['content_top']['bg'] = "bar07.gif";
			$block['content_top']['height'] = 6;
			$block['content_top']['type'] = "nws";
			break;
		default:
			$block['content_top']['bg'] = "bar00.gif";
			$block['content_top']['height'] = 6;
			$block['content_top']['type'] = "ws";
	}
	
	// Step2. Process the button on status bar
	
	
	// Step3. Return Block
	return $block;
}

?>
