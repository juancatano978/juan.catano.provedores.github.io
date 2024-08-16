<?php
$host = 'mysql.railway.internal'; // Dirección del servidor en la nube (puede ser IP o dominio)
$dbname = 'railway'; // Nombre de tu base de datos
$username = 'root'; // Usuario de la base de datos
$password = 'FpEWTHfbYoCYDLWtMPkJPJDylunYnTxF'; // Contraseña del usuario

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Error de conexión: " . $e->getMessage();
}
?>
