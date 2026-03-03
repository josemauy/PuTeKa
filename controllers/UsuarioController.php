<?php

require_once __DIR__ . '/../models/Usuario.php';
require_once __DIR__ . '/../config/database.php';

class UsuarioController {

    private $db;
    private $usuario;

    public function __construct(){
        $database = new Database();
        $this->db = $database->getConnection();
        $this->usuario = new Usuario($this->db);
    }

    public function index(){
        $result = $this->usuario->getAll();
        echo json_encode($result->fetchAll(PDO::FETCH_ASSOC));
    }

    public function store($data){
        if($this->usuario->create($data)){
            echo json_encode(["mensaje" => "Usuario creado"]);
        } else {
            echo json_encode(["mensaje" => "Error al crear"]);
        }
    }
}