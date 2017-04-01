<?php
if(!defined("MAINFILE_INCLUDED"))
	exit();

function indexNews($dirname = NULL)
{
	global $currdb, $curruser;
	
	$news = $currdb -> query("SELECT * FROM `".$currdb -> prefix("news_post")."` ORDER BY top DESC, date DESC LIMIT 0, 5");

	while($tmp = $currdb -> fetch_array($news))
	{
		$tmp['date'] = date("Y-m-d", $tmp['date']);
		$tmp['poster'] = $GLOBALS['curruser']->u_handler->getuserbyno($tmp['poster_no'])->name;
		$block["news"][] = $tmp;
	}
	return $block;
}
?>
