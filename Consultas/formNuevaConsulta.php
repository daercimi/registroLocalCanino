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
    <link rel="stylesheet" href="../css/registrar.css"></link>

    <title>RNueva Consulta/Cita</title>
</head>
<body>
    <header id="header" class="centrado-vh">
        <h1 id="bienvenido">Nueva Consulta/Cita</h1>
    </header>
    <main id="main">
        <section id="section" class="centrado-vh">
            <form id="formulario" action="actNuevo.php" method="POST"> 
                Código de la mascota
                <Input name = "Mascota" Type Text></P>
                Fecha
                <Input name= "Fecha" Type = "Date" placeholder="DNI"></P>
                Diagnóstico
                <Input name = "Diagnóstico" Type Text></P>
                Rayos X
                <Input Type = "file" name = "RayosX"></P>
                Examen de Sangre
                <Input Type = "file" name = "ExamenSangre"></P>
                <Input name= "Ok" Type = Submit value = "Ok" id="Ok">
                <a href="../main.php">
                    <button id="Cancelar">Cancelar</button>
                </a> 
            </form>
        </section>
    </main>

    <footer id="footer" class="centrado-vh">
        <span>Creado por Daniel Cifuentes</span>
    </footer>
</body>
</html>