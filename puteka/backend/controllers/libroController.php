<?php
require_once "../config/database.php";
require_once "../models/Libro.php";

$db = (new Database())->getConnection();
$model = new Libro($db);

echo json_encode($model->getAll());