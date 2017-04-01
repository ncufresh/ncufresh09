<?php
require_once("../../mainfile.php");

if(!$currmodule->isadmin($curruser))	_redirect("index.php");

$Qid=$_GET['Qid'];
$sig=$_GET['sig'];

$currdb->query("DELETE FROM `".$currdb->prefix("question_chooses")."` WHERE id = '".$Qid."' && gid = '".$sig."'");
$currdb->query("DELETE FROM `".$currdb->prefix("question_question")."` WHERE id = '".$Qid."' && gid = '".$sig."'");

$qstdb=$currdb->query("SELECT * FROM `".$currdb->prefix("question_question")."` WHERE id = '".$Qid."' && gid > '".$sig."'");

while($qstdb2=$currdb->fetch_array($qstdb))
{
	$t=$qstdb2['gid'];
	$currdb->query("UPDATE `".$currdb->prefix("question_question")."` SET gid = '".($t-1)."' WHERE id = '".$Qid."' && gid = '".($t)."'");
	$currdb->query("UPDATE `".$currdb->prefix("question_chooses")."` SET  gid = '".($t-1)."' WHERE id = '".$Qid."' && gid = '".($t)."'");
}

_redirect("editSheet.php?Qid=".$Qid);

?>
