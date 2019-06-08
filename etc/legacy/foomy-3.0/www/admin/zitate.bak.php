<?php
/**
 *    file: /admin/zitate.php
 * project: Foomys-Welt
 *  auhtor: Sascha Schneider
 * created: 23.02.2006 - 16:15
 *
 */
require_once('common.inc.php');

$debug = false;
$db    = Foomy_Db::GetInstance();
_header();
if ( $debug ) _post();
if ( count($_POST)>0 ) { //Wurde eines der Formaulare abgeschickt...
 //... also erst mal �bergabeparameter einsammeln
 $neu = ( (! isset($_POST['id'])) || (empty($_POST['id'])) ) ? true : false;
 $originator = ( isset($_POST['originator']) ) ? strip_tags($_POST['originator']) : false;
 $born = ( isset($_POST['born']) ) ? strip_tags($_POST['born']) : '';
 $died = ( isset($_POST['died']) ) ? strip_tags($_POST['died']) : '';
 $addition = ( isset($_POST['addition']) ) ? strip_tags($_POST['addition']) : '';
 $quote = ( isset($_POST['quote']) ) ? strip_tags($_POST['quote']) : false;

 //... dann Pr�fe man die  Feldeingaben
 $error = false;
 if ( ! $quote ) { //Zitat == Pflichtfeld
  $error = true;
  $errmsg['quote'] = '&lt; Bitte geben Sie ein Zitat ein.';
 }

 if ( ! $originator ) { //Urheber == Pflichtfeld
  $error = true;
  $errmsg['originator'] = '&lt; Bitte geben Sie einen Urheber an.';
 }

 //...und wenn alles i.O. speichert man das Zitat in der Db.
 if ( ! $error ) {
  if ( $neu ) {
   $sql = "INSERT INTO zitat (quote, originator, born, died, addition)
                VALUES ('$quote', '$originator', '$born', '$died', '$addition')";
   if ( $debug ) _debug($sql, 'Zitat speichern');
   if ( ! $db->qry($sql) ) {
    echo 'Speichern fehlgeschlagen!';
    exit(0);
   }
  } else {
   $sql = "UPDATE zitat
              SET quote='$quote',
                  originator='$originator',
                  born='$born',
                  died='$died',
                  addition='$addition'
            WHERE id={$_POST['id']}";
   if ( $debug ) _debug($sql, 'Zitat �ndern');
   if ( ! $db->qry($sql) ) {
    echo '�ndern Fehlgeschlagen!';
    exit(0);
   }
  }
 }//if ( ! $error )
}//if ( count($_POST)>0 )

if ( isset($_GET['id']) ) { //Wurde eine Id �bergeben?
 //Dann wird editiert
 $zid = $_GET['id'];
 $sql = "SELECT * FROM zitat WHERE id=$zid";
 if ( $debug ) _debug($sql, 'Zu editierendes Zitat aus der Db holen');
 if ( $res = $db->qry($sql) ) {
  $row = $db->fetch($res);
 }
 else {
  echo 'Lesen der Datenbank nicht m�glich.';
  exit(0);  
 }
}
?>

<form name="addquote" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
 <input type="hidden" name="id" value="<?= ( isset($zid) ) ? $zid : ''; ?>" />
 <table id="zitatAddForm">
  <tr>
   <th>Urheber:</th>
   <td><input type="text" name="originator" value="<?= ( isset($row['originator']) ) ? $row['originator'] : ''; ?>" /></td>
   <td class="error"><?= ( isset($errmsg['originator']) ) ? $errmsg['originator'] : ''; ?></td>
  </tr>
  <tr>
   <th>Geboren:</th>
   <td><input type="text" name="born" value="<?= ( $row['born']!=0 ) ? $row['born'] : ''; ?>" /></td>
   <td class="error"><?= ( isset($errmsg['born']) ) ? $errmsg['born'] : ''; ?></td>
  </tr>
  <tr>
   <th>Gestorben:</th>
   <td><input type="text" name="died" value="<?= ( $row['died']!=0 ) ? $row['died'] : ''; ?>" /></td>
   <td class="error"><?= ( isset($errmsg['died']) ) ? $errmsg['died'] : ''; ?></td>
  </tr>
  <tr>
   <th>Zusatz:</th>
   <td><input type="text" name="addition" value="<?= ( isset($row['addition']) ) ? $row['addition'] : ''; ?>" /></td>
   <td class="error"><?= ( isset($errmsg['addition']) ) ? $errmsg['addition'] : ''; ?></td>
  </tr>
  <tr>
   <th>Zitat:</th>
   <td><textarea name="quote" rows="" cols=""><?= ( isset($row['quote']) ) ? $row['quote'] : ''; ?></textarea></td>
   <td class="error"><?= ( isset($errmsg['quote']) ) ? $errmsg['quote'] : ''; ?></td>
  </tr>
  <tr>
   <td colspan="2" class="adminFormStrg"><input type="submit" value="<?= ( isset($zid) ) ? 'save' : 'add'; ?>" /></td>
  </tr>
 </table>
</form>

<form name="delquote" method="post" action="<?= $_SERVER['PHP_SELF']; ?>">
 <? $res = $db->qry('SELECT * FROM zitat'); ?>
 <table id="zitatDelForm">
  <tr>
   <th>Zitat</th>
   <th>Urheber</th>
   <th>&nbsp;</th>
   <th><img src="/img/delete.png" alt="" /></th>
  </tr>
  <? while ( $row = $db->fetch($res) ) { ?>
  <tr>
   <td class="quote"><?= htmlentities($row['quote']); ?></td>
   <td class="origin"><?= htmlentities($row['originator']); ?></td>
   <td class="edit"><a href="<?= $_SERVER['SCRIPT_NAME'] ?>?id=<?= $row['id']; ?>"><img class="editIcon" src="/img/edit.png" alt="" /></a></td>
   <td class="delete"><input type="checkbox" name="<?= $row['id']; ?>" value="delete" /></td>
  </tr>
  <? } ?>
  <tr>
   <td colspan="4" class="adminFormStrg"><input type="submit" value="del" /></td>
  </tr>
 </table>
</form>
<?php
_footer();
?>
