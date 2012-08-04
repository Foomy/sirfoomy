<?php
/** foomy.net
 * 		/error/index.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    22.06.2008 - creating file
 *
 *  (c) 2004-2008 by Sascha Schneider
 */
require_once('common.inc.php');

if( isset($_SESSION['error']) && ($_SESSION['error']!='') ) {
  $OUT['error'] = $_SESSION['error'];
  unset($_SESSION['error']);
  $dump = print_r($OUT['error'], true);

  output();
} else {
  header('Location: /');
}

?>