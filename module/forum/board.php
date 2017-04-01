<?php
require_once("../../mainfile.php");
$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/board.css');
$FNO = intval($_GET['forum']);


$Mode = mysql_real_escape_string($_GET['Mode']);
$BoardInfo = $currdb->query("SELECT * FROM `".$currdb->prefix("forum_list")."` 
							WHERE fno ='".$FNO."'");
$BoardInfo = $currdb->fetch_array($BoardInfo);
if(empty($BoardInfo))
    exit();
$fileLocation = "templates/fpic/".$BoardInfo['fno'].".".$BoardInfo['pic'];
if($BoardInfo['pic']!="none" && file_exists($fileLocation))
    $BoardInfo['pic']="<img width=\"180\" height=\"100\" src=".$fileLocation.">";
else
	$BoardInfo['pic']="";
if($Mode!="edit")
    $BoardInfo['descripe'] = nl2br($BoardInfo['descripe']);	
$BoardInfo['FNO']=$FNO;
$BoardInfo['Link']="?forum=".$FNO;
if(forum_isadmin($FNO) && empty($Mode) ){
	$ForAdmin['upload'] = "<form id=\"pic_upload\" action=\"update.php?type=pic\" method=\"post\" enctype=\"multipart/form-data\">";
	$ForAdmin['upload'] .= "<br /><input class=\"input0\" size=\"14\" type=\"file\" name=\"pic\"><input type=\"submit\" value=\"送出\">";
	$ForAdmin['upload'] .= "<br /><input type=\"hidden\" name=\"fno\" value=".$FNO.">";
	$ForAdmin['upload'] .= "<br /></form>";
	$ForAdmin['upload'] .= "<span style=\"font-size:12px;\">圖案限制180*100 完成後請重整</span>";
	$ForAdmin['edit'] .= "<a href=\"board.php?forum=".$FNO."&Mode=edit\">按此編輯</a>";
	$ForAdmin['isAdmin'] = 1;
}

if(forum_isadmin($FNO) && $Mode=="edit"){
	$ForAdmin['editContent'] = "<form action=\"update.php?type=arti\" method=\"post\" enctype=\"multipart/form-data\">";
	$ForAdmin['editContent'] .= "<textarea rows=\"8\" cols=\"100\" name=\"descripe\">".$BoardInfo['descripe']."</textarea><input type=\"submit\" value=\"送出\">";
	$ForAdmin['editContent'] .= "<br /><input type=\"hidden\" name=\"fno\" value=".$FNO.">";
	$ForAdmin['editContent'] .= "<br /></form>";
	$BoardInfo['descripe'] = "";
}
$page=mysql_real_escape_string($_GET['page']);
if(empty($page))
	$page=1;
$totalPages = $currdb->query("SELECT COUNT(*) FROM `".$currdb->prefix("forum_articals")."`
							  WHERE fno='".$FNO."' AND active='1'");
$totalPages = $currdb->fetch_array($totalPages);
$totalPages = ceil($totalPages['COUNT(*)']/10);//not complete

if($page>$totalPages)
	$page=1;
if(isset($page) && $page>0){
	$HIGH = ceil($page)*10;
	$LOW = (ceil($page)-1)*10;
}
else{
	$LOW=0;
	$HIGH=10;
}
if($page==1)
        $cpcss1=" VB_currpage";
elseif($page==$totalPages)
        $cpcsslast=" VB_currpage";
$pager=null;
if($totalPages<2)
	$pager=null;
else{
	if($page>1){
	$pager.="<a href=\"board.php?forum=".$FNO."&page=".($page-1)."\">
			<span class=\"pageTab\"><</span></a>";
	}
	$pager.="<a href=\"board.php?forum=".$FNO."&page=1\">
			<span class=\"pageTab".$cpcss1."\">1</span></a>";
	if($totalPages < 10)
		$pagerCount=2;
	else
		$pagerCount=$LOW;
	if($totalPages > 1){
		$loop=0;
		while($loop<8 && ($pagerCount < $totalPages)){
			$pager.="<a href=\"board.php?forum=".$FNO."&page=".$pagerCount."\">
				<span class=\"pageTab";
            if($page==$pagerCount)
                $pager.=" VB_currpage";
            $pager.="\">".$pagerCount."</span></a>";
			$loop++;
			$pagerCount++;
		}
	$pager.="<a href=\"board.php?forum=".$FNO."&page=".$totalPages."\">
			<span class=\"pageTab".$cpcsslast."\">".$totalPages."</span></a>";
	}
	if($page<$totalPages){
	$pager.="<a href=\"board.php?forum=".$FNO."&page=".($page+1)."\">
			<span class=\"pageTab\">></span></a>";
	}
}

if($curruser->isguest()){
	$BoardContentSQL = $currdb->query("SELECT * FROM
								 ( `".$currdb->prefix("forum_articals")."` FA LEFT JOIN
								  `".$currdb->prefix("user")."` USER ON FA.uno=USER.uno) 
								  WHERE FA.fno ='".$FNO."' AND FA.active='1'
								  ORDER BY FA.settop DESC, FA.lasttime DESC
								  LIMIT ".$LOW.",".$HIGH."
								  ") or die(mysql_error());
}
else{
    $ArticalSQL = $currdb->query("SELECT * FROM `".$currdb->prefix("forum_articals")."`
                                     WHERE fno='".$FNO."'AND active='1' ");

    $RedConfirmSQL = $currdb->query("SELECT * FROM `".$currdb->prefix("forum_redpoint")."`
                                     WHERE readuno='".$curruser->uno."'") or (mysql_error());
    
    $Results=array();
    $RedConfirm = array();
    $Articals[] = array();
    while($temp = $currdb->fetch_array($ArticalSQL))
        $Articals[]=$temp;
    while($temp2 = $currdb->fetch_array($RedConfirmSQL))
        $RedConfirm[]=$temp2;
    $SwitchArray=array();
    foreach($Articals as $ART){
            $flag = 0;
            foreach($RedConfirm as $RCF){
                if($ART['ano']==$RCF['ano']){
                    $flag=1;
                    break;
                }
            }
            if($flag==0) $Results[]=$ART;
        }
    //if($curruser->perm==1)
    //    print_r($Results); 
    if(!empty($Results)){
        $redArray=array();
        foreach($Results as $Res){
            $redArray[]="('".$curruser->uno."','".$Res['ano']."','0')";
        }
        $redSQL = implode(", ",$redArray);
        $currdb->query("INSERT INTO `".$currdb->prefix("forum_redpoint")."`
                   (`readuno`,`ano`,`redtime`) VALUES
                  ".$redSQL."") or die(mysql_error());
    }
	$BoardContentSQL = $currdb->query("SELECT * FROM
								 ( `".$currdb->prefix("forum_articals")."` FA LEFT JOIN
								  `".$currdb->prefix("user")."` USER ON FA.uno=USER.uno) LEFT JOIN
								  `".$currdb->prefix("forum_redpoint")."` RD ON FA.ano=RD.ano
								  WHERE FA.fno ='".$FNO."' AND RD.readuno='".$curruser->uno."' 
								  AND FA.active='1'
								  ORDER BY FA.settop DESC, FA.lasttime DESC
								  LIMIT ".$LOW.",".$HIGH."
								  ") or die(mysql_error());
}
//$ReplySQL = $currdb->query("SELECT COUNT(*) FROM `".$currdb->prefix("forum_reply")."` WHERE `ano` = '".$."'");
//echo $currdb->num_rows($BoardContentSQL);
$BCCounter = $LOW+1;
while($BCFetch = $currdb->fetch_array($BoardContentSQL)){
	$ReplySQL = $currdb->query("SELECT COUNT(*) FROM `".$currdb->prefix("forum_reply")."` 
								WHERE ano='".$BCFetch['ano']."'");
	$Reply = $currdb->fetch_array($ReplySQL);
	$BCFetch['replys']=$Reply['COUNT(*)'];
	$BCFetch['SN']=substr(strval($BCFetch['SNinF']+1000),1,3).".";
	if($BCFetch['settop']>0)
		$BCFetch['ListType']="FBCListTop";
	else
		$BCFetch['ListType']="FBCList";
	
	if(($BCFetch['redTime']<$BCFetch['lasttime']) || $curruser->isguest())
		$BCFetch['ReadStatus']="FBC_ReplyUnread";
	else
		$BCFetch['ReadStatus']="FBC_Reply";	
	$BCFetch['Link']="viewboard.php?forum=".$FNO."&ano=".$BCFetch['ano'];
	$BCFetch['time']=date("Y/m/d H:i",$BCFetch['time']);
	$BCFetch['HeadIcon']=HeadIcon($BCFetch['pic']);
	$BoardContent[]=$BCFetch;
	$BCCounter++;
}
	
//print_r($BoardContent);	
$currtpl->assign('pager',$pager);
$currtpl->assign('BoardContent',$BoardContent);
$currtpl->assign('BoardInfo',$BoardInfo);
$currtpl->assign('ForAdmin',$ForAdmin);
$currtpl->display('board.tpl.php');
?>
