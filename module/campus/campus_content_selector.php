<?php
require_once("../../mainfile.php");
$currtpl->setndisplay();
$selection = $_GET['selection'];
$selection = mysql_real_escape_string($selection);
$CSM_SQLResource=$currdb->query("SELECT * FROM `".$currdb->prefix('campus_submenu')."` 
								 WHERE CSMno='".$selection."'") or die("?!");
$CSM_Fetch = $currdb->fetch_array($CSM_SQLResource);
$output = $CSM_Fetch['Content'];
if($currmodule -> isadmin($curruser)){
	$output.="|||<input type=\"button\" value=\"編輯文章\" onclick=\"editMode(".$CSM_Fetch['CSMno'].");\"/>";
}
$output.="|||<span id=\"CP_Unicorn\"><img src=\"templates/images/icons/".$CSM_Fetch['PicUrl']."\"/></span>";
/*$single_row = ceil($currdb->num_rows($CSM_SQLResource)/2);
while($CSM_Fetch = $currdb->fetch_array($CSM_SQLResource)){
	//print_r($CSM_Fetch);
	if(($FetchCounter%$single_row)==0)
		$output.='<div class="floatleft">';
	$output.="<div><a onclick=\"showContent(".$CSM_Fetch['CSMno'].");return false;\" href=\"index.php?content=".$CSM_Fetch['CSMno']."\">".$CSM_Fetch['CSMtitle']."</a></div> ";
	if(($FetchCounter%$single_row)==($single_row-1))
		$output.='</div>';
	$FetchCounter++;	

}*/


    echo $output;
//	onclick=\"showContent(".$CSM_Fetch['CSMno'].");return false;\"
?>
