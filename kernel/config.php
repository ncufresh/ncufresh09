<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

class Config extends Object
{
	/* if the system is active */
	var $active = 0;

	/**
	* check if the system is active
	* @return 1: active 2: not active
	*/
	function isactive()
	{
		return ($this->active == 1) ? 1 : 0;
	}
}

class ConfigHandler extends ObjectHandler
{
	/**
	* constructor
	*/
	function ConfigHandler(&$db)
	{
		$this->db =& $db;
		$this->table = $this->db->prefix("config");
		$this->key = "conf_id";
	}

	/**
	* load config from config table
	* @return configs
	*/
	function loadconfig()
	{
		$configs = new Config();

		$result = $this->db->query("SELECT * From `".$this->table."`");

		if ($this->db->num_rows($result) > 0)
		{
			while ($conf = $this->db->fetch_array($result))
				$configs->$conf["conf_name"] = $conf["conf_value"];

			$configs->root_path = ROOT_PATH;
			$configs->url = URL;
			$configs->phpself = "http://".$_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
			$configs->query_str = $_SERVER["QUERY_STRING"];
			$configs->path = substr(realpath("./"), strlen(realpath(ROOT_PATH)) + 1);
			$configs->nowtime = date("Y/m/d g:i A");
			$configs->active = 1;

			//$result = $this->db->query("SELECT COUNT(*) From `".$this->db->prefix("online")."`");
			$result = $this->db->query("SELECT COUNT(DISTINCT ip_addr) From `".$this->db->prefix("online")."`");
			$result = $this->db->fetch_array($result);

			$configs->online_users = $result[0];
		}

		return $configs;
	}

	/**
	* update config
	* @param $config: config name
	* @param $value: config value
	**/
	function updateconfig($config, $value)
	{
		$criteria = new CriteriaCompo(new Criteria("conf_value", $value));
		$criteria2 = new CriteriaCompo(new Criteria("conf_name", $config));

		$this->db->query("UPDATE `".$this->table."` ".$criteria->updatesql()." WHERE ".$criteria2->render());
	}
}
?>
