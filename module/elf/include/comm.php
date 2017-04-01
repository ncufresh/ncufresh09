<?php

if(!defined('MAINFILE_INCLUDED'))
	exit();

// for catch elf
function elf_get($uno = '')
{
	global $currdb, $curruser;

	if($uno == '') $uno = $curruser->uno;

	$sql = "SELECT * FROM `".$currdb->prefix('elf')."` WHERE `uno`='$uno' ORDER BY `pic` ASC";
	$result = $currdb->query($sql);
	
	$pics = array();
	while($vars = $currdb->fetch_array($result))
	{
		$pics[] = $vars['pic'];
	}

	return $pics;
}
function elf_save($pic, $url)
{
	global $currdb, $curruser;

	$url = str_replace(URL.'/', '', $url);

	$sql = "INSERT INTO `".$currdb->prefix('elf')."`(`uno`,`pic`,`url`) VALUES('{$curruser->uno}', '$pic', '$url')";

	$currdb->query($sql);
}
function elf_rm($pic)
{
	global $currdb, $curruser;

	$sql = "DELETE FROM `".$currdb->prefix('elf')."` WHERE `pic`='$pic' AND `uno`='{$curruser->uno}'";

	$currdb->query($sql);
}
function elf_get_full()
{
	$pics = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'R');

	$own_pics = elf_get();

	$i = $j = 0;
	while(isset($pics[$i]) && isset($own_pics[$j]))
	{
		if($pics[$i] < $own_pics[$j]) 
		{
			$pics[$i] .= 'N';
			$i++;
		}
		else
		{
			$i++;
			$j++;
		}
	}

	$count = count($pics);
	while($i < $count) $pics[$i++] .= 'N';

	return $pics;
}

// for admin
function elf_gethttp()
{
	global $currdb;

	$sql = "SELECT * FROM `".$currdb->prefix('elf_http')."` ORDER BY `url`";

	$result = $currdb->query($sql);
	$https = array();

	while($vars = $currdb->fetch_array($result))
	{
		$https[] = $vars;
	}

	return $https;
}
function elf_addhttp($url)
{
	global $currdb;

	$url = mysql_real_escape_string(htmlencode($url));

	$sql = "INSERT INTO `".$currdb->prefix('elf_http')."`(`url`, `gilu`) VALUES('$url', '1')";

	$currdb->query($sql);
}
function elf_rmhttp($url)
{
	global $currdb;

	$url = mysql_real_escape_string($url);

	$sql = "DELETE FROM `".$currdb->prefix('elf_http')."` WHERE `url`='$url'";

	$currdb->query($sql);
}
function elf_modhttp($url, $http)
{
	global $currdb;

	$sql = "UPDATE `".$currdb->prefix('elf_http')."` SET `gilu`='{$http['gilu']}' , `piclimit`='{$http['piclimit']}' , `ord`='{$http['ord']}' WHERE `url`='$url'";
	
	$currdb->query($sql);
}

// for msg
function elf_ismailed()
{
	global $currdb, $curruser;

	$sql = "SELECT * FROM `".$currdb->prefix('elf_mail')."` WHERE `uno`='$curruser->uno'";

	$result = $currdb->query($sql);

	return $currdb->num_rows($result) > 0;
}
function elf_mail()
{
	global $currdb, $curruser;

	$sql = "INSERT INTO `".$currdb->prefix('elf_mail')."`(`uno`) VALUES('$curruser->uno')";

	$currdb->query($sql);
}

// for forall
function elf_random($num)
{
	return mt_rand(1, 100) > (100 - $num) ? true : false;
}
function elf_check($url = '')
{
	global $currdb, $curruser;

	if($url == '')
		$url = htmlencode(str_replace(URL.'/', '', $_SERVER["REQUEST_URI"]));

	$sql = "SELECT * FROM `".$currdb->prefix('elf')."` WHERE `uno`='$curruser->uno' AND `url`='$url'";
	$result = $currdb->query($sql);
	if($currdb->num_rows($result) > 0) return false;

	$sql = "SELECT * FROM `".$currdb->prefix('elf_http')."` WHERE '$url' REGEXP `url` ORDER BY `ord` DESC LIMIT 0,1";
	
	$result = $currdb->query($sql);
	$vars = $currdb->fetch_array($result);

	return $vars;
}

function elf_keycheck()
{
	return $_GET['pwd'] == $_SESSION['elf_key_o'];
}
function elf_key()
{
	return $_SESSION['elf_key'];
}

$_SESSION['elf_key_o'] = $_SESSION['elf_key'];
$_SESSION['elf_key'] = substr(md5(mt_rand(0,3250).'seedpassword'.time()), 2, 15);

?>
