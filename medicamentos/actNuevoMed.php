
<?php 

if (!array_key_exists("Registrar",$_POST)){
    ob_start();
    header('Location: '.'../main.php');
    ob_end_flush();
    die();
}

else{
    $msg = "";
    $reg = "";

    session_start();

    $v1 = $_REQUEST['Codigo'];
    $v2 = $_REQUEST['Nombre'];
    $v3 = $_REQUEST['Precio'];

    if($v1 != NULL && $v2 != NULL && $v3 != NULL ){
        $conn = mysqli_connect("localhost", "root","", "RelocaDB");
        if (!$conn) {
            die("Error de conexion: " . mysqli_connect_error());
        }
        //consulta SQL
        $sql = "INSERT INTO medicamento (med_id, med_nombre, med_costo)";
        $sql .= "VALUES ('$v1', '$v2', '$v3');";
        if (mysqli_query($conn, $sql)) {
            $msg = "Medicamento registrado correctamente";
            $reg = "Registrar a otro Medicamento";
        } else {
            $msg = "Error SQL ". $sql . "<br>" . mysqli_error($conn);
            $reg = "Volver al registro de medicamento";
        }
        mysqli_close($conn);
    } else{
        $msg = "Debe de ingresar todos los campos";
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
            <a href="registrar.php">
                <button id="registrar"><?php echo $reg?></button>
            </a>
            <a href="verMedicamentos.php">
                <button id="consultar">Ver medicamentos</button>
            </a>
        </section>
        <footer id="footer" class="centrado-vh">
            <span>Creado por Daniel Cifuentes</span>
        </footer>
    </main>
</body>
</html>