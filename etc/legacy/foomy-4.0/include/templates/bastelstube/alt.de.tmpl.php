<?php
/** foomy.net
 * 		alt.de.tmpl.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    23.07.2008 - File created
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

_header();
pagetitle('U&reg;ALT&trade;');
?>
<p>Alter: <span id="age" class="fett"><?php echo $OUT['age']; ?></span> Sekunden</p>


<h3>Countdown zur Sekunde 1.000.000.000</h3>
<div style="padding:0 0 0 50px;">
  <p>Ereigniszeitpunkt: <span class="fett"><?php echo $OUT['eventtime']; ?></span></p>
  Countdown: t minus <span id="cd" class="fett"><?php echo $OUT['cd']; ?></span> Sekunden
  <table style="margin-top:10px;">
    <tr>
      <th>Tage</th>
      <th>Stunden</th>
      <th>Minuten</th>
      <th>Sekunden</th>
    </tr>
    <tr>
      <td id="days" style="text-align:center"><?php echo $OUT['tage']; ?></td>
      <td id="hour" style="text-align:center"><?php echo $OUT['std']; ?></td>
      <td id="mins" style="text-align:center"><?php echo $OUT['min']; ?></td>
      <td id="secs" style="text-align:center"><?php echo $OUT['sek']; ?></td>
    </tr>
  </table>
</div>
<script type="text/javascript">
// <![CDATA[
  function countDown() {
    var age  = parseInt($('age').innerHTML);
    var cd   = parseInt($('cd').innerHTML);

    var secs = parseInt($('secs').innerHTML);
    var mins = parseInt($('mins').innerHTML);
    var hour = parseInt($('hour').innerHTML);
    var days = parseInt($('days').innerHTML);

    age++;
    cd--;
    secs--;
    if ( secs<0 ) {
      secs = 59;
      mins--;
      if ( mins<0 ) {
        mins = 59;
        hour--;
        if ( hour<0 ) {
          days--;
          hour = 23;
        }
      }
    }

    $('age').update(age);
    $('cd').update(cd);

    $('secs').update(secs);
    $('mins').update(mins);
    $('hour').update(hour);
    $('days').update(days);
  }// countDown()

  new PeriodicalExecuter(countDown, 1);
// ]]>
</script>
<?php
_footer();
?>
