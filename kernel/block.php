<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

require_once(ROOT_PATH."/kernel/tpl.php");

class Block extends Object
{
//	/* link to module handler */
//	var $m_handler;

	/* template of the block */
	var $tpl;

	/*
	* constructor
	*/
	function Block()
	{
//		$this->m_handler =& gethandler("module");

		$this->tpl = new Tpl();
	}

	/*
	* exec the block and return the result of the block
	* @return the result of the block
	* @param $display: false: don't display the result of the block true: display the result of the block
	*/
	function fetch($display = false)
	{
		$dir_path = ($this->dirname == "system") ? ROOT_PATH : ROOT_PATH."/module/".$this->dirname;

		if (file_exists($dir_path."/block/".$this->file.".php"))
		{
			global $currconfig, $curruser, $currtpl;

//			$module_handler =& gethandler("module");
//			$currmodule = $module_handler->getmodulebyname($this->dirname);

			if (file_exists($dir_path."/include/comm.php"))
				require_once($dir_path."/include/comm.php");
			if (file_exists($dir_path."/".TEMPLATE_PATH."/style.css"))
				$currtpl->addcss($dir_path."/".TEMPLATE_PATH."/style.css");

			require_once($dir_path."/block/".$this->file.".php");

			$func = $this->main_func;

			if (function_exists($func))
			{
				$block = $func($dirname);

				$this->tpl->settpldir($this->dirname);

				$block["dirname"] = str_replace(ROOT_PATH, URL, $dir_path);
				$this->tpl->assign("block", $block);

				if ($display)
					$this->tpl->display("block/".$this->template);
				else
					$rc = $this->tpl->fetch("block/".$this->template);

				$this->tpl->clear_assign("block");
//				$this->tpl->clear_compiled_tpl("block/".$this->template);

				return $rc;
			}
		}
	}

	/*
	* display the result of the block
	*/
	function display()
	{
		return $this->fetch(true);
	}
}

class BlockHandler extends ObjectHandler
{
	/**
	* constructor
	*/
	function BlockHandler(&$db)
	{
		$this->db =& $db;
		$this->table = $this->db->prefix("block");
		$this->key = "bno";
	}

	/**
	* get the block
	* @return block
	*/
	function getblock(&$criteria)
	{
		$block = new Block();

		if (isset($criteria) && is_subclass_of($criteria, "criteriaelement") && $criteria->render() != "")
		{
			$criteria->add(new Criteria("m.active", 1));

			$result = $this->db->query("SELECT b.*, m.name as dirname FROM `".$this->table."` b LEFT JOIN `".$this->db->prefix("module")."` m ON b.mno=m.mno WHERE ".$criteria->render());

			if ($this->db->num_rows($result) == 1)
				$block->setvars($this->db->fetch_array($result));
		}

		return $block;
	}

	/**
	* get blocks
	* @return array of blocks
	*/
	function getblocks(&$criteria)
	{
		$blocks = array();

		if (isset($criteria) && is_subclass_of($criteria, "criteriaelement") && $criteria->render() != "")
		{
			$criteria->add(new Criteria("m.active", 1));

			$result = $this->db->query("SELECT b.*, m.name as dirname FROM `".$this->table."` b LEFT JOIN `".$this->db->prefix("module")."` m ON b.mno=m.mno WHERE ".$criteria->render()." ORDER BY b.ord ASC");

			for ($i = 0;$tmp = $this->db->fetch_array($result);$i++)
			{
				$blocks[$i] = new Block();
				$blocks[$i]->setvars($tmp);
			}
		}

		return $blocks;
	}

	/**
	* get blocks by module no
	* @return array of blocks
	* @param $mno: module no of the module
	*/
	function getblockbymodule($mno)
	{
		$criteria = new CriteriaCompo(new Criteria("b.mno", $mno));

		return $this->getblocks($criteria);
	}

	/**
	* get blocks which are set to default
	* @return array of blocks
	*/
	function getblockbysystem()
	{
		$criteria = new CriteriaCompo(new Criteria("b.side", 0, "!="));

		return $this->getblocks($criteria);
	}

	/**
	* get block by block no
	* @return block
	* @param $no: block no of the block
	*/
	function getblockbyno($no)
	{
		$criteria = new CriteriaCompo(new Criteria("b.bno", $no));

		return $this->getblock($criteria);
	}
}
?>
