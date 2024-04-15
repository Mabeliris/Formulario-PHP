<?php

// Parámetros de conexión
$host = "localhost";
$port = "5432";
$dbname = "formulario_votacion";
$user = "root";
$password = "root";


$bdconection= pg_connect("host=localhost port=5432 dbname=formulario_votacion");

if(!$bdconection){
    die("Error al conectar a la base de datos");
};


?>