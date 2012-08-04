<?php
/** Impressum f�r Foomys Welt
 *  (/impressum/index.php)
 *
 *  written
 *    by Sascha Schneider
 *    on 2004-11-23
 *  (c) 2004-2006 Sascha Schneider
 */

require_once('common.inc.php');

//Statuszeile
$z = new Tempus();
$OUT['datum'] = $z->ShortDate();
$OUT['breadcrumb'] = breadcrumb();

output();
 
?>