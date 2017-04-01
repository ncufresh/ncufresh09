<?
require_once("../../mainfile.php");

$block_handler =& gethandler("block");
$c_block = $block_handler->getblockbyno(20)->fetch();
$currtpl->assign("c_block",$c_block);

$c_block2 = $block_handler->getblockbyno(19)->fetch();
$currtpl->assign("c_block2",$c_block2);

$currtpl->display("index.htm");

?>
