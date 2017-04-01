<?php

require_once '../../../mainfile.php';

if(!$curruser->isadmin()) _redirect();

?>
<a href="admin.php">Admin</a>
<a href="show.php">Show</a>
