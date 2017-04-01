<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

function userCal()
{
	$block = array();
	
	global $curruser, $currtpl;

	$date = $_GET['date'] != '' ? $_GET['date'] : date('Y/m/d');
	list($year, $mon, $day) = explode('/', $date);
	
	$type = $_GET['type'] != '' ? $_GET['type'] : 'mon'; $_GET['type'] = $type;

	if(empty($_GET['userType']) && intval($_GET['no']) > 0)
	{
		$no = intval($_GET['no']);
		$_GET['userType'] = 'G';
	}
	else if(in_array($_GET['userType'], array('U','G','UG')))
	{
		$no = intval($_GET['no']);
	}
	else
	{
		$no = $curruser->uno;
		$_GET['userType'] = 'UG';
	}
	$_GET['no'] = $no;

	$sdate = intval($_GET['sdate']);
	switch($type)
	{
	case 'mon':
		$mon += $sdate;
		break;
	case 'week':
		$day += $sdate*7;
		break;
	case 'day';
		$day += $sdate;
		break;
	}

	$mkt = mktime(0,0,0,$mon,$day,$year);
	$year = date('Y', $mkt);
	$mon = date('n', $mkt);
	$day = date('j', $mkt);
	$week = date('w', $mkt);

	$_GET['date'] = "$year/$mon/$day";

	switch($type)
	{
	case 'min':
		$info = getMonthact($mkt, $no, $_GET['userType']);
		break;
	case 'mon':
	case 'week':
		$info = getMonthact($mkt, $no, $_GET['userType']);
		break;
	case 'day':
		$info = getDayact($mkt, $no, $_GET['userType']);
		break;
	default:
		dies('error type');
	}
	
	$year_now = date('Y');
	$mon_now = date('n');
	$day_now = date('j');
	
	$week_first = date('w', mktime(0,0,0,$mon,1,$year));
	$days = date('t', mktime(0,0,0,$mon,$day,$year));
	
	$mkt_last = mktime(0,0,0,$mon-1,1,$year);
	$mon_last = date('n', $mkt_last);
	$days_last = date('t', $mkt_last);
	
	$mkt_next = mktime(0,0,0,$mon+1,1,$year);
	$mon_next = date('n', $mkt_next);
	
	$dateurl['year'] = $year;
	$dateurl['mon'] = $mon;
	$dateurl['type'] = $type;
	$dateurl['date'] = $mkt;

	if($type == 'mon' || $type == 'min')
	{
		$s = 1 - $week_first;
		$e = ceil(($days + $week_first) / 7) * 7 - $week_first;

	}
	elseif($type == 'week')
	{
		$s = $day - date('w', $mkt);
		$e = $s + 6;
	}
	else
	{
		$tmp = array('日', '一', '二', '三', '四', '五', '六');
		$dateurl['class'] = "w$week";
		$s = $day;
		$e = $s;
	}
	
	$dateinfo = array();
	for($i = $s, $iweek = 0; $i <= $e; $iweek = (++$i - $s) % 7)
	{
		$dateinfo[$i]['week'] = $iweek;
	
		$dateinfo[$i]['class'] = "w$iweek";
		if($i == $day)
			    $dateinfo[$i]['class'] .= ' dselected';
		if($i == $day_now && $mon == $mon_now && $year == $year_now)
			    $dateinfo[$i]['class'] .= ' dtoday';
	
		if($i <= 0)
		{
			$dateinfo[$i]['class'] .= ' dlast';
			$dateinfo[$i]['date'] = $mon_last.'/'.($days_last + $i);
		}
		elseif($i <= $days)
			$dateinfo[$i]['date'] = $mon.'/'.$i;
		else
		{
			$dateinfo[$i]['class'] .= ' dnext';
			$dateinfo[$i]['date'] = $mon_next.'/'.($i - $days);
		}
	
		$dateinfo[$i]['data'] = $info[$i];
	
		if($type == 'min')
		{
			$dateinfo[$i]['data'] = '';
			if($info[$i])
				$dateinfo[$i]['date'] = '<a href="calendar.php?date='.$year.'/'.$mon.'/'.$i.'&type=day">'.$i.'</a>';
			else
				$dateinfo[$i]['date'] = $i;
		}
	}
	if($type == 'day')
		$dateinfo[$s]['class'] = str_replace('w0', "w$week", $dateinfo[$s]['class']);

	$dateurl['serial'] = 'userType='.$_GET['userType'].'&amp;no='.$_GET['no'];

	$block['url'] = $dateurl;
	$block['info'] = $dateinfo;
	$block['tno'] = $_GET['tno'];

	return $block;
}
 
?>
