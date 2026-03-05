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

        $rol_id = $user['id_rol'];

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
            echo "Contraseña incorrecta";
        }

    } else {
        echo "Usuario no encontrado";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Login PuTeKa</title>
</head>

<body>

<h2>Ingreso al sistema PuTeKa</h2>

<form method="POST">

<label>Usuario</label><br>
<input type="text" name="usuario" required><br><br>

<label>Contraseña</label><br>
<input type="password" name="password" required><br><br>

<button type="submit">Ingresar</button>

</form>

<br><br>

<p><b>Información:</b></p>
<p>Usuarios y empleados usan la contraseña por defecto: <b>biblioteca</b></p>
<p>Administradores usan la contraseña: <b>admin</b></p>

</body>
</html>