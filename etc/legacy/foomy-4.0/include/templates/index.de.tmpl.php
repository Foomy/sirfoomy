<?php

_header();

?>
<form id="quote" action="">
  <div><textarea id="randomquote" rows="" cols=""></textarea></div>
</form>
<div id="optimized">
	Die folgenden Seiten wurden so optimiert, dass sie in keinem<br />
	mir derzeit bekannten Browser richtig angezeigt werden können.
</div>
<p id="entrance">
  <?php if ( IS_TESTHOST ) { ?>
	:: <a href="/home.php">Enter</a> ::
  <?php } else { ?>
	Seiten sind im Aufbau
  <?php } ?>
</p>
<p id="fundisclaimer">
	Das Lesen dieser Seiten kann zu Schizophrenie, Realitätsverlust und
	anderen psychischen Störungen führen. Der Autor übernimmt in keinster
	Weise Haftung für irgendwelche geistigen oder köperlichen Schäden.
</p>
<?php

_footer();

?>
