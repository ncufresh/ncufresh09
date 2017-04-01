<?php
require_once("../../mainfile.php");

if(!empty($_GET['news_no']))
{
	function replace($str)
	{
    	$str = ereg_replace("[a-zA-Z0-9_]*@[a-zA-Z0-9_.-]*", "<a href=\"mailto:\\0\">\\0</a>", $str);
    	$str = ereg_replace("http://[a-zA-Z0-9~_/?&%.-=]*", "<a href=\"\\0\" target=\"_blank\">\\0</a>", $str);
		$str = nl2br($str);
    	return $str;
	}
			
	$news = $currdb -> query("SELECT * FROM `".$currdb -> prefix("news_post")."` WHERE news_no=".$_GET['news_no']);
	$file = $currdb -> query("SELECT * FROM `".$currdb -> prefix("news_upfile")."` WHERE news_no=".$_GET['news_no']);
	
	if($currdb -> num_rows($news) != 0)
	{
		$news_display = $currdb -> fetch_array($news);
		
		$upfiled = array();
		
		while($temp = $currdb -> fetch_array($file))
		{
			array_push($upfiled, $temp);
		}

		$news_no = $_GET['news_no'];
		$news_display['content'] = replace($news_display['content']);

		$currtpl -> assign('news_display',$news_display);
		$currtpl -> assign('upfiled',$upfiled);					
		$currtpl -> assign('news_no',$news_no);
	}
}
$currtpl -> display("news_showsingle.htm");
?>