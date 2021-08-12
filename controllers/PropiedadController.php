<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class PropiedadController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::all();
        $vendedores = Vendedor::all();
        $resultado = $_GET['resultado'] ?? null;

        $router->render('/propiedades/admin', [
            'propiedades' => $propiedades,
            'vendedores' => $vendedores,
            'resultado' => $resultado
        ]);
    }
    public static function crear(Router $router)
    {
        $propiedad = new Propiedad;
        $vendedores = Vendedor::all();

        $errores = Propiedad::getErrores();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //crea nueva instancia
            $propiedad = new Propiedad($_POST['propiedad']);


            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            // Setea imagen
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            //validar
            $errores = $propiedad->validar();


            if (empty($errores)) {

                /** SUBIDA DE ARCHIVOS */

                //crea carpeta img
                if (!is_dir(CARPETA_IMAGENES)) {
                    mkdir(CARPETA_IMAGENES);
                }

                // Asignar files hacia una variable
                // $imagen = $_FILES['imagen'];


                //guardar img en servidor
                $image->save(CARPETA_IMAGENES . $nombreImagen);

                //guarda en la BD
                $propiedad->guardar();
            }
        }

        $router->render('/propiedades/crear', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function actualizar(Router $router)
    {
        $id = validaRedirecciona('/admin');

        $propiedad = Propiedad::find($id);
        $vendedores = Vendedor::all();
        $errores = Propiedad::getErrores();



        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //asignar atrr
            $args = $_POST['propiedad'];


            $propiedad->sincronizar($args);
            //validacion
            $errores = $propiedad->validar();


            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //setea img
            if ($_FILES['propiedad']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['propiedad']['tmp_name']['imagen'])->fit(800, 600);
                $propiedad->setImagen($nombreImagen);
            }

            if (empty($errores)) {
                // Almacenar la imagen
                if ($_FILES['propiedad']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $propiedad->guardar();
            }
        }
        $router->render('/propiedades/actualizar', [
            'propiedad' => $propiedad,
            'vendedores' => $vendedores,
            'errores' => $errores
        ]);
    }
    public static function eliminar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = $_POST['id'];
            $id = filter_var($id, FILTER_VALIDATE_INT);

            $tipo = $_POST['tipo'];
            if (validarTipoContenido($tipo)) {

                $propiedad = Propiedad::find($id);

                $propiedad->eliminar();
            }
        }
    }
}
