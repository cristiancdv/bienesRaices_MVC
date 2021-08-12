<?php

namespace Model;

class Vendedor extends ActiveRecord
{
    protected static $tabla = 'vendedores';

    protected static $columnasDB = [
        'id',
        'nombre',
        'apellido',
        'telefono',
        'imagen'
    ];

    public $id;
    public $nombre;
    public $apellido;
    public $imagen;
    public $telefono;


    public function __construct($args = [])
    {
        $this->id = $args['id'] ?? null;
        $this->nombre = $args['nombre'] ?? '';
        $this->apellido = $args['apellido'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
    }

    public function validar()
    {



        if (!$this->nombre) {
            self::$errores[] = "Debes añadir un Nombre";
        }

        if (!$this->apellido) {
            self::$errores[] = "Debes añadir un Apellido";
        }

        if (!preg_match('/[0-9]{10}/', $this->telefono)) {
            self::$errores[] = 'Formato no valido';
        }

        if (!$this->imagen) {
            self::$errores[] = 'La Foto es Obligatoria';
        }




        return self::$errores;
    }
}
