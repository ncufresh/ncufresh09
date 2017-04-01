<?
function groupGet($level = 1)
{
	global $currdb, $curruser;

	$myGroup = array();

	$result = $currdb->query("SELECT g.gno FROM `".$currdb->prefix("gmember")."` m INNER JOIN `".$currdb->prefix("group")."` g ON g.gno=m.gno AND m.level >= ".$level." WHERE m.uno='".$curruser->uno."'");

	while ($tmp = $currdb->fetch_array($result))
		$myGroup[] = $tmp["gno"];

	return $myGroup;
}

function groupAdd($name,$introduce,$motd,$public)
{
	global $currdb;
		
	$criteria = new CriteriaCompo(new Criteria("gno",intval($gno)));
	$criteria->add(new Criteria("name", htmlencode($name)));
	$criteria->add(new Criteria("introduce",htmlencode($introduce)));
	$criteria->add(new Criteria("motd",htmlencode($motd)));
	$criteria->add(new Criteria("public",intval($public)));
	$currdb->query("INSERT INTO `".$currdb->prefix("group")."` ".$criteria->insertsql());

	return $currdb->insert_id();
}
	
function memberAdd($gno, $uno, $level = 1)
{
	global $currdb;

	$criteria = new CriteriaCompo(new Criteria("gno", intval($gno)));
	$criteria->add(new Criteria("uno", intval($uno)));

	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("gmember")."` WHERE ".$criteria->render());

	if ($currdb->num_rows($result) == 0 && $uno > 0)
	{
		$criteria->add(new Criteria("level", intval($level)));
		$criteria->add(new Criteria("itime", time()));

		$currdb->query("INSERT INTO `".$currdb->prefix("gmember")."` ".$criteria->insertsql());
	}
}

function memberDelete($gno, $uno = NULL)
{
	global $currdb;

	$criteria = new CriteriaCompo(new Criteria("gno", intval($gno)));

	if(!empty($uno))
		$criteria->add(new Criteria("uno", intval($uno)));

	$currdb->query("DELETE FROM `".$currdb->prefix("gmember")."` WHERE ".$criteria->render());
}

function actCreate($subject, $content, $type, $owner_no)
{
	global $currdb;

	$criteria = new CriteriaCompo(new Criteria("ano", ""));
	$criteria->add(new Criteria("subject", htmlencode($subject)));
	$criteria->add(new Criteria("content", htmlencode($content)));
	$criteria->add(new Criteria("owner_type", $type));
	$criteria->add(new Criteria("owner_no", intval($owner_no)));

	$currdb->query("INSERT INTO `".$currdb->prefix("schedule_act")."` ".$criteria->insertsql());

	return $currdb->insert_id();
}

function actDel($ano)
{
	global $currdb;

	$result = $currdb->query("DELETE FROM `".$currdb->prefix("schedule_act")."` WHERE ano='".intval($ano)."'");

	return $result;
}
	
function schDel($sno)
{
	global $currdb;

	$result = $currdb->query("DELETE FROM `".$currdb->prefix("schedule_sch")."` WHERE sno='".intval($sno)."'");

	return $result;
}
	
function actModify($ano,$subject,$content)
{
	global $currdb;

	//$criteria = new CriteriaCompo(new Criteria("sno",""));
	$criteria = new CriteriaCompo(new Criteria("subject",htmlencode($subject)));
	$criteria->add(new Criteria("content",htmlencode($content)));

	$result = $currdb->query("UPDATE `".$currdb->prefix("schedule_act")."` ".$criteria->updatesql()." WHERE ano='".intval($ano)."'");
}

function schCreate($ano, $start_time, $end_time, $type, $interval, $weekdays)
{
	$ano = intval($ano);

	$result = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("schedule_act")."` WHERE ano='".$ano."'");

	if ($GLOBALS["currdb"]->num_rows($result) != 1)
		return 0;

	$criteria = new CriteriaCompo(new Criteria("sno", ""));
	$criteria->add(new Criteria("ano", $ano));
	$criteria->add(new Criteria("start_date", date("Y-m-d", $start_time)));
	$criteria->add(new Criteria("end_date", date("Y-m-d", $end_time)));
	$criteria->add(new Criteria("type", $type));
	$criteria->add(new Criteria("interval", intval($interval)));
	$criteria->add(new Criteria("weekdays", $weekdays));

	$result = $GLOBALS["currdb"]->query("INSERT INTO `".$GLOBALS["currdb"]->prefix("schedule_sch")."` ".$criteria->insertsql());

	return ($result) ? 1 : 0;
}

function schModify($sno, $start_time, $end_time, $type, $interval, $weekdays)
{
	$sno = intval($sno);

	$result = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("schedule_sch")."` WHERE sno='".$sno."'");

	if ($GLOBALS["currdb"]->num_rows($result) != 1)
		return 0;

	$criteria = new CriteriaCompo(new Criteria("start_date", date("Y-m-d", $start_time)));
	$criteria->add(new Criteria("end_date", date("Y-m-d", $end_time)));
	$criteria->add(new Criteria("type", $type));
	$criteria->add(new Criteria("interval", intval($interval)));
	$criteria->add(new Criteria("weekdays", $weekdays));

	$result = $GLOBALS["currdb"]->query("UPDATE `".$GLOBALS["currdb"]->prefix("schedule_sch")."` ".$criteria->updatesql()." WHERE sno='".$sno."'");

	return ($result) ? 1 : 0;
}
?>
