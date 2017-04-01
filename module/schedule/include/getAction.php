<?php

function to_days($mktime)
{
	// 從西元 0 年 0 月 5 日 0 時 0 分 0 秒 ( 禮拜日 ) 算起幾日
	// _days % 7 = 星期
	return ($mktime - 944323200) / 86400;
}
function to_mktime($_days)
{
	return $_days * 86400 + 944323200;
}
function skip_mkt($str)
{
	$ymd = explode('-', $str);
	return mktime(0, 0, 0, intval($ymd[1]), intval($ymd[2]), intval($ymd[0]));
}
function skip_days($str)
{
	return to_days(skip_mkt($str));
}

function get_permsql($viewno, $viewtype)
{
	if($viewtype == 'G')
	{
	    $myAct = "(`owner_type`='G' AND `owner_no`='".$viewno."')";
	}
	elseif($viewtype == 'U')
	{
	    $myAct = "(`owner_type`='U' AND `owner_no`='".$viewno."')";
	}
	elseif($viewtype == 'UG')
	{
	    $myAct = "(`owner_type`='U' AND `owner_no`='".$viewno."')";
	    $gnos = groupGet();
	    if(count($gnos))
		{
			$myAct = '('.$myAct;
	        $myAct .= "OR (`owner_type`='G' AND `owner_no` IN('".implode("', '", $gnos)."')))";
	    }
	}
	return $myAct;
}
function getinfo($anoarray, $anodata)
{
	$info = array();
	foreach($anoarray as $ano => $dates)
	{
		foreach($dates as $date)
		{
			$i = date('j', $date);
			if($_GET['type'] == 'mon')
				$info[$i][] = array(
					'subject' => $anodata[$ano]['subject']
				);
			else
				$info[$i][] = array(
					'subject' => ($anodata[$ano]['nick'] ? '['.$anodata[$ano]['nick'].'] ' : '').$anodata[$ano]['subject'],
					'content' => _replace_code($anodata[$ano]['content']),
					'sno' => $anodata[$ano]['sno']
				);
		}
	}
	/*
	if($_GET['type'] == 'mon')
	{
		list($year, $mon, $day) = explode('/', $_GET['date']);
		$yearmon = $year.'/'.$mon.'/';
		foreach($info as $k => $v)
			$info[$k] = '<a href="?type=day&date='.$yearmon.$k.'">'.$v.'</a>'; 
	}*/

	return $info;
}

/*
 * $mktime = view Day
 * $viewno = UserNo or GroupNo
 * $viewtype = U or G or UG (user and user's group)
 */

function getDayact($mktime, $viewno, $viewtype = 'U')
{
	global $currdb, $curruser;

	$year = date('Y', $mktime);
	$month = date('m', $mktime);
	$day = date('d', $mktime);

	$theDay = $year."-".$month."-".$day;
	
	$myAct = get_permsql($viewno, $viewtype);

	$query = "
SELECT *, g.`nick` FROM `".$currdb->prefix('schedule_sch')."` s INNER JOIN `".$currdb->prefix('schedule_act')."` a ON s.`ano`=a.`ano` LEFT JOIN `".$currdb->prefix('group')."` g ON a.`owner_type`='G' AND a.`owner_no`=g.`gno` WHERE 
".$myAct." AND
((`start_date` = '".$theDay."')
OR
(
 `start_date` <= '".$theDay."'
 AND 
 `end_date` >= '".$theDay."'
 AND
 (
  (`type` = 'D' AND
  ((TO_DAYS('$theDay') - TO_DAYS(`start_date`)) % `interval` = 0
  )
  ) 
  OR
  (`type` = 'W' AND 
  ((FLOOR((TO_DAYS('".$theDay."') +1)  / 7) - FLOOR((TO_DAYS(`start_date`) +1) / 7)) % `interval` = 0  
  )
  )
  OR
  (`type` = 'M' AND
  (('$month' - MONTH(`start_date`)) % `interval` = 0
   AND
   '$day' = DAY(`start_date`)
  )
  )
  OR
  (`type` = 'MW' AND
  (('$month' - MONTH(`start_date`)) % `interval` = 0
  )
  )
  OR
  (`type` = 'Y' AND
  (('$year' - YEAR(`start_date`)) % `interval` = 0 
   AND
   '$month' = MONTH(`start_date`)
   AND
   '$day' = DAY(`start_date`)
  )
  )
 )
))	";

	$result = $currdb->query($query);

	$anoarray = array();
	$anodata = array();
	while($rule =  $currdb->fetch_array($result))
	{
		$tmpano = array();
		list($tmpyear, $tmpmon, $tmpday) = explode("-", $rule['start_date']);
		$tmp_days = skip_days($rule['start_date']);
		switch($rule['type'])
		{
			case 'W':
				$w = date('w', $mktime);
				$check = strpos($rule['weekdays'], $w);
				if ($check !== false)
					$tmpano[] = $mktime;
				break;
			case 'MW':
				$dest_day = ($tmpday + 1) + ($tmpday + 1) % 7 - date('w', mktime(0, 0, 0, $month, 1, $year)) + 1;
				if($dest_day == $day)
					$tmpano[] = $mktime;
				break;
			default:
				$tmpano[] = $mktime;
				break;
		}
		$anoarray[$rule['ano']] = $tmpano;
		$anodata[$rule['ano']] = $rule;
	}
	return getinfo($anoarray, $anodata);
}

function getMonthact($mktime, $viewno, $viewtype = 'U')
{
	global $currdb, $curruser;
	
	$year = date('Y', $mktime);
	$month = date('m', $mktime);
	$days = date('t', $mktime);

	$s_days = to_days(mktime(0, 0, 0,$month,1,$year));
	$e_days = to_days(mktime(0, 0, 0,$month,$days,$year));

	$theStart = $year."-".$month."-01";
	$theEnd = $year."-".$month."-".$days;
	
	$myAct = get_permsql($viewno, $viewtype);

	$query = "
SELECT * FROM `".$currdb->prefix('schedule_sch')."` s INNER JOIN `".$currdb->prefix('schedule_act')."` a ON s.`ano`=a.`ano` WHERE
".$myAct." AND
((`start_date` >= '$theStart' AND `start_date` <= '$theEnd')
OR
(
 `start_date` <= '$theEnd'
 AND 
 `end_date` > '$theStart'
 AND
 (
  (`type` = 'D' AND
  (`interval` - (TO_DAYS('$theStart') - TO_DAYS(`start_date`)) % `interval`
   <= TO_DAYS('$theEnd') - TO_DAYS('$theStart') + 1
  )
  ) 
  OR
  (`type` = 'W' AND 
  (`interval` - (FLOOR((TO_DAYS('$theStart') +1) / 7) - FLOOR((TO_DAYS(`start_date`) +1) / 7)) % `interval`
   <= FLOOR((TO_DAYS('$theEnd') +1) / 7) - FLOOR((TO_DAYS('$theStart') +1) / 7) + 1
  )
  )
  OR
  ((`type` = 'M' OR `type` = 'MW') AND
  (('$month' - MONTH(`start_date`)) % `interval` = 0
  )
  )
  OR
  (`type` = 'Y' AND
  (('$year' - YEAR(`start_date`)) % `interval` = 0
   AND
   '$month' = MONTH(`start_date`)
  )
  )
 )
))	";
	$result = $currdb->query($query);

	$anoarray = array();
	$anodata = array();
	while($rule = $currdb->fetch_array($result))
	{
		list($tmpyear, $tmpmon, $tmpday) = explode("-", $rule['start_date']);
		$tmp_days = skip_days($rule['start_date']);

		$tmpano = array();
		switch($rule['type'])
		{
			case 'N':
				$tmpano[] = to_mktime($tmp_days);
				break;

			case 'D': // Daily
				$diff = $s_days - $tmp_days;

				if ($diff <= 0) 
				{
					$i = $tmp_days;
				}
				else 
				{
					$i = $s_days + $diff % $rule['interval'];
				}

				for($tmp_days = skip_days($rule['end_date']); $i <= $tmp_days && $i <= $e_days; $i += $rule['interval'])
				{
					$tmpano[] = to_mktime($i);
				}
				break;

			case 'W': // Weekly
				$tmpweek = array();
				$tok = explode(",", $rule['weekdays']);
				for ($i = 0, $l = count($tok); $i < $l; ++$i) 
				{
					$tmpweek[intval($tok[$i])] = true;
				}

				if ($s_days <= $tmp_days)
				{
					$i = $tmp_days;
				}
				else
				{
					$tmp = intval($s_days / 7) - intval($tmp_days / 7);
					if($tmp % $rule['interval'] == 0)
						$i = $s_days;
					else
						$i = $s_days - $s_days % 7 + ($rule['interval'] - $tmp % $rule['interval']) * 7 ;
				}

				$tmp_days = skip_days($rule['end_date']);
				for ($week = $i % 7; $i <= $tmp_days && $i <= $e_days; ++$i, $week = ++$week % 7)
				{
					if ($tmpweek[$week] == true) $tmpano[] = to_mktime($i);

					if ($week == 6) $i += ($rule['interval'] - 1) * 7;
				}
				break;

			case 'M': // Monthly
				$tmpano[] = mktime(0, 0, 0, $month, $tmpday, $year);
				break;
			case 'MW':
				$dest_day = ($tmpday + 1) + ($tmpday + 1) % 7 - $s_days % 7 + 1;
				if($dest_day <= $days)
					$tmpano[] = mktime(0, 0, 0, $month, $dest_day, $year);
				break;

			case 'Y': // Yearly
				$tmpano[] = mktime(0, 0, 0, $month, $tmpday, $year);
				break;
		}
		$anoarray[$rule['ano']] = $tmpano;
		$anodata[$rule['ano']] = $rule;
	}

	return getinfo($anoarray, $anodata);
}

?>
