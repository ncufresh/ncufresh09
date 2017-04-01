<?php

if(!defined('MAINFILE_INCLUDED'))
	exit();
	
require_once(ROOT_PATH."/dep.php");

function chgdep($dep_eng)
{
	global $dep;
	$dep_chs=$dep[$dep_eng];
	return $dep_chs;
}

function tenQuest(){
	global $currtpl,$currmodule,$currdb,$curruser;

	$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/styles/tenQ.css');
	$TQdb=$currdb->query("SELECT * FROM `".$currdb->prefix("qa_tenquest")."` ORDER BY TQno") or die(mysql_error());

	for($i=0;$i<10;$i++){
		$TQ=$currdb->fetch_array($TQdb);
		if($i<9)
			$QA_Ten_List[$i]['Pic']='tenQAicon0'.($i+1).'.gif';
		else
			$QA_Ten_List[$i]['Pic']='tenQAicon'.($i+1).'.gif';
			
		$QA_Ten_List[$i]['Text']=$TQ['TQtitle'];
		$QA_Ten_List[$i]['Link']="index.php?QTno=".($i+1);
	}
	
	$currtpl->assign('QA_Ten_List',$QA_Ten_List);
	$block = $currtpl->fetch('tenQuest.tpl.php');
	return $block;
}

function mainpage($page,$cls){
	global $currtpl,$currmodule,$currdb,$curruser;
	$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/styles/mainpage.css');
	
	$QCdb=$currdb->query("SELECT * FROM `".$currdb->prefix("qa_cls")."` ORDER BY Cnum;");
	$QA_cls=array();
	$i=1;
	$QA_cls[0]['num']= -1;
	$QA_cls[0]['content']="全部";

	while($QC=$currdb->fetch_array($QCdb)){
		$QA_cls[$i]['num']=$QC['Cnum'];
		$QA_cls[$i]['content']=$QC['Ccontent'];
		$i++;
	}
	
	$num=$currdb->query("SELECT COUNT(*) FROM `".$currdb->prefix("qa_question")."`;");
	$pnum=$currdb->fetch_array($num);	

	if($pnum['COUNT(*)']%10 == 0)
        $p=(int)($pnum['COUNT(*)']/10);
	else 			  
        $p=(int)($pnum['COUNT(*)']/10)+1;

	if($p==0)	$p=1; 
	if($page>$p)	_redirect();
	
	if($p<10)   //Total Pages
	{
		for($i=0;$i<$p;$i++)
			$pages[$i]=$i+1;
	}
	else if(($p-$page)<5)
	{
		$pages[0]=1;
		for($i=1;$i<6;$i++)
			$pages[$i]=$p-$page+$i;

	}
	else
	{
		$pages[0]=1;
		for($i=1,$j=$page-3;$i<9;$i++,$j++)
			$pages[$i]=$i+1;
		$pages[9]=$p;
	}
	
	if($cls!=-1)
		$Qdb=$currdb->query("SELECT * FROM `".$currdb->prefix("qa_question")."` WHERE Qactive='1' AND Qcls ='".$cls."' ORDER BY Qtime DESC LIMIT "
			.(($page-1)*10)." , 10;");
	else
		$Qdb=$currdb->query("SELECT * FROM `".$currdb->prefix("qa_question")."` WHERE Qactive='1' ORDER BY Qtime DESC LIMIT "
			.(($page-1)*10)." , 10;");
	$i=0;
	
	while($Q=$currdb->fetch_array($Qdb)){
		
		$u=$currdb->query("SELECT * FROM `".$currdb->prefix("user")."` WHERE uno='".$Q['Quno']."';");
		$u=$currdb->fetch_array($u);
		$QA_Articals[$i]['author']=$u['uid'];
		$QA_Articals[$i]['pic']=$u['pic'];
		
		$QA_Articals[$i]['num']=$Q['Qno'];
		
		if(strlen($Q['Qtitle']) > 26)
		{
			$QA_Articals[$i]['point']=1;
			$QA_Articals[$i]['title'] = mb_substr($Q['Qtitle'],0,13,'utf-8');
		    //echo $QA_Articals[$i]['title'];
		}
		else {
			$QA_Articals[$i]['title'] = $Q['Qtitle'];
			$QA_Articals[$i]['point']=0;
		}
			
		//$QA_Articals[$i]['title']=htmlencode($QA_Articals[$i]['title']);
		$QA_Articals[$i]['title']=htmlencode($QA_Articals[$i]['title']);
		$QA_Articals[$i]['reply']=$Q['Qrenum'];
		$QA_Articals[$i]['time']=date("Y.m.d H:i",$Q['Qtime']);
		$QA_Articals[$i]['cls']=$QA_cls[$Q['Qcls']]['content'];
	    if($curruser->isguest())
            $QA_Articals[$i]['new']=1;
        else{
    		$u=$currdb->query("SELECT * FROM `".$currdb->prefix("qa_read")."` WHERE uno='".$curruser->uno."' AND Qno='".$Q['Qno']."';");
		
    		if($u=$currdb->fetch_array($u)) 
	    	{ 
		    	if($u['Qtime'] > $Q['Qnewtime'])	$QA_Articals[$i]['new']=0;
			    else								$QA_Articals[$i]['new']=1;
    		}
	    	else
		    {		
    			$QA_Articals[$i]['new']=1;
	    		$currdb->query("INSERT INTO `".$currdb->prefix("qa_read").
		    	"` (`uno`,`Qno`,`Qtime`) VALUES ('"
			    .$curruser->uno."','".$Q['Qno']."','".(0)."');");
    		}
        }
	    	
		    $i++;
	}
		
	if($page-1>=1) 	$currtpl->assign('uppages',($page-1));
	else 		    $currtpl->assign('uppages',(-1));
	if($page+1<=$p)	$currtpl->assign('downpages',($page+1));
	else			$currtpl->assign('downpages',(-1));
   
    $currtpl->assign('currpage',$page);
    $currtpl->assign('PrePage',$PrePage);
	$currtpl->assign('QA_cls',$QA_cls);
	$currtpl->assign('pages',$pages);
	$currtpl->assign('QA_Articals',$QA_Articals);
	$block = $currtpl->fetch('mainpage.tpl.php');
	return $block;
}

function Qpage($QAno , $page){
	global $currtpl,$currmodule,$currdb,$curruser;
	$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/styles/Qpage.css');
	
	$currdb->query("UPDATE `".$currdb->prefix("qa_read").
		"` SET Qtime = '".mktime().
		"' WHERE Qno='".mysql_real_escape_string($QAno)."' AND uno='".$curruser->uno."';");
	
	$QCdb=$currdb->query("SELECT * FROM `".$currdb->prefix("qa_cls")."` ORDER BY Cnum;");
	$QA_cls=array();
	$i=1;
	$QA_cls[0]['num']= -1;
	$QA_cls[0]['content']="全部";

	while($QC=$currdb->fetch_array($QCdb)){
		$QA_cls[$i]['num']=$QC['Cnum'];
		$QA_cls[$i]['content']=$QC['Ccontent'];
		$i++;
	}
	
	$Qdb=$currdb->query("SELECT * FROM `".$currdb->prefix("qa_question")."` WHERE Qno='".$QAno."';");
	$Q=$currdb->fetch_array($Qdb);

		if($Q['Qactive']==0) _redirect();
		$u=$currdb->query("SELECT * FROM `".$currdb->prefix("user")."` WHERE uno='".$Q['Quno']."';");
		$u=$currdb->fetch_array($u);
		$QA_Articals['author']=$u['uid'];
		$QA_Articals['uno']=$u['uno'];
		$QA_Articals['name']=$u['name'];
		$QA_Articals['dep']=chgdep($u['department']);
		$QA_Articals['mail']=$u['email'];
		$QA_Articals['pic']=$u['pic'];
		
		$QA_Articals['num']=$Q['Qno'];
		$QA_Articals['title']=nl2br(htmlencode($Q['Qtitle']));
		$QA_Articals['content']=nl2br(htmlencode($Q['Qcontent']));
		$QA_Articals['reply']=$Q['Qrenum'];
		$QA_Articals['time']=date("Y.m.d H:i",$Q['Qtime']);
		$QA_Articals['cls']=$QA_cls[$Q['Qcls']]['content'];
	
	if($Q['Qrenum']%10 == 0) $p=(int)($Q['Qrenum']/10);
	else 					 $p=(int)($Q['Qrenum']/10)+1;
	
	if($p==0)	$p=1;
	if($page>$p)	_redirect();
	
	if($p<10)
	{
		for($i=0;$i<$p;$i++)
			$pages[$i]=$i+1;
	}
	else if($p-$page<5)
	{
		$pages[0]=1;
		for($i=1;$i<$p-$page;$i++)
			$pages[$i]=$p-8+$i;
	}
	else
	{
		$pages[0]=1;
		for($i=0,$j=$page-3;$i<7;$i++,$j++)
			$pages[$i]=$i;
		$pages[9]=$p;
	}
	
	
	$Rdb=$currdb->query("SELECT * FROM `".$currdb->prefix("qa_re")."` WHERE Rno ='".$QAno."' ORDER BY Rfloor LIMIT "
		.(($page-1)*10)." , 10;");
	$i=0;
	while($R=$currdb->fetch_array($Rdb)){
		
		$u=$currdb->query("SELECT * FROM `".$currdb->prefix("user")."` WHERE uno='".$R['Runo']."';");
		$u=$currdb->fetch_array($u);
		$RA_Articals[$i]['author']=$u['uid'];
		$RA_Articals[$i]['name']=$u['name'];
		$RA_Articals[$i]['dep']=chgdep($u['department']);
		$RA_Articals[$i]['pic']=$u['pic'];
		
		$RA_Articals[$i]['num']=$R['Rno'];
		$RA_Articals[$i]['time']=date("Y.m.d H:i",$R['Rtime']);
		$RA_Articals[$i]['floor']=$R['Rfloor'];
		$RA_Articals[$i]['content']=nl2br(htmlencode($R['Rcontent']));
		
		$i++;
	}
	
	if($page-1>=1) 	$currtpl->assign('uppages',($page-1));
	else 		    $currtpl->assign('uppages',(-1));
	if($page+1<=$p)	$currtpl->assign('downpages',($page+1));
	else			$currtpl->assign('downpages',(-1));
    
    $currtpl->assign('currpage',$page);
	$currtpl->assign('pages',$pages);
	$currtpl->assign('QA_Articals',$QA_Articals);
	$currtpl->assign('RA_Articals',$RA_Articals);
    if($curruser->uno==$Q['Quno'] || $currmodule->isadmin($curruser))
        $currtpl->assign('admin','1');
	$block = $currtpl->fetch('Qpage.tpl.php');
	return $block;
}

function TQpage($TQno){
	global $currtpl,$currmodule,$currdb,$curruser;
	$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/styles/TQpage.css');
	$TQdb=$currdb->query("SELECT * FROM `".$currdb->prefix("qa_tenquest")."` WHERE TQno='".$TQno."';");
	$TQ=$currdb->fetch_array($TQdb);
	
	$currtpl->assign('QA_Ten_title',$TQ['TQtitle']);
	$currtpl->assign('QA_Ten_content',$TQ['TQcontent']);
	$block = $currtpl->fetch('TQpage.tpl.php');
	return $block;
}

function newpage(){
	global $currtpl,$currmodule,$currdb,$curruser;
	$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/styles/newpage.css');
	$QCdb=$currdb->query("SELECT * FROM `".$currdb->prefix("qa_cls")."` ORDER BY Cnum;");
	$QA_cls=array();
	$i=0;

	while($QC=$currdb->fetch_array($QCdb)){
		$QA_cls[$i]['num']=$QC['Cnum'];
		$QA_cls[$i]['content']=$QC['Ccontent'];
		$i++;
	}
	
	$currtpl->assign('QA_cls',$QA_cls);
	$currtpl->assign('QA_Ten_title',"發表文章");
	$block = $currtpl->fetch('newpage.tpl.php');
	return $block;
}

function chgpage($QAno){
	global $currtpl,$currmodule,$currdb,$curruser;
	$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/styles/chgpage.css');
	
	$Qdb=$currdb->query("SELECT * FROM `".$currdb->prefix("qa_question")."` WHERE Qno='".$QAno."';");
	$Q=$currdb->fetch_array($Qdb);
    if($curruser->uno!=$Q['Quno']){
        _redirect('index.php');
        exit();
    }
		$QA_Articals['num']=$Q['Qno'];
		$QA_Articals['cls']=$Q['Qcls'];
		$QA_Articals['title']=$Q['Qtitle'];
		$QA_Articals['content']=$Q['Qcontent'];
	
	$QCdb=$currdb->query("SELECT * FROM `".$currdb->prefix("qa_cls")."` ORDER BY Cnum;");
	$QA_cls=array();
	$i=0;

	while($QC=$currdb->fetch_array($QCdb)){
		$QA_cls[$i]['num']=$QC['Cnum'];
		$QA_cls[$i]['content']=$QC['Ccontent'];
		if($QA_Articals['cls'] == $QA_cls[$i]['num']) 
			$QA_Articals['cls']=$QC['Ccontent'];
		$i++;
	}
	
	$currtpl->assign('QA_cls',$QA_cls);
	$currtpl->assign('QA_Articals',$QA_Articals);
	$currtpl->assign('QA_Ten_title',"修改文章");
	$block = $currtpl->fetch('chgpage.tpl.php');
	return $block;
}

?>
