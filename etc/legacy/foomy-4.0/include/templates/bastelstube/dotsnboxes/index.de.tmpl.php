<?php
/** foomy.net
 * 		index.de.tmpl.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    25.10.2008 - file created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

_header();

echo '<table id="gamematrix">';
for ($i=1; $i<=$OUT['mh']; $i++) {
  echo '<tr>';
  for ($j=1; $j<=$OUT['mw']; $j++) {
	  echo '<td class="dot"></td>';
    if ( $j<$OUT['mw'] ) {
      echo '<td class="hline"></td>';
    }
  }
	echo '</tr>';
  if ( $i<$OUT['mh'] ) {
    echo '<tr>';
    for ($j=1; $j<=$OUT['mw']; $j++) {
      echo '<td class="vline"></td>';
      if ( $j<$OUT['mw'] ) {
        echo '<td></td>';
      }
    }
    echo '</tr>';
  }
}
echo '</table>';

_footer();

?>