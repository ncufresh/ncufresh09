<?php

require_once '../../mainfile.php';

$type = $_GET['type'];
if(!in_array($type, array('board', 'topic', 'reply'))) _redirect();

$del = $_GET['del'];
if(is_array($del))
{
	foreach($del as $no)
		func_do_unsubscr($type, $no);
}
_redirect();

?>
