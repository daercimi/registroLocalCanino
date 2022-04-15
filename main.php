<?php
    session_start();
    if(!isset($_SESSION["Logged"])){
        header("Location: index.html");
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/index.css"></link>

    <title>Registro Local Canino</title>
</head>
<body>
    <header id="header" class="centrado-vh">
        <h1 id="bienvenido">¡Bienvenido! <?php echo $_SESSION["Nombre"]?></h1>
    </header>
    <main id="main">
        <h2 id="quehacer">¿Qué deseas hacer?</h2>
        <section id="section" class="centrado-vh">
            <a href="Consultas/consultas.php">
                <button id="consultas">Consultas</button>
            </a>
            <a href="registrar/registrar.php">
                <button id="registrarMascota">Registrar una mascota</button>
            </a>
            <a href="Medicamentos/medicamentos.php">
                <button id="registrarMedicamento">Medicamentos</button>
            </a>
            <a href="consultar/consultar.html">
                <button id="buscarMascotas">Buscar Mascotas</button>
            </a>
            <a href="login/logout.php">
                <button id="logout">Cerrar Sesión</button>
            </a>
        </section>
        <footer id="footer" class="centrado-vh">
            <span>Creado por Daniel Cifuentes</span>
        </footer>
    </main>
</body>
</html>