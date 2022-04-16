<?php


$tipo = "";
if (array_key_exists("submitCódigo",$_POST)){
    $tipo = "ID";
}
elseif(array_key_exists("submitNombre",$_POST)){
    $tipo = "Nombre";
}
elseif(array_key_exists("submitEspecie",$_POST)){
    $tipo = "Especie";
}
else{
    $tipo = "Raza";
}

$searchValue = $_REQUEST[$tipo];
$columna = strtolower($tipo);
$sql = "SELECT * FROM mascota WHERE mas_".$columna." LIKE '%".$searchValue."%'";

//conexion a la Base de datos (Servidor,usuario,password)
$conn = mysqli_connect("sql10.freemysqlhosting.net", "sql10486087","aFXPWBC5ZG", "sql10486087");
if (!$conn) {
    die("Error de conexion: " . mysqli_connect_error());
}

$result = mysqli_query($conn, $sql);
$num_resultados = mysqli_num_rows($result);


$msg = "Mascotas encontrados: ".$num_resultados."<P>";
for ($i=0; $i <$num_resultados; $i++) {
    $row = mysqli_fetch_array($result);

    $gen = 'macho';
    if($row["mas_genero"] == 1){
        $gen = 'hembra';
    }

    $msg .= "<br>".($i+1).")";
    $msg .= "<br>Código : ".$row["mas_id"];
    $msg .= "<br>Nombre : ".$row["mas_nombre"];
    $msg .= "<br>Especie : ".$row["mas_especie"];
    $msg .= "<br>Raza : ".$row["mas_raza"];
    $msg .= "<br>Fecha Nac. : ".$row["mas_fechanac"];
    $msg .= "<br>Género : ".$gen;
    $msg .= "<br><a target='_blank' href='".$row["mas_foto"]."'>Ver foto</a>";
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
            
            <a href="consultar.html">
                <button id="regresar">Regresar</button>
            </a>
        </section>
        <footer id="footer" class="centrado-vh">
            <span>Creado por Daniel Cifuentes</span>
        </footer>
    </main>
</body>
</html>