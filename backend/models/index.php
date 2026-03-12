<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>PuTeKa - Inicio</title>

    <style>

        body{
            margin:0;
            font-family: Arial, Helvetica, sans-serif;
            background:#f4f6f9;
            display:flex;
            justify-content:center;
            align-items:center;
            height:100vh;
        }

        .container{
            background:white;
            padding:40px;
            border-radius:10px;
            box-shadow:0 5px 15px rgba(0,0,0,0.2);
            text-align:center;
            width:300px;
        }

        h1{
            margin-bottom:30px;
            color:#333;
        }

        a{
            display:block;
            text-decoration:none;
            background:#4CAF50;
            color:white;
            padding:12px;
            margin:10px 0;
            border-radius:6px;
            transition:0.3s;
            font-weight:bold;
        }

        a:hover{
            background:#45a049;
            transform:scale(1.05);
        }

    </style>

</head>

<body>

<div class="container">

<h1>📚 PuTeKa</h1>

<a href="Usuario.php">Usuarios</a>
<a href="Libro.php">Libros</a>
<a href="Categoria.php">Categorías</a>
<a href="Stock.php">Stock</a>
<a href="Prestamo.php">Préstamos</a>

</div>

</body>
</html>