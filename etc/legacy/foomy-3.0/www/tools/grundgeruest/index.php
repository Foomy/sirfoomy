<?php
/**
 *        file: /tools/grundgeruest/index.php
 *     project: Foomys-Welt
 *      author: Sascha Schneider
 *     created: 13.03.2006
 * description: (X)HTML-Grundger�st-Generator
 *
 */

require_once('common.inc.php');

$debug = true;
_header();

if ( $debug ) _post();

pagetitle('Tools', 'HTML/XTML Grundger�st-Generator');
?>
<form method="post" action="<?= $_SERVER['SCRIPT_NAME']; ?>">
 <table id="htmlgen">
  <tr>
   <td>
    <select name="language">
     <option value="0">-- Sprache --</option>
     <option value="1">HTML 4.01</option>
     <option value="2">XHTML 1.0</option>
     <option value="3">XHTML 1.1</option>
    </select>
   </td>
   <td>
    <select name="langtype">
     <option value="0">-- Sprachvariante --</option>
     <option value="1">Strict</option>
     <option value="2">Transitional</option>
     <option value="3">Frameset</option>
    </select>
   </td>
   <td>
    <select name="encoding">
     <option value="0">-- Zeichensatz --</option>
     <option value="1">ISO-8859-1 (Latin 1)</option>
     <option value="2">ISO-8859-15 (Latin 9)</option>
     <option value="3">UTF-8 (Unicode)</option>
    </select>
   </td>
  </tr>
  <tr>
   <td><input type="submit" value="generate" /></td>
  </tr>
 </table>
</form>
<hr id="hgSeperator">
<?php
_footer();
?>
