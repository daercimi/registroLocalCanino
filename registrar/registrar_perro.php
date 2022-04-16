
<?php 

if (!array_key_exists("Registrar",$_POST)){
    ob_start();
    header('Location: '.'../main.html');
    ob_end_flush();
    die();
}

else{
    $msg = "";
    $reg = "";
    if(array_key_exists('Genero',$_REQUEST)){

        $v1 = $_REQUEST['Codigo'];
        $v2 = $_REQUEST['Nombre'];
        $v3 = $_REQUEST['FechNac'];
        $v4 = $_REQUEST['Raza'];
        $v5 = $_REQUEST['Genero'];
        $v6 = $_REQUEST['Foto'];

        if($v1 != NULL && $v2 != NULL && $v4 != NULL && $v5 != NULL){
            $conn = mysqli_connect("sql10.freemysqlhosting.net", "sql10486087","aFXPWBC5ZG", "sql10486087");
            if (!$conn) {
                die("Error de conexion: " . mysqli_connect_error());
            }
            //consulta SQL
            $sql = "INSERT INTO perro (DNI, Nombre, Raza, Genero, FechaNacimiento, Foto) ";
            $sql .= "VALUES ('$v1', '$v2', '$v4', '$v5', '$v3', '$v6' );";
            if (mysqli_query($conn, $sql)) {
                $msg = "Perro registrado correctamente";
                $reg = "Registrar a otro perro";
            } else {
                $msg = "Error SQL ". $sql . "<br>" . mysqli_error($conn);
                $reg = "Volver al registro de perro";
            }
            mysqli_close($conn);
        }
    }
    else{
        $msg = "Error: Debe ingresar el Genero de su perro";
        $reg = "Volver al registro de perro";
    }
    
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

    <title>Registro Local Canino</title>
</head>
<body>
    <header id="header" class="centrado-vh">
        <h1 id="bienvenido"><?php echo $msg?></h1>
    </header>
    <main id="main">
        <h2 id="quehacer">¿Qué deseas hacer?</h2>
        <section id="section" class="centrado-vh">
            <a href="registrar.html">
                <button id="registrar"><?php echo $reg?></button>
            </a>
            <a href="../consultar/consultar.html">
                <button id="consultar">Consultar en la BD</button>
            </a>
        </section>
        <footer id="footer" class="centrado-vh">
            <span>Creado por Daniel Cifuentes</span>
        </footer>
    </main>
</body>
</html>

<?php
?>