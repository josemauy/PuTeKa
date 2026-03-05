<?php

require_once("../config/database.php");

$database = new Database();
$conn = $database->getConnection();

$libro_id = $_POST['libro_id'];
$usuario_id = $_POST['usuario_id'];
$fecha_prestamo = $_POST['fecha_prestamo'];
$fecha_devolucion = $_POST['fecha_devolucion'];

$query = "INSERT INTO prestamos (libro_id, usuario_id, fecha_prestamo, fecha_devolucion)
          VALUES (:libro_id, :usuario_id, :fecha_prestamo, :fecha_devolucion)";

$stmt = $conn->prepare($query);

$stmt->bindParam(":libro_id", $libro_id);
$stmt->bindParam(":usuario_id", $usuario_id);
$stmt->bindParam(":fecha_prestamo", $fecha_prestamo);
$stmt->bindParam(":fecha_devolucion", $fecha_devolucion);

if($stmt->execute()){
    header("Location: ../../frontend/prestamos.php");
}else{
    echo "Error al registrar préstamo";
}

?>