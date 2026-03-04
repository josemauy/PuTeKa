<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo json_encode(["POST_recibido" => $_POST]);
    exit;
}
require_once __DIR__ . '/../config/database.php';

$db = new Database();
$conn = $db->getConnection();

/* ===== INSERTAR ===== */
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titulo       = $_POST['titulo'] ?? null;
    $autor_id     = $_POST['autor_id'] ?? null;
    $categoria_id = $_POST['categoria_id'] ?? null;

    if ($titulo && $autor_id && $categoria_id) {

        $queryInsert = "INSERT INTO libros (titulo, autor_id, categoria_id)
                        VALUES (?, ?, ?)";

        $stmtInsert = $conn->prepare($queryInsert);
        $stmtInsert->execute([$titulo, $autor_id, $categoria_id]);
    }
}

/* ===== OBTENER ===== */
$query = "SELECT 
            l.id,
            l.titulo,
            u.nombre AS autor,
            c.nombre AS categoria
          FROM libros l
          INNER JOIN usuarios u ON l.autor_id = u.id
          INNER JOIN categorias c ON l.categoria_id = c.id";

$stmt = $conn->prepare($query);
$stmt->execute();

echo json_encode($stmt->fetchAll(PDO::FETCH_ASSOC));