<?php
/** foomy.net
 * 		rating.de.tmpl.php
 *	
 *  written
 *    by Sascha Schneider <foomy.code@arcor.de>
 * 
 *  history
 *    02.10.2008 - file created
 *    02.10.2008 - rating control attached
 *    03.10.2008 - Ajax-Calls implemented
 *
 *  (c) 2004-2008 by Sascha Schneider
 */

_header();
?>
<h1>Ratingtest</h1>
<p>Wie im Schulnotensystem ( 1 = Sehr gut... 6 = ungenügend)</p>
<div id="legend">
  <div class="val">1</div>
  <div class="val">2</div>
  <div class="val">3</div>
  <div class="val">4</div>
  <div class="val">5</div>
  <div class="val">6</div>
</div>
<div id="rating_one" class="rating_container">
<?php /*
  <a href="#" class="rating_off" onchange="average();"></a>
  <a href="#" class="rating_off" onchange="average();"></a>
  <a href="#" class="rating_off" onchange="average();"></a>
  <a href="#" class="rating_off" onchange="average();"></a>
  <a href="#" class="rating_off" onchange="average();"></a>
  <a href="#" class="rating_off" onchange="average();"></a>
*/ ?>
</div>

<form method="post" action="">
<table id="auswertung">
  <tr>
    <th>Zuletzt gevotet:</th>
    <td id="lastvoting"><input type="text" id="voteval" /></td>
  </tr>
  <tr>
    <th>Vote-Durchschnitt:</th>
    <td id="avg"></td>
  </tr>
  <tr>
    <th>Anzahl Votes:</th>
    <td id="anz"></td>
  </tr>
</table>
</form>
<script type="text/javascript">
/* <![CDATA[ */
  function lastvote() {
    var url = '/bastelstube/rating/lastvote.php'
    new Ajax.Request(url, {
      method:'post',
      onSuccess: function(transport) {
        $('voteval').value = transport.responseText;
      }
    });
  }// lastvote()

  function average() {
    var url = '/bastelstube/rating/average.php'
    
    new Ajax.Updater('avg', url, {
    	method:'post'
    });
  }// average()

  function quantity() {
    var url = '/bastelstube/rating/quantity.php'
    
    new Ajax.Updater('anz', url, {
      method:'post'
    });
  }// average()
  
  
  /** initialize vote
   */
  var rating_one = new Control.Rating('rating_one', {
    max: 6,
    multiple: true,
    updateUrl: '/bastelstube/rating/vote.php',
    updateParameterName: 'grade',
    input: 'voteval',
  });
  Control.Rating.observe('afterChange',function(rating_instance,new_value) {
    average();
    quantity();
  });

  lastvote();
  average();
  quantity();
/* ]]> */
</script>
<?php
_footer();

?>