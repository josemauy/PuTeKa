<?php

require_once("../config/database.php");

$database = new Database();
$conn = $database->getConnection();

$libro_id = $_POST['libro_id'];
$cantidad = $_POST['cantidad'];

$query = "INSERT INTO stock (libro_id, cantidad) VALUES (:libro_id, :cantidad)";

$stmt = $conn->prepare($query);

$stmt->bindParam(":libro_id", $libro_id);
$stmt->bindParam(":cantidad", $cantidad);

if($stmt->execute()){
    header("Location: ../../frontend/stock.php");
}else{
    echo "Error al guardar";
}

?>