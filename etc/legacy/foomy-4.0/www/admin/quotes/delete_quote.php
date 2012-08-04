<?php
/** foomy.net
 * 		/admin/quotes/delete_quote.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    27.07.2008 - file created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

require_once('common.inc.php');
FoomyUser::AdminsOnly();

$quoteId = (int)_decrypt(getVar('id'));
if ( $quoteId>0 ) {
  $q = Quote::GetById($quoteId);
  $q->Delete();
}
else {
  header("HTTP/1.0 404 Not Found");
}
?>