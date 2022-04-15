<?php
    session_start();
    if(!isset($_SESSION["Logged"])){
        header("Location: index.html");
    }

    $sql = "";
    if (array_key_exists("submitCódigo",$_POST)){
        $searchValue = $_REQUEST["ID"];
        $sql = "SELECT * FROM consulta JOIN mascota JOIN veterinario WHERE con_id LIKE '%".$searchValue."%'";
    }
    elseif(array_key_exists("submitMascota",$_POST)){
        $searchValue = $_REQUEST["Mascota"];
        $sql = "SELECT * FROM consulta JOIN mascota JOIN veterinario WHERE mas_id LIKE '%".$searchValue."%'";
    }
    elseif(array_key_exists("submitNombre",$_POST)){
        $searchValue = $_REQUEST["Nombre"];
        $sql = "SELECT * FROM consulta JOIN mascota JOIN veterinario WHERE mascota.mas_nombre LIKE '%".$searchValue."%'";
    }
    elseif(array_key_exists("submitVeterinario",$_POST)){
        $searchValue = $_REQUEST["Veterinario"];
        $sql = "SELECT * FROM consulta JOIN mascota JOIN veterinario WHERE vet_id LIKE '%".$searchValue."%'";
    }


    //conexion a la Base de datos (Servidor,usuario,password)
    $conn = mysqli_connect("localhost", "root","", "relocaDB");
    if (!$conn) {
        die("Error de conexion: " . mysqli_connect_error());
    }

    $result = mysqli_query($conn, $sql);
    $num_resultados = mysqli_num_rows($result);
    $msg = "Consultas encontrados: ".$num_resultados."<P>";
    for ($i=0; $i <$num_resultados; $i++) {
        $row = mysqli_fetch_array($result);
    
        $msg .= "<br>".($i+1).")";
        $msg .= "<br>Código : ".$row["con_id"];
        $msg .= "<br>Mascota : ".$row["mas_id"]."(".$row["mas_nombre"].")";
        $msg .= "<br>Veterinario : ".$row["vet_id"]."(".$row["vet_nombre"].")";
        $msg .= "<br>Fecha : ".$row["con_fecha"];
        $msg .= "<br>Diagnóstico : ".$row["con_diagnostico"];
        
        if($row["con_rayosX"] == ''){
            $rX = "<i>No hay Rayos X</i>";
        }else{
            $rX = "<a href='".$row["con_rayosX"]."' target='_blank'>Ver</a>";
        }
        $msg .= "<br>Rayos X : ".$rX;

        if($row["con_examensangre"] == ''){
            $exSan = "<i>No hay Examen de Sangre</i>";
        }else{
            $exSan = "<a href='".$row["con_examensangre"]."' target='_blank'>Ver</a>";
        }
        $msg .= "<br>Examen Sangre : ".$exSan;
        $msg .= "<form action='agregarMedicamento.php' >";
        $msg .= "<Input name= '".$row['con_id']."' Type = Submit value = '+ Medicamento' id='".$row['con_id']."'>";
        $msg .= "</form>";
        $msg .= "<form action='verMedicamentos.php' >";
        $msg .= "<Input name= '".$row['con_id']."' Type = Submit value = 'Ver Medicamentos' id='".$row['con_id']."'>";
        $msg .= "</form>";

        $msg .= "<br>Costo : ".$row["con_costo"];
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