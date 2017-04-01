<?php

require_once '../../mainfile.php';

if($curruser->isadmin()):

$sql = "SELECT `uno`,`pic` FROM `".$currdb->prefix('user')."`";

$result = $currdb->query($sql);

while($vars = $currdb->fetch_array($result))
{
	$sql = "INSERT INTO `".$currdb->prefix('elf')."`(`uno`,`pic`,`url`) VALUES('{$vars['uno']}', '{$vars['pic']}', '^firstPic$')";
	$currdb->query($sql);
	
	/* for worker*/
	$gno = $curruser->g_handler->getGroupByEngName('ncufresh');
	if($curruser->g_handler->inGroup($gno,$vars['uno']))
	{
		$sql = "INSERT INTO `".$currdb->prefix('elf')."`(`uno`,`pic`,`url`) VALUES('{$vars['uno']}', 'R', '^firstPic$')";
		$currdb->query($sql);
	}
}

endif;

?>
