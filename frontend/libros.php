<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Libros - PuTeKa</title>
</head>
<body>

<h2>Agregar Libro</h2>

<form action="../backend/models/Libro.php" method="POST">
    <input type="text" name="titulo" placeholder="Título" required>

    <select name="autor_id" required>
        <option value="1">Autor 1</option>
        <option value="2">Autor 2</option>
    </select>

    <select name="categoria_id" required>
        <option value="1">Categoría 1</option>
        <option value="2">Categoría 2</option>
    </select>

    <button type="submit">Guardar</button>
</form>

<hr>

<h2>Libros</h2>

<table border="1">
<thead>
<tr>
<th>ID</th>
<th>Título</th>
<th>Autor ID</th>
<th>Categoría ID</th>
</tr>
</thead>
<tbody>

<?php

require_once("../backend/config/database.php");

$database = new Database();
$conn = $database->getConnection();

$query = "SELECT * FROM libros";

$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['titulo']."</td>";
    echo "<td>".$row['autor_id']."</td>";
    echo "<td>".$row['categoria_id']."</td>";
    echo "</tr>";

}

?>

</tbody>
</table>

<br>
<a href="index.html">⬅ Volver al inicio</a>

</body>
</html>