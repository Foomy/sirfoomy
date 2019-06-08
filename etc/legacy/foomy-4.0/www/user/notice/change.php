<?php
/** foomy.net
 * 		change.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    20.10.2008 - file created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

require_once('common.inc.php');
FoomyUser::UsersOnly();

$notice_id = getVar('notice_id');
if ( (int)$notice_id>0 ) {
  $text = getVar('text');

  $dbh = getDbInstance();
  $sql = 'UPDATE notice SET text=:2 WHERE id=:1';
  try {
  	$dbh->prepare($sql)->execute($notice_id, $text);
  } catch (MysqlException $e) {
  	ahPanic($e);
  }
  echo $text;
} else {
	ahPanic("Ungültige Id: $notice_id");
}
?>