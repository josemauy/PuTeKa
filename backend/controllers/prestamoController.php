<?php
require_once "../config/database.php";
require_once "../models/Prestamo.php";

$db = (new Database())->getConnection();
$model = new Prestamo($db);

echo json_encode($model->getAll());