<?php
if (!defined("MAINFILE_INCLUDED"))
	exit();
	
function HomeAd($dirname = null)
{
	$block = array();
	
	/*----Configure Area begin----*/
	$block['img']['0']['img'] = URL."/templates/images/logo/e-mail2.jpg";
	$block['img']['0']['url'] = "http://www.cc.ncu.edu.tw/net/new.htm";
	
	$block['img']['1']['img'] = URL."/templates/images/logo/course.jpg";
	$block['img']['1']['url'] = "http://portal.ncu.edu.tw";

	$block['img']['2']['img'] = URL."/templates/images/logo/number.jpg";
	$block['img']['2']['url'] = "http://www4.is.ncu.edu.tw/register/check/stdno_check.php";
	/*----Configure Area End------*/
	
	return $block;
}
?>
