<div class="container">

    <div class="blog-header col-sm-8 col-sm-offset-2">
        <h1 class="blog-title">Отзывы</h1>
        <p class="lead blog-description">Это страница отзывов</p>
    </div>

    <div class="row">

        <div class="col-sm-8 col-sm-offset-2 blog-main">
Сортировать по: <a href="" id="dateord" ">Дате</a> <a href="" id="emailord" >Email</a> <a href="" id="nameord" >Автору</a>
            <?php foreach ($data as $items) {
    ?>

            <div class="blog-post">
                <h2 class="blog-post-title">Отзыв № <?=$items['id']?></h2>
                <p class="blog-post-meta"><?=$items['date']?> <a href="#">Автор:<?=$items['author_name']?></a> Email: <?=$items['email']?> <?if ($items['ed'] == 1) {
    echo 'Изменен администратором';
}
    ?></p>

                <p>Текст отзыва: <?=$items['text']?></p>
                <p><img src="uploads/<?=$items['image']?>" alt="uploads/<?=$items['image']?>" width="320px" height="240px"></p>
                </div><!-- /.blog-post -->
                <hr>
            <?php 
}?>
        </div><!-- /.blog-main -->
    </div>

        <div class="row">
            <div class="col-sm-8  col-sm-offset-2">
                <!-- Контейнер, содержащий форму обратной связи -->
                <div class="panel panel-info">
                    <!-- Заголовок контейнера -->
                    <div class="panel-heading">
                        <h3 class="panel-title">Форма обратной связи</h3>
                    </div>
                    <!-- Содержимое контейнера -->
                    <div class="panel-body">
                        <!-- Сообщение, отображаемое в случае успешной отправки данных -->
                        <div class="alert alert-success hidden" role="alert" id="msgSubmit">
                            <strong>Внимание!</strong> Сообщение отправлено. Ждите одобрения администратора
                        </div>
                        <!-- Форма обратной связи -->
                        <form id="messageForm" >
                            <div class="row">
                                <div class="col-sm-6">
                                    <!-- Имя пользователя -->
                                    <div class="form-group has-feedback">
                                        <label for="name" class="control-label">Введите Ваше имя:</label>
                                        <input type="text" id="name" name="name" class="form-control" required="required" value="" placeholder="Например, Иван Иванович" minlength="2" maxlength="30">
                                        <span class="glyphicon form-control-feedback"></span>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- E-mail пользователя -->
                                    <div class="form-group has-feedback">
                                        <label for="email" class="control-label">Введите email:</label>
                                        <input type="email" id="email" name="email" class="form-control" required="required"  value="" placeholder="Например, ivan@mail.ru" maxlength="30">
                                        <span class="glyphicon form-control-feedback"></span>
                                    </div>
                                </div>

                            </div>
                            <div class="form-group has-feedback">
                                <label for="message" class="control-label">Введите текст сообщения:</label>
                                <input type="text" id="message" class="form-control" rows="3" placeholder="Введите сообщение, состоящее не менее чем из 20 символов и не более чем из 500" minlength="20" maxlength="500" required="required">
                            </div>
                            <div class="row">
                                <div class="col-sm-8">
                                    <!-- Картинка -->
                                    <div class="form-group has-feedback">
                                        <label for="email" class="control-label">Вставьте изображение:</label>
                                        <input type="file" multiple="multiple" id="file" name="file" required="required"  value="" placeholder="Вставьте файл" accept=".image/*">
                                        <span class="glyphicon form-control-feedback"></span>
                                    </div>
                                </div>
                            </div>
                            <!-- Сообщение пользователя -->

                            <hr>

                            <!-- Кнопка, отправляющая форму по технологии AJAX -->
                            <div  class="btn btn-success pull-left" id="preview">Предварительный просмотр</div>
                            <button type="submit" class="btn btn-primary pull-right">Отправить сообщение</button>
                        </form><!-- Конец формы -->
                    </div>
                </div><!-- Конец контейнера -->
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8 blog-main" id="pre">

                </div>
        </div>

    </div><!-- /.row -->

</div><!-- /.container -->