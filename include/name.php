<?php

require_once '../mainfile.php';

$currtpl->setndisplay();

if(isset($_POST['name']) && $curruser->isguest()) 
{
	if(trim($_POST['name']) != $_POST['name'] || preg_file(ROOT_PATH.'/etc/badname', $_POST['name']))
		echo '暱稱禁止使用';
	else
		echo 'true';
}
else
	_redirect(URL);

?>
