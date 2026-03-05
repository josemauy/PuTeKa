<?php

require_once __DIR__ . '/../config/database.php';

$db = new Database();
$conn = $db->getConnection();

if (!$conn) {
    die("No hay conexión");
}

/* ===== INSERTAR ===== */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nombre = $_POST["nombre"];
    $email  = $_POST["email"];
    $rol_id = $_POST["rol_id"];

    $queryInsert = "INSERT INTO usuarios (nombre, email, rol_id)
                    VALUES (?, ?, ?)";

    $stmtInsert = $conn->prepare($queryInsert);
    $stmtInsert->execute([$nombre, $email, $rol_id]);

    header("Location: Usuario.php");
    exit;
}

/* ===== OBTENER ===== */
$query = "SELECT u.id, u.nombre, u.email, r.nombre AS rol
          FROM usuarios u
          INNER JOIN roles r ON u.rol_id = r.id";

$stmt = $conn->prepare($query);
$stmt->execute();
$usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Usuarios</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:40px;
}

.container{
    width:900px;
    margin:auto;
}

h2{
    color:#333;
}

form{
    background:white;
    padding:20px;
    border-radius:8px;
    box-shadow:0px 3px 10px rgba(0,0,0,0.1);
    margin-bottom:30px;
}

input, select{
    width:100%;
    padding:10px;
    margin:8px 0;
    border:1px solid #ccc;
    border-radius:5px;
}

button{
    background:#4CAF50;
    color:white;
    border:none;
    padding:10px 20px;
    border-radius:5px;
    cursor:pointer;
}

button:hover{
    background:#45a049;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0px 3px 10px rgba(0,0,0,0.1);
}

th{
    background:#4CAF50;
    color:white;
    padding:12px;
}

td{
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:center;
}

tr:hover{
    background:#f1f1f1;
}

</style>

</head>

<body>

<div class="container">

<h2>Registrar Usuario</h2>

<form method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Email" required>

    <select name="rol_id" required>
        <option value="1">Administrador</option>
        <option value="2">Empleado</option>
    </select>

    <button type="submit">Guardar</button>
</form>

<h2>Lista de Usuarios</h2>

<table>
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Email</th>
        <th>Rol</th>
    </tr>

    <?php foreach ($usuarios as $u): ?>
    <tr>
        <td><?= $u['id'] ?></td>
        <td><?= $u['nombre'] ?></td>
        <td><?= $u['email'] ?></td>
        <td><?= $u['rol'] ?></td>
    </tr>
    <?php endforeach; ?>
</table>

</div>

</body>
</html>