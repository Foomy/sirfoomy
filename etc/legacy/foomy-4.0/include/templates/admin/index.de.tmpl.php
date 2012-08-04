<?php
/** foomy.net
 * 		index.de.tmpl.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    28.06.2008 - File created
 * 
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

_header();
pagetitle(j('Administration'));
?>
<h3>Benutzermanagment</h3>
<p>
  <a href="/admin/groups/">Gruppen bearbeiten</a><br />
  <a href="/admin/users/">Benutzer bearbeiten</a>
</p>
<h3>Content Management</h3>
<p>
  <a href="/admin/quotes/">Zitate bearbeiten</a>
</p>
<?php

_footer();
?>