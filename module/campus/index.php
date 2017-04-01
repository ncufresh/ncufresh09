<?php
require_once("../../mainfile.php");
$currtpl->addjs(ROOT_PATH.'/module/'.$currmodule->name.'/include/campus.js');
$currtpl->addjs(ROOT_PATH.'/module/'.$currmodule->name.'/include/jquery.lightbox.js');
$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/jquery.lightbox.css');
if ($_GET['xdtest'])
	$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/buildings.bak.css');
else
	$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/buildings.css');
//require_once("campus_submenu_selector.php");
if($currmodule->isadmin($curruser))
	$currtpl->addjs(ROOT_PATH.'/module/'.$currmodule->name.'/include/foradmin.js');
$buildingContent = array();
for($i=1;$i<60;$i++){
    if($_GET['menu']==6)
        break;
	$extendClasses="";
	$extendJS="";
	switch($i){
		case 37:case 41:
			$extendClasses.=" campus_adm";
			$extendJS=" onclick=\"sub_menu(1)\"";
			break;
		default:
			//unset($extendJS);
			break;
	}
	
	switch($i){
		case 1:case 3:case 31:case 34:case 36:case 42:case 45:case 2:
			$extendClasses.=" campus_view";
			$extendJS=" onclick=\"sub_menu(2)\"";
			break;
		default:
			//unset($extendJS);
			break;
	}
	
	switch($i){
		case 1:case 8:case 18:case 21:case 23:case 25:case 29:case 39:case 40:case 44:case 46:
			$extendClasses.=" campus_depart";
			$extendJS="onclick=\"sub_menu(3)\"";
			break;
		default:
			//unset($extendJS);
			break;
	}
	
	switch($i){
		case 28:case 37:case 38:case 39:
			$extendClasses.=" campus_learn";
			$extendJS=" onclick=\"sub_menu(4)\"";
			break;
		default:
			//unset($extendJS);
			break;	
	}
	
	switch($i){
		case 9:case 10:case 11:case 12:case 13:case 14:case 15:case 16:case 17:case 35:
			$extendClasses.=" campus_sport";
			$extendJS=" onclick=\"sub_menu(5)\"";
			break;
		default:
			//unset($extendJS);
			break;
	}

	if ($_GET['xdtest'])
		$extendClasses .=" png111";

	$element = "class=\"buildings $extendClasses\" id=\"building$i\"";
	if(!isset($extendJS))
			$extendJS=" onclick=\"sub_menu(6)\"";
	$element.=$extendJS;
	$buildingContent[]=$element;
}

$Switcher['CSM']="CPHiding";
$Switcher['CPI']="CPHiding";
$output="";
if(isset($_GET['menu']) && !isset($_GET['content'])){
	if($_GET['menu']==6){
        //$Switcher['CSM']="CPdisplay";
        $specialCase = "style=\"height:1151px;background:url('templates/images/allmap234.jpg');\"";
        //background","url('templates/images/allmap234.jpg
        //$output="<span style=\"inline-block;\"><img src=\"templates/images/allmap234.jpg\"/></span>";
        $currtpl->assign('SpecialCase',$specialCase);
        // $currtpl->assign('campus_intro',$output);
    }
    else{
        $FetchCounter=0;
	    $selection = mysql_real_escape_string($_GET['menu']);
    	$Switcher['CSM']="CPdisplay";
	    $CSM_SQLResource=$currdb->query("SELECT * FROM `".$currdb->prefix('campus_submenu')."`
                                         WHERE CMno=".$selection."
                                         ORDER BY `CSMno`") or die("error");
	    $single_row = ceil($currdb->num_rows($CSM_SQLResource)/6);
    	while($CSM_Fetch = $currdb->fetch_array($CSM_SQLResource)){
    //print_r($CSM_Fetch);
	    	if(($FetchCounter%$single_row)==0)
		    	$output.='<div class="floatleft">';
            if($_GET['menu']!=3){
    		    $output.="<div><a onclick=\"showContent(".$CSM_Fetch['CSMno'].");return false;\" href=\"index.php?content=".$CSM_Fetch['CSMno']."\">".$CSM_Fetch['CSMtitle']."</a></div> ";
            }
            else{
                $output.="<div>".$CSM_Fetch['CSMtitle']."</div>";      
            }


	    	if(($FetchCounter%$single_row)==($single_row-1))
		    	$output.='</div>';
        	$FetchCounter++;
	    }
    	if(($currdb->num_rows($CSM_SQLResource)%2)!=0)
    		$output.="</div>";
        if($_GET['menu']==3){
            $stats="<span style=\"inline-block;\"><img src=\"templates/images/depart.gif\"></span>";
            $currtpl->assign('campus_intro',$stats);
            $specialCase2 = "style=\"margin-left:150px\"";
            $currtpl->assign('SpecialCase2',$specialCase2);
        }
    	$campus_submenu = $output;
        $currtpl->assign('campus_submenu',$campus_submenu);
    }
}   

else if(!isset($_GET['menu']) && isset($_GET['content'])){
	$selection = intval($_GET['content']);
	$Switcher['CSM']="CPdisplay";
	$CSM_SQLResource=$currdb->query("SELECT * FROM `".$currdb->prefix('campus_submenu')."` 
								 WHERE CSMno=".$selection."") or die("?!");
	$CSM_Fetch = $currdb->fetch_array($CSM_SQLResource);
	$output = $CSM_Fetch['Content'];
	$campus_intro = $output;
	$currtpl->assign('campus_intro',$campus_intro);
}



$currtpl->assign('Switcher',$Switcher);
//$currtpl->assign('campus_intro',$campus_intro);
$currtpl->assign('buildingContent',$buildingContent);
//$currtpl->assign('main_menu',$currtpl->fetch('menu.tpl.php'));

if(!isset($_GET['selector']))
	$currtpl->display("index.tpl.php");
?>
