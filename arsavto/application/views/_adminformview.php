<form action="{base_url}_admin" method="POST">
        <table  style="width:100%; height:80px;border-bottom: 2px dotted #339999; border-top: 2px dotted #339999; text-align: center" bgcolor="#d2dae1">
        <tr><td align=center>
            <table><tr style="height: 30px;border-bottom: 1px solid #000000;"><td align="center" colspan="2">Форма авторизации</td></tr>
            <tr  style="height: 15px;"><td  style="text-align: right">Логин:</td><td dtyle="text-align: left;"><input type="text" name="login"></td></tr>
            <tr  style="height: 15px;"><td  style="text-align: right">Пароль:</td><td dtyle="text-align: left;"><input type="password" name="pass"></td></tr>
            <tr  style="height: 20px;"><td colspan="2" align="center"><input type="submit" value="Войти"><input type="hidden" name="act" value="1"></td></tr>
            </table>
            </td></tr>
        </table>
{message}
        </form>