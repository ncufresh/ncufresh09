<?
require_once("./mainfile.php");

if ($curruser->isguest())
	$currtpl->display("login.htm");
else
	_redirect();
?>
