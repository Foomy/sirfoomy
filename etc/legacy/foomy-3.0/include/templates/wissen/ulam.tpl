{include file=header.tpl}
<h1>Das Collatz-Problem</h1>
<p>
 Das Collatz-Problem gehört zu den ungelösten Problemen der Mathematik. Es
 wird gelegentlich auch 3n+1-Problem, Syracuse-Vermutung, Kakutanis Problem,
 Hasse-Algorithmus, Thwaites Vermutung oder Ulams Problem (nach Stanislaw
 Marcin Ulam) genannt.
</p>
<h3>Der Algorithmus</h3>
<ol>
 <li>Beginne mit einer beliebigen natürlichen Zahl</li>
 <li>Wenn die Zahl gerade ist, teile die Zahl durch 2</li>
 <li>Wenn die Zahl ungerade ist, multipliziere die Zahl mit 3 und addiere 1 dazu</li>
 <li>Die Folge endet wenn 1 erreicht ist</li>
</ol>
<h3>Als PHP-Code</h3>
<div class="codebox">
 {literal}
 <pre>
  <span class="fett">while</span> ( $a!=1 ) {
   <span class="fett">if</span> ( $a%2==0 ) {
    $a = $a/2;
   }
   <span class="fett">else</span> {
    $a = 3*$a+1;
   }
   <span class="fett" style="color:lightblue">echo</span> $a.'<span style="color:red">&lt;br /&gt;</span>';
  }
 </pre>
 {/literal}
</div>
<h3>Möchten Sie mehr wissen?</h3>
<p>
 Genauere Informationen können Sie der entsprechenden
 <a href="http://de.wikipedia.org/wiki/Collatz-Problem">Wikipedia-Seite</a> entnehmen.
</p>
<p>
 Wenn Sie es selbst mal ausprobieren wollen, können Sie das hier tun. Der obige Quellcode wurde hier umgesetzt. Einfach Startwert eintippen und ab dafür.
<form method="post" action="{$formaction}">
 Startwert: <input type="text" name="a" size="10" />
 <input type="submit" value="Und... Strom!" />
</form>
<table id="auswertung">
 <tr>
  <th>Startwert:</th>
  <td>{$startwert}</td>
 </tr>
 <tr>
  <th>Maximum:</th>
  <td>{$maximum}</td>
 </tr>
 <tr>
  <th>Minimum:</th>
  <td>{$minimum}</td>
 </tr>
 <tr>
  <th colspan="2">Die Zahlenfolge:</tr>
 </tr>
 <tr>
  <td colspan="2">
{foreach item=zahl from=$folge}{$zahl}, {/foreach}
  </td>
 </tr>
</table>
{include file=footer.tpl}
