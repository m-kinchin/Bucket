<h4><form action="{base_url}zakaz/" method="post">
<table style="width: 100%; height: 100%; margin-top: 20px; margin-bottom: 20px;">
<tr><td valign="top" style="width: 300px;text-align: justify ;"><br><span style="padding-left:10px;">�</span>��������� ��� ������� online-�����. ����� ���������� ������ �������� �������� � ���� � ������� ����������� ������.<br><br><span style="padding-left:10px;">�</span>��� �� �� ����� ������ �������� ��� ������ ������ ���� � ����� ��������, �� ������ �������� ������ � ���������, ������������� ������, ��������� ������ � ����� ������� � �� ������� ��� � �������� �������� �����.</td><td>
<table style="width: 690px; height: 100%; margin-top: 10px; margin-bottom: 20px;">
<tr>
	<td width= "690px" align="left" valign="top">
    <table class="form_table">
	{message}
<tr>
    <td>���������� ����������:</td>
    <td colspan="3"><textarea name="contact" cols="25" rows="3">{contact}</textarea></td>
</tr>
<tr>
    <td>����� � ������ ����:</td>
    <td colspan="3"><input type="text" name="model" value="{model}"></td>
</tr>
<tr>
    <td>��� �������:</td>
    <td colspan="3"><input type="text" name="year" maxlength="4" value="{year}"></td>
</tr>
<tr>
    <td>VIN-���:</td>
    <td colspan="3"><input type="text" name="vin" value="{vin}"></td>
</tr>
<tr>
    <td>��� ������:</td>
    <td colspan="3"><input type="text" name="body" value="{body}"></td>
</tr>
<tr>
    <td>����� ���������:</td>
    <td colspan="3"><input type="text" name="value_engine" value="{value_engine}"></td>
</tr>
<tr>
    <td>�������� ���������:</td>
    <td colspan="3"><input type="text" name="power" value="{power}"></td>
</tr>
<tr>
    <td>��� ���:</td>
	{type_kpp}
    <td width="130px"><input type="radio" value="{value}" id="{value}" name="type_kpp" {check}><label for="{value}">{value}</label></td>
    {/type_kpp}
</tr>
<tr>
    <td>��� ������� �����:</td>
    {type_privod}
    <td width="130px"><input type="radio" value="{value}" id="{value}" name="type_privod" {check}><label for="{value}">{value}</label></td>
    {/type_privod}
</tr>
<tr>
    <td>������������ ����:</td>
    {type_wheel}
    <td width="130px"><input type="radio" value="{value}" id="{value}" name="type_wheel" {check}><label for="{value}">{value}</label></td>
    {/type_wheel}
</tr>
<tr>
    <td>����� ������:</td>
    <td colspan="3"><textarea name="text_order" cols="50" rows="7" >{text_order}</textarea></td>
</tr>
<tr>
    <td>�����������, ��� �� �������:
    </td>
    <td colspan="3">
    <img align="absmiddle" src="{base_url}img/captcha.php">&nbsp<input type="text" name="captcha" size="10">
    </td>
</tr>
<tr>
    <td>
    </td>
	<td colspan="3">
    <input type="submit" value="���������">
    &nbsp
    <input type="reset" value="��������">
    </td>
</tr>
</table>
</td>
</tr></table>
</td></tr></table></h4>