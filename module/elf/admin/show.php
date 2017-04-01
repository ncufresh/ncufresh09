<?php

require_once '../../../mainfile.php';

if(!$curruser->isadmin()) _redirect();

$sql = "SELECT * FROM `".$currdb->prefix('elf_mail')."` ORDER BY `time` ASC";

$result = $currdb->query($sql);

while($vars = $currdb->fetch_array($result))
{?>
<div><?=$vars['uno']?> :: <?=$vars['time']?></div>
<?
}
?>
