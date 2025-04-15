<?php

namespace app\controllers;

use core\Controller;

class NotFoundController extends Controller
{
    public function index()
    {
        $view = 'notfound';
         $data = [
           'pageTitle' => 'loream',
            'meta' => [
              'title' => "loream",
              'description' => "loream",
               'url' => 'https://www.lacasadecom.com/blogs',
              'image' => 'assets/images/'
          ]
        ];
        $this->render($view, $data);
    }
}
