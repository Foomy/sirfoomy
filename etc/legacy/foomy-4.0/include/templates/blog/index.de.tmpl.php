<?php
/** foomy.net
 * 		index.de.tmpl.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    09.08.2008 - file created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

_header();
pagetitle($OUT['blog']->GetTitle(), $OUT['blog']->GetSubtitle());

if ( (! empty($OUT['blog'])) ) {
?>
<div id="blog">
  <?php foreach ($OUT['blog']->GetEntrys() as $entry) { ?>
  <div class="entry">
    <div class="entryhead">
      <span class="head3"><?php echo $entry->GetHeadline(); ?></span><br />
      <span class="head4"><?php echo $entry->GetSubhead(); ?></span>
    </div>
    <div class="entrybody"><?php echo $entry->GetMessage(); ?></div>
    <div class="entryfoot">Author: Foomy</div>
  </div>
  <?php } ?>
</div>
<?php
} 

#_debug($OUT['blog']);
_footer();
?>
