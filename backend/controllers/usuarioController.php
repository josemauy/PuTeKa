<?php
require_once "../config/database.php";
require_once "../models/Usuario.php";

$db = (new Database())->getConnection();
$model = new Usuario($db);

echo json_encode($model->getAll());