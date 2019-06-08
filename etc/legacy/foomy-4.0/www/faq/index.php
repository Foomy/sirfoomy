<?php
/** Die etwas andere FAQ-Seite
 *  (/faq/index.php)
 *
 *  written
 *    by Sascha Schneider
 *    on 2006-10-08
 *  (c) 2004-2006 Sascha Schneider
 */
require_once('common.inc.php');
 
_header();
_footer();
pagetitle('FAQ - Frequently Asked Questions', 'Die etwas anderen FAQ');
$smarty->display('intern/faq/index.tpl');
?>