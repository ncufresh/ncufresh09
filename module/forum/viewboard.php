<?php
require_once("../../mainfile.php");
include_once("../../dep.php");
$ano = mysql_real_escape_string($_GET['ano']);
//$ano = addslashes($_GET['ano']);
$fno = mysql_real_escape_string($_GET['forum']);

$articalSQL = $currdb->query("SELECT * FROM
						 ( `".$currdb->prefix("forum_articals")."` FA LEFT JOIN
						   `".$currdb->prefix("user")."` USER ON FA.uno=USER.uno) 
						   WHERE FA.ano ='".$ano."'") or die(mysql_error());
$artical = $currdb->fetch_array($articalSQL);
$currdb->query("UPDATE `".$currdb->prefix("forum_redpoint")."`
					SET `redtime` = '".mktime()."'
					WHERE `ano`='".$ano."' AND `readuno`='".$curruser->uno."'");
if($artical['active']==0){
	echo "本文已被刪除";
	exit();
}
$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/viewboard.css');

$ReplyCount = $currdb->query("SELECT COUNT(*) FROM `".$currdb->prefix("forum_reply")."`
							  WHERE `ano` = '".$ano."' AND `active`=1") or die(mysql_error());
$ReplyCount = $currdb->fetch_array($ReplyCount);
$ReplyCount = $ReplyCount['COUNT(*)'];

$page=mysql_real_escape_string($_GET['page']);
$totalPages=ceil($ReplyCount/10);
if(empty($page))
	$page=1;
if($page>$totalPages)
	$page=1;

if(isset($page) && $page>0){
	//$HIGH = ceil($page)*10;
	$LOW = (ceil($page)-1)*10;
    $HIGH = 10;
}
else{
	$LOW=0;
	$HIGH=10;
}

$artical['HeadIcon'] = HeadIcon($artical['pic'],120);
$artical['content'] = nl2br(htmlencode($artical['content']));
$artical['department'] = $dep[$artical['department']];
$artical['time'] = date("Y/m/d H:i",$artical['time']);
if($artical['uno']==$curruser->uno)
	$artical['admin']=1;
else
	$atical['admin']=null;
$TopPoster = $artical;
$TopPoster['replys'] = $ReplyCount;
$TopPoster['Mail']=$currconfig->url."/msgsend.php?fno=".$TopPoster['uno'];

if($page==1)
    $currpagecss_1 = " VB_currpage";
elseif($page==$totalPages)
    $currpagecss_last = " VB_currpage";
$pager=null;
if($ReplyCount<11)
	$pager=null;
else{
	if($page>1){
	$pager.="<a href=\"viewboard.php?forum=".$fno."&ano=".$ano."&page=".($page-1)."\">
			<span class=\"pageTab\"><</span></a>";
	}
	$pager.="<a href=\"viewboard.php?forum=".$fno."&ano=".$ano."&page=1\">
			<span class=\"pageTab".$currpagecss_1."\">1</span></a>";
	if($page < 5)
		$pagerCount=2;
	else
		$pagerCount=$page-4;
	if($totalPages > 1){
		$loop=0;
		while($loop<8 && ($pagerCount < $totalPages)){
			$pager.="<a href=\"viewboard.php?forum=".$fno."&ano=".$ano."&page=".$pagerCount."\">
				<span class=\"pageTab";
            if($page==$pagerCount)
                    $pager.=" VB_currpage";
            $pager.="\">".$pagerCount."</span></a>";
			$loop++;
			$pagerCount++;
		}
	$pager.="<a href=\"viewboard.php?forum=".$fno."&ano=".$ano."&page=".$totalPages."\">
			<span class=\"pageTab$currpagecss_last\">".$totalPages."</span></a>";
	}
	if($page<$totalPages){
	$pager.="<a href=\"viewboard.php?forum=".$fno."&ano=".$ano."&page=".($page+1)."\">
			<span class=\"pageTab\">></span></a>";
	}
}
	

$VBReplySql = $currdb->query("SELECT * FROM
						  (`".$currdb->prefix("forum_reply")."` FR LEFT JOIN
						   `".$currdb->prefix("user")."` USER ON FR.uno=USER.uno) 
						   WHERE FR.ano ='".$ano."'
                           AND FR.active=1
						   LIMIT ".$LOW.",".$HIGH."") or die(mysql_error());
$FloorCounter=$LOW+1;
while($VBFetch = $currdb->fetch_array($VBReplySql)){
	$VBFetch['HeadIcon'] = HeadIcon($VBFetch['pic'],120);
	$VBFetch['content'] = nl2br(htmlencode($VBFetch['content']));
	$VBFetch['department'] = $dep[$VBFetch['department']];
	$VBFetch['time'] = date("Y/m/d H:i",$VBFetch['time']);
	$VBFetch['floor']=$FloorCounter."F";
	if(($FloorCounter == $ReplyCount) || ($FloorCounter%10)==0)
		$VBFetch['Last']=1;
	$VBReply[]=$VBFetch;
	$FloorCounter++;
	
}

$currtpl->assign('pager',$pager);
$currtpl->assign('fno',$fno);
$currtpl->assign('ano',$ano);
$currtpl->assign('TopPoster',$TopPoster);
$currtpl->assign('VBReply',$VBReply);
$currtpl->display('viewboard.tpl.php');
?>
