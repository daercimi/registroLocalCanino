<?php
$tipo = "";
if (array_key_exists("submitCódigo",$_POST)){
    $tipo = "ID";
}
else{
    $tipo = "Nombre";
}

$searchValue = $_REQUEST[$tipo];
$columna = strtolower($tipo);
$sql = "SELECT * FROM medicamento WHERE med_".$columna." LIKE '%".$searchValue."%'";

//conexion a la Base de datos (Servidor,usuario,password)
$conn = mysqli_connect("localhost", "root","", "relocaDB");
if (!$conn) {
    die("Error de conexion: " . mysqli_connect_error());
}

$result = mysqli_query($conn, $sql);
$num_resultados = mysqli_num_rows($result);


$msg = "Medicamentos encontrados: ".$num_resultados."<P>";
for ($i=0; $i <$num_resultados; $i++) {
    $row = mysqli_fetch_array($result);
    $msg .= "<br>".($i+1).")";
    $msg .= "<br>Código : ".$row["med_id"];
    $msg .= "<br>Nombre : ".$row["med_nombre"];
    $msg .= "<br>Costo : ".$row["med_costo"];
    $msg .= "<P>";
}

mysqli_close($conn);
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
    <link rel="stylesheet" href="../css/results.css"></link>

    <title>Registro Local Canino</title>
</head>
<body>
    <header id="header" class="centrado-vh">
        <h1 id="bienvenido">Resultados de Consulta</h1>
    </header>
    <main id="main">
        <section id="section" class="centrado-vh">
            <div id="resultado">
                <div id="resultado-txt">
                    <?php echo $msg?>
                </div>
            </div>
            
            <a href="verMedicamentos.php">
                <button id="regresar">Regresar</button>
            </a>
        </section>
    </main>
    <footer id="footer" class="centrado-vh">
            <span>Creado por Daniel Cifuentes</span>
    </footer>
</body>
</html>