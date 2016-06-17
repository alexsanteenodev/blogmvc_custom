<?php
/**
 * Created by PhpStorm.
 * User: santeeno
 * Date: 24.05.2016
 * Time: 15:29.
 */

namespace app\models;

use app\base\Model;

class Admin extends Model
{
    public $id;
    public $name;
    public $password;

    public function fieldsTable()
    {
        return array(
            'id' => 'Id',
            'name' => 'Имя',
            'password' => 'Пароль',
        );
    }
}
