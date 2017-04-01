<?php
require_once("../../mainfile.php");

if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}


$sno=$_GET['sno'];
$sig=$_GET['sig'];

$qstdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp = '".$sno."' AND SNinGrp = '".$sig."' ");
$qstdb2=$currdb->fetch_array($qstdb);
$qid=$qstdb2['qid'];

$currdb->query("DELETE FROM `".$currdb->prefix("sheet_chooses")."` WHERE SNofQst = '".$qid."'");
$currdb->query("DELETE FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp = '".$sno."' AND SNinGrp = '".$sig."'");

$qstdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp = '".$sno."' AND SNinGrp > '".$sig."' ");

while($qstdb2=$currdb->fetch_array($qstdb)){
	$qstdb2=$currdb->fetch_array($qstdb);
	$qid = $qstdb2['qid'];
	$sig = $qstdb2['SNinGrp'] - 1;
	$currdb->query("UPDATE `".$currdb->prefix("sheet_quests")."` SET SNinGrp = '".$sig."' WHERE qid = '".$qid."'");
}

_redirect("editSheet.php?sno=".$sno);

?>
