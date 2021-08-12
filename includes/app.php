<?php
require __DIR__ . '/funciones.php';
require __DIR__ . '/config/database.php';
require __DIR__ . '/../vendor/autoload.php';

$db = conectarDB();

use Model\ActiveRecord;

ActiveRecord::setDB($db);


//  var_dump($propiedad);
