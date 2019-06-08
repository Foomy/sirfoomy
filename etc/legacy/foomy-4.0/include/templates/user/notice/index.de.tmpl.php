<?php
/** foomy.net
 * 		index.de.tmpl.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    20.10.2008 - file created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

_header();

?>
<div id="noticebox">
  <div class="noticeform">
    <?php
      echo $OUT['nf']->Start();
      if ( $OUT['nf']->HasFormError() ) {
    ?>
    <p class="formerror"><?php echo $OUT['nf']->GetFormError(); ?></p>
    <?php
      }
    ?> 
    <div class="lbl"><?php echo $OUT['nf']->GetLabel('notice'); ?></div>
    <div class="fld"><?php echo $OUT['nf']->GetElement('notice'); ?></div>
    <div class="err"><?php echo $OUT['nf']->GetError('notice'); ?></div>
    <div class="ctrl">
      <ul>
        <li class="abortbtn"><a href="javascript:clearfields();">abbrechen</a></li>
        <li><?php echo $OUT['nf']->GetSubmit('speichern'); ?></li>
      </ul>
    </div>
    <?php echo $OUT['nf']->Finish(); ?>
  </div>

  <?php if ( hasValue($OUT['notices']) ) { ?>
  <div class="nlist">
    <?php foreach ($OUT['notices'] as $notice) { ?> 
    <div id="nle_<?php echo $notice['id']; ?>" class="nlist_element">
      <?php echo $notice['text']; ?>
      <div id="delbox"><a href="">[X]</a></div>
    </div>
    <script type="text/javascript">
    /* <![CDATA[ */
      new Ajax.InPlaceEditor('nle_<?php echo $notice['id']; ?>', '/user/notice/change.php', {
        callback: function(form, value) {
          return 'notice_id=455&text='+encodeURIComponent(value)
        }
      });
    /* ]]> */
    </script>
    <?php } ?>
  </div>
  <?php } ?>
</div>
<script type="text/javascript">
/* <![CDATA[ */
  function clearfields() {
  	$('notice').value = '';
  }// clearfields()
/* ]]> */
</script>
<?php
_footer();

?>
