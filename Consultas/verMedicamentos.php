<?php
    session_start();
    if(!isset($_SESSION["Logged"])){
        header("Location: ../index.html");
    }

    $sql = "";

    foreach($_REQUEST as $key => $val){
        if($val == "Ver Medicamentos"){
            $sql = "SELECT * FROM detallesprescripción JOIN medicamento ON detallesprescripción.med_id = medicamento.med_id  WHERE con_id = ".key($_REQUEST).";";
        }
        
    } 


    //conexion a la Base de datos (Servidor,usuario,password)
    $conn = mysqli_connect("localhost", "root","", "relocaDB");
    if (!$conn) {
        die("Error de conexion: " . mysqli_connect_error());
    }

    $result = mysqli_query($conn, $sql);
    $num_resultados = mysqli_num_rows($result);
    $msg = "Medicamentos prescritos: ".$num_resultados."<P>";
    for ($i=0; $i <$num_resultados; $i++) {
        $row = mysqli_fetch_array($result);
    
        $msg .= "<br>".($i+1).")";
        $msg .= "<br>Código : ".$row["med_id"];
        $msg .= "<br>Nombre : ".$row["med_nombre"];
        $msg .= "<br>Cantidad : ".$row["det_cantidad"];
        $msg .= "<br>Costo Unid. : ".$row["det_costoUnit"];
        $msg .= "<br>Subtotal : ".$row["det_subtotal"];
        
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
            
            <a href="formRevisarConsultas.php">
                <button id="regresar">Regresar</button>
            </a>
        </section>
        <footer id="footer" class="centrado-vh">
            <span>Creado por Daniel Cifuentes</span>
        </footer>
    </main>
</body>
</html>