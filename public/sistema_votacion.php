<?php
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    // Respondemos a la solicitud OPTIONS con los encabezados CORS permitidos
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: POST, OPTIONS');
    header('Access-Control-Allow-Headers: Content-Type');
    header('Access-Control-Max-Age: 86400'); // Cache preflight request for 1 day
    header("HTTP/1.1 200 OK");
    exit();
}

//Código para manejar las solicitudes POST

$method = $_SERVER['REQUEST_METHOD'];
if ($method == "POST") {
    // Incluir archivo de conexión
    include("conexion.php");
    $ClassConexion = conection();

    // Obtener datos del formulario y sanitizarlos
    $data = json_decode(file_get_contents('php://input'), true);

    $name = pg_escape_string($ClassConexion, $data["name"]);
    $alias = pg_escape_string($ClassConexion, $data["alias"]);
    $rut = pg_escape_string($ClassConexion, $data["rut"]);
    $email = pg_escape_string($ClassConexion, $data["email"]);
    $region = pg_escape_string($ClassConexion, $data["region"]);
    $comuna = pg_escape_string($ClassConexion, $data["comuna"]);
    $candidate = pg_escape_string($ClassConexion, $data["candidate"]);
    $checkboxGroup = pg_escape_string($ClassConexion, $data["information"]);

    // Verificar los valores de las variables
    echo "Nombre: " . $name . "<br>";
    echo "Alias: " . $alias . "<br>";
    echo "RUT: " . $rut . "<br>";
    echo "Email: " . $email . "<br>";
    echo "Region: " . $region . "<br>";
    echo "Comuna: " . $comuna . "<br>";
    echo "Candidato: " . $candidate . "<br>";
    echo "Información: " . $checkboxGroup . "<br>";

    // Crear la consulta SQL con datos sanitizados
   // $query = "INSERT INTO votaciones (nombre_apellido, alias, rut, email, region, comuna, candidato, informacion) 
    //          VALUES ('$name', '$alias', '$rut', '$email', '$region', '$comuna', '$candidate', '$checkboxGroup')";
    $query = "INSERT INTO votaciones (nombre_apellido, alias, rut, email, region, comuna, candidato, informacion) 
              VALUES ($1, $2, $3, $4, $5, $6, $7, $8)";
    // Prepare a query for execution
    $result = pg_prepare($dbconn, "my_query", $query);

    // Execute the prepared query.  Note that it is not necessary to escape
    // the string "Joe's Widgets" in any way
    $result = pg_execute($dbconn, "my_query", array($name, $alias, $rut, $email, $region, $comuna, $candidate, $checkboxGroup));
    // Ejecutar la consulta y verificar el resultado
    //$result = pg_query($ClassConexion, $query);
    $response = array(); // array para la respuesta

    if ($result) {
        $response['success'] = true;
        $response['message'] = "Tu voto fue enviado correctamente.";
    } else {
        $response['success'] = false;
        $response['message'] = "Error al enviar el voto. Por favor, inténtalo de nuevo más tarde.";
    }

    // Cerrar la conexión
    pg_close($ClassConexion);

    // Devolver la respuesta como JSON
    header('Content-Type: application/json');
    echo json_encode($response);
} else {
    // Método no permitido
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(array("error" => "Método no permitido"));
}
?>



