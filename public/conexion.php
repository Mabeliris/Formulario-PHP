<?php
 function conection(){
    // Parámetros de conexión
    $host = "localhost";
    $port = "5432";
    $dbname = "formulario_votacion";
    $user = "postgres";
    $password = "root";
    $bdconection= pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");
    return $bdconection;

 }

 function closeConection($bdconection){
    $close= pg_close($bdconection);
    return $close;

 }

?>