<?php
session_start();

require_once __DIR__ . '/config/database.php';

$db = new Database();
$conn = $db->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $usuario = $_POST['usuario'];
    $contrasena = $_POST['contrasena'];

    $query = "SELECT u.*, r.nombre AS rol
              FROM usuario u
              INNER JOIN rol r ON u.id_rol = r.id_rol
              WHERE u.usuario = :usuario";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(":usuario", $usuario);
    $stmt->execute();

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $contrasena == $user['contrasena']) {

        $_SESSION['id_usuario'] = $user['id_usuario'];
        $_SESSION['nombre'] = $user['nombre'];
        $_SESSION['rol'] = $user['rol'];

        header("Location: ../frontend/index.html");
        exit();

    } else {
        echo "Usuario o contraseña incorrectos";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login PuTeKa</title>
</head>
<body>

<h2>Login Biblioteca PuTeKa</h2>

<form method="POST">

<label>Usuario</label><br>
<input type="text" name="usuario" required><br><br>

<label>Contraseña</label><br>
<input type="password" name="contrasena" required><br><br>

<button type="submit">Iniciar sesión</button>

</form>

</body>
</html>