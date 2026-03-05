<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Categorías - PuTeKa</title>

<style>

*{
    box-sizing: border-box;
}

body{
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg,#eef2f7,#dce6f2);
    margin:0;
}

/* HEADER */

header{
    background:green;
    color:white;
    padding:20px;
    text-align:center;
    font-size:22px;
    font-weight:bold;
    letter-spacing:1px;
}

/* CONTENEDOR */

.container{
    width:85%;
    margin:auto;
    margin-top:40px;
}

/* TITULOS */

h2{
    color:#2c3e50;
    margin-bottom:15px;
}

/* FORMULARIO */

form{
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 6px 15px rgba(0,0,0,0.08);
    margin-bottom:40px;
}

input{
    padding:12px;
    width:280px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:14px;
}

/* BOTON */

button{
    padding:12px 18px;
    border:none;
    background:green;
    color:white;
    border-radius:6px;
    font-size:14px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#2980b9;
    transform:scale(1.05);
}

/* TABLA */

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    border-radius:10px;
    overflow:hidden;
    box-shadow:0 6px 15px rgba(0,0,0,0.08);
}

th{
    background:green;
    color:white;
    padding:14px;
}

td{
    padding:12px;
    text-align:center;
    border-bottom:1px solid #eee;
}

tr:hover{
    background:#f4f7fb;
}

/* BOTON VOLVER */

.volver{
    display:inline-block;
    margin-top:25px;
    text-decoration:none;
    color:white;
    background:#27ae60;
    padding:12px 18px;
    border-radius:6px;
    transition:0.3s;
}

.volver:hover{
    background:#1e8449;
}

</style>

</head>

<body>

<header>
📚 Sistema Biblioteca - PuTeKa
</header>

<div class="container">

<h2>Registrar Categoría</h2>

<form action="../backend/models/Categoria.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre de la categoría" required>
    <button type="submit">Guardar</button>
</form>

<h2>Categorías registradas</h2>

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