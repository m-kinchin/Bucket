<script type="text/javascript" src="{base_url}js/jquery-1.4.min.js"></script>

<script type="text/javascript" src="{base_url}js/zoomi.js"></script>

<script type="text/javascript">

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