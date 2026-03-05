<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Usuarios - PuTeKa</title>
</head>
<body>

<h2>Registrar Usuario</h2>

<form action="../backend/models/Usuario.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Email" required>

    <select name="id_rol">
        <option value="1">Administrador</option>
        <option value="2">Empleado</option>
    </select>

    <button type="submit">Guardar</button>
</form>

<hr>

<h2>Usuarios</h2>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
        </tr>
    </thead>
    <tbody>

<?php

require_once("../backend/config/database.php");

$database = new Database();
$conn = $database->getConnection();

$query = "SELECT usuarios.id, usuarios.nombre, usuarios.email, roles.nombre AS rol
          FROM usuarios
          INNER JOIN roles ON usuarios.rol_id = roles.id";

$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['nombre']."</td>";
    echo "<td>".$row['email']."</td>";
    echo "<td>".$row['rol']."</td>";
    echo "</tr>";

}

?>

    </tbody>
</table>

<br>
<a href="index.html">⬅ Volver al inicio</a>

</body>
</html>