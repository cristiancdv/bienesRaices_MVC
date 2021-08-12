<?php

namespace Controllers;

use MVC\Router;
use Model\Propiedad;
use Model\Vendedor;
use Model\Blog;
use PHPMailer\PHPMailer\PHPMailer;

class PaginasController
{
    public static function index(Router $router)
    {
        $propiedades = Propiedad::get(3);
        $blogs = Blog::get(2);
        $incio = true;

        $router->render('paginas/index', [
            'propiedades' => $propiedades,
            'blogs' => $blogs,
            'inicio' => $incio
        ]);
    }
    public static function nosotros(Router $router)
    {
        $router->render('paginas/nosotros', []);
    }
    public static function propiedades(Router $router)
    {
        $propiedades = Propiedad::get(10);
        $router->render('paginas/propiedades', [
            'propiedades' => $propiedades

        ]);
    }
    public static function propiedad(Router $router)
    {
        $id = validaRedirecciona('/');
        $propiedad = Propiedad::find($id);

        $router->render('paginas/propiedad', [
            'propiedad' => $propiedad

        ]);
    }

    public static function contacto(Router $router)
    {
        $mensajeError = null;
        $mensajeExito = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $respuestas = $_POST['contacto'];



            //crea instancia de mail
            $mail = new PHPMailer();
            //Server settings
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'smtp.mailtrap.io';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = '81a524379e7e5f';                     //SMTP username
            $mail->Password   = 'a7257e4b37d364';                               //SMTP password
            $mail->SMTPSecure = 'tls';            //Enable implicit TLS encryption
            $mail->Port       = 2525;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            //configurar contenido de email
            $mail->setFrom('admin@bienesraices.com');
            $mail->addAddress('admin@bienesraices.com', 'bienesRaices.com');     //Add a recipient
            $mail->Subject = 'Tienes un Nuevo Mensaje';

            //habilita HTML
            $mail->isHTML(true);
            $mail->CharSet = 'UTF-8';

            //contenido mail
            $contenido =  '<html>';
            $contenido .= '<p>Tienes un nuevo mensaje</p>';
            $contenido .= '<p>Nombre: ' . $respuestas['nombre']  . ' </p>';

            //enviar de forma condicional algunos campos de mail o telefono
            if ($respuestas['contacto'] === 'telefono') {
                $contenido .= '<p>Eligio ser contactado por Telefono</p>';
                $contenido .= '<p>Telefono: ' . $respuestas['telefono']  . ' </p>';
                $contenido .= '<p>Fecha y Hora de contacto: ' . $respuestas['fecha'] . ' ' . $respuestas['hora']  . ' </p>';
            } else {
                $contenido .= '<p>Eligio ser contactado por Email</p>';
                $contenido .= '<p>Email: ' . $respuestas['email']  . ' </p>';
            }

            $contenido .= '<p>Mensaje: ' . $respuestas['mensaje']  . ' </p>';
            $contenido .= '<p>Vende/Compra: ' . $respuestas['tipo']  . ' </p>';
            $contenido .= '<p>Presupuesto/Precio: $' . $respuestas['precio']  . ' </p>';
            $contenido .= '<p>Preferencia de contacto: ' . $respuestas['contacto']  . ' </p>';

            $contenido .= ' </html>';

            $mail->Body = $contenido;
            $mail->AltBody = 'esto es un mail sin HMTL';

            //enviar email
            if ($mail->send()) {
                $mensajeExito = "Mensaje Enviado Correctamente";
            } else {
                $mensajeError = "falla en el envio del Mensaje";
            }
        }

        $router->render('paginas/contacto', [
            'mensajeExito' => $mensajeExito,
            'mensajeError' => $mensajeError
        ]);
    }
}
