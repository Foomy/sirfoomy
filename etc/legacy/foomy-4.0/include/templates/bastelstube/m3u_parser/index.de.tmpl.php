<?php
  _header();
?>
<h1>.m3u-Parser</h1>
<form action="<?php $_SERVER['SCRIPT_NAME']; ?>" method="post" >
  <table>
    <tr>
      <td colspan="3">
        <input type="file" name="playlist" />
      </td>
    </tr>
    <tr>
      <td style="text-align:right; ">
        <input type="button" value="abbrechen" onclick="history.back();" />&nbsp;
        <input type="submit" value="hochladen" />
      </td>
    </tr>
  </table>
</form>
<?php
  _footer();
?>
