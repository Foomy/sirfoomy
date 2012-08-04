<?php

require_once('common.inc.php');

$title = 'Möchten Sie mehr wissen?';
pagetitle($title);

_header();
_footer();
$smarty->display('wissen/index.tpl');

?>