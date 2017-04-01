<?
require_once("../mainfile.php");

if (!$curruser->isguest())
{
	$currtpl->setndisplay();

	$curruser->u_handler->freshonlinetime($curruser->uid);

	$msg_handler =& gethandler("msg");

	echo count($msg_handler->getunreads());
}
?>
