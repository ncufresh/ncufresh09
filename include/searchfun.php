<?php
function search_news($keyword,$low = 0,$high = 10,$cou = false)
{
	global $currdb;
	$temp = $currdb->query("SELECT SQL_CALC_FOUND_ROWS * FROM `".$currdb->prefix("news_post")."` WHERE content LIKE '%".$keyword."%' OR title LIKE '%".$keyword."%' LIMIT ".$low.",".$high);

	$result = $currdb->query("SELECT FOUND_ROWS()");
	$count = $currdb->fetch_array($result);
	$count = $count[0];
	if($cou) return $count;

	$result_dis = array();

	$result = array();	
	while($data = $currdb->fetch_array($temp))
	{
		$result['title'] = $data['title'];
		
		$data['content'] = preg_replace('/<[^>]*>/i', '', $data['content']);
		
		$result['content'] = _substrfix($data['content'],100);
		$result['url'] = URL."/module/news/index.php?news_no=".$data['news_no'];
		
		$result_dis['data'][] = $result;
	}

	$result_dis['count'] = $count;

	return $result_dis;
}

function search_reg($keyword,$low,$high,$cou = false)
{
	global $currdb;
	$rw_s = $currdb -> query("SELECT SQL_CALC_FOUND_ROWS * FROM `".($currdb -> prefix("regwizard_opt"))."` WHERE rwo_name LIKE '%".$keyword."%' OR rwo_description LIKE '%".$keyword."%' LIMIT ".$low.",".$high );

	$result = $currdb -> query("SELECT FOUND_ROWS()");
	$count = $currdb->fetch_array($result);
	$count = $count[0];
	if($cou) return $count;

	$rw_s_result_dis = array();
	
	while($rw_s_result_processing = $currdb -> fetch_array($rw_s))
	{
		$rw_s_result['title'] = $rw_s_result_processing['rwo_name'];
		
		$rw_s_result_processing['rwo_description'] = preg_replace('/<[^>]*>/i', '', $rw_s_result_processing['rwo_description']);
		$rw_s_result['content'] = _substrfix($rw_s_result_processing['rwo_description'], 100);
		
		$rw_s_result['url'] = URL."/module/regwizard/opt_check.php?rwoID=".$rw_s_result_processing['rwoID'];
		
		$rw_s_result_dis['data'][] =  $rw_s_result;
	}
	
	$rw_s_result_dis['count'] = $count;

	return $rw_s_result_dis;
}

function search_wiki($keyword,$low,$high,$cou = false)
{
	global $currdb;
	$sql = ("SELECT p.tno, MAX(p.pno) as pno FROM `".$currdb->prefix("wiki_post")."`p INNER JOIN `".$currdb->prefix("wiki_topic")."`t ON t.tno=p.tno WHERE t.showlink=1 GROUP BY p.tno ");
	$result = $currdb->query($sql);

	$arr = array();
	while($res = $currdb->fetch_array($result))
	{
		$arr[] = $res['pno'];
	}

	$sql = ("SELECT SQL_CALC_FOUND_ROWS t.title ,p.tno,p.pno,p.content FROM `".$currdb->prefix("wiki_post")."`p INNER JOIN `".$currdb->prefix("wiki_topic")."`t ON t.tno=p.tno WHERE (p.content LIKE '%".$keyword."%' OR t.title LIKE '%".$keyword."%') AND p.pno IN ('".implode("','",$arr)."') LIMIT ".$low.",".$high);
	$result = $currdb->query($sql);
	
	$count_res = $currdb->query("SELECT FOUND_ROWS()");
	$count = $currdb->fetch_array($count_res);
	$count = $count[0];
	if($cou) return $count;

	$arr = array();
	while($res = $currdb->fetch_array($result))
	{
		$res['url'] = URL.'/module/superask/view.php?tno='.$res['tno'];
		$res['content'] = preg_replace('/\[[^\]]*\]/i', '', $res['content']);
		$res['content'] = _substrfix($res['content'],100);
		$arr['data'][] = $res;
	}

	$arr['count'] = $count;
	return $arr;
}


function search_life($keyword,$low,$high,$cou = false)
{
	global $currdb;
	$source=$currdb->query("SELECT SQL_CALC_FOUND_ROWS * FROM `".$currdb->prefix("life_main")."` as m INNER JOIN `".$currdb->prefix("life_category")."` as c on m.csn = c.csn WHERE m.main LIKE '%".$keyword."%' OR	c.title LIKE '%".$keyword."%' LIMIT ".$low.",".$high);

	$result = $currdb->query("SELECT FOUND_ROWS()");
	$count = $currdb->fetch_array($result);
	$count = $count[0];
	if($cou) return $count;

	$result = array();
	while($results=$currdb->fetch_array($source)){
		$results['url'] = URL."/module/lifemigi/".$results['hyperlink'];
		$results['content'] = preg_replace('/<[^>]*>/i', '', $results['main']);
		if($results['content']=="空的")
			$results['content']=$results['title'];
			$results['content'] = _substrfix($results['content'], 100);
		$result['data'][] = $results;
	}

	$result['count'] = $count;
	return $result;
}

function search_must($keyword,$low,$high,$cou = false)
{
	global $currdb;
	$source=$currdb->query("SELECT SQL_CALC_FOUND_ROWS * FROM `".$currdb->prefix("must_main")."` as m INNER JOIN `".$currdb->prefix("must_category")."` as c on m.csn = c.csn WHERE m.main LIKE '%".$keyword."%' OR	c.title LIKE '%".$keyword."%' LIMIT ".$low.",".$high);

	$result = $currdb->query("SELECT FOUND_ROWS()");
	$count = $currdb->fetch_array($result);
	$count = $count[0];
	if($cou) return $count;

	$result = array();
	while($results=$currdb->fetch_array($source)){
		if($results['csn'] <= 1036 && $results['csn'] >= 1016) $results['hyperlink'] = 'index.php?csn='.$results['csn'];
		$results['url'] = URL."/module/mustknow/".$results['hyperlink'];
		$results['content'] = preg_replace('/<[^>]*>/i', '', $results['main']);
		if($results['content']=="空的")
			$results['content']=$results['title'];
			$results['content'] = _substrfix($results['content'], 100);
		$result['data'][] = $results;
	}

	$result['count'] = $count;
	return $result;
}

function search_forum($keyword, $low, $high, $cou=false)
{
	global $currdb;

	// join 回覆 .. 很慢
	//$source = $currdb->query("SELECT SQL_CALC_FOUND_ROWS DISTINCT ft.`topic_no` as 'no', ft.`content`, ft.`title` FROM `".$currdb->prefix('forum_topic')."` ft INNER JOIN `".$currdb->prefix('forum_board')."` fb ON fb.`board_no`=ft.`board_no` LEFT JOIN `".$currdb->prefix('forum_reply')."` fr ON ft.`topic_no`=fr.`topic_no` WHERE ft.`die`='0' AND fb.`name`!='TEST' AND (ft.`title` LIKE '%".$keyword."%' OR ft.`content` LIKE '%".$keyword."%' OR fr.`content` LIKE '%".$keyword."%') LIMIT $low, $high");
	
	// 只有本文
	$source = $currdb->query("SELECT SQL_CALC_FOUND_ROWS DISTINCT ft.`topic_no` as 'no', ft.`content`, ft.`title`, fb.`name` FROM `".$currdb->prefix('forum_topic')."` ft INNER JOIN `".$currdb->prefix('forum_board')."` fb ON fb.`board_no`=ft.`board_no` WHERE ft.`die`='0' AND fb.`name`!='TEST' AND (ft.`title` LIKE '%".$keyword."%' OR ft.`content` LIKE '%".$keyword."%') LIMIT $low, $high");
	
	$result = $currdb->query("SELECT FOUND_ROWS()");
	$count = $currdb->fetch_array($result);
	$count = $count[0];
	if($cou) return $count;

	$result = array();
	while($vars = $currdb->fetch_array($source)){
		$data = array();
		$data['url'] = URL.'/module/forum/viewtopic.php?no='.$vars['no'];
		$data['content'] = _substrfix($vars['content'], 100);
		$data['title'] = "[{$vars['name']}] {$vars['title']}";
		$result['data'][] = $data;
	}

	$result['count'] = $count;
	return $result;
}

?>
