<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

require_once(ROOT_PATH."/kernel/tpl.php");

class Template extends Tpl
{
	/* if ajax lib is loaded */
	var $ajax = 0;

	/* headers */
	var $hdr = array();

	/* scripts */
	var $js = array();

	/* if alldisplayed */
	var $alldisplayed = 0;

	/**
	* constructor
	*/
	function Template()
	{
		$this->Tpl();

		ob_start();
		
		$this->addcss(ROOT_PATH."/".TEMPLATE_PATH."/style.css");
		$this->addcss(ROOT_PATH."/".TEMPLATE_PATH."/ie6.css");

		$this->addajax();

		if (empty($_SESSION["ref"]))
			$_SESSION["ref"] = URL;
	}

	/**
	* add header
	* @param $hdr: header which you want to add
	*/
	function addhdr($hdr)
	{
		$hdr .= "\n";

		if (!in_array($hdr, $this->hdr))
			$this->hdr[] = $hdr;
	}

	/**
	* add css
	* @param $src: css source which you want to add
	* @param $content: css content which you want to add
	*/
	function addcss($src, $content = null)
	{
		$src = str_replace(DIRECTORY_SEPARATOR, "/", $src);

		if (file_exists($src) && !strcasecmp(substr($src, 0, strlen(ROOT_PATH)), str_replace(DIRECTORY_SEPARATOR, "/", ROOT_PATH)))
			$css .= "    <link rel=\"stylesheet\" type=\"text/css\" href=\"".str_replace(str_replace(DIRECTORY_SEPARATOR, "/", ROOT_PATH)."/", URL."/", $src)."\" />\n";
		else
		{
			$css .= "    <style>\n";
			$css .= $content;
			$css .= "    </style>\n";
		}

		if (!in_array($css, $this->js))
			$this->js[] = $css;
	}

	/**
	* add script
	* @param $src: script source which you want to add
	* @param $content: script content which you want to add
	*/
	function addjs($src, $content = null)
	{
		$src = str_replace(DIRECTORY_SEPARATOR, "/", $src);

		$js = "    <script type=\"text/javascript\"";

		if (file_exists($src) && !strcasecmp(substr($src, 0, strlen(ROOT_PATH)), str_replace(DIRECTORY_SEPARATOR, "/", ROOT_PATH)))
			$js .= " src=\"".str_replace(str_replace(DIRECTORY_SEPARATOR, "/", ROOT_PATH)."/", URL."/", $src)."\">";
		else
		{
			$js .= ">\n";
			$js .= $content;
			$js .= "\n    ";
		}
		$js .= "</script>\n";

		if (!in_array($js, $this->js))
			$this->js[] = $js;
	}

	/**
	* add ajax lib
	*/
	function addajax()
	{
		if ($this->ajax == 0)
		{
			$this->addjs(ROOT_PATH."/include/js/jquery.js");
			$this->addjs('', 'var J = jQuery.noConflict();');
			$this->addjs(ROOT_PATH."/include/js/prototype.js");
			$this->addjs(ROOT_PATH."/include/js/jquery.pngFix.js");
			$this->addjs(ROOT_PATH."/include/js/scriptaculous.js");
			$this->ajax = 1;
		}
	}

	/**
	* set don't display default template
	*/
	function setndisplay()
	{
		$this->alldisplayed = 1;

		htmlheader();
	}

	/**
	* display the default template and close the buffer
	*/
	function alldisplay()
	{
		if (!$this->alldisplayed)
		{
			global $currconfig, $curruser, $currmodule, $currtpl;

			foreach ($this->hdr as $value)
				$hdr .= $value;

			foreach ($this->js as $value)
				$js .= $value;

			$this->settpldir();

			$content = ob_get_contents();

			ob_end_clean();

			if (is_object($currconfig))
				$this->assign_by_ref("sitename", $currconfig->site_name);

			$this->assign_by_ref("currsite", $GLOBALS["currsite"]);

			$block_handler =& gethandler("block");
			
			$currblocks = $block_handler->getblockbysystem();

			for ($i = 0;$i < count($currblocks);$i++)
			{
				if ($currblocks[$i]->side == 1)
					$default_top_blocks[] = $currblocks[$i]->fetch();
				else
					$default_side_blocks[] = $currblocks[$i]->fetch();
			}

			$this->assign("default_top_blocks", $default_top_blocks);

			$this->assign("default_side_blocks", $default_side_blocks);

			$this->assign("hdr", $hdr);
			$this->assign("js", $js);
			$this->assign("content", $content);

			htmlheader();

			$this->display("index.htm");

			$this->alldisplayed = 1;

			/*if (strcasecmp($_SESSION["ref"], $_SERVER["REQUEST_URI"]))
			{
				$_SESSION["ref_o"] = $_SESSION["ref"];
				$_SESSION["ref"] = $_SERVER["REQUEST_URI"];
			}*/
			if(!is_array($_SESSION['gn_ref']))
				$_SESSION['gn_ref'] = array();
			
			if(strcasecmp($_SESSION['gn_ref'][0],$_SERVER['REQUEST_URI']))
				array_unshift($_SESSION['gn_ref'],$_SERVER['REQUEST_URI']);

			unset($_SESSION['gn_ref'][5]);
		}
	}

	/*
	* close th buffer and dump xml header
	*/
	function echoxml()
	{
		header("Content-Type: text/xml");
		ob_end_clean();

		$this->alldisplayed = 1;
		echo "<?xml version=\"1.0\" encoding=\"utf-8\"?>\n";
	}

	/**
	* destructor
	*/
	function __destruct()
	{
		global $currconfig, $curruser, $currmodule, $currtpl;

		$currtpl = $this;

		$this->alldisplay();

		unset($currtpl);
	}
}
?>
