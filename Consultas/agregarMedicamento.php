<?php

    session_start();
    if(!isset($_SESSION["Logged"])){
        header("Location: ../index.html");
    }

    foreach($_REQUEST as $key => $val){
        if($val == "+ Medicamento"){
            $_SESSION["Consulta"] = key($_REQUEST);
        }
        
    } 

    $cant = 0;
    $precio = 0;
    $med_cod = 0;
    $subtotal = 0;
    $con_cod = 0;
    $reg = "Añadir un medicamento";

    $check = FALSE;
    if(isset($_REQUEST["Cantidad"])){
        $cant = $_REQUEST["Cantidad"];
    }

    if(isset($_REQUEST["Precio"])){
        $precio = $_REQUEST["Precio"];
    }

    if(isset($_REQUEST["Código"])){
        $med_cod = $_REQUEST["Código"];
    }

    if($cant != 0 && $precio != 0 && $med_cod != 0 && isset($_SESSION["Consulta"])){
        $con_cod = $_SESSION["Consulta"];
        $check = TRUE;
        $subtotal = $cant * $precio;
    }


    //Registrar en la BD
    if($check){
        $conn = mysqli_connect("localhost", "root","", "RelocaDB");
        if (!$conn) {
            die("Error de conexion: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO detallesprescripción (con_id, med_id, det_cantidad, det_costoUnit, det_subtotal)";
        $sql .= "VALUES ('$con_cod', '$med_cod', '$cant', '$precio', '$subtotal');";
        if (mysqli_query($conn, $sql)) {
            $sql2 = "UPDATE consulta ";
            $sql2 .= "SET con_costo = consulta.con_costo + '$subtotal' ";
            $sql2 .= "WHERE con_id = '$con_cod';";
            if (mysqli_query($conn, $sql2)){
                ob_start();
                header('Location: '.'agregarMedicamentocheck.php');
                ob_end_flush();
                die();
            }
            else {
                echo "Error SQL ". $sql2 . "<br>" . mysqli_error($conn);
            }
        }
        else {
            echo "Error SQL ". $sql . "<br>" . mysqli_error($conn);
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

    <link rel="stylesheet" href="../css/index.css"></link>
    <link rel="stylesheet" href="../css/registrar.css"></link>

    <title>Registrar Medicamento</title>
</head>
<body>
    <header id="header" class="centrado-vh">
        <h1 id="bienvenido">Añadir un medicamento</h1>
    </header>
    <main id="main">
        <section id="section" class="centrado-vh">
            <form id="formulario" action="agregarMedicamento.php" method="POST"> 
                Código del medicamento
                <input type="text" name="Código" id="Código"><P>
                Precio de Venta
                <input type="number" step="0.01" name="Precio" id="Precio"><P>
                Cantidad
                <input type="number" name="Cantidad" id="Cantidad"><P>
                <input type="submit" value="Ok">
            </form>
        </section>
    </main>

    <footer id="footer" class="centrado-vh">
        <span>Creado por Daniel Cifuentes</span>
    </footer>
</body>
</html>
