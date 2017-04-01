<?php
require_once("../../mainfile.php");

$forumlist['libart']=array();		//1
$forumlist['sci']=array();			//2
$forumlist['engineer']=array();		//3
$forumlist['management']=array();	//4
$forumlist['info']=array();			//5
$forumlist['earth']=array();		//6
$forumlist['haha']=array();			//7
$forumlist['help']=array();			//8
$forumlist['learn']=array();		//9
$forumlist['asso']=array();			//10
$forumlist['havemoney']=array();	//11

$forumlist_sqlresource = $currdb->query("SELECT * FROM `".$currdb->prefix('forum_list')."` ORDER BY fno ASC");
while($forumlist_fetch = $currdb->fetch_array($forumlist_sqlresource)){
	switch($forumlist_fetch['categoly']){
		case 1:
			$forumlist['libart'][]="<a href=\"board.php?forum=".$forumlist_fetch['fno']."\">".$forumlist_fetch['board_sname']."</a>";
			break;
		case 2:
			$forumlist['sci'][]="<a href=\"board.php?forum=".$forumlist_fetch['fno']."\">".$forumlist_fetch['board_sname']."</a>";
			break;
		case 3:
			$forumlist['engineer'][]="<a href=\"board.php?forum=".$forumlist_fetch['fno']."\">".$forumlist_fetch['board_sname']."</a>";
			break;
		case 4:
			$forumlist['management'][]="<a href=\"board.php?forum=".$forumlist_fetch['fno']."\">".$forumlist_fetch['board_sname']."</a>";
			break;
		case 5:
			$forumlist['info'][]="<a href=\"board.php?forum=".$forumlist_fetch['fno']."\">".$forumlist_fetch['board_sname']."</a>";
			break;			
		case 6:
			$forumlist['earth'][]="<a href=\"board.php?forum=".$forumlist_fetch['fno']."\">".$forumlist_fetch['board_sname']."</a>";
			break;		
		case 7:
			$forumlist['haha'][]="<a href=\"board.php?forum=".$forumlist_fetch['fno']."\">".$forumlist_fetch['board_sname']."</a>";
			if($forumlist_fetch['fno']=='50' || $forumlist_fetch['fno']=='51' || $forumlist_fetch['fno']=='52')
				$forumlist['haha'][]="";
			break;		
		case 8:
			$forumlist['help'][]="<a href=\"board.php?forum=".$forumlist_fetch['fno']."\">".$forumlist_fetch['board_sname']."</a>";
			break;		
		case 9:
			$forumlist['learn'][]="<a href=\"board.php?forum=".$forumlist_fetch['fno']."\">".$forumlist_fetch['board_sname']."</a>";
			if($forumlist_fetch['fno']=='79')
				$forumlist['learn'][]="";
			break;		
		case 10:
			$forumlist['asso'][]="<a href=\"board.php?forum=".$forumlist_fetch['fno']."\">".$forumlist_fetch['board_sname']."</a>";
			if($forumlist_fetch['fno']=='100' || $forumlist_fetch['fno']=='101'|| $forumlist_fetch['fno']=='99')
				$forumlist['asso'][]="";
			break;
		case 11:
			$forumlist['havemoney'][]="<a href=\"board.php?forum=".$forumlist_fetch['fno']."\">".$forumlist_fetch['board_sname']."</a>";
			break;
	}
}

$currtpl->assign('forum',$forumlist);
$currtpl->display('index.tpl.php');
?>