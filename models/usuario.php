<?php

class Usuario {

    private $conn;
    private $table = "usuario";

    public function __construct($db){
        $this->conn = $db;
    }

    public function getAll(){
        $query = "SELECT u.*, r.nombre as rol
                  FROM usuario u
                  INNER JOIN rol r ON u.id_rol = r.id_rol";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    public function create($data){
        $query = "INSERT INTO usuario
                  (nombre, documento, telefono, correo, usuario, contrasena, id_rol)
                  VALUES (:nombre, :documento, :telefono, :correo, :usuario, :contrasena, :id_rol)";

        $stmt = $this->conn->prepare($query);

        return $stmt->execute($data);
    }
}