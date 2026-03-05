<?php

require_once("../config/database.php");

$database = new Database();
$conn = $database->getConnection();

$nombre = $_POST['nombre'];

$query = "INSERT INTO categorias (nombre) VALUES (:nombre)";

$stmt = $conn->prepare($query);
$stmt->bindParam(":nombre", $nombre);

if($stmt->execute()){
    header("Location: ../../frontend/categorias.php");
}else{
    echo "Error al guardar categoría";
}

?>