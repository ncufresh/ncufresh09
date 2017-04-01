<?
require_once("../../mainfile.php");

$result = $currdb->query("select csn from `".$currdb->prefix("must_category")."` where csn = '16';");
$data = $currdb->fetch_array($result);
$currdb->query(

?>
