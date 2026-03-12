<?php

require_once("../backend/config/database.php");

$database = new Database();
$conn = $database->getConnection();

/* INSERTAR STOCK */

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $libro_id = $_POST["libro_id"];
    $cantidad = $_POST["cantidad"];

    $query = "INSERT INTO stock (libro_id, cantidad)
              VALUES (:libro_id, :cantidad)";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":libro_id", $libro_id);
    $stmt->bindParam(":cantidad", $cantidad);
    $stmt->execute();

    echo "<p class='success'>Stock agregado correctamente</p>";
}

?>

<!DOCTYPE html>
<html>
<head>

<title>Stock PuTeKa</title>

<style>

body{
font-family: Arial;
background:#f4f6f9;
margin:0;
padding:0;
}

.container{
width:800px;
margin:auto;
margin-top:40px;
background:white;
padding:30px;
border-radius:10px;
box-shadow:0px 0px 10px rgba(0,0,0,0.1);
}

h1{
text-align:center;
color:#2c3e50;
}

form{
margin-bottom:30px;
}

label{
font-weight:bold;
}

select,input{
width:100%;
padding:8px;
margin-top:5px;
margin-bottom:15px;
border:1px solid #ccc;
border-radius:5px;
}

button{
background:#3498db;
color:white;
border:none;
padding:10px;
width:100%;
border-radius:5px;
cursor:pointer;
}

button:hover{
background:#2980b9;
}

table{
width:100%;
border-collapse:collapse;
}

table th{
background:#3498db;
color:white;
padding:10px;
}

table td{
padding:10px;
text-align:center;
border-bottom:1px solid #ddd;
}

.success{
background:#2ecc71;
color:white;
padding:10px;
border-radius:5px;
text-align:center;
}

.volver{
display:block;
margin-top:20px;
text-align:center;
}

</style>

</head>

<body>

<div class="container">

<h1>Inventario de Libros</h1>

<h3>Agregar Stock</h3>

<form method="POST">

<label>Libro</label>

<select name="libro_id">

<?php

$query = "SELECT * FROM libros";
$stmt = $conn->prepare($query);
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

echo "<option value='".$row['id']."'>".$row['titulo']."</option>";

}

?>

</select>

<label>Cantidad</label>
<input type="number" name="cantidad" required>

<button type="submit">Guardar Stock</button>

</form>

<h3>Inventario Actual</h3>

<table>

<tr>
<th>ID</th>
<th>Libro</th>
<th>Cantidad</th>
</tr>

<?php

$query = "SELECT stock.id, libros.titulo, stock.cantidad
          FROM stock
          INNER JOIN libros ON stock.libro_id = libros.id";

$stmt = $conn->prepare($query);
$stmt->execute();

while($row = $stmt->fetch(PDO::FETCH_ASSOC)){

echo "<tr>";
echo "<td>".$row['id']."</td>";
echo "<td>".$row['titulo']."</td>";
echo "<td>".$row['cantidad']."</td>";
echo "</tr>";

}

?>

</table>

<a class="volver" href="index.html">Volver al inicio</a>

</div>
<button style="
background:red;
color:white;
border:none;
padding:10px 20px;
border-radius:5px;
cursor:pointer;
"
onclick="window.location='../backend/models/login.php'">
Cerrar sesión
</button>
</body>
</html>