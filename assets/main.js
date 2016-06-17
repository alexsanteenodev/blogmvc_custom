$(function() {
    //при нажатии на кнопку Обновить

    //при отправке формы messageForm на сервер (id="save")
    $('#messageForm').submit(function(event) {
        //отменить стандартное действие браузера
        event.preventDefault();
        //завести переменную, которая будет говорить о том валидная форма или нет
        var formValid = true;
        //перебирает все элементы управления формы (input и textarea)
        $('#messageForm input,textarea').each(function() {
            //если этот элемент капча, то пропустить его проверку
            if ($(this).attr('id') == 'text-captcha') { return true; }
            //найти предков, имеющих класс .form-group (для установления success/error)
            var formGroup = $(this).parents('.form-group');
            //найти glyphicon (иконка успеха или ошибки)
            var glyphicon = formGroup.find('.form-control-feedback');
            //валидация данных с помощью HTML5 функции checkValidity
            if (this.checkValidity()) {
                //добавить к formGroup класс .has-success и удалить .has-error
                formGroup.addClass('has-success').removeClass('has-error');
                //добавить к glyphicon класс .glyphicon-ok и удалить .glyphicon-remove
                glyphicon.addClass('glyphicon-ok').removeClass('glyphicon-remove');
            } else {
                //добавить к formGroup класс .has-error и удалить .has-success
                formGroup.addClass('has-error').removeClass('has-success');
                //добавить к glyphicon класс glyphicon-remove и удалить glyphicon-ok
                glyphicon.addClass('glyphicon-remove').removeClass('glyphicon-ok');
                //если элемент не прошёл проверку, то отметить форму как не валидную
                formValid = false;
            }
        });

        // форма валидна и длина капчи равно 6 символам, то отправляем форму на сервер (AJAX)
        if (formValid) {
            var $that = $(this),
                formData = new FormData($that.get(0));

            var message = $("#message").val();


            formData.append('message', message);

            //отправляем данные на сервер (AJAX)
            $.ajax({
                //метод передачи запроса - POST
                type: "POST",
                //URL-адрес запроса
                url: "site/setdata",
                //передаваемые данные
                contentType: false, // важно - убираем форматирование данных по умолчанию
                processData: false, // важно - убираем преобразование строк по умолчанию
                data: formData,
                dataType: 'json',
                //data: "name=" + name + "&email=" + email + "&message=" + message +image ,
                success: function(data){
                    alert(data);
                    //скрыть форму обратной связи
                    $('#messageForm').hide();
                    //удалить у элемент, имеющего id msgSubmit, класс hidden
                    $('#msgSubmit').removeClass('hidden');
                }


                    //если пришёл ответ invalidcaptcha, то делаем следующее...


            });
            $('#messageForm').hide();
            //удалить у элемент, имеющего id msgSubmit, класс hidden
            $('#msgSubmit').removeClass('hidden');
        }
    });

    $('#preview').click(function(event) {
        var $that = $('#messageForm'),
            formData = new FormData($that.get(0));

        var message = $("#message").val();


        formData.append('message', message);
        $.ajax({
            //метод передачи запроса - POST
            type: "POST",
            //URL-адрес запроса
            url: "site/preview",
            //передаваемые данные
            contentType: false, // важно - убираем форматирование данных по умолчанию
            processData: false, // важно - убираем преобразование строк по умолчанию
            data: formData,
            dataType: 'json',
            //data: "name=" + name + "&email=" + email + "&message=" + message +image ,
            success: function(data){

                $('#pre').html(data);

            }
        });

    });



    $('#loginButton').click(function(event) {
        //отменить стандартное действие браузера
        event.preventDefault();
        //завести переменную, которая будет говорить о том валидная форма или нет
        var formValid = true;
        //перебирает все элементы управления формы (input и textarea)
        $('#loginForm input,textarea').each(function() {


            var formGroup = $(this).parents('.form-group');
            //найти glyphicon (иконка успеха или ошибки)
            var glyphicon = formGroup.find('.form-control-feedback');
            //валидация данных с помощью HTML5 функции checkValidity
            if (this.checkValidity()) {
                //добавить к formGroup класс .has-success и удалить .has-error
                formGroup.addClass('has-success').removeClass('has-error');
                //добавить к glyphicon класс .glyphicon-ok и удалить .glyphicon-remove
                glyphicon.addClass('glyphicon-ok').removeClass('glyphicon-remove');
            } else {
                //добавить к formGroup класс .has-error и удалить .has-success
                formGroup.addClass('has-error').removeClass('has-success');
                //добавить к glyphicon класс glyphicon-remove и удалить glyphicon-ok
                glyphicon.addClass('glyphicon-remove').removeClass('glyphicon-ok');
                //если элемент не прошёл проверку, то отметить форму как не валидную
                formValid = false;
            }
        });

        // форма валидна и длина капчи равно 6 символам, то отправляем форму на сервер (AJAX)
        if (formValid) {


            var name = $("#inputName").val();
            var password = $("#inputPassword").val();



            //отправляем данные на сервер (AJAX)
            $.ajax({
                //метод передачи запроса - POST
                type: "POST",
                //URL-адрес запроса
                url: "/admin/login",
                //передаваемые данные

                data: "name=" + name + "&password=" + password,
                success: function(data){
                    if (data==1) {
                        window.location.href = "/admin/dashboard";
                    }else{
                        alert('Неправильный логин/пароль')
                    }
                }


                //если пришёл ответ invalidcaptcha, то делаем следующее...


            });

        }
    });

    $('.public').click(function(event) {
        //отменить стандартное действие браузера
        event.preventDefault();
        var el = $(this);
        var onel = el.parent();
        var value = $(this).attr('value');

            //отправляем данные на сервер (AJAX)
            $.ajax({
                //метод передачи запроса - POST
                type: "POST",
                //URL-адрес запроса
                url: "/admin/active",
                //передаваемые данные
                data: "value=" + value,
                success: function(data){
                    el.detach();
                    onel.html('Опубликовано');
                    console.log('ok')
                }


                //если пришёл ответ invalidcaptcha, то делаем следующее...


            });


    });

    $('.change').click(function(event) {
        //отменить стандартное действие браузера
        event.preventDefault();

        var button = $(this);
        var onel = button.parent();
        var value = $(this).attr('value');
        var el = $('#row'+value+' .changetext');
        var text = el.html();
        var input = '<input type="text" value="'+text+'" id="input'+value+'">';
        var button2 = $('#row'+value+' .save');
        el.empty();
        el.html(input);
        button.detach();
        button2.show();
        // $('#row'+value+' .changetext').html(text);
        //отправляем данные на сервер (AJAX)



    });

    $('.save').click(function(event) {
        //отменить стандартное действие браузера
        event.preventDefault();
        var el = $(this);
        var onel = el.parent();
        var value = $(this).attr('value');
        var inp = $('#input'+value+'');

        var text = inp.val();
        var input = inp.html();
        var oninput = inp.parent();

        //отправляем данные на сервер (AJAX)
        $.ajax({
            //метод передачи запроса - POST
            type: "POST",
            //URL-адрес запроса
            url: "/admin/change",
            //передаваемые данные
            data: "id=" + value + "&text=" + text,
            success: function(data){

                    el.detach();


                    onel.html('Сохранено');
                    oninput.html(text);
               // input.detach();

            }





        });


    });

    $('#emailord').click(function(event) {
        event.preventDefault();
        //отменить стандартное действие браузера
        var emailord = '1';
        $.ajax({
            //метод передачи запроса - POST
            type: "POST",
            //URL-адрес запроса
            url: "/site/index",
            //передаваемые данные
            data: "emailord=" + emailord,
            success: function(data){

                $('html').empty();
                $('html').html(data);

            }



    });
    });

    $('#dateord').click(function(event) {
        event.preventDefault();
        //отменить стандартное действие браузера
        var dateord = '1';
        $.ajax({
            //метод передачи запроса - POST
            //метод передачи запроса - POST
            type: "POST",
            //URL-адрес запроса
            url: "/site/index",
            //передаваемые данные
            data: "dateord =" + dateord ,
            success: function(data){

                $('html').empty();
                $('html').html(data);

            }



        });
    });

    $('#nameord').click(function(event) {
        event.preventDefault();
        //отменить стандартное действие браузера
        var nameord = '1';
        $.ajax({
            //метод передачи запроса - POST
            //метод передачи запроса - POST
            type: "POST",
            //URL-адрес запроса
            url: "/site/index",
            //передаваемые данные
            data: "nameord =" + nameord ,
            success: function(data){

                $('html').empty();
                $('html').html(data);

            }



        });
    });







});
/**
 * Created by santeeno on 24.05.2016.
 */
