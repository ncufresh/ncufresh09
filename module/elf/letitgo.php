<?php

require_once '../../mainfile.php';

$pic = $_GET['pic'];

$own_pics = elf_get();

if(in_array($pic, $own_pics))
{
	elf_rm($pic);
}

_redirect();

?>
