<?php
$link = mysql_connect("localhost", "root", "123456") or die(mysql_error());
mysql_select_db("work2009", $link);
mysql_query("SET NAMES utf8");

switch ($_GET['act'])
{
	case'Q':
		$search = mysql_query("SELECT * FROM `workv1_video` WHERE `no` = " . $_GET['no'] . "");
		$data = mysql_fetch_array($search);
		$data['content'] = nl2br($data['content']);
		
		echo $data['no'];
		echo "||";
		echo $data['name'];
		echo "||";
		echo $data['content'];
		echo "||";
		echo $data['image'];
		break;
	case'U':
		$_GET['page'] = intval($_GET['page']);
		$page = $_GET['page'] - 1;
		$search = mysql_query("SELECT * FROM `workv1_video` ORDER BY `no` DESC");
		$num = mysql_num_rows($search);
		if ($page < 0)
		{
			$page = 0;
		}
		$search = mysql_query("SELECT * FROM `workv1_video` ORDER BY `no` DESC LIMIT " . $page . ", 3");
		$data_array = array();
		while ($data_get = mysql_fetch_array($search))
		{
			array_push($data_array, $data_get);
		}
		echo $page;
		echo "||";
		echo $data_array[0]['image'];
		echo "||";
		echo $data_array[1]['image'];
		echo "||";
		echo $data_array[2]['image'];
		echo "||";
		echo $data_array[0]['no'];
		echo "||";
		echo $data_array[1]['no'];
		echo "||";
		echo $data_array[2]['no'];
		break;
	case'D':
		$_GET['page'] = intval($_GET['page']);
		$page = $_GET['page'] + 1;
		$search = mysql_query("SELECT * FROM `workv1_video` ORDER BY `no` DESC");
		$num = mysql_num_rows($search);
		if ($page > $num - 3)
		{
			$page = $page - 1;
		}
		$search = mysql_query("SELECT * FROM `workv1_video` ORDER BY `no` DESC LIMIT " . $page . ", 3");
		$data_array = array();
		while ($data_get = mysql_fetch_array($search))
		{
			array_push($data_array, $data_get);
		}
		echo $page;
		echo "||";
		echo $data_array[0]['image'];
		echo "||";
		echo $data_array[1]['image'];
		echo "||";
		echo $data_array[2]['image'];
		echo "||";
		echo $data_array[0]['no'];
		echo "||";
		echo $data_array[1]['no'];
		echo "||";
		echo $data_array[2]['no'];
		break;
}
?>