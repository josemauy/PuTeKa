<?php

require_once("../config/database.php");

$database = new Database();
$conn = $database->getConnection();

$titulo = $_POST['titulo'];
$autor = $_POST['autor_id'];
$categoria_id = $_POST['categoria_id'];

$query = "INSERT INTO libros (titulo, autor_id, categoria_id)
          VALUES (:titulo, :autor_id, :categoria_id)";

$stmt = $conn->prepare($query);

$stmt->bindParam(":titulo", $titulo);
$stmt->bindParam(":autor_id", $autor);
$stmt->bindParam(":categoria_id", $categoria_id);

$stmt->execute();

header("Location: ../../frontend/libros.php");
exit();

?>