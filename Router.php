<?php

namespace MVC;

class Router
{
    public $rutasGET = [];
    public $rutasPOST = [];

    public function get($url, $fn)
    {
        $this->rutasGET[$url] = $fn;
    }
    public function post($url, $fn)
    {
        $this->rutasPOST[$url] = $fn;
    }


    public function comprobarRutas()
    {
        session_start();
        $auth = $_SESSION['login'] ?? null;

        //arreglos de rutas protegidas
        $rutas_protegidas =
            [
                '/admin',

                '/propiedades/crear',
                '/propiedades/actualizar',
                '/propiedades/eliminar',

                '/vendedores/crear',
                '/vendedores/actualizar',
                '/vendedores/eliminar'
            ];

        $urlActual = $_SERVER['PATH_INFO'] ?? '/';
        $metodo = $_SERVER['REQUEST_METHOD'];

        if ($metodo === 'GET') {
            $fn = $this->rutasGET[$urlActual] ?? null;
        } else {
            $fn = $this->rutasPOST[$urlActual] ?? null;
        }

        //proteger las rutas
        if (in_array($urlActual, $rutas_protegidas) && !$auth) {
            header('Location: /');
        }

        if ($fn) {
            //existe URL y tiene una funcion
            call_user_func($fn, $this);
        } else {
            echo 'Error 404';
        }
    }

    //muestra la vista
    public function render($view, $datos = [])
    {
        foreach ($datos as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include __DIR__  . "/views/$view.php";

        $contenido = ob_get_clean();

        include __DIR__ . "/views/layout.php";
    }
}
