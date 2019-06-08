<?php
/** foomy.net
 * 		analysis.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    03.10.2008 - file created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

require_once('common.inc.php');

$dbh  = getDbInstance();
$sql = 'SELECT count(*) AS quantity FROM rating';
try {
 	$dbret = $dbh->prepare($sql)->execute()->fetch_assoc();
} catch (MysqlException $e) {
 	header('HTTP/1.1 404 Not Found');
  echo $e;
  exit(0);
}

if ( is_array($dbret) && (int)$dbret['quantity']>0 ) {
	echo $dbret['quantity'];
} else {
  echo '0';	
}
?>