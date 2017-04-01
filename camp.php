<?php
require_once('./mainfile.php');
$currtpl->setndisplay();
$_GET['page'] = intval($_GET['page']);
if($_GET['page'] < 1)
{
	$_GET['page'] = 1;
}
else if($_GET['page'] >3)
{
	$_GET['page'] = 3;
}
$currtpl->display('camp'.$_GET['page'].'.html');
?>
