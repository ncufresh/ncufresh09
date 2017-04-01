<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

class User extends Object
{
	/* link to user handler */
	var $u_handler;

	/* link to perm handler */
	var $p_handler;

	/* 1: guest 0: user */
	var $isguest;
	
	var $g_handler;

	/**
	* constructor
	*/
	function User()
	{
		$this->u_handler =& gethandler("user");

		$this->p_handler =& gethandler("perm");

		$this->g_handler =& gethandler("group");

		$this->isguest = 1;
	}

	/**
	* @return 1: have perm  0: doesn't have perm
	* @param $permid: the id of perm which you like to check
	*/
	function haveperm($permid)
	{
		if (intval($this->perm) & intval($this->p_handler->getpermadmin()))
			return ($permid == $this->p_handler->getpermdeny()) ? 0 : 1;
		else if (intval($this->perm) & intval($this->p_handler->getpermdeny()))
			return 0;
		else if (intval($this->perm) & intval($permid))
			return 1;
		else if(intval($permid) == 0)
			return 1;
		else
			return 0;
	}

	/**
	* @return 1: guest 0: user
	*/
	function isguest()
	{
		return ($this->isguest == 1) ? 1 : 0;
	}

	/**
	* @return 1: admin 0: other
	*/
	function isadmin()
	{
		return $this->haveperm($this->p_handler->getpermadmin());
	}

	/**
	* @return 1: online 0: offline
	*/
	function isonline()
	{
		return $this->u_handler->isonline($this->uid);
	}
}

class UserHandler extends ObjectHandler
{
	/**
	* constructor
	*/
	function UserHandler(&$db)
	{
		$this->db =& $db;
		$this->table = $this->db->prefix("user");
		$this->key = "uno";
	}

	/**
	* @return user
	*/
	function &getuser(&$criteria)
	{
		$user = new User();

		if (isset($criteria) && is_subclass_of($criteria, "criteriaelement") && $criteria->render() != "")
		{
			$result = $this->db->query("SELECT * FROM `".$this->table."` WHERE ".$criteria->render());

			if ($this->db->num_rows($result) == 1)
				$user->setvars($this->db->fetch_array($result));
		}

		if ($user->uno > 0)
			$user->isguest = 0;

		return $user;
	}

	/**
	* get user by user id
	* @return user
	*/
	function &getuserbyid($uid)
	{
		$criteria = new CriteriaCompo(new Criteria("uid", strtolower($uid)));

		return $this->getuser($criteria);
	}

	/**
	* get user by user no
	* @return user
	*/
	function &getuserbyno($no)
	{
		$criteria = new CriteriaCompo(new Criteria("uno", $no));

		return $this->getuser($criteria);
	}

	/*
	* login user
	* @return user
	* @param $uid: user id which you want to login
	* @param $pwd: password of the user
	*/
	function &loginuser($uid, $pwd)
	{
		$criteria = new CriteriaCompo(new Criteria("uid", strtolower($uid)));
		$criteria->add(new Criteria("pwd", $pwd));

		$user = $this->getuser($criteria);

		if ($user->uno > 0)
		{
			$this->db->query("UPDATE `".$this->table."` SET numlogin='".($user->numlogin + 1)."', ip_addr='".$_SERVER["REMOTE_ADDR"]."' WHERE ".$criteria->render());
		}

		$this->freshonlinetime($user->uid);

		return $user;
	}

	/*
	* fresh the online table and delete users which idle longer than 5 mins
	* @param $uid: the current user id
	*/
	function freshonlinetime($uid)
	{
		$user = $this->getuserbyid($uid);

		if ($user->uno > 0)
			$criteria = new CriteriaCompo(new Criteria("online_id", strtolower($uid)));
		else
		{
			$uid =  $_SERVER["REMOTE_ADDR"];
			$criteria = new CriteriaCompo(new Criteria("online_id", $uid));
		}

		$result = $this->db->query("SELECT * FROM `".$this->db->prefix("online")."` WHERE ".$criteria->render());


		$time = mktime();

		if ($this->db->num_rows($result) <= 0)
			$this->db->query("INSERT INTO `".$this->db->prefix("online")."` (online_id, online_time, online_lasttime, ip_addr) VALUES ('".$uid."', '".$time."', '".$time."', '".$_SERVER["REMOTE_ADDR"]."')");
		else
			$this->db->query("UPDATE `".$this->db->prefix("online")."` SET online_lasttime='".$time."' WHERE ".$criteria->render());


		$time = mktime(date("H"), date("i") - 5, date("s"), date("m"), date("d"), date("Y"));

		$this->db->query("DELETE FROM `".$this->db->prefix("online")."` WHERE online_lasttime < '".$time."'");
	}

	/**
	* check id user is online
	* @return 1: online 0: offine
	* @param $uid: user id which you want to check
	*/
	function isonline($uid)
	{
		$criteria = new CriteriaCompo(new Criteria("online_id", strtolower($uid)));

		$result = $this->db->query("SELECT * FROM `".$this->db->prefix("online")."` WHERE ".$criteria->render());

		return ($this->db->num_rows($result) == 1) ? 1 : 0;
	}

	/**
	* delete user from online table
	* @param $uid: user id which you want to delete
	*/
	function logoutuser($uid)
	{
		$criteria = new CriteriaCompo(new Criteria("online_id", strtolower($uid)));

		$this->db->query("DELETE FROM `".$this->db->prefix("online")."` WHERE ".$criteria->render());
	}

	/**
	* insert new user into user table
	* @return 1: success 0: failed
	* @param $uid: user id which you want to insert into
	* @param $pwd: password of the new user
	*/
	function registeruser($uid, $pwd)
	{
		$uid = strtolower($uid);
		$pwd = $pwd;

		return $this->db->query("INSERT INTO `".$this->table."` (uid, pwd) VALUES ('".$uid."', '".$pwd."')");
	}

	/**
	* modify user's data
	* @param $uno: user no of the user which you want to modify
	* @param $field: the field name which you want to modify
	* @param $value: new value of the field
	*/
	function modifyuser($uno, &$criteria)
	{
		if (isset($criteria) && is_subclass_of($criteria, "criteriaelement") && $criteria->render() != "")
		{
			$criteria2 = new CriteriaCompo(new Criteria("uno", $uno));

			$this->db->query("UPDATE `".$this->table."` ".$criteria->updatesql()." WHERE ".$criteria2->render());
		}
	}

	/**
	* active user
	* @param : $uno: user no of the user which you want to active
	*/
	function activeuser($uno)
	{
		$user = $this->getuserbyno($uno);
		if ($user->uno > 0)
		{
			$criteria = new CriteriaCompo(new Criteria("perm", intval($user->perm) | intval($user->p_handler->getpermvalid())));
			$this->modifyuser($user->uno, $criteria);
		}
	}
}
?>
