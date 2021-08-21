<?php

namespace MVC;

class Router
{

    private $basepath;
    private $uri;
    private $base_url;
    private $routes;
    private $route;
    private $params;
    private $get_params;

    function __construct($get_params = false)
    {
        $this->get_params = $get_params;
    }

    public function getRoutes()
    {
        $this->base_url = $this->getCurrentUri();
        $this->routes = explode('/', $this->base_url);

        $this->getParams(); //invocamos el neuvo método
        return $this->routes;
    }

    private function getCurrentUri()
    {
        $this->basepath = implode('/', array_slice(explode('/', $_SERVER['SCRIPT_NAME']), 0, -1)) . '/';
        $this->uri = substr($_SERVER['REQUEST_URI'], strlen($this->basepath));

        if ($this->get_params) {
            $this->getParams();
        } else {
            if (strstr($this->uri, '?')) $this->uri = substr($this->uri, 0, strpos($this->uri, '?'));
        }

        $this->uri = '/' . trim($this->uri, '/');
        return $this->uri;
    }

    public function getParams()
    {
        if (strstr($this->uri, '?')) {
            $params = explode("?", $this->uri);
            $params = $params[1];

            parse_str($params, $this->params);
            $this->routes[0] = $this->params;
            array_pop($this->routes);
        }
    }

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
            // echo ('proteger rutas XD');
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
