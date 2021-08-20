<?php

namespace Model;

class Blog extends ActiveRecord
{
    protected static $tabla = 'blog';

    protected static $columnasDB = [
        'id',
        'titulo',
        'subtitulo',
        'imagen',
        'contenido',
        'creado',
        'firma'
    ];

    public $id;
    public $titulo;
    public $subtitulo;
    public $imagen;
    public $contenido;
    public $creado;
    public $firma;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->titulo = $args['titulo'] ?? '';
        $this->subtitulo = $args['subtitulo'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->contenido = $args['contenido'] ?? '';
        $this->creado = date('Y/m/d');
        $this->firma = $args['firma'] ?? '';
    }
    public function validar()
    {

        if (!$this->titulo) {
            self::$errores[] = "Debes añadir un titulo";
        }
        if (!$this->subtitulo) {
            self::$errores[] = "Debes añadir un subtitulo";
        }

        if (strlen($this->contenido) < 50) {
            self::$errores[] = 'El contenido es obligatoria y debe tener al menos 50 caracteres';
        }

        if (!$this->firma) {
            self::$errores[] = 'La firma es Obligatoria';
        }

        return self::$errores;
    }
}
