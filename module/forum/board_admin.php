<?php
include("../../mainfile.php");
	$FNO = $_POST['FNO'];
	if(!forum_isadmin($FNO)){
		_redirect();
		exit();
	}
	if($_POST['submit']=="切換置頂"){
		$priority = $currdb->query("SELECT `settop` FROM `".$currdb->prefix("forum_articals")."` 
									WHERE `fno` = '".$FNO."' ORDER BY settop DESC LIMIT 1");
		$priority = $currdb->fetch_array($priority);
		$priority = $priority['settop']+1;
		foreach($_POST['selector'] as $looper){
			$checker = $currdb->query("SELECT `settop` FROM `".$currdb->prefix("forum_articals")."` 
									WHERE `fno` = '".$FNO."' AND `SNinF` = '".$looper."' LIMIT 1");
			$checker = $currdb->fetch_array($checker);
			if($checker['settop']>0){
				$currdb->query("UPDATE `".$currdb->prefix("forum_articals")."`
							SET settop = '0'
							WHERE `SNinF`='".$looper."' AND `fno`='".$FNO."'");
			}
			else{
				$currdb->query("UPDATE `".$currdb->prefix("forum_articals")."`
							SET settop = '".$priority."'
							WHERE `SNinF`='".$looper."' AND `fno`='".$FNO."'");
				$priority++;
			}
		}
	}
	elseif($_POST['submit']=="刪除"){
		foreach($_POST['selector'] as $looper){
			$currdb->query("UPDATE `".$currdb->prefix("forum_articals")."`
						SET active = '0'
						WHERE `SNinF`='".$looper."' AND `fno`='".$FNO."'");
		}
	}
	_redirect();
?>