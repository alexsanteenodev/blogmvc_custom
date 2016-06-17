<?php
/**
 * Created by PhpStorm.
 * User: santeeno
 * Date: 24.05.2016
 * Time: 15:25.
 */

namespace app\controllers;

use app\base\Controller;
use app\base\View;
use app\models\Admin;
use app\models\Site;
use app\Session;

class AdminController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        //$this->model = new Site();

        $this->view = new View();
    }
    public function action_index()
    {
        Session::init();
        $logged = Session::get('loggedIn');
        if ($logged == false) {
            Session::destroy();
            parent::action_index();

            $select = array(
            'where' => 'id >= 1', // условие

        );
            $model = new Admin($select, 1); // создаем объект модели
        $data = $model->getAllRows(); // получаем все строки

        $this->view->generate('login.php', $data);
        } else {
            header('Location: admin/dashboard');
        }
    }

    public function action_login()
    {
        if (!empty($_POST['name']) && !empty($_POST['password'])) {
            $name = $_POST['name'];
            $password = $_POST['password'];

            $select = array(
           );
            $model = new Admin($select, 1); // создаем объект модели
           $data = $model->getRowById(1); // получаем все строки
           if ($data['name'] == $name && $data['password'] == $password) {
               Session::init();
               Session::set('loggedIn', true);
               echo 1;
           } else {
               echo 'Неправильный логин или пароль';
           }
        }
    }

    public function action_logout()
    {
        Session::init();
        Session::set('loggedIn', false);
        header('Location: /admin');
        exit();
    }

    public function action_dashboard()
    {
        Session::init();
        $logged = Session::get('loggedIn');
        if ($logged == false) {
            Session::destroy();
            header('Location: /admin');
            exit();
        } else {
            $select = array(
                'where' => 'id >= 1', // условие

            );

            $model = new Site($select); // создаем объект модели
            $data = $model->getAllRows();
            $this->view->generate('dashboard.php', $data);
        }
    }

    public function action_active()
    {
        if (isset($_POST['value'])) {
            $id = $_POST['value'];
            $select = array(
                'where' => 'id = '.$id,
            );
            $model = new Site($select);
            $model->fetchOne();
            $model->active = 1;
            if ($result = $model->update()) {
                echo 1;
            }
        }
    }

    public function action_change()
    {
        if (isset($_POST['text'])) {
            $id = $_POST['id'];
            $text = $_POST['text'];
            $select = array(
                'where' => 'id = '.$id,
            );
            $model = new Site($select);
            $model->fetchOne();
            $model->text = $text;
            $model->ed = 1;
            if ($result = $model->update()) {
                echo 1;
            }
        }
    }
}
