<?php 

function conectarDB() {
    $db = new mysqli('localhost', 'root', 'root', 'bienes-raices');

    if(!$db) {
        echo "Error no se pudo conectar";
        exit;
    } 

    return $db;
    
}