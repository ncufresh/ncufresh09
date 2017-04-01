<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

function error_handler($errNo, $errStr, $errFile, $errLine)
{
	if (ob_get_length())
		ob_clean();

	die('Errorno: '.$errNo);
}

/**
* do some security check
*/
function do_security()
{	
	if(preg_file(ROOT_PATH.'/etc/badip', $_SERVER['REMOTE_ADDR']))
	{
		exit();
	}

	ini_set('session.use_only_cookies', 1);
	set_magic_quotes_runtime(0);

	check_globals();

	transcribe($_GET);
	transcribe($_POST);
	transcribe($_COOKIE);
}

/**
* check if there have any global var's name in the request
*/
function check_globals()
{
	foreach (array('GLOBALS', '_SESSION', 'HTTP_SESSION_VARS', '_GET', 'HTTP_GET_VARS', '_POST', 'HTTP_POST_VARS', '_COOKIE', 'HTTP_COOKIE_VARS', '_REQUEST', '_SERVER', 'HTTP_SERVER_VARS', '_ENV', 'HTTP_ENV_VARS', '_FILES', 'HTTP_POST_FILES', '_COOKIE', 'HTTP_COOKIE_VARS', 'FILES', 'HTTP_POST_FILES', 'currdb', 'currconfig', 'curruser', 'currmodule', 'currtpl', 'currblocks') as $bad_global)
	{
		if (isset($_REQUEST[$bad_global]))
			_redirect(URL);
	}
}

/**
* do stripslashes to get/post/cookie if magic_quotes_gpc is open
* translate encoding to utf-8
*/
function transcribe(&$aList, $aIsTopLevel = true)
{
	$isMagic = get_magic_quotes_gpc();
   
	foreach ($aList as $key => $value)
	{
		if (is_array($value))
		{
//			$ec = mb_detect_encoding($key, "ASCII, BIG-5, UTF-8");
//			$key = iconv($ec, "UTF-8", ($isMagic && !$aIsTopLevel) ? stripslashes($key) : $key);
			$key = (($isMagic && !$aIsTopLevel) ? stripslashes($key) : $key);

			transcribe($value, false);
		}
		else
		{
//			$ec = mb_detect_encoding($key, "ASCII, BIG-5, UTF-8");
//			$key = iconv($ec, "UTF-8", stripslashes($key));
			$key = (stripslashes($key));

//			$ec = mb_detect_encoding($value, "ASCII, BIG-5, UTF-8");
//			$value = iconv($ec, "UTF-8", ($isMagic) ? stripslashes($value) : $value);
			$value = (($isMagic) ? stripslashes($value) : $value);
		}

		$aList[$key] = $value;
	}
}

/**
* send html headers
*/
function htmlheader()
{
	if (!headers_sent())
	{
		header('Content-Type:text/html; charset=utf-8');
		header('Pragma: no-cache');
	}
}

/**
* find the file in the kernel and return the handler class
*/
function &gethandler($name)
{
	static $handlers;

	$name = strtolower(trim($name));

	if (!is_object($handlers[$name]))
	{
		if (file_exists(ROOT_PATH.'/kernel/'.$name.'.php'))
			require_once(ROOT_PATH.'/kernel/'.$name.'.php');

		$fullname = ucfirst($name).'Handler';

		if (class_exists($fullname))
			$handlers[$name] = new $fullname($GLOBALS['currdb']);
	}

	if (!is_object($handlers[$name]))
		dies('Class <b>'.$name.'</b> doesn\'t exists');

	return $handlers[$name];
}

/**
* close the buffer and send some message to client then exit
*/
function dies($msg, $redirect = false)
{
	if ($redirect != false)
		$GLOBALS["currtpl"]->addhdr("<meta http-equiv=\"refresh\" content=\"2;url=".$redirect."\">");

	echo $msg;

	exit();
}

/**
* Save return page. _redirect to this page
 */
function _savePage($url)
{
	if(!is_array($_SESSION['gn_ref']))
		$_SESSION['gn_ref'] = array();

	if(strcasecmp($_SESSION['gn_ref'][0],$_SERVER['REQUEST_URI']))
		array_unshift($_SESSION['gn_ref'],$_SERVER['REQUEST_URI']);

	unset($_SESSION['gn_ref'][5]);

	_redirect($url);
}

/**
* redirect to other url and exit
*/
function _redirect($url = '') {
	if (empty($url)) 
	{   
		$url = $_SERVER['REQUEST_URI'];

		$total = count($_SESSION['gn_ref']);

		for ($i = 0;$i < $total;$i++) {
			if (strcasecmp($url, substr($_SESSION['gn_ref'][$i], 0, strlen($url)))) {
				$url = $_SESSION['gn_ref'][$i];
				break;
			}
		}
	
		if ($i == $total)
			$url = URL;
	}

	if (gettype($url) == 'integer' && abs($url) >= 1 && !empty($_SESSION['gn_ref'][abs($url) - 1]))
		$url = $_SESSION['gn_ref'][abs($url) - 1];

	if (is_object($GLOBALS['currtpl']))
		$GLOBALS['currtpl']->setndisplay();

	header('Location: '.$url);

	exit();
}
//function _redirect($url = "")
//{
//	if (empty($url))
//	{
//		$n_url = $_SERVER["REQUEST_URI"];
//
//		if (isset($_SESSION["ref"]) && strcasecmp($n_url, substr($_SESSION["ref"], 0, strlen($n_url))))
//			$url = $_SESSION["ref"];
//		else if  (isset($_SESSION["ref_o"]) && strcasecmp($n_url, substr($_SESSION["ref_o"], 0, strlen($n_url))))
//			$url = $_SESSION["ref_o"];
//		else
//			$url = URL;
//	}
//
//	if (is_object($GLOBALS['currtpl']))
//		$GLOBALS['currtpl']->setndisplay();
//
//	header('Location: '.$url);
//
//	exit();
//}

/**
* this function are not complete yat
*/
function _substr($str, $start, $length = 0)
{
	return mb_substr($str, $start, $length, 'UTF-8');
}
function _substrfix($str, $len, $fail = '...')
{
	return mb_strimwidth($str, 0, $len, $fail, 'UTF-8');
}

/**
* return the html encode string
*/
function htmlencode($str)
{
	return htmlentities($str, ENT_QUOTES, "UTF-8");
}

/**
* encrypt the password
*/
function _encrypt($str)
{
	return md5($str);
}

/**
* make the page's link
*/
function _multipage($pos, $max, $url, $size = 0)
{
	$size = (intval($size) <= 0) ? 5 : intval($size);

	$link = array();

	$url = eregi_replace('[&?]page=[0-9]*', '', $url);

	$tag = (strpos($url, '?') > 0) ? '&' : '?';

	if (($pos - 1) > $size)
		$link[] = '<a href="'.$url.$tag.'page=1" title="第1頁">&lt;</a>';

	for ($i = ($pos - $size);$i <= ($pos + $size);$i++)
	{
		if ($i <= 0 || $i > $max)
			continue;

		if ($i == $pos)
			$link[] = $i;
		else
			$link[] = '<a href="'.$url.$tag.'page='.$i.'" title="第'.$i.'頁">'.$i.'</a>';
	}

	if (($pos + $size) < $max)
		$link[] = '<a href="'.$url.$tag.'page='.$max.'" title="最後一頁">&raquo;</a>';

	return $link;
}

/**
* make the security ticket
*/
function make_ticket()
{
	$_SESSION["currticket"] = substr(md5($currconfig->session_name.mktime()), 0, 10);

	if (is_object($GLOBALS["currtpl"]))
		$GLOBALS["currtpl"]->assign("currticket", $currticket);
}

/**
*
*/
function binary_and($from, $to)
{
	$from = intval($from);
	$to = intval($to);
	return ($from & $to) ? true : false;
}

function msgsend($fid = '',$title = '',$content = '',$sid = '')
{
		global $curruser,$currdb;

		if(empty($sid)) $sno = $curruser->uno;
		else $sno = $curruser->u_handler->getuserbyid($sid)->uno;

		if($fid == 'NCUFresh')
		{
			$criteria = new CriteriaCompo(new Criteria("mno",""));
			$criteria->add(new Criteria("sender",$sno));
			$criteria->add(new Criteria("email",""));
			$criteria->add(new Criteria("title",$title));
			$criteria->add(new Criteria("content",$content));
			$criteria->add(new Criteria("time",mktime()));
			$criteria->add(new Criteria("isguest",0));
			$criteria->add(new Criteria("ip",$_SERVER["REMOTE_ADDR"]));
			$criteria->add(new Criteria("state",'未處理'));

			$currdb->query("INSERT INTO `".$currdb->prefix("contact")."` ".$criteria->insertsql());
			return true;
		}
		else
		{
			$owner_no = $curruser->u_handler->getuserbyid($fid)->uno;

	        if ($owner_no > 0)
    	    {
        	    $title = htmlencode($title);
            	$content = htmlencode($content);

	            if ($sno > 0 && $owner_no > 0)
    	        {
        	        $criteria = new CriteriaCompo(new Criteria("mno", ""));
            	    $criteria->add(new Criteria("sender_no", $sno));
                	$criteria->add(new Criteria("owner_no", $owner_no));
	                $criteria->add(new Criteria("title", $title));
    	            $criteria->add(new Criteria("content", $content));
        	        $criteria->add(new Criteria("time", mktime()));
            	    $criteria->add(new Criteria("status", '2'));


                	$currdb->query("INSERT INTO `".$currdb->prefix("msg")."` ".$criteria->insertsql());
            	}

				return true;
    	    }
	        else
				return false;
		}
}

function _replace_code($str)
{
	$str = nl2br($str);		
	$str = preg_replace("/\[img\](.*?)\[\/img\]/is", "<img src=\"$1\" border=\"0\" />", $str);
	$str = preg_replace("/\[url\=(.*?)\](.*?)\[\/url\]/is","<a href=\"$1\" target=\"_blank\">$2</a>",$str);
	$str = ereg_replace("[a-zA-Z0-9_]*@[a-zA-Z0-9_.-]*", "<a href=\"mailto:\\0\">\\0</a>", $str);
	//$str = preg_replace('/[^"](http:\/\/[a-z0-9~_\/?&%.-=]*)/i', "<a href=\"\\0\" target=\"_blank\">\\0</a>", $str);
	$str = preg_replace('/(^|[^"])(http:\/\/[^<>]*)/i', "<a href=\"\\0\" target=\"_blank\">\\0</a>", $str);
	return $str;
}

function send_all($title,$content,$sid = '')
{
	global $curruser,$currdb;
	
	$title = htmlencode($title);
	$content = htmlencode($content);
	
	if(empty($sid)) $sno = $curruser->uno;
	else $sno = $curruser->u_handler->getuserbyid($sid)->uno;
	
	$send_array = array();
	
	$result = $currdb->query("SELECT uno FROM `".$currdb->prefix("user")."`");
	while($tmp = $currdb->fetch_array($result))
	{
		$send_array[] = "('".$sno."','".$tmp['uno']."','".$title."','".$content."','".mktime()."','2')";
	}
	
	$currdb->query("INSERT INTO `".$currdb->prefix("msg")."`(sender_no,owner_no,title,content,time,status) VALUES".implode(',',$send_array));
}

function preg_file($file_path, $subject)
{
	if(!file_exists($file_path)) return false;

	$file = file($file_path);

	foreach($file as $line)
	{
		$line = trim($line);
		if($line[0] == '#' || $line == '') continue;

		if(preg_match('/'.$line.'/i', $subject)) return true;
	}

	return false;
}

?>
