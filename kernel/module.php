<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

class Module extends Object
{
	/* link to module handler */
	var $m_handler;

	/* link to perm handler */
	var $p_handler;

	/* module info loaded from module.php */
	var $modinfo = array();

	/* perm id of the module admin */
	var $permid = -1;

	/* blocks of the module */
	var $block = array();

	/**
	* constructor
	*/
	function Module($name = null)
	{
		$this->m_handler =& gethandler("module");

		$this->p_handler =& gethandler("perm");
	}

	/**
	* load info from module.php
	*/
	function loadinfo()
	{
		$this->permid = $this->p_handler->getpermbyname($this->perm_name);

		if ($this->name != "system")
		{
			if (strcasecmp(substr(realpath(ROOT_PATH."/module/".$this->name), 0, strlen(ROOT_PATH."/module")), realpath(ROOT_PATH."/module")))
			{
				$this->active = 0;
				return ;
			}

			if (file_exists(ROOT_PATH."/module/".$this->name."/module.php"))
			{
				require(ROOT_PATH."/module/".$this->name."/module.php");
				$this->modinfo = $modinfo;
				$this->block = $modinfo["block"];
			}
		}
	}

	/**
	* if the module is active
	* @return 1: active 0: not active
	*/
	function isactive()
	{
		return ($this->active == 1) ? 1 : 0;
	}

	/**
	* check if admin of the module
	* @return 1: module admin 0: not module admin
	* @param $perm: perm id which you want to check if the module admin
	*/
	function isadmin($user)
	{
		if (is_object($user) && get_class($user) == get_class($GLOBALS["curruser"]))
			return ((intval($user->perm) & intval($this->p_handler->getpermadmin())) || (intval($user->perm) & intval($this->permid))) ? 1 : 0;
		else
			return 0;
	}
}

class ModuleHandler extends ObjectHandler
{
	/* hide the module link in the main menu */
	var $hidelink = 0;

	/* show the module link in the main menu */
	var $showlink = 1;

	/**
	* constructor
	*/
	function ModuleHandler(&$db)
	{
		$this->db =& $db;
		$this->table = $this->db->prefix("module");
		$this->key = "mno";
	}

	/**
	* get the module
	* @return module
	*/
	function &getmodule(&$criteria)
	{
		$module = new Module();

		if (isset($criteria) && is_subclass_of($criteria, "criteriaelement") && $criteria->render() != "")
		{
			$result = $this->db->query("SELECT * FROM `".$this->table."` WHERE ".$criteria->render());

			if ($this->db->num_rows($result) == 1)
				$module->setvars($this->db->fetch_array($result));

			$module->loadinfo();
		}

		return $module;
	}

	/**
	* get module by name
	* @return module
	* @param $name: module name of the module
	*/
	function &getmodulebyname($name = null)
	{
		if (!$name)
		{
			$name = explode("/", strstr($_SERVER["REQUEST_URI"], "/module/"));
			if (!empty($name[2]))
				$name = $name[2];
			else
				$name = "system";
		}

		$criteria = new CriteriaCompo(new Criteria("name", $name));

		return $this->getmodule($criteria);
	}

	/**
	* get module by no
	* @return module
	* @param $no: module no of the module
	*/
	function &getmodulebyno($no)
	{
		$criteria = new CriteriaCompo(new Criteria("mno", $no));

		return $this->getmodule($criteria);
	}

	/**
	* set module active or not
	* @param $mno: mno of the module which you want to change settings
	* @param $active: 1: active 0: deactive
	*/
	function setactive($no, $active)
	{
		$criteria = new CriteriaCompo(new Criteria("mno", $no));
		$criteria2 = new CriteriaCompo(new Criteria("active", ($active == 1) ? 1 : 0));

		$this->db->query("UPDATE `".$this->table."` ".$criteria2->updatesql()." WHERE ".$criteria->render());
	}

	/**
	* set hide/show module link in main menu
	* @param $no: module no of module which you want to set
	* @param $show: $this->hidelink: hide module link else: show module link
	*/
	function setshowlink($no, $show)
	{
		$show = ($show == $this->hidelink) ? $this->hidelink : $this->showlink;

		$criteria = new CriteriaCompo(new Criteria("mno", $no));

		$this->db->query("UPDATE `".$this->table."` SET showlink='".$show."' where ".$criteria->render());
	}
}
?>
