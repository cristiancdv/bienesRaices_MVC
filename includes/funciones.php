<?php



define('TEMPLATES_URL', __DIR__ . '/templates');
define('FUNCIONES_URL', __DIR__ . 'funciones.php');
define('CARPETA_IMAGENES', $_SERVER['DOCUMENT_ROOT'] . '/imagenes/');

function incluirTemplate(string  $nombre, bool $inicio = false)
{
    include TEMPLATES_URL . "/${nombre}.php";
}

function estaAutenticado()
{
    session_start();

    // if(!$_SESSION['login']) {
    //     header('Location: /');
    // }

}
function debugear($var)
{
    echo "<pre>";
    var_dump($var);
    echo "</pre>";
    exit;
}

//escapa /sanitizar el HTML
function s($html)
{
    $s = htmlspecialchars($html);
    return $s;
}

//Validar tipo de contenido
function validarTipoContenido($tipo)
{
    $tipos = ['vendedor', 'propiedad'];

    return in_array($tipo, $tipos);
}

//mostrador de alertas

function mostrarNotificacion($codigo)
{
    $mensaje = '';
    switch ($codigo) {
        case 1:
            $mensaje = 'Creado Correctamente';
            break;
        case 2:
            $mensaje = 'Actualizado Correctamente';
            break;
        case 3:
            $mensaje = 'Eliminado Correctamente';
            break;
        default:
            $mensaje = false;
            break;
    }
    return $mensaje;
}
function validaRedirecciona(string $url)
{
    $id = $_GET['id'];
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if (!$id) {
        header("Location: ${url}");
    }
    return $id;
}
function inyectarUrlExterna()
{ //IMPORTANTE AL CORRER EN LOCAL CAMBIAR A PATH_INFO
    $url = $_SERVER['REDIRECT_URL'];

    return $url;
}
