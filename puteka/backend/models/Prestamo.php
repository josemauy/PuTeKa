<?php
class Prestamo {
    private $conn;
    private $table = "prestamos";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $sql = "SELECT p.id,
                       l.titulo,
                       u.nombre,
                       p.fecha_prestamo,
                       p.fecha_devolucion
                FROM prestamos p
                INNER JOIN libros l ON p.libro_id = l.id
                INNER JOIN usuarios u ON p.usuario_id = u.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}