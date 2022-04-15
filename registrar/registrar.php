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

    <title>Registra a tu mascota</title>
</head>
<body>
    <header id="header" class="centrado-vh">
        <h1 id="bienvenido">¡Registra a tu mascota!</h1>
    </header>
    <main id="main">
        <section id="section" class="centrado-vh">
            <form id="formulario" action="actRegistrarMascota.php" method="POST"> 
                DNI del dueño
                <Input name = "Dni" Type Text></P>
                Ingresar Nombre 
                <Input name = "Nombre" Type Text></P>
                Ingresar Especie
                <Input name = "Especie" Type Text></P>
                Ingresar Raza
                <Input name = "Raza" Type Text></P>
                Fecha de Nacimiento
                <Input name= "FechaNac" Type = "Date"></P>
                Genero 
                <Input name="Genero" Type = "Radio"> Macho 
                <Input name= "Genero" Type = "Radio"> Hembra</P>
                Subir Foto 
                <Input Type = "file" name = "Foto" placeholder=""> 
                    <br>
                <Input name= "Registrar" Type = Submit value = "Registrar" id="Registrar">
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