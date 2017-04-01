<?php
require_once("../../mainfile.php");
$currtpl->setndisplay();
$selection = $_GET['selection'];

$FetchCounter=0;
$output="";
$CSM_SQLResource=$currdb->query("SELECT * FROM `".$currdb->prefix('campus_submenu')."` 
								 WHERE CMno=".$selection." ORDER BY `CSMno`") or die("?!");
$single_row = ceil($currdb->num_rows($CSM_SQLResource)/5);
if($selection==3){
	while($CSM_Fetch = $currdb->fetch_array($CSM_SQLResource)){
		//print_r($CSM_Fetch);
		if(($FetchCounter%$single_row)==0)
			$output.='<div class="floatleft">';
		$output.="<div>".$CSM_Fetch['CSMtitle']."</div> ";
		if(($FetchCounter%$single_row)==($single_row-1))
			$output.='</div>';
		$FetchCounter++;
	}
}
else{
	while($CSM_Fetch = $currdb->fetch_array($CSM_SQLResource)){
		//print_r($CSM_Fetch);
		if(($FetchCounter%$single_row)==0)
			$output.='<div class="floatleft">';
		$output.="<div><a onclick=\"showContent(".$CSM_Fetch['CSMno'].");return false;\" href=\"index.php?content=".$CSM_Fetch['CSMno']."\">".$CSM_Fetch['CSMtitle']."</a></div> ";
		if(($FetchCounter%$single_row)==($single_row-1))
			$output.='</div>';
		$FetchCounter++;	
	}
}
echo $output;
?>
