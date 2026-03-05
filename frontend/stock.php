<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Stock - PuTeKa</title>
</head>
<body>

<h2>Registrar Stock</h2>

<form action="../backend/models/Stock.php" method="POST">

<label>Libro:</label>
<select name="libro_id">

<?php
require_once("../backend/config/database.php");

$database = new Database();
$conn = $database->getConnection();

$query = "SELECT id, titulo FROM libros";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    echo "<option value='".$row['id']."'>".$row['titulo']."</option>";

}
?>

</select>

<input type="number" name="cantidad" placeholder="Cantidad" required>

<button type="submit">Guardar</button>

</form>

<hr>

<h2>Stock de Libros</h2>

<table border="1">
<thead>
<tr>
<th>ID</th>
<th>Libro</th>
<th>Cantidad Disponible</th>
</tr>
</thead>

<tbody>

<?php

$query = "SELECT libros.id, libros.titulo, stock.cantidad
          FROM stock
          INNER JOIN libros ON stock.libro_id = libros.id";

$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

echo "<tr>";
echo "<td>".$row['id']."</td>";
echo "<td>".$row['titulo']."</td>";
echo "<td>".$row['cantidad']."</td>";
echo "</tr>";

}

?>

</tbody>
</table>

<br>
<a href="index.html">⬅ Volver al inicio</a>

</body>
</html>