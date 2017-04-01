<?php

require_once '../../mainfile.php';

$block_handler =& gethandler("block");
$block_handler->getblockbyno(20)->display();

?>
