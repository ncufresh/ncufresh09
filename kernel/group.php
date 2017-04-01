<?
if (!defined("MAINFILE_INCLUDED"))
        exit();

class Group extends Object
{
	var $g_handler;
	function Group(){
		$this->g_handler =& gethandler("group");
	}
}

class GroupHandler extends ObjectHandler
{
        /**
        * constructor
        */
	function GroupHandler(&$db)
	{
		$this->db =& $db;
		$this->table = $this->db->prefix("group");
		$this->mtable = $this->db->prefix("gmember");
		$this->key = "gno";
	}

	function GroupAdd($name,$intro,$motd,$pub)
	{
 		$criteria = new CriteriaCompo(new Criteria("name",htmlencode($name)));
		$criteria->add(new Criteria("introduce",htmlencode($intro)));
		$criteria->add(new Criteria("motd",htmlencode($motd)));
		$criteria->add(new Criteria("public",intval($pub)));
	 	$currdb->query("INSERT INTO `".$this->table."` ".$criteria->insertsql());

		return $currdb->insert_id(); 
	}

	function GroupDelete($gno)
	{
		$this->memberDelete($_GET['gno']);
		$this->db->query("DELETE FROM `".$this->table."` WHERE gno='".$gno."'");
	}

	function GroupModify($gno,$name,$intro,$motd,$pub)
	{
		 $criteria = new CriteriaCompo(new Criteria("name", htmlencode($name)));
		 $criteria->add(new Criteria("introduce", htmlencode($intro)));
		 $criteria->add(new Criteria("motd", htmlencode($motd)));
		 $criteria->add(new Criteria("public", intval($pub)));

		 $this->db->query("UPDATE `".$this->table."` ".$criteria->updatesql()." WHERE gno='".$gno."'");
	}

	function memberAdd($gno, $uno, $level = 0)
	{
			$criteria = new CriteriaCompo(new Criteria("gno", intval($gno)));
			$criteria->add(new Criteria("uno", intval($uno)));
            $criteria->add(new Criteria("level", intval($level)));
			$criteria->add(new Criteria("itime", time()));

			if (!$this->ispublic($gno))
			{
				if($this->isGroupAdmin($gno,$GLOBALS['curruser']->uno))
				{
					$this->db->query("INSERT INTO `".$this->mtable."` ".$criteria->insertsql());
					return true;
				}
				return false;
			}
			else if (!($this->inGroup($gno,$uno)) && $uno > 0)
        	{

				$this->db->query("INSERT INTO `".$this->mtable."` ".$criteria->insertsql());
				return true;
        	}
	}

	function memberDelete($gno, $uno = NULL)
	{
		if($curruser->uno == $uno && $gno == $this->getGroupByEngName($curruser->department)){
			//echo "不能刪除自己的系所喔～";
		}else if($this->isLastAdmin($gno)){
			//echo "你是最後一個管理者囉～";
		}else{
        		$criteria = new CriteriaCompo(new Criteria("gno", intval($gno)));

		        if(!empty($uno))
                		$criteria->add(new Criteria("uno", intval($uno)));

			$this->db->query("DELETE FROM `".$this->mtable."` WHERE ".$criteria->render());
		}
	}

	function getGroupByEngName($gname = NULL)
	{
		//$group = new Group();
	
                if ($gname != NULL)
                {
			$criteria = new CriteriaCompo(new Criteria("engName", htmlencode($gname)));

                        $result = $this->db->query("SELECT gno FROM `".$this->table."` WHERE ".$criteria->render());

			if ($this->db->num_rows($result) == 1){
				$a = $this->db->fetch_array($result);
				return $a["gno"];
			}
                }

                return NULL;		
	}

	function getGroupByNo($gno)
	{
		$criteria = new CriteriaCompo(new Criteria("gno",intval($gno)));
		$result = $this->db->query("SELECT * FROM `".$this->table."` WHERE ".$criteria->render());
		$a = $this->db->fetch_array($result);
		return $a["name"];
	}

	function isLastAdmin($gno)
	{
		$criteria = new CriteriaCompo(new Criteria("gno",intval($gno)));
		$criteria->add(new Criteria("level",3));
		$criteria->add(new Criteria("uno",$GLOBALS["curruser"]->uno));
		$result = $this->db->query("SELECT COUNT(*) AS count FROM`".$this->mtable."` WHERE ".$criteria->render());
		$a = $this->db->fetch_array($result);
		return ($a["count"]==1)?true:false;
	}

	function inGroup($gno,$uno,$level = 0)
	{
		$criteria = new CriteriaCompo(new Criteria("gno", intval($gno)));
		$criteria->add(new Criteria("uno", intval($uno)));
		$criteria->add(new Criteria("level", intval($level),">="));

		$result = $this->db->query("SELECT * FROM `".$this->mtable."` WHERE ".$criteria->render());
		
		//	$result = $this->db->query("SELECT gno FROM `".$this->mtable."` WHERE level>=".$level." AND uno='".$uno."'");
		return ($this->db->num_rows($result) > 0)?true:false;
	}

	function isGroupAdmin($gno,$uno)
	{
		if($GLOBALS['curruser']->isadmin())
			return true;
		else
			return $this->inGroup($gno,$uno,3);
	}

	function ispublic($gno)
	{
		$result = $this->db->query("SELECT public FROM `".$this->table."` WHERE gno='".$gno."'");
		$res = $this->db->fetch_array($result);
		return $res['public'];
	}
}
?>
