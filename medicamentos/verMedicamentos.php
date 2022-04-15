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

    <link rel="stylesheet" href="../css/index.css"></link>
    <link rel="stylesheet" href="../css/consultar.css"></link>
    
    <title>Ver medicamentos</title>
</head>
<body>
    <header id="header" class="centrado-vh">
        <h1 id="bienvenido">Buscar medicamentos</h1>
    </header>
    <main id="main">
        <section id="section" class="centrado-vh">
            <form action="actVerMedicamentos.php" method="POST"> 
                <label for="Código">Código</label>
                <input type="text" name="ID">
                <input name="submitCódigo" type="submit" value="Buscar por Código"></P>
                <label for="Nombre">Nombre</label>
                <input type="text" name="Nombre">
                <input name="submitNombre" type="submit" value="Buscar por Nombre"></P>
            </form>
            <a href="medicamentos.php">
                <button id="consultar">Regresar</button>
            </a>
        </section>
        <footer id="footer" class="centrado-vh">
            <span>Creado por Daniel Cifuentes</span>
        </footer>
    </main>
</body>
</html>