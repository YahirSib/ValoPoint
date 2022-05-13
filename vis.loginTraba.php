<?php
    require_once('Controlador/login.php');
    $error = '';

    if(!empty($_POST['btnLogin'])){
        $nombre = $_POST['nombre'];
        $contrasena = $_POST['contrasena'];

        if(strlen(trim($nombre)) > 1 && strlen(trim($contrasena)) > 1){
            $error = loginTraba($nombre,$contrasena);
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
    <link rel="stylesheet" href="css/login.css">
    <title>Login | ValoPoint</title>
</head>
<body>
    <section class="pic">
        <img src="img/icono_blanco2.png" alt="Logo">
    </section>
    <section class="form">
        <form method="post" name="login" action="vis.loginTraba.php">
            <h1>LOGIN TRABAJADOR</h1>
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="password" name="contrasena" placeholder="Contraseña">
            <div class="boton">
                <input class="btn" type="submit" name="btnLogin" value="Login">
            </div>
            <div class="errorMsg"><?php echo $error; ?></div>
        </form>
    </section>
    
</body>
</html>