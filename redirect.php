<?php

require_once 'mainfile.php';

array_shift($_SESSION['gn_ref']);
_redirect(intval($_SERVER['QUERY_STRING']));

?>
