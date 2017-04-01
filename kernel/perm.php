<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

class PermHandler extends ObjectHandler
{
	var $permlist = array();

	/**
	* constructor
	*/
	function PermHandler(&$db)
	{
		$this->db =& $db;
		$this->table = $this->db->prefix("perm");
		$this->key = "perm_id";

		$this->getpermlist(0);
	}

	/**
	* get perm list
	* @return array of perms
	* @param $fresh: 1: fresh 0: not fresh
	*/
	function getpermlist($fresh = 0)
	{
		if (count($this->permlist) == 0 || $fresh)
		{
			$result = $this->db->query("SELECT * FROM `".$this->table."` ORDER BY perm_id ASC");

			$this->permlist = array();

			while ($perm = $this->db->fetch_array($result))
				$this->permlist[] = $perm;
		}

		return $this->permlist;
	}

	/**
	* add perm to perm table
	* @param $perm_name: name of the perm which you want to add
	*/
	function addperm($perm_name)
	{
		$criteria = new CriteriaCompo(new Criteria("perm_name", $perm_name));
		$result = $this->db->query("SELECT * FROM `".$this->table."` WHERE ".$criteria->render());

		if ($this->db->num_rows($result) == 0)
		{
			$this->getpermlist(1);
			$perm_id = $this->permlist[count($this->permlist) - 1]["perm_id"] * 2;
			$this->db->query("INSERT INTO `".$this->table."` SET perm_name='".$perm_name."', perm_id='".$perm_id."'");
			$this->getpermlist(1);
		}
	}

	/**
	* delete perm from perm table
	* @param $perm_name: name of the perm which you want to delete
	*/
	function delperm($perm_name)
	{
		$criteria = new CriteriaCompo(new Criteria("perm_name", $perm_name));

		$result = $this->db->query("SELECT * FROM `".$this->table."` WHERE ".$criteria->render());

		if ($this->db->num_rows($result) == 1)
		{
			$this->db->query("DELETE FROM `".$this->table."` WHERE ".$criteria->render());
			$this->getpermlist(1);
		}
	}	

	/**
	* get perm id by name
	* @return perm id
	* @param $name: name of the perm which you want to get
	*/
	function getpermbyname($name)
	{
		for ($i = 0;$i < count($this->permlist);$i++)
		{
			if ($this->permlist[$i]["perm_name"] == $name)
				return $this->permlist[$i]["perm_id"];
		}

		return -1;
	}

	/**
	* get valid perm
	* @return perm id
	*/
	function getpermdeny()
	{
		return $this->getpermbyname("PERM_DENY");
	}

	/**
	* get valid perm
	* @return perm id
	*/
	function getpermvalid()
	{
		return $this->getpermbyname("PERM_VALID");
	}

	/**
	* get admin perm
	* @return perm id
	*/
	function getpermadmin()
	{
		return $this->getpermbyname("PERM_ADMIN");
	}
}
?>
