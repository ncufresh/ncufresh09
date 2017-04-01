<?php

require_once '../../mainfile.php';

/*
$sql = "
	SELECT
	`wt`.`tno` as 'board_no',
	`wt`.`cno` as 'group_no',
	`wt`.`title` as 'name',
	`wt`.`title`,
	`g`.`gno` as 'admin'
	FROM `".$currdb->prefix('group')."` g
	INNER JOIN `".$currdb->prefix('wiki_topic')."` wt ON `wt`.`gno`=`g`.`gno`
	";

$result = $currdb->query($sql);

while($vars = $currdb->fetch_array($result))
{
	$sql = "INSERT INTO `".$currdb->prefix('forum_board')."`(`board_no`,`group_no`,`name`,`title`,`admin`) 
		VALUES('{$vars['board_no']}', '{$vars['group_no']}', '{$vars['name']}', '{$vars['title']}', '{$vars['admin']}')";
	
	$currdb->query($sql);
}

$sql = "
	SELECT 
	`cno` as 'group_no',
	`name`,
	`name` as 'title', 
	`parent` as 'parents',
	`ord` as 'priority'
	FROM `".$currdb->prefix('wiki_category')."`
	";

$result = $currdb->query($sql);

while($vars = $currdb->fetch_array($result))
{
	$sql = "INSERT INTO `".$currdb->prefix('forum_group')."`(`group_no`,`name`,`title`,`parents`,`priority`)
		VALUES('{$vars['group_no']}', '{$vars['name']}', '{$vars['title']}', '{$vars['parents']}', '{$vars['priority']}')";
	
	$currdb->query($sql);
}
 */
echo 'end';

?>
