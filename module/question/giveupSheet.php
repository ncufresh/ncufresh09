<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser))	_redirect("index.php");


$Qid=$_GET['Qid'];

$currdb->query("DELETE FROM `".$currdb->prefix("question_topic")."` WHERE id = ".$Qid);
$currdb->query("DELETE FROM `".$currdb->prefix("question_question")."` WHERE id = ".$Qid);
$currdb->query("DELETE FROM `".$currdb->prefix("question_chooses")."` WHERE id = ".$Qid);

_redirect("index.php");
?>