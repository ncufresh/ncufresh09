<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

define("TEMPLATE_PATH", 'templates');

require_once(ROOT_PATH."/include/smarty/Smarty.class.php");

class Tpl extends Smarty
{
	/**
	* constructor
	*/
	function Tpl()
	{
		$this->Smarty();
		$this->template_dir = ROOT_PATH."/".TEMPLATE_PATH."/";
		$this->compile_dir = ROOT_PATH."/".TEMPLATE_PATH."_c/";
		$this->left_delimiter = "<{";
		$this->right_delimiter = "}>";

		$this->assign_by_ref("currconfig", $GLOBALS["currconfig"]);
		$this->assign_by_ref("curruser", $GLOBALS["curruser"]);
		$this->assign_by_ref("currmodule", $GLOBALS["currmodule"]);

		$this->register_function("htmlencode", "htmlencode");
		$this->register_function("urlencode", "urlencode");
		$this->register_function("binary_and", "binary_and");
	}

	/**
	* set template dir and compile dir
	* @param $name: name of the module which you want to change to
	*/
	function settpldir($name = null)
	{
		if (!empty($name) && $name != "system"  && file_exists(ROOT_PATH."/module/".$name."/".TEMPLATE_PATH."/"))
		{
			$this->template_dir = ROOT_PATH."/module/".$name."/".TEMPLATE_PATH."/";
			$this->compile_dir = ROOT_PATH."/module/".$name."/".TEMPLATE_PATH."_c/";
		}
		else
		{
			$this->template_dir = ROOT_PATH."/".TEMPLATE_PATH."/";
			$this->compile_dir = ROOT_PATH."/".TEMPLATE_PATH."_c/";
		}
	}
}
?>
