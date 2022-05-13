<?php

require_once("Modelo/class.conexion.php");
require_once("Modelo/class.usuarios.php");
require_once("Modelo/class.cuenta.php");

session_start();

if(!isset($_SESSION['id_usuario'])){
  header("location: index.html");
}

$usuario = new Usuarios();
$detallesUsuario = $usuario->detallesUsuario($_SESSION["id_usuario"]);
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
    <link rel="stylesheet" href="css/dashboard.css">
    <title>Dashboard | ValoPoint</title>
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

    <header>
        <h1>Bienvenido <span><?php echo $detallesUsuario->Nombres;?></span></h1>
        <?php
          $cuenta = new Cuenta();
          $verCuentas = $cuenta->verCuentas($_SESSION["id_usuario"]);
          if($verCuentas == null){
            echo '<h1>No tienes <span>cuentas</span> registradas</h1>';
          }else{  
        ?>
        <table>
            <thead>
                <tr>
                    <th>Numero de Cuenta</th>
                    <th>Tipo de cuenta</th>
                    <th>Operaciones Gratis</th>
                    <th>% de Recargo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                      foreach ($verCuentas as $filas) {
                ?> 
                    <tr>
                        <td><?php echo $filas["Numero"]; ?></td>
                        <td><?php echo $filas["Tipo"]; ?></td>
                        <?php
                            if($filas["OperaGratis"] == null && $filas["Intereses"]== null){
                        ?>
                            <td>---</td>
                            <td>---</td>
                        <?php 
                            }else{
                        ?>
                            <td><?php echo $filas["OperaGratis"]; ?></td>
                            <td><?php echo $filas["Intereses"]; ?>%</td>
                        <?php
                            }
                        ?>
                        
                    </tr>
                <?php
                    }

                  }
                ?>
            </tbody>
        </table>

    </header> 
</body>
</html>