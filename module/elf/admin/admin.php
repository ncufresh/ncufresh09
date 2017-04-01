<?php

require_once '../../../mainfile.php';

if(!$currmodule->isadmin($curruser)) _redirect();

if($_POST['http'])
{
	if(is_array($_POST['http']['del']))
		foreach($_POST['http']['del'] as $url)
			elf_rmhttp($url);

	if(is_array($_POST['http']['data']))
	{
		foreach($_POST['http']['data'] as $k=>$v)
			elf_modhttp($k, $v);
	}

	if(!empty($_POST['http']['url']))
		elf_addhttp($_POST['http']['url']);
}

$https = elf_gethttp();

$sql = "SELECT count(DISTINCT `uno`) as 'count' FROM `".$currdb->prefix('elf')."`";
$result = $currdb->query($sql);
list($maxpage) = $currdb->fetch_array($result);
$pagesize = 100;
$maxpage = ceil($maxpage/$pagesize);
$page = $_GET['page'];
if($page <= 0 || $page > $maxpage) $page = 1;
$plink = _multipage($page, $maxpage, URL.'/module/elf/admin/admin.php');

$sql = "SELECT `uno`, count(`pic`) as 'count' FROM `".$currdb->prefix('elf')."` GROUP BY `uno` ORDER BY `count` DESC, `uno` ASC LIMIT ".($page-1)*$pagesize.", $pagesize";
$result = $currdb->query($sql);
$userdata = array();
while($vars = $currdb->fetch_array($result))
{
	$userdata[] = $vars;
}

$currtpl->assign('plink', $plink);
$currtpl->assign('https', $https);
$currtpl->assign('userdata', $userdata);
$currtpl->display('admin.htm');

?>
