<?
require_once("../../mainfile.php");

$_GET['gno'] = intval($_GET['gno']);

$isAdmin = $currmodule->isadmin($curruser);

 $result = $currdb->query("SELECT g.gno FROM `".$currdb->prefix("gmember")."` m INNER JOIN `".$currdb->prefix("group")."` g ON g.gno=m.gno AND m.level >= 3 WHERE g.gno='".$_GET["gno"]."' AND (m.uno='".$curruser->uno."' OR ".$isAdmin.")");

if ($currdb->num_rows($result) > 0)
{
	memberDelete($_GET['gno']);
	$currdb->query("DELETE FROM `".$currdb->prefix("group")."` WHERE gno='".$_GET['gno']."'");	
			
	_redirect("index.php");
}
else
	_redirect();
?>
