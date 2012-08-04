<?php
/** foomy.net
 * 		login.de.tmpl.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    01.08.2008 - file created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

_header();
pagetitle(j('Benutzerbereich'), j('Anmeldung'));
?>
<p>
  Aber Hallo!
</p>
<p>
  Wollen wir doch mal sehen mit wem wir es hier zu tun haben.<br />
  Kennst du denn das Zauberwort?
</p>
<?php echo $OUT['f']->Start(); ?>
<table class="addform">
  <tr>
    <th><?php echo $OUT['f']->GetLabel('email'); ?></th>
    <td><?php echo $OUT['f']->GetElement('email'); ?></td>
    <td><?php echo $OUT['f']->GetError('email'); ?></td>
  </tr>  
  <tr>
    <th><?php echo $OUT['f']->GetLabel('password'); ?></th>
    <td><?php echo $OUT['f']->GetElement('password'); ?></td>
    <td><?php echo $OUT['f']->GetError('password'); ?></td>
  </tr>
  <tr>
    <td class="ctrl" colspan="3">
      <?php echo $OUT['f']->GetSubmit(j('Anmelden')); ?>
    </td>
  </tr> 
</table>
<?php echo $OUT['f']->Finish(); ?>
<p class="small">
  Nein, &raquo;Sesam öffne dich!&laquo; ist es nicht! ;-)
</p>
<?php
_footer();
?>