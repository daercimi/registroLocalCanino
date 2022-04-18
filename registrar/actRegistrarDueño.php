
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



if (!array_key_exists("Registrar",$_POST)){
    ob_start();
    header('Location: '.'../main.php');
    ob_end_flush();
    die();
}

else{

  $mascota = json_decode($_COOKIE['mascota'], true);

  $msg = "";
  $reg = "";

  session_start();

  $v1 = $mascota['Dni'];
  $v2 = $_POST['Nombre'];
  $v3 = $_POST['Apellido'];
  $v4 = $_POST['Teléfono'];
  $v5 = $_POST['Correo'];

  if($v1 != NULL && $v2 != NULL && $v3 != NULL ){

    $conn = mysqli_connect("sql10.freemysqlhosting.net", "sql10486087","aFXPWBC5ZG", "sql10486087");
    if (!$conn) {
        die("Error de conexion: " . mysqli_connect_error());
    }

    //consulta SQL
    $sql = "INSERT INTO dueno (due_id, due_nombre, due_apellido, due_telefono, due_correo) ";
    $sql .= "VALUES ('$v1', '$v2', '$v3', '$v4', '$v5');";
    if (mysqli_query($conn, $sql)) { //inserción de dueño exitosa

      $v0 = $mascota['Dni'].'1';
      $v1 = $mascota['Dni'];
      $v2 = $mascota['Nombre'];
      $v3 = $mascota['Especie'];
      $v4 = $mascota['Raza'];
      $v5 = $mascota['FechaNac'];
      $v6 = $mascota['Genero'];
      $v7 = $mascota['Foto'];

      $result = (new UploadApi())->upload("../fotos_perros/".$v7);
      // Get the image URL
      $url = $result['url'];

      if($v1 != NULL && $v2 != NULL && $v3 != NULL && $v4 != NULL){

        $sql = "INSERT INTO mascota (mas_id, due_id, mas_nombre, mas_especie, mas_raza, mas_fechanac, mas_genero, mas_foto) ";
        $sql .= "VALUES ('$v0', '$v1', '$v2', '$v3', '$v4', '$v5' , '$v6','$url');";
        if (mysqli_query($conn, $sql)) {
            $msg = "Mascota registrado correctamente";
            $reg = "Registrar a otro mascota";
        }else {
            $msg = "Error SQL ". $sql . "<br>" . mysqli_error($conn);
            $reg = "Volver al registro de mascota";
        }
        
      }else{
          $msg = "Debe de ingresar dni, nombre, especie y raza ";
          $reg = "Volver al registro de mascota";
      }

    }
    else {
      //Registro de dueño fallido
        $msg = "Error al registrar dueño SQL ". $sql . "<br>" . mysqli_error($conn);
        $reg = "Volver al registro de mascota";
    }

  }else{
      $msg = "Debe de ingresar dni, nombre, apellido ";
      $reg = "Volver al registro de mascota";
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
            <a href="../consultar/consultar.html">
                <button id="consultar">Consultar en la BD</button>
            </a>
        </section>
        <footer id="footer" class="centrado-vh">
            <span>Creado por Daniel Cifuentes</span>
        </footer>
    </main>
</body>
</html>