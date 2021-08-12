<?php

namespace Controllers;

use MVC\Router;
use Model\Vendedor;
use Intervention\Image\ImageManagerStatic as Image;

class VendedoresController
{
    public static function crear(Router $router)
    {
        $vendedor = new Vendedor;
        $errores = Vendedor::getErrores();

        // Ejecutar el código después de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //crea nueva instancia
            $vendedor = new Vendedor($_POST['vendedor']);


            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            // Setea imagen
            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800, 600);
                $vendedor->setImagen($nombreImagen);
            }

            //validar
            $errores = $vendedor->validar();


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
                $vendedor->guardar();
            }
        }

        $router->render('vendedores/crear', [
            'vendedor' => $vendedor,
            'errores' => $errores

        ]);
    }
    public static function actualizar(Router $router)
    {
        $id = validaRedirecciona('/admin');

        $vendedor = Vendedor::find($id);
        $errores = Vendedor::getErrores();

        // Ejecutar el código después de que el usuario envia el formulario
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //asignar atrr
            $args = $_POST['vendedor'];


            $vendedor->sincronizar($args);
            //validacion
            $errores = $vendedor->validar();

            // Generar un nombre único
            $nombreImagen = md5(uniqid(rand(), true)) . ".jpg";
            //setea img
            if ($_FILES['vendedor']['tmp_name']['imagen']) {
                $image = Image::make($_FILES['vendedor']['tmp_name']['imagen'])->fit(800, 600);
                $vendedor->setImagen($nombreImagen);
            }

            if (empty($errores)) {
                // Almacenar la imagen
                if ($_FILES['vendedor']['tmp_name']['imagen']) {
                    $image->save(CARPETA_IMAGENES . $nombreImagen);
                }
                $vendedor->guardar();
            }
        }


        $router->render('vendedores/actualizar', [
            'vendedor' => $vendedor,
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

                $vendedor = Vendedor::find($id);

                $vendedor->eliminar();
            }
        }
    }
}
