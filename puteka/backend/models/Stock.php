<?php
class Stock {
    private $conn;
    private $table = "stock";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $sql = "SELECT s.id, l.titulo, s.cantidad
                FROM stock s
                INNER JOIN libros l ON s.libro_id = l.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}