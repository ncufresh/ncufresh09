<?
require_once("../../mainfile.php");

if ($curruser->isguest())
	_redirect();

$_GET["gno"] = intval($_GET["gno"]);

$criteria = new CriteriaCompo(new Criteria("gno", $_GET["gno"]));
$criteria->add(new Criteria("uno", $curruser->uno));
$criteria->add(new Criteria("level", 3));
$result = $currdb->query("SELECT * FROM `".$currdb->prefix("gmember")."` WHERE ".$criteria->render());

if (!$currmodule->isadmin($curruser) && $currdb->num_rows($result) != 1)
        _redirect();


//if(!in_array($_GET["gno"],groupGet(3)))
//	_redirect();

	$criteria = new CriteriaCompo(new Criteria("m.gno", $_GET["gno"]));

	$orderby = ($_GET["order"] == "level") ? "level ASC" : "itime DESC";
	$result = $currdb->query("SELECT m.*, u.uid FROM `".$currdb->prefix("gmember")."` m LEFT JOIN `".$currdb->prefix("user")."` u ON m.uno=u.uno  WHERE ".$criteria->render()." ORDER BY ".$orderby);

	while ($tmp = $currdb->fetch_array($result))
	{
		$tmp["itime"] = date("Y-m-d H:i:s", $tmp["itime"]);
		$gmember[] = $tmp;
	}

	//$p = _multipage($page, $maxpage, URL."/module/".$currmodule->name."/member.php");
	
	$currtpl->assign("level", $currglevel);

	$currtpl->assign("gmember", $gmember);
	$currtpl->assign("gno", $_GET["gno"]);
	$currtpl->display("member.htm");
?>
