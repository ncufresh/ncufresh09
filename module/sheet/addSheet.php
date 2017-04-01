<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}

$currdb->query("UPDATE `".$currdb->prefix("sheet_sheet")."` SET public='1' WHERE SN='".$_GET['sno']."'");

_redirect("index.php");
?>