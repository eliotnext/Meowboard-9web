<div id="header" class="d-flex flex-column flex-md-row align-items-center p-2 px-md-3   border-bottom shadow-sm">
<h5> <a class="my-0 mr-md-auto font-weight-normal p-2  text-white">MeowBoard</a></h5>
<img  src="/img/Meow-logo.png"  width="80" height="80">

<?php
ini_set('display_errors','Off');
if($_COOKIE['nickname'] == ""):
?>

<?php
  else:
?>
<button type="button" id="exit_btn" class="btn btn-danger  mr-2 mb-2">
Выйти</button>

<?php
  endif;
?>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script>
// действия кнопки выхода
$('#exit_btn').click(function () {
  $.ajax({
    url:'ajax/HacExit.php',
    type:'POST',
    cache:false,
    data:{},
    dataType: 'html',
    success: function(data){
        location.replace("../HacEnterPHP.php");
    }
  });
});

</script>
