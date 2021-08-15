<?php

function conectarDB()
{
    // $db = new mysqli('localhost', 'root', 'root', 'bienes-raices');

    $db = new mysqli('ro2padgkirvcf55m.cbetxkdyhwsb.us-east-1.rds.amazonaws.com', 'gt613zotzimgzrnb', 'f4825uruv6kqb5j3', 'v0cbex6a79dunokf');
    if (!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}
