<?php
require_once("../../mainfile.php");

if ($currmodule->isadmin($curruser))
{	
	if(isset($_GET['newpost']))//發文
	{
		if(isset($_GET['action']))
		{
			$currdb -> query("INSERT INTO `".$currdb -> prefix("news_post")."` (news_no,title,content,date,top,poster_no) VALUES ('','".htmlencode($_POST['title'])."','".htmlencode($_POST['content'])."','".mktime()."','".$_POST['top']."','".$curruser->uno."')");
			
			if(!empty($_FILES['upfile']['tmp_name']))//附加檔案
			{
				$news_no = $currdb -> insert_id();

				$news = $currdb -> query("SELECT * FROM `".($currdb -> prefix("news_post"))."` WHERE news_no = ".$news_no."");
				$news = $currdb -> fetch_array($news);
				mkdir("upfile/fileofnews".$news['news_no']);
				$dir = "upfile/fileofnews".$news['news_no']."/";
				move_uploaded_file($_FILES['upfile']['tmp_name'], $dir.$_FILES['upfile']['name']);
			
				$currdb -> query("INSERT INTO `".$currdb -> prefix("news_upfile")."` (fno,news_no,fname) VALUES ('','".$news['news_no']."','".$_FILES['upfile']['name']."')");
			}//附加檔案
			
			if(!empty($_POST['sendmail']))
				send_all($_POST['title'],$_POST['content']);
						
			_redirect("index.php");
		}	
		else
			$currtpl->display("news_post.htm");
	}
	
	else if(isset($_GET['edit']))//編輯
	{
		if(isset($_GET['action']))
		{
			if(!empty($_FILES['upfile']['tmp_name']))//附加檔案
			{
				$news = $currdb -> query("SELECT * FROM `".($currdb -> prefix("news_post"))."` WHERE news_no = ".$_GET['news_no']."");
				$news = $currdb -> fetch_array($news);
				if(is_dir("upfile/fileofnews".$news['news_no']))
				{
					$dir = "upfile/fileofnews".$news['news_no']."/";
				}
				else
				{
					mkdir("upfile/fileofnews".$news['news_no']);
					$dir = "upfile/fileofnews".$news['news_no']."/";
				}
				move_uploaded_file($_FILES['upfile']['tmp_name'], $dir.$_FILES['upfile']['name']);
			
				$currdb -> query("INSERT INTO `".$currdb -> prefix("news_upfile")."` (fno,news_no,fname) VALUES ('','".$news['news_no']."','".$_FILES['upfile']['name']."')");
			}//附加檔案
			
			if(isset($_GET['del_file']))//刪除附加檔案??
			{
				$file = $currdb -> query("SELECT * FROM `".$currdb -> prefix("news_upfile")."` WHERE news_no = ".$_GET['news_no']." AND fname = ".$_POST['filename']."");
				while($temp = $currdb -> fetch_array($file))
				{
					unlink("upfile/fileofnews".$_GET['news_no']."/".$temp['fname']);
				}
			}

			$currdb -> query("UPDATE `".$currdb -> prefix("news_post")."` set title = '".htmlencode($_POST['title'])."', content = '".htmlencode($_POST['content'])."', top = '".$_POST['top']."' ,poster_no='".$curruser->uno."' WHERE news_no = ".$_GET['news_no']."");

			if(!empty($_POST['sendmail']))
				send_all($_POST['title'],$_POST['content']);

			_redirect("index.php");
		}
		else
		{
			$news = $currdb -> query("SELECT * FROM `".($currdb -> prefix("news_post"))."` WHERE news_no = ".$_GET['news_no']."");
			$file = $currdb -> query("SELECT * FROM `".($currdb -> prefix("news_upfile"))."` WHERE news_no = ".$_GET['news_no']."");
			$news = $currdb -> fetch_array($news);

			$upfiled = array();
		
			while($temp = $currdb -> fetch_array($file))
			{
				array_push($upfiled, $temp);
			}

			$news_no = $_GET['news_no'];
			$title = $news['title'];
			$content = $news['content'];
			$top = $news['top'];

			$currtpl -> assign('news_no',$news_no);
			$currtpl -> assign('title',$title);
			$currtpl -> assign('content',$content);
			$currtpl -> assign('top',$top);
			$currtpl -> assign('upfiled',$upfiled);					
		
			$currtpl -> display("news_edit.htm");
		}
	}
	
	else if(isset($_GET['del']))//刪除
	{
		$file = $currdb -> query("SELECT * FROM `".$currdb -> prefix("news_upfile")."` WHERE news_no = ".$_GET['news_no']."");
		if($currdb -> num_rows($file) != 0)
		{
			while($temp = $currdb -> fetch_array($file))
			{
				unlink("upfile/fileofnews".$_GET['news_no']."/".$temp['fname']);
			}
			rmdir("upfile/fileofnews".$_GET['news_no']);//資料夾必須是空的
		}
		$currdb -> query("DELETE FROM `".$currdb -> prefix("news_post")."` WHERE news_no = ".$_GET['news_no']."");
		$currdb -> query("DELETE FROM `".$currdb -> prefix("news_upfile")."` WHERE news_no = ".$_GET['news_no']."");
		_redirect("index.php");
	}
}
?>
