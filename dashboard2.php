<?php

require_once("Modelo/class.conexion.php");
require_once("Modelo/class.cuenta.php");

session_start();

if(!isset($_SESSION['id_cuenta']) || $_SESSION['id_cuenta'] == ''){
    header("location: dashboard.php");
}

$cuenta = new Cuenta();
$detallesCuenta = $cuenta->detallesCuenta($_SESSION["id_cuenta"]);

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
    <link rel="stylesheet" href="css/dashboard2.css">
    <title>Dashboard Cuenta | ValoPoint</title>
</head>
<body>
<nav id="menu" class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a id="text" class="navbar-brand" href="dashboard2.php">
                <img src="img/icono_blanco.png" alt="" width="60" height="60">
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
                    <a id="text" class="nav-link" href="vis.retiro.php">Retiro</a>
                  </li>
                  <li class="nav-item">
                    <a id="text" class="nav-link" href="vis.selectDeposito.php">Deposito</a>
                  </li>
                  <li class="nav-item">
                    <a id="text" class="nav-link" href="vis.reporte.php">Reporte</a>
                  </li>
                  <li class="nav-item">
                    <a id="text" class="nav-link" href="vis.saldoCuenta.php">Saldo</a>
                  </li>
                  <li class="nav-item">
                    <a id="text-active" class="nav-link active" href="Controlador/logoutCuenta.php">Cerrar Cuenta</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
    </nav>
    <header>
        <div class="titulo">
            <h1>Cuenta Ingresada:</h1>
            <h1 class="num"><?php echo $detallesCuenta->Numero;?></h1>
        </div>
        <a class="btn" href="Controlador/logoutCuenta.php">Cerrar Sesión</a>
    </header>
</body>
</html>