<?php

namespace Model;

class ActiveRecord
{
    //BD
    protected static $db;
    protected static $columnasDB = [];
    protected static $tabla = '';

    //errores
    protected static $errores = [];



    //set conexion
    public static function setDB($database)
    {
        self::$db = $database;
    }



    public function guardar()
    {
        if (!is_null($this->id)) {
            //actualizar
            $this->actualizar();
        } else {
            //crea un registro
            $this->crear();
        }
    }

    public function crear()
    {
        //sanitizar datos
        $atributos = $this->sanitizarAtributos();

        $string = join(', ', array_keys($atributos));

        //inserta datos
        $query = " INSERT INTO  " . static::$tabla . "( ";
        $query .= join(', ', array_keys($atributos));
        $query .= " ) VALUES (  '";
        $query .= join("', '", array_values($atributos));
        $query .= "'  ) ";




        $resultado = self::$db->query($query);
        //mensaje de exito o error
        if ($resultado) {
            // Redireccionar al usuario.
            header('Location: /admin?resultado=1');
        }
    }

    public function actualizar()
    {
        //sanitizar datos
        $atributos = $this->sanitizarAtributos();

        $valores = [];
        foreach ($atributos as $key => $value) {
            $valores[] = "{$key}='{$value}'";
        }
        $query = "UPDATE  " . static::$tabla . " SET ";
        $query .= join(', ', $valores);
        $query .= "WHERE id = '" . self::$db->escape_string($this->id) . "' ";
        $query .= "LIMIT 1 ";



        $resultado = self::$db->query($query);

        if ($resultado) {
            // Redireccionar al usuario.
            header('Location: /admin?resultado=2');
        }
    }
    public function eliminar()
    {
        // Eliminar el registro
        $query = "DELETE FROM  " . static::$tabla . " WHERE id = " . self::$db->escape_string($this->id) . " LIMIT 1";
        $resultado = self::$db->query($query);

        if ($resultado) {
            $this->borrarimagen();
            header('location: /admin?resultado=3');
        }
    }
    //identifica y une los atr de la BD
    public function atributos()
    {
        $atributos = [];
        foreach (static::$columnasDB as $columna) {
            if ($columna === 'id') continue;
            $atributos[$columna] = $this->$columna;
        }
        return $atributos;
    }

    public function sanitizarAtributos()
    {
        $atributos = $this->atributos();
        $sanitizado = [];
        foreach ($atributos as $key => $value) {
            $sanitizado[$key] = self::$db->escape_string($value);
        }

        return $sanitizado;
    }
    //Subida de archivo
    public function setImagen($imagen)
    {
        //elimina img si existe
        if (!is_null($this->id)) {
            $this->borrarimagen();
        }

        //asignar atrib al nombre imagen
        if ($imagen) {
            $this->imagen = $imagen;
        }
    }
    //ELimina archivo
    public function borrarimagen()
    {

        $existeArchivo = file_exists(CARPETA_IMAGENES . $this->imagen);
        if ($existeArchivo) {
            unlink(CARPETA_IMAGENES . $this->imagen);
        }
    }

    //validar
    public static function getErrores()
    {
        return static::$errores;
    }

    public function validar()
    {
        static $errores = [];
        return static::$errores;
    }

    //lista registro
    public static function all()
    {
        $query = "SELECT * FROM  " . static::$tabla;

        $resultado = self::consultarSQL($query);

        return $resultado;
    }
    // pide registro especifico
    public static function get($cantidad)
    {
        $query = "SELECT * FROM  " . static::$tabla . " LIMIT " . $cantidad;


        $resultado = self::consultarSQL($query);

        return $resultado;
    }
    //busca 1 registro x su id
    public static function find($id)
    {
        $query = "SELECT * FROM  " . static::$tabla . " WHERE id = ${id}";

        $resultado = self::consultarSQL($query);

        return array_shift($resultado);
    }

    public static function consultarSQL($query)
    {
        //consultar DB
        $resultado = self::$db->query($query);

        //iterar
        $array = [];
        while ($registro = $resultado->fetch_assoc()) {
            $array[] = static::crearObjeto($registro);
        }

        //liberar mem
        $resultado->free();

        //retornar valor
        return $array;
    }

    protected static function crearObjeto($registro)
    {
        $objeto = new static;

        foreach ($registro as $key => $value) {
            if (property_exists($objeto, $key)) {
                $objeto->$key = $value;
            }
        }
        return $objeto;
    }
    //sincro el obj en memoria con los cambios echos del user
    public function sincronizar($args = [])
    {
        foreach ($args as $key => $value) {
            if (property_exists($this, $key) && !is_null($value)) {
                $this->$key = $value;
            }
        }
    }
}
