<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

class FriendHandler extends ObjectHandler
{
	/* bad friend */
	var $badfriend = 1;

	/* good friend */
	var $goodfriend = 2;

	/* link to user handler */
	var $u_handler;

	/**
	* constructor
	*/
	function FriendHandler(&$db)
	{
		$this->db =& $db;
		$this->table = $this->db->prefix("friendlist");
		$this->key = "";

		$this->u_handler =& gethandler("user");
	}

	/**
	* get friends
	* @return array of friends
	*/
	function getfriends(&$criteria)
	{
		if (isset($criteria) && is_subclass_of($criteria, "criteriaelement") && $criteria->render() != "")
		{
			$result = $this->db->query("SELECT * FROM `".$this->table."` WHERE ".$criteria->render());

			while ($tmp = $this->db->fetch_array($result))
			{
				$friend = $this->u_handler->getuserbyno($tmp["fno"]);
				$friend->friendship = $tmp["friendship"];
				$friends[] = $friend;
			}
		}

		return $friends;
	}

	/**
	* get all friends
	* @return array of friends
	* @param $uno: user no which you want to get his/her friends
	*/
	function getallfriends($uno = 0)
	{
		if ($uno == 0)
			$uno = $GLOBALS["curruser"]->uno;

		$criteria = new CriteriaCompo(new Criteria("uno", $uno));

		return $this->getfriends($criteria);
	}

	/**
	* get good friends
	* @return array of good friends
	* @param $uno: user no which you want to get his/her good friends
	*/
	function getgoodfriends($uno = 0)
	{
		if ($uno == 0)
			$uno = $GLOBALS["curruser"]->uno;

		$criteria = new CriteriaCompo(new Criteria("uno", $uno));
		$criteria->add(new Criteria("friendship", $this->goodfriend));

		return $this->getfriends($criteria);
	}

	/**
	* get bad friends
	* @return array of bad friends
	* @param $uno: user no which you want to get his/her bad friends
	*/
	function getbadfriends($uno = 0)
	{
		if ($uno == 0)
			$uno = $GLOBALS["curruser"]->uno;

		$criteria = new CriteriaCompo(new Criteria("uno", $uno));
		$criteria->add(new Criteria("friendship", $this->badfriend));

		return $this->getfriends($criteria);
	}

	/**
	* check if in the user's friend list
	* @return 0: not in the list 1: in the goodfriend list -1: in the badfriend list
	* @parm $uno: user no which you want to check his/her friend list
	* @parm $fno: user no which you want to check if in the friend list
	*/
	function checkinlist($uno, $fno)
	{
		$friends = $this->getgoodfriends($uno);

		for ($i = 0;$i < count($friends);$i++)
		{
			if ($friends[$i]->uno == $fno)
				return 1;
		}

		$friends = $this->getbadfriends($uno);

		for ($i = 0;$i < count($friends);$i++)
		{
			if ($friends[$i]->uno == $fno)
				return -1;
		}

		return 0;
	}

	/**
	* add to the friend list
	* @param $fno: user no which you want to add to friend list
	* @param $friendship: $this->badfriend: bad friend else: good friend
	*/
	function addfriend($fno, $friendship)
	{
		if ($this->checkinlist($GLOBALS["curruser"]->uno, $fno) == 0)
		{
			$user = $this->u_handler->getuserbyno($fno);

			if ($user->uno > 0)
			{
				$friendship = ($friendship == $this->badfriend) ? $this->badfriend : $this->goodfriend;

				$this->db->query("INSERT INTO `".$this->table."` (uno, fno, friendship) VALUES ('".$GLOBALS["curruser"]->uno."', '".$fno."', '".$friendship."')");
			}
		}
	}

	/**
	* delete user from friend list
	* @param $fno: user no which you want to delete from the friend list
	*/
	function delfriend($fno)
	{
		if ($this->checkinlist($GLOBALS["curruser"]->uno, $fno) != 0)
		{
			echo "1";

			$criteria = new CriteriaCompo(new Criteria("uno", $GLOBALS["curruser"]->uno));
			$criteria->add(new Criteria("fno", $fno));

			$this->db->query("DELETE FROM `".$this->table."` WHERE ".$criteria->render());
		}
	}

	/**
	* modify the friendship of the user in the friend list
	* @param $fno: user no which you want to modify friendship in the friend list
	*/
	function turnfriendship($fno)
	{
		if ($this->checkinlist($GLOBALS["curruser"]->uno, $fno) != 0)
		{
			$criteria = new CriteriaCompo(new Criteria("uno", $GLOBALS["curruser"]->uno));
			$criteria->add(new Criteria("fno", $fno));

			$result = $this->db->query("SELECT friendship FROM `".$this->table."` WHERE ".$criteria->render());

			if ($this->db->num_rows($result) == 1)
			{
				$friend = $this->db->fetch_array($result);
				$friendship = ($friend["friendship"] == $this->goodfriend) ? $this->badfriend : $this->goodfriend;
				$this->db->query("UPDATE `".$this->table."` SET friendship='".$friendship."' WHERE ".$criteria->render());
			}
		}
	}
}
?>
