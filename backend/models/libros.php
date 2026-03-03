<?php

require_once __DIR__ . '/../config/database.php';

$db = new Database();
$conn = $db->getConnection();

if (!$conn) {
    die("Error de conexión");
}

$query = "SELECT 
            l.id_libro,
            l.titulo,
            l.anio_publicacion,
            u.nombre AS autor,
            c.nombre AS categoria
          FROM libro l
          INNER JOIN usuario u ON l.id_autor = u.id_usuario
          INNER JOIN categoria c ON l.id_categoria = c.id_categoria";

$stmt = $conn->prepare($query);
$stmt->execute();
$libros = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<h2>Lista de Libros</h2>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Título</th>
        <th>Autor</th>
        <th>Categoría</th>
        <th>Año</th>
    </tr>

    <?php foreach ($libros as $l): ?>
    <tr>
        <td><?= $l['id_libro'] ?></td>
        <td><?= $l['titulo'] ?></td>
        <td><?= $l['autor'] ?></td>
        <td><?= $l['categoria'] ?></td>
        <td><?= $l['anio_publicacion'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

<br>
<a href="../index.php">Volver</a>