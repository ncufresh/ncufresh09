<?php

if(!defined('MAINFILE_INCLUDED')) exit();

function block_elf_catch($dirname = '')
{
	if($GLOBALS['curruser']->isguest()) return array();

	$block = array();
	
	$own_pics = elf_get();
	
	if(($http = elf_check()) && ($block['show'] = elf_random($http['gilu'])))
	{
		$pics = explode(',', $http['piclimit']);
		$pics = array_values(array_diff($pics, $own_pics));
		if(count($pics) == 0)
		{
			$block['show'] = false;
		}
		else
		{
			$pic_num = intval(mt_rand(0, count($pics)-1));
			$block['pic'] = $pics[$pic_num];
			$block['h'] = mt_rand(-700, 160);
			$block['v'] = mt_rand(-200, 200);
			$block['key'] = $_SESSION['elf_key'] = $block['pic'].elf_key();
			$_SESSION['elf_url'] = $_SERVER['REQUEST_URI'];
		}
	}

	return $block;
}

?>
