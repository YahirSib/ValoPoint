<?php

require_once('Controlador/registro.php');
$error = '';
session_start();

if(!isset($_SESSION['id_usuario'])){
    header("location: index.html");
}

if(!empty($_POST['btnNuevo'])){
    $numero = $_POST['numero'];
    $contrasena = $_POST['contrasena'];
    $tipo = $_POST['tipo'];
    $monto = $_POST['monto'];

    if(strlen(trim($numero)) > 0 && strlen(trim($contrasena)) > 0 && strlen(trim($tipo)) > 0 && strlen(trim($monto)) > 0){
        $error = registroCuenta($numero, $contrasena, $tipo, $monto);
    }else{
        $error = "Por favor llene los campos";
    }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/agregar.css">
    <title>Agregar Cuenta | ValoPoint</title>
</head>
<body>
    <nav id="menu" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a id="text" class="navbar-brand" href="dashboard.php">
                <img src="img/icono_color.png" alt="" width="60" height="60">
            </a>
            <button id="bot" class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
              <span id="ham" class="navbar-toggler-icon"></span>
            </button>
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
              <div class="offcanvas-header">
                <h5 id="h5" class="offcanvas-title" id="offcanvasNavbarLabel">ValoPoint</h5>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
              </div>
              <div class="offcanvas-body">
                <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
                  <li class="nav-item">
                    <a id="text" class="nav-link" href="vis.loginCuenta.php">Ingresar a Cuenta</a>
                  </li>
                  <li class="nav-item">
                    <a id="text" class="nav-link" href="vis.agregarCuenta.php">Agregar Cuenta</a>
                  </li>
                  <li class="nav-item">
                    <a id="text-active" class="nav-link active" href="Controlador/logout.php">Salir Perfil</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
    </nav>
    <article>
      <section class="tit">
        <h1>Crear</h1>
        <h1 class="sub">Cuenta</h1>
      </section>
      <section class="form">
        <form method="post" action="" name="nueva" enctype="multipart/form-data" >
            <label for="numero">Numero de la cuenta</label>
            <input type="text" name="numero" placeholder="xxxxxx-xxxxxx">
            <label for="contrasena">Contraseña</label>
            <input type="password" name="contrasena" placeholder="*****">
            <label for="tipo">Tipo de cuenta</label>
            <select name="tipo" id="tipo">
                <option value="Ahorro">Ahorro</option>
                <option value="Empresarial">Empresarial</option>
                <option value="Personal">Personal</option>
            </select>
            <label for="monto">Monto inicial</label>
            <input type="text" name="monto" placeholder="00.00">
            <div class="boton">
                <input class="btn" type="submit" name="btnNuevo" value="Crear">
            </div>
            <div class="errorMsg"><?php echo $error; ?></div>
        </form>
      </section>
    </article>
</body>
</html>