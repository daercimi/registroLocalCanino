<?php
if (array_key_exists("Cancelar",$_POST)){
    ob_start();
    header('Location: '.'../index.html');
    ob_end_flush();
    die();
}

else{

    if(!($_SERVER["REQUEST_METHOD"]=="POST")){
        $msg = "No ingreses por este método, regresa al inicio de sesión";
    }
    else{

        $msg = "";
    
        $dni = $_POST['DNI'];
        $pw = $_POST['pw'];
    
        $conn = mysqli_connect("localhost", "root",'', "relocadb");
        if (!$conn) {
            $msg = "Error de conexion: " . mysqli_connect_error();
        }else{
            $sql_id = "SELECT * from veterinario WHERE vet_id = '".$dni."';";
            $result = mysqli_query($conn, $sql_id);
            $num_emails = mysqli_num_rows($result);
            if($num_emails == 0){
                $msg = "DNI no encontrado";
            }else{
                for ($i=0; $i <$num_emails; $i++) {
                    $row = mysqli_fetch_array($result);
                    if(!(md5($pw) == $row["vet_contraseña"])){
                        $msg = "Contraseña incorrecta";
                    }
                    else{
                        session_start();
                        $_SESSION["Nombre"] = $row["vet_nombre"];
                        $_SESSION["DNI"] = $row["vet_id"];
                        $_SESSION["Logged"] = True;

                        if(isset($_SESSION["Logged"])){
                            header('Location: '.'../main.php');
                        }
                    }
                }
            }
            mysqli_close($conn);
        }
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
        <section id="section" class="centrado-vh">
            <a href="login.html">
                <button id="consultar">Volver a Intentar</button>
            </a>
        </section>
        <footer id="footer" class="centrado-vh">
            <span>Creado por Daniel Cifuentes</span>
        </footer>
    </main>
</body>
</html>