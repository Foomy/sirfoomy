<?php
/** foomy.net
 * 		admin/groups/index.de.tmpl.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    04.10.2008 - file created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

_header();
pagetitle('Administration', 'Gruppen');

echo $OUT['gf']->Start();
echo $OUT['gf']->GetElement('group_id');
?>
<table id="form">
  <tr>
    <th><?php echo $OUT['gf']->GetLabel('name'); ?></th>
    <td><?php echo $OUT['gf']->GetElement('name'); ?></td>
    <td><?php echo $OUT['gf']->GetError('name'); ?></td>
  </tr>
  <tr>
    <th><?php echo $OUT['gf']->GetLabel('description'); ?></th>
    <td><?php echo $OUT['gf']->GetElement('description'); ?></td>
    <td><?php echo $OUT['gf']->GetError('description'); ?></td>
  </tr>
  <tr>
    <td class="ctrl" colspan="3">
      <ul>
        <li><?php echo $OUT['gf']->GetSubmit('speichern'); ?></li>
        <li class="abortbtn"><a href="javascript:history.back();">abbrechen</a>
      </ul>
    </td>
  </tr>
</table>
<?php
echo $OUT['gf']->Finish();
?>
<table id="grouplist" class"listing">
  
</table>
<?php
_footer();

?>