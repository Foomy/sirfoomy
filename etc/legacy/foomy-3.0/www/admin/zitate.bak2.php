<?php
/** Modul zu Verwaltung der Zitate
 *  (admin/zitate.php)
 *
 *  written
 *    by Sascha Schneider
 *    on 23rd February 2006
 *
 *  (c) 2006 by Sascha Schneider
 */
require_once('common.inc.php');

$debug = false;
if ( $debug ) _post();

$db = Foomy_Db::GetInstance();
$quote = new Quote($db);

if ( count($_POST)>0 ) { //Wure eines der Formulare abgeschickt?
	$quote->id = sqlFilter(getVar('id'));
	$quote->text = sqlFilter(getVar('text'));
	$quote->origin = sqlFilter(getVar('origin'));
	$quote->born = sqlFilter(getVar('born'));
	$quote->died = sqlFilter(getVar('died'));
	$quote->addition = sqlFilter(getVar('addition'));

 	$quote->SaveQuote($db);
}
elseif ( isset($_GET['id']) ) { //Wurde eine Id �bergeben?
	//Dann soll editiert werden
	$quoteId = $_GET['id'];
	$quote->GetQuoteById($db, $quoteId);
	$smarty->assign('quote', $quote);
}
else {
	$quote->Clear();
}

_header();
_footer();

$smarty->assign('PHP_SELF', $_SERVER['PHP_SELF']);
$smarty->assign('quotes', $quote->list);

$smarty->display('admin/zitate.tpl');
?>
