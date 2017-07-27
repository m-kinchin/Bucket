<h4>
<table style="width: 100% height: 100%; margin-top: 20px; margin-bottom: 20px;">
    <tr>
	<td width= "380px" align="left" valign="top">

    Офис ООО "Арс-Авто":<br><br>
	<b>г. Казань<br>ул.Гвардейская, 53А, корпус 1</b><br>
	(территория "Автопилот")<br><br>
    <table width="100%">
			<?php
			if(isset($phone) && is_array($phone))
            foreach($phone as $v)
            {
			?>
		    <tr>
			<td align="left">Тел:</td><td align="left"><b><?=$v;?></b></td>
		    </tr>
            <?php
			}
			if(isset($fax) && is_array($fax))
            foreach($fax as $v)
            {
			?>
		    <tr>
			<td align="left">Факс:</td><td align="left"><b><?=$v;?></b></td>
		    </tr>
            <?php
			}
			if(isset($icq) && is_array($icq))
            foreach($icq as $k=>$v)
            {
            ?>
		    <tr>
			<td align="left">ICQ:</td><td align="left"><b><?=$v;?> <img style="border:none;" alt="*" align="absmiddle" src="http://status.icq.com/online.gif?icq=<?=$v;?>&img=5" /> <?=$k;?></b></td>
		    </tr>
            <?php
            }
			if(isset($skype) && is_array($skype))
            foreach($skype as $v)
            {
            ?>
            <tr valign="center">
			<td align="left">Skype:</td><td align="left"><b><?=$v;?></b> <a href="skype:<?=$v;?>call"><img src="{base_url}img/skype.png" style="border:none;"  align="absmiddle" alt="S"/></a>
			</td>
		    </tr>
            <?php
            }
			if(isset($email) && is_array($email))
            foreach($email as $v)
            {
            ?>
		    <tr>
			<td align="left">Email:</td><td align="left"><b><a href="mailto:<?=$v;?>"><?=$v;?></a></b></td>
		    </tr>
			<?php
			}
			?>
		</table>
        <br><br>Режим работы:<br><br>
        <table width="100%">
		    <tr>
			<td align="left">Пн:</td><td align="left"><b>9:00 - 18:00</b></td>
            </tr>
            <tr>
			<td align="left">Вт:</td><td align="left"><b>9:00 - 18:00</b></td>
            </tr>
            <tr>
			<td align="left">Ср:</td><td align="left"><b>9:00 - 18:00</b></td>
            </tr>
            <tr>
			<td align="left">Чт:</td><td align="left"><b>9:00 - 18:00</b></td>
            </tr>
            <tr>
			<td align="left">Пт:</td><td align="left"><b>9:00 - 18:00</b></td>
            </tr>
            <tr>
			<td align="left">Сб:</td><td align="left"><b>9:00 - 14:00</b></td>
            </tr>
            <tr>
			<td align="left">Вс:</td><td align="left"><b>Выходной</b></td>
            </tr>
        </table>
	</td>
	<td width= "610px" align="left" valign="top">
	<center>Схема проезда
	<!--
	<iframe width="600" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps/ms?msid=216207138008071300481.0004cd75b0a88fd6bd804&amp;msa=0&amp;ie=UTF8&amp;t=m&amp;ll=55.775161,49.172144&amp;spn=0.004827,0.012853&amp;z=16&amp;output=embed"></iframe>
	-->
	<script type="text/javascript" charset="utf-8" src="//api-maps.yandex.ru/services/constructor/1.0/js/?sid=8HRE7XgrfYkBO3swSvQD1LvnxaUbEgmm&width=600&height=450"></script>
	</td>
    </tr>
</table>
</h4>