<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
.icnewsdiv{width:100%}
.icnewsdiv a{}
.icnewsdiv a:hover{color:#333333;}
.icnewspic{margin:0px 10px 5px 0px; border:1px solid #666666;}
.icnewsdescr{ text-align:justify;}
.icnewsdate{font-size:10px; color:#999999;margin-top:2px}
</style>
<script type="text/javascript" src="{base_url}js/jquery-1.4.min.js"></script>
<script type="text/javascript" src="{base_url}js/zoomi.js"></script>
<script type="text/javascript">
// <!-- Examples of dynamically calling zoomi -->
$(function(){

  $('#zoomme img').zoom1().click(function(){
    $(this).zoom2().fadeIn().click(function(){
      $(this).hide(); return false; })
    .end().parent().addClass('red'); return false; });

  for(i=1; i<=5; ++i)
    $('#bleach').append('<img class="zoomi" src="bleach/'+i+'.jpg" height="110">');
  $('#bleach img.zoomi').zoomi();

  $('.bw img')
  .zoom1().mouseover(function(){ $(this).zoom2().fadeIn(); })
  .zoom2().mouseout(function(){ $(this).fadeOut(1600); });
});

</script>
<title>
Автозапчасти для автомобилей Honda и Acura
</title>
<meta http-equiv="content-type" content="text/html; charset=windows-1251;">
<meta name="description" content="Автозапчасти Хонда Казань" />
<meta name="keywords" content="Автозапчасти Хонда Казань" />
<meta name="robots" content="Автозапчасти Хонда Казань" />
<link rel="icon" href="favicon.ico"/>
<link rel="stylesheet" href="{base_url}css/reset.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="{base_url}css/_menu.css" type="text/css" media="screen"/>
<link rel="stylesheet" href="{base_url}css/base.css" type="text/css" media="screen"/>
<script>
function winop(link,hi,wd,x,y)
{
settings="menubar=no,location=no,resizable=no,scrollbars=no,status=no";
settings=settings+',height='+hi+',width='+wd+',left='+x+',top='+y;
windop = window.open(link,"Windows",settings);
}
</script>
</head>
<body>
<form action="{base_url}_admin/" method="POST">
<table width="100%" height="100%">
<tr>
    <td align="center">{menu}
	    </td></tr><tr><td>{content}</td>
</tr>
</table>
</form>
</body>
</html>