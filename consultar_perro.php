<?php

$check = FALSE;
$sql = "";
$num_resultados = 0;
$req_type = 0;
$v2 = "";
$msg = "";
$info = array(
    'DNI' => "",
    'Nombre' => "",
    'Raza' => "",
    'Genero' => "",
    'Nac' => "",
);

if (isset($_POST['Buscar'])) {
    $check = TRUE;
    $req_type = 1;
    $v2 = $_REQUEST['Nombre'];

    $sql = "select * from Perro where Nombre like '".$v2."'";

}
if (isset($_POST['Mestizos'])) {
    $check = TRUE;
    $req_type = 2;
    $v2 = "Mestizos";

    $sql = "select COUNT(*) AS num from Perro where Raza = 'Mestizo'";
}
if (isset($_POST['Pitbull'])) {
    $check = TRUE;
    $req_type = 3;
    $v2 = "Pitbull";

    $sql = "select COUNT(*) AS num from Perro where Raza = 'Pitbull'";
}

if($check){
    //conexion a la Base de datos (Servidor,usuario,password)
    $conn = mysqli_connect("localhost", "root","", "relocaDB");
    if (!$conn) {
        die("Error de conexion: " . mysqli_connect_error());
    }

    $result = mysqli_query($conn, $sql);
    $num_resultados = mysqli_num_rows($result);

    switch($req_type){
        case 1:
            $msg = "Número de perros con nombre ".$v2.": ".$num_resultados;
            for ($i=0; $i <$num_resultados; $i++) {
                $row = mysqli_fetch_array($result);
                $msg .= "<br>".($i+1).")";
                $msg .= "<br>Nombre : ".$row["Nombre"];
                $msg .= "<br>Raza : ".$row["Raza"];
                $msg .= "<br>Genero : ".$row["Genero"];
                $msg .= "<br>Nacio en : ".$row["FechaNacimiento"];
                $msg .= "<br>";
            }
            break;
        case 2:
            $row = mysqli_fetch_array($result);
            $num_resultados = $row["num"];

            $msg = "Número de perros ".$v2.": ".$num_resultados;
            break;
        case 3:
            $row = mysqli_fetch_array($result);
            $num_resultados = $row["num"];

            $msg = "Número de perros ".$v2.": ".$num_resultados;
            break;
    }
    mysqli_close($conn);
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
    <link rel="stylesheet" href="css/results.css"></link>

    <title>Registro Local Canino</title>
</head>
<body>
    <header id="header" class="centrado-vh">
        <h1 id="bienvenido">Resultados de Consulta</h1>
    </header>
    <main id="main">
        <section id="section" class="centrado-vh">
            <?php echo $msg?>
            <a href="registrar.html">
                <button id="registrar">Registrar a mi perro</button>
            </a>
            <a href="consultar.html">
                <button id="consultar">Consultar en la BD</button>
            </a>
        </section>
        <footer id="footer" class="centrado-vh">
            <span>Creado por Daniel Cifuentes</span>
        </footer>
    </main>
</body>
</html>