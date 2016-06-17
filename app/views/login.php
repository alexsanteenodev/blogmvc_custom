<?//echo var_dump($data);?>
<div class="container">
<h1 align="center">Вход в админку</h1>

<form class="form-horizontal" id="loginform" >
    <div class="form-group">
        <label for="inputName" class="col-xs-2 control-label">Имя:</label>
        <div class="col-xs-10">
            <input type="text" name="name" class="form-control" id="inputName" placeholder="Введите имя">
        </div>
    </div>
    <div class="form-group">
        <label for="inputPassword" class="col-xs-2 control-label">Пароль:</label>
        <div class="col-xs-10">
            <input type="password" name="password" class="form-control" id="inputPassword" placeholder="Введите пароль">
        </div>
    </div>

    <div class="form-group">
        <div class="col-xs-offset-2 col-xs-10">
            <div type="" class="btn btn-default" id="loginButton">Войти</div>
        </div>
    </div>
</form>

</div>
