<div>
 <main >
  <div class="row">
<div class="col-md-2">
<?php  require 'block/HacLeftmenu.php'; ?>
</div>

    <div class="col-md-8">
     <h4>-</h4>
      <h4>-</h4>
  <h4>Личный кабинет</h4>
      <?php
       // require_once 'mysql_connect.php';
      ?>
      <form>
        <div class="form-group row">
          <div class="col-sm-10">
            <!-- Всплывающее красивое оно с кнопками -->
           <div class="jumbotron">
             <h1 class="display-7">Тема!</h1>
             <p class="lead">Введите тему для обсуждения.</p>
             <hr class="my-2">
             <div class="col-sm-10">
               <input type="text" class="form-control" id="inputQuestion" placeholder="Тема">
             </div></p>
             <p class="lead">
                 <button type="button" id="sent_question" class="btn btn-danger btn-lg">Отправить на обсуждение</button>
             </p>
           </div>
          </div>
        </div>

        <!-- <div class="form-group row mt-5">
          <label for="inputQuestion" class="col-sm-2 col-form-label">Введите тему обсуждения</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" id="inputQuestion" placeholder="Вопрос">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10 offset-sm-2">
            <button type="button" id="sent_question" class="btn btn-danger">Отправить на обсуждение</button>
          </div>
        </div> -->


        <div class="form-group row">
          <div class="col-sm-10">
            <!-- Всплывающее красивое оно с кнопками -->
           <div class="jumbotron">
             <h1 class="display-7">Нужные люди!</h1>
             <p class="lead">Введите вопросы, которые вы хотели бы поднять.</p>
             <hr class="my-2">
             <p><div class="input-group">
               <div class="input-group-prepend">
                 <div class="input-group-text">
                   <input type="checkbox" aria-label="Checkbox for following text input">
                 </div>
               </div>
               <input type="text" class="form-control" aria-label="Text input with checkbox" value="Человек">
             </div></p>
             <p class="lead">
               <a class="btn btn-danger btn-lg" href="#!" role="button">Добавить</a>
             </p>
           </div>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-10">
            <!-- Всплывающее красивое оно с кнопками -->
           <div class="jumbotron">
             <h1 class="display-7">Вопросы!</h1>
             <p class="lead">Выберите людей, которых требуется добавить для обсуждения вопроса.</p>
             <hr class="my-2">
               <hr class="my-2">
               <div class="col-sm-10">
                 <input type="text" class="form-control" id="inputQuestion" placeholder="Вопрос">
               </div></p>
               <p class="lead">
               <a class="btn btn-danger btn-lg" href="#!" role="button">Добавить</a>
             </p>
           </div>
          </div>
        </div>

        

 <center><button class="btn-danger btn-lg mb-4 " href="#!" role="button">Начать опрос</button></center>

        <div id="activ" class="form-group row">
          <div class="col-sm-10">
            <!-- Всплывающее красивое оно с кнопками -->
           <div class="jumbotron">
             <h1 class="display-7">Опрос!</h1>
             <p class="lead">Текст вопроса.</p>
             <hr class="my-2">
               <hr class="my-2"></p>
               <p class="lead">
               <a class="btn btn-danger btn-lg" href="#!" role="button">За</a>
                <a class="btn btn-info btn-lg" href="#!" role="button">Против</a>
             </p>
           </div>
          </div>
        </div>
        <form>

        <div id="finished" class="form-group row">
          <div class="col-sm-10">
            <!-- Всплывающее красивое оно с кнопками -->
           <div class="jumbotron">
             <h1 class="display-7">Рассмотренные вопросы!</h1>
             <p class="lead">Тема -> вопрос -> общее решение.</p>

           </div>
          </div>
        </div>

        </div>


      </form>



    <?php require 'block/HacFooter.php'; ?>
    </div>
   </main>
 </div>



 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

 <script>

 $('#sent_question').click(function () {
   var question = $('#inputQuestion').val();

   $.ajax({
     url:'ajax/HacQuestion.php',
     type:'POST',
     cache:false,
     data:{'question' : question, },
     dataType: 'html',
     success: function(data){
     if(data == 'готово'){
       $('#sent_question').text('Всё готово');
       $('#HacErrorBlock2').hide();
         document.location.reload(true);
       }
     else {
         $('#HacErrorBlock2').show();
         $('#HacErrorBlock2').text(data);
       }
     }
   });
 });
 </script>
