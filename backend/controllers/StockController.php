<?php
require_once "../config/database.php";
require_once "../models/Stock.php";

$db = (new Database())->getConnection();
$model = new Stock($db);

echo json_encode($model->getAll());