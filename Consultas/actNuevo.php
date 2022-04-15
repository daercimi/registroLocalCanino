
<?php 
require '../vendor/autoload.php';
use Cloudinary\Configuration\Configuration;
use Cloudinary\Api\Upload\UploadApi;
Configuration::instance([
    'cloud' => [
      'cloud_name' => 'dlydyow9o', 
      'api_key' => '553968592227425', 
      'api_secret' => '-WPKZjnhX2VWZt7XtR3O5mECK5M'],
    'url' => [
      'secure' => true]]);



if (!array_key_exists("Ok",$_POST)){
    ob_start();
    header('Location: '.'consultas.php');
    ob_end_flush();
    die();
}

if(!isset($_SESSION["Logged"])){
    header("Location: ../index.html");
}

else{
    $msg = "";
    $reg = "";

    session_start();

    $v1 = $_REQUEST['Mascota'];
    $v2 = $_REQUEST['Fecha'];
    $v3 = $_SESSION['DNI'];
    $v4 = $_REQUEST['Diagnóstico'];
    $v5 = $_REQUEST['RayosX'];
    $v6 = $_REQUEST['ExamenSangre'];

    $conn = mysqli_connect("localhost", "root","", "RelocaDB");
    if (!$conn) {
        die("Error de conexion: " . mysqli_connect_error());
    }

    $urlRayosX = "";
    if($v5 != NULL){
        $result = (new UploadApi())->upload("../fotos_perros/".$v5);
        $urlRayosX = $result['url'];
    }
    $urlSangre = "";
    if($v6 != NULL){
        $result = (new UploadApi())->upload("../fotos_perros/".$v6);
        $urlSangre = $result['url'];
    }

    if($v1 != NULL && $v2 != NULL && $v3 != NULL && $v4 != NULL){
        $conn = mysqli_connect("localhost", "root","", "RelocaDB");
        if (!$conn) {
            die("Error de conexion: " . mysqli_connect_error());
        }
        //consulta SQL
        $sql = "INSERT INTO consulta (mas_id, vet_id, con_fecha, con_diagnostico, con_rayosX, con_examensangre, con_costo)";
        $sql .= "VALUES ('$v1', '$v3', '$v2', '$v4', '$urlRayosX', '$urlSangre', 20.00);";
        if (mysqli_query($conn, $sql)) {
            $msg = "Consulta registrada correctamente";
            $reg = "Registrar a otro consulta";
        } else {
            $msg = "Error SQL ". $sql . "<br>" . mysqli_error($conn);
            $reg = "Volver al registro de consulta";
        }
        mysqli_close($conn);
    }else{
        $msg = "Debe de ingresar mascota, fecha, veterinario y diagnóstico ";
        $reg = "Volver al registro de consulta/cita";
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
            <a href="formNuevaConsulta.php">
                <button id="registrar"><?php echo $reg?></button>
            </a>
            <a href="formRevisarConsultas.php">
                <button id="consultar">Revisar la consulta</button>
            </a>
        </section>
        <footer id="footer" class="centrado-vh">
            <span>Creado por Daniel Cifuentes</span>
        </footer>
    </main>
</body>
</html>