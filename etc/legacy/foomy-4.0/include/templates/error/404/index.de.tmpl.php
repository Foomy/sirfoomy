<?php
/** foomy.net
 * 		404.de.tmpl.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    01.08.2008 - file created
 *    24.10.2008 - error text changed
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

_header();
pagetitle(j('Fehler'), j('Seite nicht gefunden'));

if ( hasValue($OUT['error']) ) _debug($OUT['error']);
?>
<p>
  Nicht böse sein aber es ist wie verhext: Ich konnte die von dir gewünschte
  Seite nicht finden. Ich haben echt überall nachgeschaut.
</p>
<p>
  Vermutlich ist eine nie dagewesene Verschwörung im Gange. Vielleicht ist auch
  eines deiner Lesezeichen ist veraltet. Es könnte auch sein, dass ich einfach
  irgendwas vergessen hab.
</p>
<p>Aber...</p>
<h2 style="text-align:center;">Don't Panic!</h2>
<p>
  Noch ist nicht alles verloren! Sie haben jetzt mehrere Möglichkeiten.
  Sie könnten zum Beispiel...
</p>
<ul>
  <li>könntest du die <a href="/">Startseite</a> aufsuchen,</li>
  <li>oder du könntest vielleicht meinen <a href="/blog/">Blog</a> lesen,</li>
  <li>
    oder aber auch was
    <a href="http://www.lachnet.de/lustige/witze/Dinge,+die+man+tun+kann,+wenn+einem+langweilig+ist.txt.html">
    ganz Anderes</a> machen.</li>
</ul>
<?php
_footer();
?>