<?php

require_once("../config/database.php");

$database = new Database();
$conn = $database->getConnection();

$libro_id = $_POST['libro_id'];
$usuario_id = $_POST['usuario_id'];
$fecha_prestamo = $_POST['fecha_prestamo'];
$fecha_devolucion = $_POST['fecha_devolucion'];

$query = "INSERT INTO prestamos (libro_id, usuario_id, fecha_prestamo, fecha_devolucion)
          VALUES (:libro_id, :usuario_id, :fecha_prestamo, :fecha_devolucion)";

$stmt = $conn->prepare($query);

$stmt->bindParam(":libro_id", $libro_id);
$stmt->bindParam(":usuario_id", $usuario_id);
$stmt->bindParam(":fecha_prestamo", $fecha_prestamo);
$stmt->bindParam(":fecha_devolucion", $fecha_devolucion);

if($stmt->execute()){
    header("Location: ../../frontend/prestamos.php");
}else{
    echo "Error al registrar préstamo";
}

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Préstamos - PuTeKa</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:0;
}

.container{
    width:90%;
    max-width:1000px;
    margin:auto;
}

h2{
    text-align:center;
    color:#333;
}

.card{
    background:white;
    padding:25px;
    margin-top:30px;
    border-radius:10px;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

form{
    display:grid;
    gap:15px;
}

label{
    font-weight:bold;
}

select,input{
    padding:10px;
    border-radius:6px;
    border:1px solid #ccc;
}

button{
    padding:12px;
    border:none;
    border-radius:6px;
    background:green;
    color:white;
    font-weight:bold;
    cursor:pointer;
}

button:hover{
    background:green;
}

table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
    background:white;
    box-shadow:0 4px 10px rgba(0,0,0,0.1);
}

th{
    background:green;
    color:white;
    padding:12px;
}

td{
    padding:10px;
    border-bottom:1px solid #ddd;
    text-align:center;
}

tr:hover{
    background:#f2f2f2;
}

.volver{
    display:inline-block;
    margin-top:20px;
    text-decoration:none;
    background:#28a745;
    color:white;
    padding:10px 15px;
    border-radius:6px;
}

.volver:hover{
    background:#1e7e34;
}

</style>

</head>

<body>

<div class="container">

<div class="card">

<h2>Registrar Préstamo</h2>

<form action="../backend/models/Prestamo.php" method="POST">

<label>Libro:</label>
<select name="libro_id">

<?php

require_once("../backend/config/database.php");

$database = new Database();
$conn = $database->getConnection();

$query = "SELECT id, titulo FROM libros";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='".$row['id']."'>".$row['titulo']."</option>";
}

?>

</select>

<label>Usuario:</label>
<select name="usuario_id">

<?php

$query = "SELECT id, nombre FROM usuarios";
$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo "<option value='".$row['id']."'>".$row['nombre']."</option>";
}

?>

</select>

<label>Fecha Préstamo:</label>
<input type="date" name="fecha_prestamo" required>

<label>Fecha Devolución:</label>
<input type="date" name="fecha_devolucion" required>

<button type="submit">Registrar Préstamo</button>

</form>

</div>

<div class="card">

<h2>Lista de Préstamos</h2>

<table>

<thead>
<tr>
<th>ID</th>
<th>Libro</th>
<th>Usuario</th>
<th>Fecha Préstamo</th>
<th>Fecha Devolución</th>
</tr>
</thead>

<tbody>

<?php

$query = "SELECT prestamos.id,
                 libros.titulo AS libro,
                 usuarios.nombre AS usuario,
                 prestamos.fecha_prestamo,
                 prestamos.fecha_devolucion
          FROM prestamos
          INNER JOIN libros ON prestamos.libro_id = libros.id
          INNER JOIN usuarios ON prestamos.usuario_id = usuarios.id";

$stmt = $conn->prepare($query);
$stmt->execute();

while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

echo "<tr>";
echo "<td>".$row['id']."</td>";
echo "<td>".$row['libro']."</td>";
echo "<td>".$row['usuario']."</td>";
echo "<td>".$row['fecha_prestamo']."</td>";
echo "<td>".$row['fecha_devolucion']."</td>";
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

</div>

</body>
</html>