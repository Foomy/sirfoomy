<?php
  _header('The Manowords');
  pagetitle('The Manowords');
?>
<form action="" method="post">
  <input type="text" name="filename" />
  <input type="submit" value="Hail to the Words!" />
</form>
<script type="text/javascript">
// <![CDATA[
  <?php if ( ! hasValue($OUT['scraped_file']) ) { ?>
  var msg = 'Wörter der Datei ';
  msg += '<?php echo $OUT['scraped_file']; ?> ';
  msg += 'hinzugefügt.';
  $('messages').update(msg);
  <?php } ?>
// ]]>
<?php
  _footer();
?>
