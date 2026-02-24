<?php
class Libro {
    private $conn;
    private $table = "libros";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $sql = "SELECT l.id, l.titulo,
                       c.nombre as categoria,
                       u.nombre as autor
                FROM libros l
                INNER JOIN categorias c ON l.categoria_id = c.id
                INNER JOIN usuarios u ON l.autor_id = u.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}