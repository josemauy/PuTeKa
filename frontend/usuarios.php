<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Usuarios - PuTeKa</title>
</head>
<body>

<h2>Registrar Usuario</h2>

<form action="../backend/models/Usuario.php" method="POST">
    <input type="text" name="nombre" placeholder="Nombre" required>
    <input type="email" name="email" placeholder="Email" required>

    <select name="id_rol">
        <option value="1">Administrador</option>
        <option value="2">Empleado</option>
    </select>

    <button type="submit">Guardar</button>
</form>

<hr>

<h2>Usuarios</h2>

<table border="1">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Email</th>
            <th>Rol</th>
        </tr>
    </thead>
    <tbody id="tablaUsuarios"></tbody>
</table>

<br>
<a href="index.html">⬅ Volver al inicio</a>

<script src="js/app.js"></script>
<script>
    cargar("usuarios", "tablaUsuarios");
</script>

</body>
</html>