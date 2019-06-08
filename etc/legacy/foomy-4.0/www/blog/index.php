<?php
/** foomy.net
 * 		index.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    09.08.2008 - file created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

require_once('common.inc.php');

$OUT['blog'] = Blog::GetById(1);
output();

?>