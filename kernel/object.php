<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

class Object
{
	var $var = array();

	function __get($varname)
	{
		return $this->var[$varname]["value"];
	}

	function __set($varname, $value)
	{
		$this->var[$varname]["value"] = $value;
	}

	function setvars($var_arr)
	{
		foreach ($var_arr as $varname => $value)
			$this->__set($varname, $value);
	}

	function &cloneobject()
	{
		$class = get_class($this);
		$clone = new $class();
		return $clone;
	}
}

class ObjectHandler
{
	var $db = null;

	var $table = null;

	var $key = null;
}
?>
