<?php

require_once __DIR__ . '/../config/database.php';

$db = new Database();
$conn = $db->getConnection();

if (!$conn) {
    die("Error de conexión");
}

$query = "SELECT 
            p.id_prestamo,
            l.titulo,
            u.nombre AS usuario,
            p.fecha_prestamo,
            p.fecha_devolucion,
            p.estado
          FROM prestamo p
          INNER JOIN libro l ON p.id_libro = l.id_libro
          INNER JOIN usuario u ON p.id_usuario = u.id_usuario";

$stmt = $conn->prepare($query);
$stmt->execute();
$prestamos = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h2>Lista de Préstamos</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Libro</th>
        <th>Usuario</th>
        <th>Fecha Préstamo</th>
        <th>Fecha Devolución</th>
        <th>Estado</th>
    </tr>

    <?php foreach ($prestamos as $p): ?>
    <tr>
        <td><?= $p['id_prestamo'] ?></td>
        <td><?= $p['titulo'] ?></td>
        <td><?= $p['usuario'] ?></td>
        <td><?= $p['fecha_prestamo'] ?></td>
        <td><?= $p['fecha_devolucion'] ?></td>
        <td><?= $p['estado'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="../index.php">Volver</a>