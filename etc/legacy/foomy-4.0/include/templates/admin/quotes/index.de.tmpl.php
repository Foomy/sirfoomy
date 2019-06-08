<?php
  /** foomy.net
   * 		admin/quotes/index.de.tmpl.php
   *	
   *  written
   *    by Sascha Schneider <foomy.code@arcor.de>
   * 
   *  history
   *    28.06.2008 - File created
   *
   *  (c) 2004-2008 by Sascha Schneider
   */

  _header();
  pagetitle('Administration', 'Zitate');

  echo $OUT['f']->Start();
  echo $OUT['f']->GetElement('quote_id');
?>
<table id="form">
  <tr>
    <th><?php echo $OUT['f']->GetLabel('author'); ?></th>
    <td><?php echo $OUT['f']->GetElement('author'); ?></td>
    <td><?php echo $OUT['f']->GetError('author'); ?></td>
  </tr>
  <tr>
    <th><?php echo $OUT['f']->GetLabel('extra'); ?></th>
    <td><?php echo $OUT['f']->GetElement('extra'); ?></td>
    <td><?php echo $OUT['f']->GetError('extra'); ?></td>
  </tr>
  <tr>
    <th><?php echo $OUT['f']->GetLabel('quotetext'); ?></th>
    <td><?php echo $OUT['f']->GetElement('quotetext'); ?></td>
    <td><?php echo $OUT['f']->GetError('quotetext'); ?></td>
  </tr>
  <tr>
    <td class="ctrl" colspan="3">
      <ul>
        <li><?php echo $OUT['f']->GetSubmit('speichern'); ?></li>
        <li class="abortbtn"><a href="javascript:history.back();">abbrechen</a></li>
      </ul>
    </td>
  </tr>
</table>
<?php
  echo $OUT['f']->Finish();

  if ( hasValue($OUT['quotelist']) ) {
?>
<table id="quotelist" class="listing">
  <tr>
    <th>id</th>
    <th>quote</th>
    <th>author</th>
    <th>extra</th>
    <th></th>
  </tr>
  <?php foreach ( $OUT['quotelist'] as $q ) { ?>
  <tr id="quot_<?php echo $q->Id(); ?>">
    <td class="id"><?php echo $q->Id(); ?></td>
    <td class="quot">
      <span id="qt_<?php echo $q->Id(); ?>"><?php echo $q->Text(); ?></span>
      <script type="text/javascript">
      // <![CDATA[
        new Ajax.InPlaceEditor('qt_<?php echo $q->Id(); ?>', '/admin/quotes/ch_text.php', {
          callback: function(form, value) {
            return 'quote_id=<?php echo $q->Id(); ?>&text='+encodeURIComponent(value);
          }
        });
      // ]]>
      </script>
    </td>
    <td class="auth">
      <span id="qa_<?php echo $q->Id(); ?>"><?php echo $q->Author(); ?></span>
      <script type="text/javascript">
      // <![CDATA[
        new Ajax.InPlaceEditor('qa_<?php echo $q->Id(); ?>', '/admin/quotes/ch_author.php', {
          callback: function(form, value) {
            return 'quote_id=<?php echo $q->Id(); ?>&author='+encodeURIComponent(value);
          }
        });
      // ]]>
      </script>
    </td>
    <td class="xtra">
      <span id="qe_<?php echo $q->Id(); ?>"><?php echo $q->Extra(); ?></span>
      <script type="text/javascript">
      // <![CDATA[
        new Ajax.InPlaceEditor('qe_<?php echo $q->Id(); ?>', '/admin/quotes/ch_extra.php', {
          callback: function(form, value) {
            return 'quote_id=<?php echo $q->Id(); ?>&author='+encodeURIComponent(value);
          }
        });
      // ]]>
      </script>
    </td>
    
    <td class="ico">
      <?php 
        $lnk = "javascript:deleteQuote('".$q->Id()."')";
        $alt = 'Zitat löschen';
        $img = img(ICON_DELETE, 'delete', 'icon', $alt, $alt);
       ?>
      <a href="<?php echo $lnk; ?>"><?php echo $img; ?></a>
    </td>
  </tr>
  <?php } ?>
</table>
<?php
  }
?>
<script type="text/javascript">
/* <![CDATA[ */
    function deleteQuote(quote_id) {
      new Ajax.Request('/admin/delete_quote.php', {
        method:'post',
        postBody:'quote_id='+quote_id,
        onSuccess: function(transport) {
          $(quote_id).remove();
        },
        onFailure: function(transport) {
          alert('<?php echo j('Fehler: Zitat konnte nicht gelöscht werden.'); ?>');
        }
      });
    }
/* ]]> */
</script>
<?php _footer(); ?>
