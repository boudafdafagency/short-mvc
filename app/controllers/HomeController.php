<?php

namespace app\controllers;

use core\Controller;


class HomeController extends Controller
{
    public function index()
    {
        $view = 'home';
        $data = [
            'pageTitle' => 'Création de site web pas chers | La Casa de Com',
            'meta' => [
                'title' => "Création de site web pas chers | La Casa de Com",
                'description' => "La Casa de Com accompagne les PME et entrepreneurs dans leur stratégie digitale : création de sites web, marketing digital et communication sur mesure pour booster votre activité",
                'url' => 'https://lacasadecom.com',
                'image' => ''
            ]
        ];
        $this->render($view, $data);
    }

 
}
