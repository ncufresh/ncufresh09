<?
if (!defined("MAINFILE_INCLUDED"))
{
	define("MAINFILE_INCLUDED", 1);

	define("PROTOCAL", (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') ? "https" : "http");

	define("PORT", ((PROTOCAL == "http" && $_SERVER["SERVER_PORT"] == 80) || PROTOCAL == "https" && $_SERVER["SERVER_PORT"] == 443) ? "" : ":".$_SERVER["SERVER_PORT"]);

	define("ROOT_PATH", realpath(dirname(__FILE__)));

	define("URL_FULL", PROTOCAL."://".$_SERVER["SERVER_NAME"].PORT.str_replace(DIRECTORY_SEPARATOR, "/", substr(ROOT_PATH, strlen(realpath($_SERVER["DOCUMENT_ROOT"])))));
	define("URL", str_replace(DIRECTORY_SEPARATOR, "/", substr(ROOT_PATH, strlen(realpath($_SERVER["DOCUMENT_ROOT"])))));

	define("DB_HOST", "localhost");

	define("DB_USER", "root");

	define("DB_PWD", "YouMySQLPASSWD");

	define("DB_PREFIX", "workv1");
	
	define("DB_NAME", "work2007");

	define("PERM_ADMIN", 0x0001);

	define("PERM_VALID", 0x0002);

	define("PERM_DENY", 0x0004);

	require_once(ROOT_PATH."/include/common.php");
}
?>
