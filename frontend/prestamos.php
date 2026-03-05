<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Préstamos - PuTeKa</title>
</head>
<body>

<h2>Registrar Préstamo</h2>

<form action="../backend/models/Prestamo.php" method="POST">

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

<label>Usuario:</label>
<select name="usuario_id">

<?php

$query = "SELECT id, nombre FROM usuarios";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
}

?>

</select>

<label>Fecha Préstamo:</label>
<input type="date" name="fecha_prestamo" required>

<label>Fecha Devolución:</label>
<input type="date" name="fecha_devolucion" required>

<button type="submit">Registrar</button>

</form>

<hr>

<h2>Préstamos</h2>

<table border="1">
<thead>
<tr>
<th>ID</th>
<th>Libro</th>
<th>Usuario</th>
<th>Fecha Préstamo</th>
<th>Fecha Devolución</th>
</tr>
</thead>

<tbody>

<?php

$query = "SELECT prestamos.id,
                 libros.titulo AS libro,
                 usuarios.nombre AS usuario,
                 prestamos.fecha_prestamo,
                 prestamos.fecha_devolucion
          FROM prestamos
          INNER JOIN libros ON prestamos.libro_id = libros.id
          INNER JOIN usuarios ON prestamos.usuario_id = usuarios.id";

$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

echo "<tr>";
echo "<td>".$row['id']."</td>";
echo "<td>".$row['libro']."</td>";
echo "<td>".$row['usuario']."</td>";
echo "<td>".$row['fecha_prestamo']."</td>";
echo "<td>".$row['fecha_devolucion']."</td>";
echo "</tr>";

}

?>

</tbody>
</table>

<br>
<a href="index.html">⬅ Volver al inicio</a>

</body>
</html>