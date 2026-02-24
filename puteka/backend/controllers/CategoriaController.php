<?php
require_once "../config/database.php";
require_once "../models/Categoria.php";

$db = (new Database())->getConnection();
$model = new Categoria($db);

echo json_encode($model->getAll());