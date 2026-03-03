<?php

class Libro {

    private $conn;

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAll(){
        $query = "SELECT l.*, u.nombre as autor, c.nombre as categoria
                  FROM libro l
                  INNER JOIN usuario u ON l.id_autor = u.id_usuario
                  INNER JOIN categoria c ON l.id_categoria = c.id_categoria";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
}