<?php
session_start();

require_once __DIR__ . '/../config/database.php';

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $query = "SELECT * FROM usuarios WHERE email = :email";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":email", $usuario);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {

        $rol_id = $user['rol_id'];

        // Administrador
        if ($rol_id == 1 && $password == "admin") {

            $_SESSION['usuario'] = $user['nombre'];
            $_SESSION['rol'] = "admin";

            header("Location: ../index.php");
            exit();
        }

        // Empleado / Usuario
        elseif ($rol_id != 1 && $password == "biblioteca") {

            $_SESSION['usuario'] = $user['nombre'];
            $_SESSION['rol'] = "empleado";

            header("Location: ../../frontend/index.html");
            exit();
        }

        else {
            echo "<p class='error'></p>";
        }

    } else {
        echo "<p class='error'>Usuario no encontrado</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Login PuTeKa</title>

<style>

body{
    font-family: Arial, Helvetica, sans-serif;
    background: green;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    margin:0;
}

.login-box{
    background:white;
    padding:40px;
    width:350px;
    border-radius:10px;
    box-shadow:0 10px 25px rgba(0,0,0,0.3);
    text-align:center;
}

h2{
    margin-bottom:25px;
    color:#333;
}

input{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:20px;
    border-radius:5px;
    border:1px solid #ccc;
    font-size:14px;
}

input:focus{
    border-color:#2a5298;
    outline:none;
}

button{
    width:100%;
    padding:12px;
    border:none;
    background:green;
    color:white;
    font-size:16px;
    border-radius:5px;
    cursor:pointer;
    transition:0.3s;
}

button:hover{
    background:#1e3c72;
}

.info{
    margin-top:20px;
    font-size:13px;
    color:#555;
}

.error{
    color:red;
    text-align:center;
}

</style>

</head>

<body>

<div class="login-box">

<h2>📚 PuTeKa</h2>

<form method="POST">

<label>Usuario</label>
<input type="text" name="usuario" required>

<label>Contraseña</label>
<input type="password" name="password" required>

<button type="submit">Ingresar</button>
<button type="button" onclick="window.location='registro.php'" style="background:#555;margin-top:10px;">
Registrarse
</button>
</form>

<div class="info">

<p><b>Información:</b></p>
<p>Usuarios y empleados usan: <b>biblioteca</b></p>
<p>Administradores usan: <b>admin</b></p>

</div>

</div>

</body>
</html>