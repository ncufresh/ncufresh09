<?
	require_once("../../../mainfile.php");
	
	if($currmodule->isadmin($curruser))
	{
		$post=array();
		$result=$currdb->query("select u1.uid as poster_id, u2.uid as impeach_id, t.title as title, p.* from " .$currdb->prefix("wiki_post"). " p left join " .$currdb->prefix("user"). " u1 on p.poster_no=u1.uno left join " .$currdb->prefix("user"). " u2 on p.impeach=u2.uno left join " .$currdb->prefix("wiki_topic"). " t on p.tno=t.tno where impeach!='0'");
		for($m=0;$m<$currdb->num_rows($result);$m++)
		{
			$a=$currdb->fetch_array($result);
			array_push($post,$a);
		}
		$currtpl->assign_by_ref("post",$post);
		$currtpl->display("index.tpl");
	}
?>
