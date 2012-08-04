{include file=header.tpl}
<form name="addquote" method="post" action="{$PHP_SELF}">
	<input type="hidden" name="id" value="{$quote->id}" />
	<table id="zitatAddForm">
		<tr>
			<th>Zitat:</th>
			<td><textarea name="text" rows="" cols="">{$quote->text}</textarea></td>
			<td class="error"><?= ( isset($errmsg['quote']) ) ? $errmsg['quote'] : ''; ?></td>
		</tr>
		<tr>
			<th>Urheber:</th>
			<td><input type="text" name="origin" value="{$quote->origin}" /></td>
			<td class="error"><?= ( isset($errmsg['originator']) ) ? $errmsg['originator'] : ''; ?></td>
		</tr>
		<tr>
			<th>Geboren:</th>
			<td><input type="text" name="born" value="{$quote->born}" /></td>
			<td class="error"><?= ( isset($errmsg['born']) ) ? $errmsg['born'] : ''; ?></td>
		</tr>
		<tr>
			<th>Gestorben:</th>
			<td><input type="text" name="died" value="{$quote->died}" /></td>
			<td class="error"><?= ( isset($errmsg['died']) ) ? $errmsg['died'] : ''; ?></td>
		</tr>
		<tr>
			<th>Zusatz:</th>
			<td><input type="text" name="addition" value="{$quote->addition}" /></td>
			<td class="error"><?= ( isset($errmsg['addition']) ) ? $errmsg['addition'] : ''; ?></td>
		</tr>
		<tr>
			<td colspan="2" class="adminFormStrg"><input type="submit" value="save" /></td>
		</tr>
 </table>
</form>
	
{* <? space(20); ?> *}
<form name="delquote" method="post" action="{$PHP_SELF}">
 <table id="zitatDelForm">
  <tr>
   <th>Zitat</th>
   <th>Urheber</th>
   <th>&nbsp;</th>
   <th><img src="/img/delete.png" alt="" /></th>
  </tr>
  {foreach from=$quotes item=quote}
  <tr>
   <td class="quote">{$quote->text}</td>
   <td class="origin">{$quote->origin}</td>
   <td class="edit"><a href="{$PHP_SELF}?id={$quote->id}"><img class="editIcon" src="/img/edit.png" alt="" /></a></td>
   <td class="delete"><input type="checkbox" name="{$quote->id}" value="delete" /></td>
  </tr>
  {/foreach}
  <tr>
   <td colspan="4" class="adminFormStrg"><input type="submit" value="del" /></td>
  </tr>
 </table>
</form>
{include file=footer.tpl}
