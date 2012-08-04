<?php
/** foomy.net
 * 		config.inc.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    07.09.2008 - file created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

//== MISC ==
define('MAINTENANCE', false);
define('SERVER', $_SERVER['SERVER_NAME']);
define('SCRIPT', $_SERVER['SCRIPT_NAME']);

if ( SERVER=='foomy.net' || SERVER=='www.foomy.net' ) {
  define('IS_TESTHOST', false);
} else {
  define('IS_TESTHOST', true);
}

if ( SCRIPT=='/index.php' || MAINTENANCE ) {
  define('QUOTES_ON', true);
} else {
  define('QUOTES_ON', false);
}

define('LANGUAGE', 'de'); // ToDo: Sprachwahl für Templates automatisieren!

define('DEC_POINT', ',');
define('THOUSANDS_SEP', '.');
define('DIR_SEPARATOR', '/'); // ToDo: Automatisch ermitteln, je nach OS!

//== PFADE ==
define('INCLUDE_PATH', '/var/www/foomy.net-test/include/');
define('TEMPLATE_PATH', 'templates/');

//== BILDER ==
define('LOGIN', '/img/login-1.0.png');

// == ICONS ==
define('ICON_EDIT', '/img/icon/edit-1.0.png');
define('ICON_DELETE', '/img/icon/delete-1.0.gif');


?>
