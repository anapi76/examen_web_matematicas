<?php
declare(strict_types=1);

namespace app\controllers;

use app\Core\AbstractController;

class MainController extends AbstractController
{

    public function main():void{
        
        //Ahora usamos el método extendido del AbstractController render para lanzar la plantilla de twig
        // con los parámetros necesarios.
        $this->render("index.html.twig",[
            'title'=> 'Matemáticas'
        ]);
    }
}