<?php
if(!defined("MAINFILE_INCLUDED"))
	exit();

$tq_list_src = $currdb -> query("SELECT `TQno`, `TQtitle` FROM `".($currdb -> prefix("qa_tenquest"))."` ORDER BY `TQno` ASC");
$tq_list_arr = array();
while($tq_list_processing = $currdb -> fetch_array($tq_list_src))
{
	array_push($tq_list_arr, $tq_list_processing);
}
?>