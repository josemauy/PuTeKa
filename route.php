<?php

require_once "controllers/UsuarioController.php";
require_once "controllers/LibroController.php";

$uri = $_GET['route'] ?? '';

switch($uri){

    case "usuarios":
        $controller = new UsuarioController();
        $controller->index();
        break;

    case "libros":
        $controller = new LibroController();
        $controller->index();
        break;

    default:
        echo json_encode(["mensaje" => "Ruta no encontrada"]);
}