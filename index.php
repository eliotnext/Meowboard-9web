<html lang="ru">
<head>
  <?php
   $website_title = 'Вход в аккаунт';
   require 'block/HacHead.php'; ?>
</head>
  <body>

<?php require 'block/HacHeader.php'; ?>

<?php
ini_set('display_errors','Off');// не показывать ошибку на этой странице
if($_COOKIE['nickname'] == ""):
?>

  <div  id="form_enter" class="col-md-3">
  <h4 align="center">Вход</h4>
<form >
<p>
  <label for="username"> Логин </label>
  <input type="text" name="username" id="username" class="form-control">
  <form class="my-form">
      <div class="form-group">
          <label for="password"> Пароль </label>
          <input type="password" name="password" id="password" class="form-control">
      </div>
      <div class="form-group">
          <a href="#" onclick="return false" id="s-h-pass">Показать пароль</a>
      </div>
  </form>

  <div class="alert alert-danger mt-2" id="HacErrorBlock1"> </div>

  <center><button type="button" id="enter_user"  class="btn btn-danger mt-3">
    Войти
  </button></center>
</form>

</div>
<img  src="/img/vtb-log.png"  width="115" height="45"  align="right" hspace="10" vspace="10">
</p>
<?php require 'block/HacFooter.php'; ?>

<?php
else:
?>

<?php require 'HacPers_account.php';?>
<!-- Здесь будет привинчина страница с основным функционалом-->
<?php
endif;
?>



<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>

  <script>
      $( document ).ready(function() {
          $('#s-h-pass').click(function(){
              var type = $('#password').attr('type') == "text" ? "password" : 'text',
               c = $(this).text() == "Скрыть пароль" ? "Показать пароль" : "Скрыть пароль";
              $(this).text(c);
              $('#password').prop('type', type);
          });
      });
  </script>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script>

$('#enter_user').click(function () {
  var nick = $('#username').val();
  var pass = $('#password').val();

  $.ajax({
    url:'ajax/HacEnter.php',
    type:'POST',
    cache:false,
    data:{'username' : nick, 'pass': pass },
    dataType: 'html',
    success: function(data){
    if(data == 'готово'){
      $('#enter_user').text('Всё готово');
      $('#HacErrorBlock1').hide();
        document.location.reload(true);
      }
    else {
        $('#HacErrorBlock1').show();
        $('#HacErrorBlock1').text(data);
      }
    }
  });
});
</script>

</body>
</html>
