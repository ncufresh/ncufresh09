<?php
require_once('mainfile.php');

$currtpl -> setndisplay();

if($_GET['request_id']==1)
{
	$currtpl -> display('lnk_block_ajax_1.htm');
}
else
if($_GET['request_id']==2)
{
	$currtpl -> display('lnk_block_ajax_2.htm');
}
?>