<?php
require_once("../../mainfile.php");
	
if (!$currmodule -> isadmin($curruser))
{
	$_POST['insert'] = "false";
	$_POST['update'] = "false";
	$_POST['delete'] = "false";
}
if ($_POST['insert'] == "true" && is_uploaded_file($_FILES['video']['tmp_name']) && is_uploaded_file($_FILES['low']['tmp_name']) && is_uploaded_file($_FILES['image']['tmp_name']))
{
    $items_DIR = "items";

    $video_sec = explode(".", $_FILES['video']['name']);
    $video_sec = $video_sec[count($video_sec)-1];
    $video_name = date("YmdHis") . "." . $video_sec;
    copy($_FILES['video']['tmp_name'], $items_DIR . "/" . $video_name);
	$video_name = $items_DIR . "/" . $video_name;
	
	$low_sec = explode(".", $_FILES['low']['name']);
    $low_sec = $low_sec[count($low_sec)-1];
    $low_name = date("YmdHis") . "_." . $low_sec;
    copy($_FILES['low']['tmp_name'], $items_DIR . "/" . $low_name);
	$low_name = $items_DIR . "/" . $low_name;
	
	$image_sec = explode(".", $_FILES['image']['name']);
	$image_sec = $image_sec[count($image_sec)-1];
	$image_name = date("YmdHis") . "." . $image_sec;
	copy($_FILES['image']['tmp_name'], $items_DIR . "/" . $image_name);
	$image_name = $items_DIR . "/" . $image_name;


	$sql = "INSERT INTO `workv1_video` (name, content, size, video, low, image)  VALUES ('" . $_POST['name'] . "', '" . $_POST['content'] . "', '" . $_FILES['video']['size'] . "', '" . $video_name . "', '" . $low_name . "', '" . $image_name . "')";
	$currdb -> query($sql);
	
	$_POST['content'] = nl2br($_POST['content']);
}


if ($_POST['update'] == "true")
{
	$items_DIR = "items";

    $video_sec = explode(".", $_FILES['video']['name']);
    $video_sec = $video_sec[count($video_sec)-1];
    $video_name = date("YmdHis") . "." . $video_sec;
    copy($_FILES['video']['tmp_name'], $items_DIR . "/" . $video_name);
	$video_name = $items_DIR . "/" . $video_name;
	
	$low_sec = explode(".", $_FILES['low']['name']);
    $low_sec = $low_sec[count($low_sec)-1];
    $low_name = "l_" . date("YmdHis") . "." . $low_sec;
    copy($_FILES['low']['tmp_name'], $items_DIR . "/" . $low_name);
	$low_name = $items_DIR . "/" . $low_name;
	
	$image_sec = explode(".", $_FILES['image']['name']);
	$image_sec = $image_sec[count($image_sec)-1];
	$image_name = date("YmdHis") . "." . $image_sec;
	copy($_FILES['image']['tmp_name'], $items_DIR . "/" . $image_name);
	$image_name = $items_DIR . "/" . $image_name;
	
	
	$sql = "UPDATE `workv1_video` SET `name` = '" . $_POST['name'] . "', `content` = '" . $_POST['content'] . "', `size` = '" . $_FILES['video']['size'] . "', `video` = '" . $video_name . "', `low` = '" . $low_name . "', `image` = '" . $image_name . "' WHERE `no` = '" . $_POST['no'] . "'";
	$currdb -> query($sql);
	
	$_POST['content'] = nl2br($_POST['content']);
}


if ($_POST['delete'] == "true")
{
	$currdb -> query("DELETE FROM `workv1_video` WHERE `no` = '" . $_POST['no'] . "'");
}

header("Refresh:5; URL=admin.php");


$currtpl -> assign('name', $_POST['name']);
$currtpl -> assign('video', $_FILES['video']);
$currtpl -> assign('low', $_FILES['low']);
$currtpl -> assign('image', $_FILES['image']);
$currtpl -> assign('content', $_POST['content']);
$currtpl -> display('fileget.tpl.htm');
?>