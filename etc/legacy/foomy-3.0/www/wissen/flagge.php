<?php
/**
 *    file: flagge.php
 * project: Foomys-Welt
 *  author: Sascha Schneider
 * created: 04.07.2006
 *
 */
require_once('common.inc.php');

$title = 'Die Flagge der BRD';
pagetitle($title);

_header();
_footer();
$smarty->display('wissen/flagge.tpl');

?>
