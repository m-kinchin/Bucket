<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
    "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<script>
{succes}
function CloseIt() {
    close();
    } 
</script>
  <title></title>
  <link rel="stylesheet" href="{base_url}css/reset.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="{base_url}css/base.css" type="text/css" media="screen"/>
</head>

<body>
<form action="" method="POST" ENCTYPE="multipart/form-data">
<table>
<tr><td align="left" colspan="2"></td></tr>
<tr><td align="right">Наименование детали*:</td><td align="left"><input type="text" name="part[name]" value='{name}'>{error_name}</td></tr>
<tr><td align="right">Фирма-производитель:</td><td align="left"><input type="text" name="part[firm]" value='{firm}' ></td></tr>
<tr><td align="right">Цена*:</td><td align="left"><input type="text" name="part[price]" value='{price}'>{error_price}</td></tr>
<tr><td align="right">Номер по каталогу:</td><td align="left"><input type="text" name="part[ncat]" value='{ncat}'></td></tr>
<tr><td align="right">Описание:</td><td align="left"><textarea name="part[des]">{des}</textarea></td></tr>
<tr><td align="right">Изображение*:</td><td align="left"><input type="file" name="myfile" maxlength="254" size="20" accept="jpg/image">{error_myfile}</td></tr>
<input type="hidden" name="part[id]" value="{id}">
<input type="hidden" name="part[cat]" value="{cat}">
<tr><td align="right">Товар недели:</td><td align="left"><input type="checkbox" name="part[sale]" value="1" {sale}></td></tr>
<tr><td align="left" colspan="2">* - обязательны для заполнения</td></tr>
<tr><td align="right"><input type="submit" onClick="close();"></td><td align="left"><input type="button" onClick="CloseIt()" value="Отмена"></td></tr>
</table>
</form>
</body>
</html>
