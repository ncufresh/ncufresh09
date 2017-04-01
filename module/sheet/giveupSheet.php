<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}

$sno=$_GET['sno'];

$qstdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quest")."` WHERE SNofGrp = '".$sno."'");

while($qstdb2=$currdb->fetch_array($qstdb)){
	$qid=$qstdb2['qid'];
	$currdb->query("DELETE FROM `".$currdb->prefix("sheet_chooses")."` WHERE SNofQst = '".$qid."'");
}


$currdb->query("DELETE FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp = ".$sno);
$currdb->query("DELETE FROM `".$currdb->prefix("sheet_sheet")."` WHERE SN = ".$sno);

_redirect("index.php");
?>