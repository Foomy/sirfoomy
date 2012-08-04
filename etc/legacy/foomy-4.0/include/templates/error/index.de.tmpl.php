<?php
/** foomy.net
 * 		templates/error/index.de.tmpl.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    22.06.2008 - creating file
 *    24.10.2008 - error text changed
 *
 *  (c) 2004-2008 by Sascha Schneider
 */
 
_header();
pagetitle('Fehler', 'oops!');

if ( hasValue($OUT['error']) ) _debug($OUT['error']);
?>
<p>Da ist wohl ein Malheur passiert. :(</p>
<?php

_footer();
?>
