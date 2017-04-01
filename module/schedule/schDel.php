<?php 

require_once '../../mainfile.php';

$sno = intval($_GET['sno']);

$result = $currdb->query("
	SELECT * FROM `".$currdb->prefix('schedule_sch')."` s 
	INNER JOIN `".$currdb->prefix('schedule_act')."` a ON s.`ano`=a.`ano` 
	WHERE `sno`='$sno'
");

$vars = $currdb->fetch_array($result);

if(is_array($vars) && (
	$vars['owner_type'] == 'U' && $vars['owner_no'] == $curruser->uno ||
	$vars['owner_type'] == 'G' && $curruser->g_handler->isGroupAdmin($vars['owner_no'], $curruser->uno) 
	)
)
{
	schDel($sno);

	$result = $currdb->query("SELECT count(*) as count FROM `".$currdb->prefix('schedule_sch')."` WHERE `ano`='{$vars['ano']}");
	$vars = $currdb->fetch_array($result);
	if($vars['count'] == 0) actDel($vars['ano']);

	_redirect();
}
else
	dies('error link');

?>
