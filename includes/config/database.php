<?php

function conectarDB()
{
    // $db = new mysqli('localhost', 'root', 'root', 'bienes-raices');

    $db = new mysqli('l6glqt8gsx37y4hs.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'gkialma2i7re6zg3', 'n3qpkk48yzs34pjl', 'tpi2r3rzw1ahyldo', 3306);
    if (!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}
