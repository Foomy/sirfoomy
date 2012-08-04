<?php

_header();
pagetitle('Primzahlen');

?>
<p>
  Im Bereich zwischen <span class="fett"><?php echo $OUT['min']; ?></span> und
  <span class="fett"><?php echo $OUT['max']; ?></span> gibt es folgende
  <span class="fett"><?php echo $OUT['primecnt']; ?></span> Primzahlen:
</p>
<table>
  <?php for ( $i=0; $i<=count($OUT['primes'])-1; $i++ ) { ?>
  <tr>
    <?php foreach ( $OUT['primes'][$i] as $prime ) { ?>
    <td class="fett"><?php echo $prime; ?></td>
    <?php } ?>
  </tr>
  <?php } ?>
</table>

<br />
<p>Primzahlenbreich eingeben:</p>
<form method="post">
  von: <input type="text" name="min" />
  bis: <input type="text" name="max" />
  <input type="submit" value="abschicken" />
</form>
<?php

_footer();

?>