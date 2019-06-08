<?php
/** foomy.net
 * 		vote.php
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

$grade = getVar('grade');
if ( (int)$grade>0 ) {
  $dbh = getDbInstance();
	$sql = 'INSERT INTO rating (value) VALUES (:1)';
  try {
    $dbh->prepare($sql)->execute($grade);
  } catch (MysqlException $e) {
  	panic($e);
  }
  echo $grade;
} else {
	header('HTTP/1.1 404 Not Found');
  exit(0);
}
?>