<?php
/**
 * Created by PhpStorm.
 * User: santeeno
 * Date: 23.05.2016
 * Time: 14:55.
 */

namespace app\base;

class controller
{
    public $model;
    public $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action_index()
    {
    }
}
