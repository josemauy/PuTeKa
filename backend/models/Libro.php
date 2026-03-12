<?php

require_once("../config/database.php");

$database = new Database();
$conn = $database->getConnection();

$titulo = $_POST['titulo'];
$autor = $_POST['autor_id'];
$categoria_id = $_POST['categoria_id'];

$query = "INSERT INTO libros (titulo, autor_id, categoria_id)
          VALUES (:titulo, :autor_id, :categoria_id)";

$stmt = $conn->prepare($query);

$stmt->bindParam(":titulo", $titulo);
$stmt->bindParam(":autor_id", $autor);
$stmt->bindParam(":categoria_id", $categoria_id);

$stmt->execute();

header("Location: ../../frontend/libros.php");
exit();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Libros - PuTeKa</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:0;
}

.container{
    width:90%;
    max-width:900px;
    margin:auto;
    margin-top:40px;
}

h2{
    text-align:center;
    color:#333;
}

form{
    background:white;
    padding:25px;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
    margin-bottom:30px;
}

input, select{
    width:100%;
    padding:10px;
    margin-top:10px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:6px;
    font-size:14px;
}

button{
    background:#4CAF50;
    color:white;
    border:none;
    padding:12px;
    width:100%;
    border-radius:6px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#43a047;
}

table{
    width:100%;
    border-collapse:collapse;
    background:white;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

th{
    background:#4CAF50;
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
    display:block;
    width:200px;
    margin:20px auto;
    text-align:center;
    background:#2196F3;
    color:white;
    padding:10px;
    border-radius:6px;
    text-decoration:none;
}

.volver:hover{
    background:#1976D2;
}

</style>
</head>

<body>

<div class="container">

<h2>Agregar Libro</h2>

<form action="../backend/models/Libro.php" method="POST">

<input type="text" name="titulo" placeholder="Título del libro" required>

<input type="text" name="autor_id" placeholder="Autor" required>

<select name="categoria_id" required>

<?php

require_once("../backend/config/database.php");

$database = new Database();
$conn = $database->getConnection();

$query = "SELECT id, nombre FROM categorias";

$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

echo "<option value='".$row['id']."'>".$row['nombre']."</option>";

}

?>

</select>

<button type="submit">Guardar Libro</button>

</form>

<h2>Lista de Libros</h2>

<table>

<thead>
<tr>
<th>ID</th>
<th>Título</th>
<th>Autor</th>
<th>Categoría</th>
</tr>
</thead>

<tbody>

<?php

require_once("../backend/config/database.php");

$database = new Database();
$conn = $database->getConnection();

$query = "SELECT * FROM libros";

$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

echo "<tr>";
echo "<td>".$row['id']."</td>";
echo "<td>".$row['titulo']."</td>";
echo "<td>".$row['autor_id']."</td>";
echo "<td>".$row['categoria_id']."</td>";
echo "</tr>";

}

?>

</tbody>
</table>

<a class="volver" href="index.html">⬅ Volver al inicio</a>
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
</div>

</body>
</html>