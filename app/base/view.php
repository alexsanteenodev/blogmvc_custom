<?php
/**
 * Created by PhpStorm.
 * User: santeeno
 * Date: 23.05.2016
 * Time: 14:56.
 */

namespace app\base;

class view
{
    //public $template_view; // здесь можно указать общий вид по умолчанию.

    public function generate($content, $data = null)
    {
        if (is_array($data)) {
            extract($data);
        }

        include 'app/views/header.php';
        include 'app/views/'.$content;
        include 'app/views/footer.php';
    }
}
