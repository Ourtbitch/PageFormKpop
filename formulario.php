<!-- procesar_formulario.php -->
<?php

$servidor = "localhost";
$usuario = "root";
$clave = "";
$basededatos = "ejemplo";

$enlace = mysqli_connect($servidor, $usuario, $clave, $basededatos);
if (!$enlace) {
    die("Conexión fallida: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['register'])) {
    // Obtener y sanitizar los datos del formulario
    $Name = mysqli_real_escape_string($enlace, $_POST['nombre'] ?? '');
    $Mail = mysqli_real_escape_string($enlace, $_POST['correo'] ?? '');
    $Age = mysqli_real_escape_string($enlace, $_POST['edad'] ?? '');
    $Type = mysqli_real_escape_string($enlace, $_POST['type'] ?? '');
    $Artist = mysqli_real_escape_string($enlace, $_POST['group-recommend'] ?? '');
    $Plataform = isset($_POST['prefer']) ? implode(", ", $_POST['prefer']) : '';
    $Text = mysqli_real_escape_string($enlace, $_POST['comments'] ?? '');

    // Consulta para insertar los datos en la tabla `dato`
    $insertardatos = "INSERT INTO dato (name, email, age, type, artist, platform, comments) VALUES ('$Name', '$Mail', '$Age', '$Type', '$Artist', '$Plataform', '$Text')";

    // Ejecutar la consulta y verificar errores
    if (mysqli_query($enlace, $insertardatos)) {
        echo "Datos insertados correctamente.";
    } else {
        echo "Error en la consulta: " . mysqli_error($enlace);
    }
}

// Cerrar la conexión
mysqli_close($enlace);

?>
