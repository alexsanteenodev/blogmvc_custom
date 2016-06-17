<?php
/**
 * Created by PhpStorm.
 * User: santeeno
 * Date: 23.05.2016
 * Time: 15:19.
 */

namespace app\models;

use app\base\Model;

class Site extends Model
{
    public $id;
    public $author_name;
    public $email;
    public $text;
    public $active;
    public $image;
    public $date;
    public $ed;

    public function fieldsTable()
    {
        return array(
            'id' => 'Id',
            'author_name' => 'Имя автора',
            'email' => 'email',
            'text' => 'text',
            'active' => 'active',
            'image' => 'image',
            'date' => 'дата',
            'ed' => 'изменен',
        );
    }
}
