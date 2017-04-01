<?
class Database
{
	var $c;
	var $id;

	function Database()
	{
	}

	function connect($host, $user, $pwd)
	{
		$this->id = @mysql_connect($host, $user, $pwd);

		$this->query("SET NAMES utf8");
		return $this->id;
	}

	function select_db($name)
	{
		return @mysql_select_db($name, $this->id);
	}

	function prefix($name)
	{
		return DB_PREFIX."_".$name;
	}

	function query($strsql)
	{
		$this->c[] = $strsql;
		return @mysql_query($strsql, $this->id);
	}

	function num_rows($result)
	{
		return @mysql_num_rows($result);
	}

	function fetch_array($result)
	{
		return @mysql_fetch_array($result);
	}

	function fetch_object($result)
	{
		return @mysql_fetch_object($result);
	}

	function insert_id()
	{
		return mysql_insert_id($this->id);
	}

	function close()
	{
		return @mysql_close($this->id);
	}

	function __destruct()
	{
		//foreach ($this->c as $k => $v)
		//	echo "::".(++$k)."::[".$v."]<br />\n";

		return $this->close();
	}
}
?>
