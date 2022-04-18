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

    <title>Registrate Dueño</title>
</head>
<body>
    <header id="header" class="centrado-vh">
        <h1 id="bienvenido">Dueño no encontrado, debe ser registrado</h1>
    </header>
    <main id="main">
        <section id="section" class="centrado-vh">
            <form action="actRegistrarDueño.php" method="POST"> 
                Ingresar Nombre 
                <Input name = "Nombre" Type Text></P>
                Ingresar Apellido
                <Input name= "Apellido" Type Text></P>
                Ingresar Teléfono
                <Input name= "Teléfono" Type Text></P>
                Ingresar Correo
                <Input name= "Correo" Type Text></P>
                    <br>
                <Input name= "Registrar" Type = Submit value = "Registrar"> 
                <a href="../main.html">
                    <button id="cancelar">Cancelar</button>
                </a>
            </form>
        </section>
    </main>

    <footer id="footer" class="centrado-vh">
        <span>Creado por Daniel Cifuentes</span>
    </footer>
</body>
</html>
