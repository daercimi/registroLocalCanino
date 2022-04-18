<?php
if (array_key_exists("Cancelar",$_POST)){
    ob_start();
    header('Location: '.'../index.html');
    ob_end_flush();
    die();
}

else{
    
    $msg = "";
    $check = False;

    $dni = $_POST['DNI'];
    $nombre = $_POST['Nombre'];
    $apellido = $_POST['Apellido'];
    $email = $_POST['Email'];
    $telefono = $_POST['Teléfono'];
    $pw = $_POST['pw'];

    $regexPw = "/^(?=.*[A-Z]{1,})(?=.*[0-9]{2,})(?=.*[#$%&?]{2,}).{8,}$/";
    $regexTel = "/([+]?)([0-9])/";

    if(!preg_match($regexPw, $pw)){
        $msg = "La contraseña debe tener al menos 8 caracteres, 1 letra mayúscula, 2 números y 2 caracteres especiales(#$%&?)";
    }
    else if(!preg_match($regexTel, $telefono)){
        $msg = "Solo se aceptan números en el teléfono";
    }
    else{
        $pw = md5($pw);

        $conn = mysqli_connect("sql10.freemysqlhosting.net", "sql10486087","aFXPWBC5ZG", "sql10486087");

        $sql = "INSERT INTO veterinario (vet_id, vet_nombre, vet_apellido, vet_correo, vet_telefono, vet_contrasena)";
        $sql .= " VALUES ('$dni','$nombre','$apellido','$email', '$telefono', '$pw')"; 
        if (mysqli_query($conn, $sql)) {
            $msg = "Registro correcto";
            $check = True;
        } else {
            $msg = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
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
    <link rel="stylesheet" href="../css/registrar.css"></link>

    <title>Registrate como veterinario</title>
</head>
<body>
    <header id="header" class="centrado-vh">
        <h1 id="bienvenido"><?php echo $msg?></h1>
    </header>
    <main id="main">
        <section id="section" class="centrado-vh">

            <a href="signup.html">
                <button id="registrar"><?php echo "Regresar al Registro"?></button>
            </a>
            <a href="../login/login.html">
                <button id="registrar"><?php echo "Ir al inicio de sesión"?></button>
            </a>

        </section>
    </main>

    <footer id="footer" class="centrado-vh">
        <span>Creado por Daniel Cifuentes</span>
    </footer>
</body>
</html>