<?php
//session_start();
require_once("../../mainfile.php");
$currtpl->setndisplay();
$curruser->isguest();
if($curruser->isguest()){
	_savePage(URL.'/include/user.php?login_form=1');	
	}

else{
	$result=$currdb->query("SELECT * from `".$currdb->prefix("shop")."` WHERE type = 'puzzle_bag' ORDER BY `ino` DESC");
	$result_tem = array();
	
	$total = $currdb->num_rows($result);
	$num = 6;
	$p=(empty($_GET['p']))?1:$_GET['p'];
	$i=0;
	$start = ($p-1)*$num+1;
	$end = $p*$num;
	
	while($data=$currdb->fetch_array($result)){
		$i++;
		if($i>=$start and $i<=$end){
			$data['deric'] = nl2br($data['deric']);
			$data['skill'] = nl2br($data['skill']);
			array_push($result_tem, $data);
			}
		}
		
	$n = ceil($total/$num);
	$page_tem = array();
	for($a=1;$a<=$n;$a++){
		$page_tem[]="{$_SERVER['PHP_SELF']}?p={$a}";
		}
	$pre = $_GET['p'] - 1;
	$ne = $_GET['p'] + 1;
	if($pre >= 1) $page_before = "{$_SERVER['PHP_SELF']}?p={$pre}";
	if($ne <= $n) $page_after = "{$_SERVER['PHP_SELF']}?p={$ne}";
	
	$money = $curruser->coins;

    $admin;
	if($curruser->isadmin())
    {
        $admin = 1;
    }
    else
    {
        $admin = 0;
    }

	$currtpl -> assign('contents',$result_tem);
	$currtpl -> assign('coin',$money);
	$currtpl -> assign('page',$page_tem);
	$currtpl -> assign('previous',$page_before);
	$currtpl -> assign('next',$page_after);
	$currtpl -> assign('admin',$admin);
	$currtpl -> display('items.tpl.htm');
	}
?>
