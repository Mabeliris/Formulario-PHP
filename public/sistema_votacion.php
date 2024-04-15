<?php

// Incluir archivo de conexión
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST["name"])) {
        // Obtener datos del formulario
        $name = $_POST["name"];
        $alias = $_POST["alias"];
        $rut = $_POST["rut"];
        $email = $_POST["email"];
        $region = $_POST["region"];
        $comuna = $_POST["comuna"];
        $candidate = $_POST["candidate"];
        $checkboxGroup = $_POST["checkboxGroup"];
    } else {
        echo "Error: El campo 'name' no se ha enviado";
    }
} else {
    echo "Error: Esta página solo acepta solicitudes POST.";
}


if ($rut === "" || $email === "") {
    echo json_encode("Llena los campos");
} else {
    echo json_encode("Correcto: <br>Rut:" . $rut . "<br>Email:" . $email);
}

?>

