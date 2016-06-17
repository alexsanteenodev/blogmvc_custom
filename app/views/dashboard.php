<div class="container">

    <div class="blog-header">
        <h1 class="blog-title">Администрирование отзывов</h1>
        <a href="/admin/logout" class="btn btn-default btn-danger pull-right">Выход</a>

    </div>

    <div class="row">

        <div class="col-sm-8 blog-main">

            <table class="table">
                <thead>
                <tr>
                    <th>№ </th>
                    <th>Имя автора</th>
                    <th>E-mail</th>
                    <th>Текст</th>
                    <th>Дата</th>
                    <th>Картинка</th>
                    <th>Активен</th>
                    <th>Публикация</th>
                    <th>Изменение</th>
                </tr>
                </thead>

                <tbody>
                <?php ?>
            <?php foreach ($data as $items) {
    ?>

                    <tr id="row<?=$items['id']?>">
                        <th><?=$items['id']?> </th>
                        <th><?=$items['author_name']?></th>
                        <th><?=$items['email']?></th>
                        <th class="changetext" value="<?=$items['id']?>"><?=$items['text']?></th>
                        <th><?=$items['date']?></th>
                        <th><img src="../../uploads/<?=$items['image']?>" alt="<?=$items['image']?>" width="160px" height="120px"></th>
                        <th><?if ($items['active'] == 1) {
    echo 'Да';
} else {
    echo 'Нет';
}
    ?></th>
                        <th><?if ($items['active'] == 0) {
    ?><a href="" class="btn btn-success btn-sm public"  id="change<?=$items['id']?>" value="<?=$items['id']?>">Опубликовать</a></th>
                        <?php

}
    ?>
                        <th><a href="" class="btn btn-default btn-sm change"  value="<?=$items['id']?>">Редактировать</a>
                            <span class="btn btn-default save" value="<?=$items['id']?>" style="display: none">Сохранить</span>
                        </th>
                    </tr>



            <?php 
}?>
                </tbody>
            </table>



        </div><!-- /.blog-main -->
    </div>




</div><!-- /.row -->

</div><!-- /.container -->