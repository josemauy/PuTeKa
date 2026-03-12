<?php

require_once __DIR__ . '/../config/database.php';

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $rol_id = 2; // usuario normal

    $query = "INSERT INTO usuarios (nombre,email,rol_id) 
              VALUES (:nombre,:email,:rol_id)";

    $stmt = $conn->prepare($query);

    $stmt->bindParam(":nombre",$nombre);
    $stmt->bindParam(":email",$email);
    $stmt->bindParam(":rol_id",$rol_id);

    if($stmt->execute()){
        echo "<p style='color:green'>Usuario registrado correctamente</p>";
    }else{
        echo "<p style='color:red'>Error al registrar</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Registro PuTeKa</title>

<style>

body{
    font-family: Arial;
    background: green;
    display:flex;
    justify-content:center;
    align-items:center;
    height:100vh;
}

.registro-box{
    background:white;
    padding:40px;
    border-radius:10px;
    width:350px;
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
}

input{
    width:100%;
    padding:10px;
    margin-bottom:15px;
}

button{
    width:100%;
    padding:12px;
    background:green;
    color:white;
    border:none;
    border-radius:5px;
}

button:hover{
    background:#1e3c72;
}

</style>

</head>

<body>

<div class="registro-box">

<h2>Registro de Usuario</h2>

<form method="POST">

<label>Nombre</label>
<input type="text" name="nombre" required>

<label>Email</label>
<input type="email" name="email" required>

<a href="login.php"><button type="submit">registarse</button></a>

</form>

<br>

<a href="login.php">Volver al login</a>

</div>

</body>
</html>