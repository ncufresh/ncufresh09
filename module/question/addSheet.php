<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}

$currdb->query("UPDATE `".$currdb->prefix("question_topic")."` SET public='1' WHERE id='".$_GET['Qid']."'");

_redirect("index.php");
?>