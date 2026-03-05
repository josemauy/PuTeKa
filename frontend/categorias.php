<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Categorías - PuTeKa</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:0;
}

.container{
    width:80%;
    margin:auto;
    margin-top:40px;
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

input{
    padding:10px;
    width:250px;
    border:1px solid #ccc;
    border-radius:5px;
}

button{
    padding:10px 15px;
    border:none;
    background:green;
    color:white;
    border-radius:5px;
    cursor:pointer;
}

button:hover{
    background:green;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0px 3px 10px rgba(0,0,0,0.1);
}

th{
    background:green;
    color:white;
    padding:12px;
}

td{
    padding:10px;
    text-align:center;
    border-bottom:1px solid #ddd;
}

tr:hover{
    background:#f1f1f1;
}

.volver{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    color:white;
    background:#2ecc71;
    padding:10px 15px;
    border-radius:5px;
}

.volver:hover{
    background:#27ae60;
}

</style>

</head>

<body>

<div class="container">

<h2>📚 Registrar Categoría</h2>

<form action="../backend/models/Categoria.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre de la categoría" required>
    <button type="submit">Guardar</button>
</form>

<h2>📋 Categorías registradas</h2>

<table>

<thead>
<tr>
<th>ID</th>
<th>Nombre</th>
</tr>
</thead>

<tbody>

<?php

require_once("../backend/config/database.php");

$database = new Database();
$conn = $database->getConnection();

$query = "SELECT id, nombre FROM categorias";

$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    echo "<tr>";
    echo "<td>".$row['id']."</td>";
    echo "<td>".$row['nombre']."</td>";
    echo "</tr>";

}

?>

</tbody>

</table>

<a class="volver" href="index.html">⬅ Volver al inicio</a>

</div>

</body>
</html>