<?
require_once("../../mainfile.php");

$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_topic")."`");

while ($tmp = $currdb->fetch_array($result))
	echo "<a href=\"".URL."/module/".$currmodule->name."/view.php?tno=".$tmp["tno"]."\">".$tmp["title"]."</a><br />";
?>
