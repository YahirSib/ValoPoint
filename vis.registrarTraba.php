<?php

    require_once('Controlador/registro.php');
    require_once("Modelo/class.trabajador.php");

    $error = "";

session_start();

if(!isset($_SESSION['id_trabajador'])){
    header("location: index.html");
}

$trabajador = new Trabajador();
$detallesTraba = $trabajador->detallesTraba($_SESSION["id_trabajador"]);

if($detallesTraba->Cargo != "Jefe"){
    header("location: dashboard3.php");
}

    if(!empty($_POST['btnRegistrar'])){
        $nombre = $_POST['nombre'];
        $apellido = $_POST['apellido'];
        $contrasena = $_POST['contrasena'];
        $cargo = $_POST['cargo'];

        if(strlen(trim($nombre)) > 0 && strlen(trim($apellido)) > 0 && strlen(trim($cargo)) > 0 &&  strlen(trim($contrasena)) > 0){
            $error = registroTrabajador($nombre,$apellido,$cargo,$contrasena);
        }else{
            $error = "<h2>Por favor llene los campos</h2>";
        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/registro.css">
    <title>Registro | ValoPoint</title>
</head>
<body>
    <section class="form">
        <form method="post" action="" name="registro" enctype="multipart/form-data" >
            <h1>SIGN UP TRABAJADOR</h1>
            <input placeholder="Nombres" name="nombre" type="text" />
            <input placeholder="Apellido" name="apellido" type="text" />
            <input placeholder="Contraseña" name="contrasena" type="password" />
            <select name="cargo" id="Cargo">
                <option value="Jefe">Jefe</option>
                <option value="Administrador">Administrador</option>
            </select>
            <div class="boton">
                <input class="btn" type="submit" name="btnRegistrar" value="SIGN UP" />
            </div>
            <div class="errorMsg"><?php echo $error; ?></div>
        </form>
    </section>
    <section class="pic">
        <img src="img/icono_blanco2.png" alt="Logo">
    </section>
</body>
</html>