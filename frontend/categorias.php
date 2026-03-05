<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Categorías - PuTeKa</title>
</head>
<body>

<h2>Registrar Categoría</h2>

<form action="../backend/models/Categoria.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre de la categoría" required>
    <button type="submit">Guardar</button>
</form>

<hr>

<h2>Categorías</h2>

<table border="1">
<thead>
<tr>
<th>ID</th>
<th>Nombre</th>
</tr>
</thead>

<tbody>

<?php

require_once("../backend/config/database.php");

$database = new Database();
$conn = $database->getConnection();

$query = "SELECT id, nombre FROM categorias";

$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['nombre']."</td>";
    echo "</tr>";

}

?>

</tbody>
</table>

<br>
<a href="index.html">⬅ Volver al inicio</a>

</body>
</html>