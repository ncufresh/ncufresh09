<?php
require_once("../../mainfile.php");
if(!$currmodule -> isadmin($curruser))
	exit();
$currtpl->setndisplay();
$selection = $_GET['selection'];

if(empty($_GET['type'])){
	$CSM_SQLResource=$currdb->query("SELECT * FROM `".$currdb->prefix('campus_submenu')."` 
									WHERE CSMno=".$selection."") or die("?!");
	$CSM_Fetch = $currdb->fetch_array($CSM_SQLResource);
	$output = "<textarea id=\"cp_editcontent\" rows=\"5\" cols=\"115\">".$CSM_Fetch['Content']."</textarea>";
	$upload_file_html_str = "<br /><form name=\"form\" action=\"\" method=\"POST\" enctype=\"multipart/form-data\">";
	$upload_file_html_str.= "<br /><input id=\"fileToUpload\" type=\"file\" size=\"45\" name=\"fileToUpload\">";
	$upload_file_html_str.= "<button class=\"button\" id=\"buttonUpload\" onclick=\"return ajaxFileUpload();\">Upload</button>";
	//$output .= $upload_file_html_str;
	$output .="|||<input type=\"button\" value=\"儲存文章\" onclick=\"saveMode(".$CSM_Fetch['CSMno'].");\"/>";
}
else if($_GET['type']=="save"){
	$currdb->query("UPDATE `".$currdb->prefix('campus_submenu')."` SET `Content` = '".$_GET['newcontent']."' 
					WHERE CSMno=".$selection."") or die("?!");

	$output = $_GET['newcontent'];
	$output.="|||<input type=\"button\" value=\"編輯文章\" onclick=\"editMode(".$selection.");\"/>";
}
echo $output;

?>