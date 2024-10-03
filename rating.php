<?php
// Conexión a la base de datos
$servername = "localhost"; // Cambia según tu servidor
$username = "root";        // Tu usuario de base de datos
$password = "";            // Tu contraseña de base de datos
$dbname = "ratings_db";    // Nombre de tu base de datos

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Verificar si la calificación fue enviada
if (isset($_POST['rating'])) {
    $rating = intval($_POST['rating']); // Obtener y sanitizar la calificación

    // Preparar la consulta para insertar la calificación en la base de datos
    $stmt = $conn->prepare("INSERT INTO ratings (rating) VALUES (?)");
    $stmt->bind_param("i", $rating);

    // Ejecutar la consulta
    if ($stmt->execute()) {
        echo "¡Gracias por tu calificación de " . $rating . " estrellas!";
    } else {
        echo "Error al guardar la calificación.";
    }

    $stmt->close();
} else {
    echo "No se recibió ninguna calificación.";
}

$conn->close();
?>