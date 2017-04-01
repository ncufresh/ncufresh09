<?php
	require_once '../../mainfile.php';
	
if($curruser->isguest()){
		_savePage(URL.'/include/user.php?login_form=1');
	}
    
    $Qno = mysql_real_escape_string($_GET['Qno']);
    $Quest = $currdb->query("SELECT * FROM `".$currdb->prefix("QA_Question")."` WHERE Qno='".$Qno."'");
	$Quest = $currdb->fetch_array($Quest);
    if($curruser->uno != $Quest['Quno'])
        _redirect("index.php");
    else{
         $currdb->query("UPDATE `".$currdb->prefix("qa_question").
	    	          "` SET Qactive = '0' WHERE Qno='".mysql_real_escape_string($_GET['Qno'])."';");
    }
	_redirect("index.php");

?>
