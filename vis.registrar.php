<?php

    require_once('Controlador/registro.php');

    $error = "";

    if(!empty($_POST['btnRegistrar'])){
        $nombres = $_POST['nombres'];
        $apellidos = $_POST['apellidos'];
        $username = $_POST['username'];
        $contrasena = $_POST['contrasena'];
        $correo = $_POST['correo'];
        $dui = $_POST['dui'];

        if(strlen(trim($nombres)) > 0 && strlen(trim($apellidos)) > 0 && strlen(trim($username)) > 0 &&  strlen(trim($contrasena)) > 0 && strlen(trim($correo)) > 0 && strlen(trim($dui)) > 0){
            $error = registroUsuario($nombres,$apellidos,$username,$contrasena,$correo,$dui);
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
            <h1>SIGN UP</h1>
            <input placeholder="Nombres" name="nombres" type="text" />
            <input placeholder="Apellidos" name="apellidos" type="text" />
            <input placeholder="Username" name="username" type="text" />
            <input placeholder="Contraseña" name="contrasena" type="password" />
            <input placeholder="Correo" name="correo" type="mail" />
            <input placeholder="DUI" name="dui" type="text" />
            <div class="boton">
                <input class="btn" type="submit" name="btnRegistrar" value="SIGN UP" />
            </div>
            <div class="errorMsg"><?php echo $error; ?></div>
            <p>¿Ya cuentas con una cuenta?, accede <a href="vis.login.php">AQUI</a></p>
        </form>
    </section>
    <section class="pic">
        <img src="img/icono_blanco2.png" alt="Logo">
    </section>
</body>
</html>