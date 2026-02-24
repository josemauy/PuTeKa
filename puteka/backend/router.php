<?php

$route = $_GET['route'] ?? '';

switch($route) {

    case 'usuarios':
        require "controllers/UsuarioController.php";
        break;

    case 'libros':
        require "controllers/LibroController.php";
        break;

    case 'categorias':
        require "controllers/CategoriaController.php";
        break;

    case 'stock':
        require "controllers/StockController.php";
        break;

    case 'prestamos':
        require "controllers/PrestamoController.php";
        break;

    case 'categorias':
    require "controllers/CategoriaController.php";
    break;

    default:
        echo json_encode(["mensaje" => "Ruta no válida"]);
}