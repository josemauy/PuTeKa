<?php

require_once __DIR__ . '/../config/database.php';

$db = new Database();
$conn = $db->getConnection();

if (!$conn) {
    die("No hay conexión");
}

/* ===== INSERTAR ===== */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_POST["nombre"];
    $email  = $_POST["email"];
    $rol_id = $_POST["rol_id"];

    $queryInsert = "INSERT INTO usuarios (nombre, email, rol_id)
                    VALUES (?, ?, ?)";

    $stmtInsert = $conn->prepare($queryInsert);
    $stmtInsert->execute([$nombre, $email, $rol_id]);

    header("Location: Usuario.php");
    exit;
}

/* ===== OBTENER ===== */
$query = "SELECT u.id, u.nombre, u.email, r.nombre AS rol
          FROM usuarios u
          INNER JOIN roles r ON u.rol_id = r.id";

$stmt = $conn->prepare($query);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h2>Registrar Usuario</h2>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Email" required>

    <select name="rol_id" required>
        <option value="1">Administrador</option>
        <option value="2">Empleado</option>
    </select>

    <button type="submit">Guardar</button>
</form>

<hr>

<h2>Lista de Usuarios</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Rol</th>
    </tr>

    <?php foreach ($usuarios as $u): ?>
    <tr>
        <td><?= $u['id'] ?></td>
        <td><?= $u['nombre'] ?></td>
        <td><?= $u['email'] ?></td>
        <td><?= $u['rol'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>