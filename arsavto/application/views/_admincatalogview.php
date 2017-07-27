<table>
	<tr><td colspan = "7" align="left"><a href="#" onClick="winop('{base_url}_admin/add/{model}/{cat}/','350','400','500','50')"><h3>Добавить...</h3></a></td></tr>
	<tr>
		<td style=\"border-bottom: 1px solid #000;\">Наименование</td>
		<td style=\"border-bottom: 1px solid #000;\">Цена</td>
		<td style=\"border-bottom: 1px solid #000;\">Фирма-производитель</td>
		<td style=\"border-bottom: 1px solid #000;\">Номер по каталогу</td>
		<td style=\"border-bottom: 1px solid #000;\">Изображение</td>
		<td style=\"border-bottom: 1px solid #000;\">Товар недели</td>
		<td style=\"border-bottom: 1px solid #000;\">Удалить</td>
	</tr>
	{catalog}
	<tr>
		<td><a href="#" onClick="winop('{base_url}_admin/edit/{id}/','350','400','500','50')">{name}</a></td>
		<td>{price}</td>
		<td>{firm}</td>
		<td>{ncat}</td>
		<td><a id="zoomme" href="#" title="Нажмите"><img src="{img}" width="50" height="50" alt="{img}"></a></td>
		<td><input type="checkbox" {sale} disabled></td>
		<td align="center"><a href="{base_url}_admin/del/{id}">Удалить</a></td>
	</tr>{/catalog}
</table>