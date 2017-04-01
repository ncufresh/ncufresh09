<?
if(!defined("MAINFILE_INCLUDED"))
	exit();

function listGroup($dirname = NULL){
	global $currdb, $curruser, $currglevel;
	
	$groups = $currdb->query("SELECT g.gno ,g.name,m.level FROM `".$currdb->prefix("gmember")."`m LEFT JOIN `".$currdb->prefix("group")."`g ON m.gno=g.gno WHERE m.uno='".$curruser->uno."' ORDER BY LEVEL DESC");

	while($tmp = $currdb->fetch_array($groups)){
		$tmp["level"] = $currglevel[$tmp["level"]];
		$block["group"][] = $tmp;
	}
	return $block;
}
?>
