<?php
/**
 * Created by PhpStorm.
 * User: santeeno
 * Date: 23.05.2016
 * Time: 15:11.
 */

namespace app\controllers;

use app\base\Controller;
use app\base\View;
use app\models\Site;

class SiteController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->model = new Site();
        $this->view = new View();
    }

    public function action_index()
    {
        parent::action_index();
        $order = 'date DESC';
        if (isset($_POST['emailord'])) {
            $order = 'email ASC';
        }

        if (isset($_POST['dateord'])) {
            $order = 'date DESC';
        }
        if (isset($_POST['nameord'])) {
            $order = 'author_name ASC';
        }

        $select = array(
                'where' => 'active = 1', // условие
                'order' => $order,
            );

        $model = new Site($select); // создаем объект модели
        $data = $model->getAllRows(); // получаем все строки

        //var_dump($usersInfo); // выводим данные

        $this->view->generate('main.php', $data);
    }

    public function resize($file, $type = 1, $rotate = null, $quality = null)
    {
        global $tmp_path;

        // Ограничение по ширине в пикселях
        $max_thumb_size = 200;
        $max_size = 600;
        $w = 320;
        // Качество изображения по умолчанию
        if ($quality == null) {
            $quality = 75;
        }

        // Cоздаём исходное изображение на основе исходного файла
        if ($file['type'] == 'image/jpeg') {
            $source = imagecreatefromjpeg($file['tmp_name']);
        } elseif ($file['type'] == 'image/png') {
            $source = imagecreatefrompng($file['tmp_name']);
        } elseif ($file['type'] == 'image/gif') {
            $source = imagecreatefromgif($file['tmp_name']);
        } else {
            return false;
        }

        // Поворачиваем изображение
        if ($rotate != null) {
            $src = imagerotate($source, $rotate, 0);
        } else {
            $src = $source;
        }

        // Определяем ширину и высоту изображения
        $w_src = imagesx($src);
        $h_src = imagesy($src);

        // В зависимости от типа (эскиз или большое изображение) устанавливаем ограничение по ширине.
        if ($type == 1) {
            $w = $max_thumb_size;
        } elseif ($type == 2) {
            $w = $max_size;
        }

        // Если ширина больше заданной
        if ($w_src > $w) {
            // Вычисление пропорций
            $ratio = $w_src / $w;
            $w_dest = round($w_src / $ratio);
            $h_dest = round($h_src / $ratio);

            // Создаём пустую картинку
            $dest = imagecreatetruecolor($w_dest, $h_dest);

            // Копируем старое изображение в новое с изменением параметров
            imagecopyresampled($dest, $src, 0, 0, 0, 0, $w_dest, $h_dest, $w_src, $h_src);

            // Вывод картинки и очистка памяти
            imagejpeg($dest, $tmp_path.$file['name'], $quality);
            imagedestroy($dest);
            imagedestroy($src);

            return $file;
        } else {
            // Вывод картинки и очистка памяти
            imagejpeg($src, $tmp_path.$file['name'], $quality);
            imagedestroy($src);

            return $file;
        }
    }

    public function action_setdata()
    {
        $author_name = $_POST['name'];
        $email = $_POST['email'];
        $text = $_POST['message'];

        //ширина и высота в пикселях
        $pic_weight = 320;
        $pic_height = 240;

        $data = array();

        $error = false;
        $files = array();
        $types = array('image/gif', 'image/png', 'image/jpeg');
        $uploaddir = './uploads/'; // . - текущая папка где находится submit.php

            // Создадим папку если её нет

            if (!is_dir($uploaddir)) {
                mkdir($uploaddir, 0777);
            }

            // переместим файлы из временной директории в указанную
        function imageresize($outfile, $infile, $neww, $newh, $quality)
        {
            $im = imagecreatefromjpeg($infile);
            $im1 = imagecreatetruecolor($neww, $newh);
            imagecopyresampled($im1, $im, 0, 0, 0, 0, $neww, $newh, imagesx($im), imagesy($im));

            imagejpeg($im1, $outfile, $quality);
            imagedestroy($im);
            imagedestroy($im1);
        }
        // Проверяем тип файла

    if (!in_array($_FILES['file']['type'], $types)) {
        die('Запрещённый тип файла. Файл должен быть формата jpg, jpeg, png,gif</a>');
    }
        $name = $this->resize($_FILES);

        foreach ($_FILES as $file) {
            if (move_uploaded_file($file['tmp_name'], $uploaddir.basename($file['name']))) {
                $files[] = realpath($uploaddir.$file['name']);
            } else {
                $error = true;
            }
        }

        $image = json_encode($file['name']);
        $image = str_replace('"', '', $image);

        if ($error) {
            echo 'ошибка загрузки файлов';
        } else {
            $model = new Site();
        // задаем значения для полей таблицы
            $model->author_name = $author_name; // id можно и пропустить, если для этого поля настроен авто инкремент
            $model->email = $email;
            $model->text = $text;
            $model->active = 0;
            $model->image = $image;
            $model->date = date('Y-m-d');
            if ($model->save()) {
                echo 'success';
            }
        }
    }

    public function action_preview()
    {
        $author_name = json_encode($_POST['name']);
        $email = json_encode($_POST['email']);
        $text = json_encode($_POST['message']);

        $types = array('image/gif', 'image/png', 'image/jpeg');
        $uploaddir = './uploads2/'; // . - текущая папка где находится submit.php

        // Создадим папку если её нет
        if (!in_array($_FILES['file']['type'], $types)) {
            die('Запрещённый тип файла. Файл должен быть формата jpg, jpeg, png,gif</a>');
        }
        if (!is_dir($uploaddir)) {
            mkdir($uploaddir, 0777);
        }

        $uploadfile = $uploaddir.basename($_FILES['file']['name']);

        if (move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)) {
        } else {
            echo "Возможная атака с помощью файловой загрузки!\n";
        }
        $image = $uploadfile;

        echo json_encode('
        <div class="blog-post pre">
                <h2 class="blog-post-title">Предварительный просмотр отзыва</h2>
                <p class="blog-post-meta"><span style="font-weight: bold;">Автор: '.$author_name.'</span> Email: '.$email.'</p>

                <p>'.$text.'</p>
                <p><img src="'.$image.'" alt="" width="320px" height="240px"></p>
                </div>
        ');
    }

    public function action_404()
    {
        echo 404;
    }
}
