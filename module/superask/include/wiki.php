<?
require_once(ROOT_PATH."/module/".$currmodule->name."/include/parseutil.php");

class WikiCat extends Object
{
	var $parent_o;

	function WikiCat($cno = 0)
	{
		if ($cno > 0)
		{
			$criteria = new CriteriaCompo(new Criteria("cno", $cno));

			$result = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("wiki_category")."`  WHERE ".$criteria->render());

			if ($GLOBALS["currdb"]->num_rows($result) == 1)
			{
				$this->setvars($GLOBALS["currdb"]->fetch_array($result));

				if ($this->manager)
					$this->manager = explode("/", $this->manager);
			}

			$this->parent_o = new WikiCat($this->parent);
		}
	}

	function ismanager()
	{
		if ($this->cno > 0)
		{
			if ($GLOBALS["currmodule"]->isadmin($GLOBALS["curruser"]))
				return 1;
			else if (is_array($this->manager) && in_array($GLOBALS["curruser"]->uid, $this->manager))
				return 1;
			else if ($this->parent > 0)
				return $this->parent_o->ismanager();
			else if ($GLOBALS["curruser"]->g_handler->isGroupAdmin($this->gno,$GLOGBAS["curruser"]->uno))
				return 1;
			else
				return 0;
		}
		else
			return 0;
	}
}

class WikiPost extends Object
{
	function WikiPost($pno = 0)
	{
		if ($pno > 0)
		{
			$criteria = new CriteriaCompo(new Criteria("p.pno", $pno));

			$result = $GLOBALS["currdb"]->query("SELECT p.* FROM `".$GLOBALS["currdb"]->prefix("wiki_post")."` p LEFT JOIN `".$GLOBALS["currdb"]->prefix("wiki_topic")."` t ON p.tno=t.tno WHERE ".$criteria->render());

			if ($GLOBALS["currdb"]->num_rows($result) == 1)
			{
				$this->setvars($GLOBALS["currdb"]->fetch_array($result));

				$result = $GLOBALS["currdb"]->query("SELECT name FROM `".$GLOBALS["currdb"]->prefix("user")."` WHERE uno='".$this->poster_no."'");

				if ($GLOBALS["currdb"]->num_rows($result) == 1)
				{
					$tmp = $GLOBALS["currdb"]->fetch_array($result);

					$this->poster_name = $tmp["name"];
				}
			}
		}
	}

	function content()
	{
		$c = preg_replace($GLOBALS["wiki_bbcode"], $GLOBALS["wiki_htmlcode"], nl2br(htmlencode($this->content)));

		for ($i = 0;$i < count($GLOBALS["wiki_bbcode"]);$i++)
		{
			if (preg_match($GLOBALS["wiki_bbcode"][$i], $c))
			{
				$c = preg_replace($GLOBALS["wiki_bbcode"], $GLOBALS["wiki_htmlcode"], nl2br($c));
				$i--;
			}
		}


		return $c;
	}
}

class WikiTopic extends Object
{
	var $loaded = 0;

	var $cat;

	var $currpost;

	var $posts = array();

	function gettopic($criteria)
	{
		if (isset($criteria) && is_subclass_of($criteria, "criteriaelement") && $criteria->render() != "")
		{
			$result = $GLOBALS["currdb"]->query("SELECT DISTINCT t.*, p.pno FROM `".$GLOBALS["currdb"]->prefix("wiki_topic")."` t LEFT JOIN `".$GLOBALS["currdb"]->prefix("wiki_post")."` p ON t.tno=p.tno WHERE ".$criteria->render()." ORDER BY p.pno DESC LIMIT 0, 1");

			if ($GLOBALS["currdb"]->num_rows($result) == 1)
			{
				$this->setvars($GLOBALS["currdb"]->fetch_array($result));
				$this->cat = new WikiCat($this->cno);
				$this->currpost = new WikiPost($this->pno);

				if ($this->manager)
					$this->manager = explode("/", $this->manager);

				$this->loaded = 1;
			}
		}
	}

	function getbyno($tno)
	{
		if ($tno > 0)
		{
			$criteria = new CriteriaCompo(new Criteria("t.tno", $tno));

			return $this->gettopic($criteria);
		}
	}

	function getbytitle($title)
	{
		if (!empty($title))
		{
			$criteria = new CriteriaCompo(new Criteria("t.title", strtolower(trim($title))));

			return $this->gettopic($criteria);
		}
	}

	function ismanager()
	{
		if ($GLOBALS["currmodule"]->isadmin($GLOBALS["curruser"]))
			return 1;
		else if (is_array($this->manager) && in_array($GLOBALS["curruser"]->uid, $this->manager))
			return 1;
		else if ($GLOBALS["curruser"]->g_handler->isGroupAdmin($this->gno,$GLOBALS["curruser"]->uno))
			return 1;
		else
			return $this->cat->ismanager();
	}

	function unlock($locktype = 1)
	{
		if ($this->loaded)
		{
			if ($GLOBALS["curruser"]->haveperm($GLOBALS["curruser"]->p_handler->getpermdeny()))
				return 0;
			else if (!(intval($this->locks) & intval($locktype)))
				return 1;
			else
			{
				if ($this->ismanager())
					return 1;
				else
					return 0;
			}
		}
		else
			return 0;
	}
}
?>
