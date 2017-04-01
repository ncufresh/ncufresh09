<?php
if(!defined("MAINFILE_INCLUDED"))
	exit();

function qa_block($dirname = NULL)
{
	global $currdb;
	$block = array();
	$block['qa_arr'] = array();
	
	$qa_src = $currdb -> query("SELECT `Qno`,`Qtitle`,`Qtime` FROM `".($currdb -> prefix("qa_question"))."` WHERE `Qactive` != 0 ORDER BY `Qtime` DESC LIMIT 0,5");
	while($qa_src_processing = $currdb -> fetch_array($qa_src))
	{
		if(mb_strlen($qa_src_processing['Qtitle']) > 32)
		{
			$qa_src_processing['Qtitle'] = mb_substr($qa_src_processing['Qtitle'], 0, 24)."...";
		}
		$qa_src_processing['Qtime'] = date("Y-m-d", $qa_src_processing['Qtime']);
		
		array_push($block['qa_arr'], $qa_src_processing);
	}

	return $block;
}
?>
