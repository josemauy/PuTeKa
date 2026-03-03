<?php

require_once __DIR__ . '/../config/database.php';

$db = new Database();
$conn = $db->getConnection();

if (!$conn) {
    die("No hay conexión");
}

$query = "SELECT u.*, r.nombre AS rol
          FROM usuario u
          INNER JOIN rol r ON u.id_rol = r.id_rol";

$stmt = $conn->prepare($query);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h2>Lista de Usuarios</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Usuario</th>
        <th>Correo</th>
        <th>Rol</th>
    </tr>

    <?php foreach ($usuarios as $u): ?>
    <tr>
        <td><?= $u['id_usuario'] ?></td>
        <td><?= $u['nombre'] ?></td>
        <td><?= $u['usuario'] ?></td>
        <td><?= $u['correo'] ?></td>
        <td><?= $u['rol'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>