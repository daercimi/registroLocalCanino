<?php

    session_start();
    if(!isset($_SESSION["Logged"])){
        header("Location: ../index.html");
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

    <link rel="stylesheet" href="../css/index.css"></link>
    <link rel="stylesheet" href="../css/registrar.css"></link>

    <title>Listo</title>
</head>
<body>
    <header id="header" class="centrado-vh">
        <h1 id="bienvenido">Detalle del medicamento añadido</h1>
    </header>
    <main id="main">
        <section id="section" class="centrado-vh">
            <a href="agregarMedicamento.php">
                <button id="agregarMedicamento">Añadir otro medicamento</button>
            </a>
            <a href="formRevisarConsultas.php">
                <button id="revisarConsultas">Regresar a ver las consultas</button>
            </a>
        </section>
    </main>

    <footer id="footer" class="centrado-vh">
        <span>Creado por Daniel Cifuentes</span>
    </footer>
</body>
</html>
